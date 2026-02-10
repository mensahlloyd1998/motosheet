<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarPaymentController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicCarController;
use App\Http\Controllers\ProfileController;

// Landing Page
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Public car page (Carfolio page)
Route::get('/car/{car:slug}', [PublicCarController::class, 'show'])
    ->name('cars.public.show');

// Submit inquiry / offer
Route::post('/car/{car:slug}/inquiry', [InquiryController::class, 'store'])
    ->name('cars.inquiry.store');

// Route::get('/dashboard', function () {
//     return view('luno.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::middleware(['auth', 'verified'])->group(function () {

    // Seller dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Car Management
    |--------------------------------------------------------------------------
    */

    // Cars list
    Route::get('/cars', [CarController::class, 'index'])
    ->name('cars.index');

    Route::get('/cars/{car}/show', [CarController::class, 'show'])
    ->name('cars.show');

    // Create car listing
    Route::get('/cars/create', [CarController::class, 'create'])
        ->name('cars.create');

    Route::post('/cars', [CarController::class, 'store'])
        ->name('cars.store');

    // Edit car
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])
        ->name('cars.edit');

    Route::put('/cars/{car}', [CarController::class, 'update'])
        ->name('cars.update');

    // Delete car
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])
        ->name('cars.destroy');

    Route::get('/cars/{car}/get-details', [CarController::class, 'get'])
    ->name('cars.get');


    Route::get('/cars/{car}/qr', [CarController::class, 'qr'])
    ->name('cars.qr');

    Route::post('/cars/{car}/status', [CarController::class, 'updateStatus']);

    Route::post('/cars/{car}/activate-after-payment', [CarController::class, 'activateAfterPayment']);

    Route::get('/cars/{car}/images', [CarImageController::class, 'index'])
    ->name('cars.images.index');

    Route::delete('/cars/images/{image}', [CarImageController::class, 'destroy'])
    ->name('cars.images.destroy');

    Route::post('/cars/images/{image}/set-cover', [CarImageController::class, 'setCover'])
    ->name('cars.images.setCover');


    /*
    |--------------------------------------------------------------------------
    | Car Images
    |--------------------------------------------------------------------------
    */

    Route::post('/cars/{car}/images', [CarImageController::class, 'store'])
        ->name('cars.images.store');

    Route::delete('/cars/images/{image}', [CarImageController::class, 'destroy'])
        ->name('cars.images.destroy');


    /*
    |--------------------------------------------------------------------------
    | Offer Management
    |--------------------------------------------------------------------------
    */
    Route::get('/offers', [InquiryController::class, 'offers'])->name('offers.index');
    


    /*
    |--------------------------------------------------------------------------
    | Payments
    |--------------------------------------------------------------------------
    */

    // Initiate payment for a car page
    Route::get('/cars/{car}/pay', [PaymentController::class, 'create'])
        ->name('payments.create');

    Route::post('/cars/{car}/pay', [PaymentController::class, 'initialize'])
    ->name('cars.pay');

    Route::get('/payments/paystack/callback', [PaymentController::class, 'callback'])
        ->name('paystack.callback');

    /*
    |---------------------------------------------------------------------------
    | Car Payments
    |---------------------------------------------------------------------------
    */
    // Route::get('/payments', [CarPaymentController::class, 'index'])->name('payments.index');

    // Route::post('/payments', [CarPaymentController::class, 'store'])->name('payments.store');

    

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/poster', [ProfileController::class, 'poster'])->name('profile.poster');
    Route::post('/profile/poster', [ProfileController::class, 'updatePoster'])->name('profile.updatePoster');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';