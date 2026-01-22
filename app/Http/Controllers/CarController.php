<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Rule;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;




class CarController extends Controller
{
    //
    public function index(Request $request)
    {
        // $cars = Car::with('images')
        // ->where('user_id', auth()->id())
        // ->orderByDesc('id')
        // ->get();

        // Build the query for cars
        $cars = Car::with('images')
        ->where('user_id', auth()->id())
        ->when($request->search, function($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->orderByDesc('id')
        ->get();

        return view('luno.cars.index', compact('cars'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'make'           => ['required', 'string', 'max:255'],
            'model'          => ['required', 'string', 'max:255'],
            'year'           => ['required', 'integer', 'min:1900', 'max:' . now()->year],
            'trim'           => ['nullable', 'string', 'max:255'],
            'color'          => ['nullable', 'string', 'max:255'],
            'transmission'   => ['required', 'in:manual,automatic'],
            'fuel_type'      => ['required', 'in:petrol,diesel,hybrid,electric'],
            'mileage'        => ['required', 'integer', 'min:0'],
            'condition'      => ['required', 'in:new,used,foreign_used'],
            'price'          => ['required', 'numeric', 'min:0'],
            'is_negotiable'  => ['required', 'boolean'],
            'description'    => ['required', 'string'],

            // Require images array with at least 5 files
            'images'         => ['required', 'array', 'min:5'],
            'images.*'       => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'features'   => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
        
        ]);

        DB::transaction(function () use ($validated, $request) {

            // 1. Generate title
            $title = trim("{$validated['year']} {$validated['make']} {$validated['model']} {$validated['trim']}");

            // 2. Generate unique slug
            $baseSlug = Str::slug($title);
            $slug = $baseSlug. '-' . now()->timestamp;
            $count = 1;

            while (
                Car::where('user_id', auth()->id())
                    ->where('slug', $slug)
                    ->exists()
            ) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }

            // 3. Create car
            $car = Car::create([
                'user_id'        => auth()->id(),
                'title'          => $title,
                'slug'           => $slug,
                'make'           => $validated['make'],
                'model'          => $validated['model'],
                'trim'           => $validated['trim'],
                'exterior_color' => $validated['color'],
                'year'           => $validated['year'],
                'price'          => $validated['price'],
                'price_type'     => $validated['is_negotiable'] ? 'negotiable' : 'fixed',
                'mileage'        => $validated['mileage'],
                'transmission'   => $validated['transmission'],
                'fuel_type'      => $validated['fuel_type'],
                'condition'      => $validated['condition'],
                'description'    => $validated['description'],
                'status'         => 'draft',
                'expires_at'     => now()->addDays(30),
                'features' => array_values(
                    array_filter($validated['features'] ?? [])
                )
            ]);

            // 4. Save images
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');

                CarImage::create([
                    'car_id'    => $car->id,
                    'image_path'=> $path,
                ]);
            }
        });

        return redirect()
            ->route('cars.index')
            ->with('success', 'Car page created successfully.');
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make'           => ['required', 'string', 'max:255'],
            'model'          => ['required', 'string', 'max:255'],
            'year'           => ['required', 'integer', 'min:1900', 'max:' . now()->year],
            'trim'           => ['nullable', 'string', 'max:255'],
            'color'          => ['nullable', 'string', 'max:255'],
            'transmission'   => ['required', 'in:manual,automatic'],
            'fuel_type'      => ['required', 'in:petrol,diesel,hybrid,electric'],
            'mileage'        => ['required', 'integer', 'min:0'],
            'condition'      => ['required', 'in:new,used,foreign_used'],
            'price'          => ['required', 'numeric', 'min:0'],
            'is_negotiable'  => ['required', 'boolean'],
            'description'    => ['required', 'string'],
            'images.*'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);
    
