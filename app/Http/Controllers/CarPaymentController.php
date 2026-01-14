<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CarPaymentController extends Controller
{
    public function initialize(Request $request, Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);
    
        if ($car->is_paid) {
            return response()->json([
                'message' => 'This car is already paid for.'
            ], 409);
        }
    
        $reference = 'CAR_' . $car->id . '_' . Str::uuid();
    
        $amount = 90 * 100; // pesewas
    
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
        }

        return redirect()
            ->route('cars.index')
            ->with('success', 'Payment successful. Your car is now live.');
    }



}
