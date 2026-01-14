<?php

namespace App\Http\Controllers;

use App\Models\CarImage;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CarImageController extends Controller
{
    public function index(Car $car)
    {
        abort_if($car->user_id !== auth()->id(), 403);

        return response()->json([
            'images' => $car->images->map(fn ($img) => [
                'id' => $img->id,
                'url' => asset('storage/' . $img->image_path),
                'is_cover' => $img->is_cover,
            ])
        ]);
    }

    
    public function destroy(CarImage $image)
    {
        $car = $image->car;

        // Ownership check
        if ($car->user_id !== auth()->id()) {
            abort(403);
        }

        // Minimum image rule
        if ($car->images()->count() <= 5) {
            throw ValidationException::withMessages([
                'images' => 'A car must have at least 5 images.',
            ]);
        }

        // Delete file
        Storage::disk('public')->delete($image->image_path);

        // Delete record
        $image->delete();

        // Ensure there is still a cover image
        if (!$car->images()->where('is_cover', true)->exists()) {
            $car->images()->first()?->update(['is_cover' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function setCover(CarImage $image)
    {
        $car = $image->car;

        // Ownership check
        if ($car->user_id !== auth()->id()) {
            abort(403);
        }

        // Reset old cover
        $car->images()->update(['is_cover' => false]);

        // Set new cover
        $image->update(['is_cover' => true]);

        return response()->json(['success' => true]);
    }
}