        DB::transaction(function () use ($request, $validated, $car) {
    
            /**
             * 1. Ensure minimum image count (existing + new)
             */
            $existingImagesCount = $car->images()->count();
            $newImagesCount = $request->hasFile('images')
                ? count($request->file('images'))
                : 0;
    
            if (($existingImagesCount + $newImagesCount) < 5) {
                throw ValidationException::withMessages([
                    'images' => 'A minimum of 5 images is required for each vehicle.',
                ]);
            }
    
            /**
             * 2. Regenerate title ONLY if identity changes
             */
            $identityChanged =
                $car->make !== $validated['make'] ||
                $car->model !== $validated['model'] ||
                $car->year !== $validated['year'] ||
                $car->trim !== $validated['trim'];
    
            if ($identityChanged) {
                $title = trim(
                    "{$validated['year']} {$validated['make']} {$validated['model']} {$validated['trim']}"
                );
    
                $car->title = $title;
                // NOTE: slug intentionally NOT changed
            }
    
            /**
             * 3. Update car record
             */
            $car->update([
                'make'           => $validated['make'],
                'model'          => $validated['model'],
                'trim'           => $validated['trim'],
                'exterior_color' => $validated['color'],
                'year'           => $validated['year'],
                'price'          => $validated['price'],
                'price_type'     => $validated['is_negotiable'] ? 'negotiable' : 'fixed',
                'mileage'        => $validated['mileage'],
                'transmission'   => $validated['transmission'],
                'fuel_type'      => $validated['fuel_type'],
                'condition'      => $validated['condition'],
                'description'    => $validated['description'],
            ]);
    
            /**
             * 4. Handle new images (append only)
             */
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('cars', 'public');
    
                    CarImage::create([
                        'car_id'    => $car->id,
                        'image_path'=> $path,
                    ]);
                }
            }
        });
    
        return redirect()
            ->route('cars.index')
            ->with('success', 'Car page updated successfully.');
    }
    


    public function get(Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);

        $car->load('images');

        return response()->json([
            'car' => $car,
        ]);
        
        
    }

    public function destroy(Car $car)
    {
        // Security: ensure ownership
        abort_if($car->user_id !== auth()->id(), 403);

        // DB::transaction(function () use ($car) {

        //     foreach ($car->images as $image) {
        //         if (Storage::disk('public')->exists($image->image_path)) {
        //             Storage::disk('public')->delete($image->image_path);
        //         }
        //     }
        //     $car->images()->delete();

        //     /**
        //      * 3. Delete the car
        //      */
        //     $car->delete();
        // });

        $car->delete();

        return response()->json([
            'message' => 'Vehicle deleted successfully.'
        ]);
    }


    public function updateStatus(Request $request, Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);

        $request->validate([
            // 'status' => ['required', Rule::in(Car::statuses())],
            'status' => ['required', 'in:draft,active,paused,expired,sold']
        ]);

        $newStatus = $request->status;

        // DRAFT → ACTIVE requires payment
        if (
            $car->status === Car::STATUS_DRAFT &&
            $newStatus === Car::STATUS_ACTIVE &&
            ! $car->is_paid
        ) {
            return response()->json([
                'requires_payment' => true,
                'message' => 'Payment required to activate listing.',
            ], 402);
        }

        // Prevent invalid transitions
        if ($car->status === Car::STATUS_ACTIVE && $newStatus === Car::STATUS_DRAFT) {
            abort(403, 'Invalid status transition');
        }

        $car->update(['status' => $newStatus]);

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $car->status,
        ]);
    }


    public function activateAfterPayment(Request $request, Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);

        $request->validate([
            'payment_reference' => 'required|string',
        ]);

        // OPTIONAL: verify PaySwitch reference here

        $car->update([
            'status' => Car::STATUS_ACTIVE,
            'is_paid' => true,
            'paid_at' => now(),
            'payment_reference' => $request->payment_reference,
        ]);

        return response()->json([
            'message' => 'Listing activated successfully',
        ]);
    }

    public function qr(Request $qr, Car $car)
    {

        $url = route('cars.public.show', ['car'=> $car->slug]);
    
        $filename = 'qr_' . uniqid();
        $qrPath = "qrcodes/{$filename}.svg";
    
        // Generate & save QR PNG
        $qrImage = QrCode::format('svg')
        ->size(800)
        ->color(93, 106, 124)           // #5D6A7C
        ->backgroundColor(253, 253, 253) 
        ->generate($url);
    
        Storage::disk('public')->put("qrcodes/{$filename}.svg", $qrImage);
    
        // Generate PDF
        $pdf = Pdf::loadView('luno.cars.qr-pdf', [
            'qr'  => storage_path("app/public/{$qrPath}"),
            'url' => $url,
            'contact' => auth()->user()->phone ? str_replace('+233', '0', auth()->user()->phone) : null
        ]);

        
    
        return $pdf->download('qr-code.pdf');
    }



    
}
