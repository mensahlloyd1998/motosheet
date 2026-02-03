<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Car;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    //

    public function initialize(Request $request, Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);
    
        if ($car->is_paid) {
            return response()->json([
                'message' => 'This car is already paid for.'
            ], 409);
        }
    
        $reference = 'CAR_' . $car->id . '_' . Str::uuid();
    
        $amount = config('services.car_page_charge') * 100; // pesewas
    
        $response = Http::withToken(config('services.paystack.secret'))
            ->post('https://api.paystack.co/transaction/initialize', [
                'email' => auth()->user()->email,
                'amount' => $amount,
                'reference' => $reference,
                'callback_url' => route('paystack.callback'),
                'metadata' => [
                    'car_id' => $car->id,
                    'user_id' => auth()->id(),
                ],
            ]);
    
            if (! $response->successful()) {
                logger()->error('Paystack init failed', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);
            
                return response()->json([
                    'message' => $response->json()['message'] ?? 'Paystack error'
                ], 500);
            }
    
        return response()->json([
            'authorization_url' => $response['data']['authorization_url']
        ]);
    }
    

    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        abort_if(! $reference, 404);

        $response = Http::withToken(env('PAYSTACK_SECRET'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        if (! $response->successful() || $response['data']['status'] !== 'success') {
            return redirect()
                ->route('cars.index')
                ->withErrors('Payment verification failed.');
        }

        $metadata = $response['data']['metadata'];

        $car = Car::findOrFail($metadata['car_id']);

        if (! $car->is_paid) {
            $car->update([
                'is_paid'            => true,
                'paid_at'            => now(),
                'payment_reference'  => $reference,
                'status'             => Car::STATUS_ACTIVE,
            ]);

            try{
                // create successful payment record 
                Payment::create([
                    'user_id' => auth()->user()->id,
                    'car_id' => $car->id,
                    'amount' => config('services.car_page_charge'),
                    'currency' => 'GHS',
                    'payment_method' => 'paystack',
                    'payment_reference' => $reference,
                    'status' => 'successful',
                    'paid_at' => now(),
                ]);

            }catch(Exception $e){
                // log the error and proceed
                logger()->error('Failed to create payment record', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        return redirect()
            ->route('cars.index')
            ->with('success', 'Payment successful. Your car is now live.');
    }
}
