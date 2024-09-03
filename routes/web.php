<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\EventypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
// routes client
Route::get('/', [PageController::class , 'index'])->name('indexx') ;
Route::get('/ap', [AproposController::class , 'index'])->name('index') ;
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit') ;
Route::get('/recherche', [EventController::class, 'search'])->name('recherche');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');

// Routes pour les types d'événements
Route::prefix('categorie')->group(function () {
Route::get('concert', [EventypeController::class, 'concert'])->name('categorie.concert');
Route::get('conference', [EventypeController::class, 'conference'])->name('categorie.conference');
Route::get('exposition', [EventypeController::class, 'art'])->name('categorie.exposition');
});

// route cart
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');

//   route payement
Route::middleware('auth')->group(function () {
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
    Route::get('/confirmation/success', function() { return view('confirmation');})->name('confirmation.success');
});

// API Routes
Route::post('/notify-admin', [NotificationController::class, 'notifyAdmin']);
Route::post('/notify-user', [NotificationController::class, 'notifyUser']);

// Routes admin pour la gestion des evenements
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::resource('admin/events', EventController::class);
Route::prefix('admin')->group(function () {
    Route::get('/events', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{event}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{event}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{event}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/reservations', [AdminController::class, 'showReservations'])->name('admin.reservations');
    Route::put('/reservations/{id}', [AdminController::class, 'updateReservationStatus'])->name('admin.reservations.update');
    Route::get('/utilisateurs', [AdminController::class, 'showUsers'])->name('admin.utilisateurs');
    Route::get('categories',[EventypeController::class,'index'])->name('categorie');
 // Route pour afficher la liste des types d'événements
       Route::get('/eventTypes', [EventypeController::class,'index'])->name('admin.eventTypes.index');
       Route::get('/eventTypes/create', [EventypeController::class, 'create'])->name('admin.eventTypes.create');
       Route::post('/eventTypes', [EventypeController::class, 'store'])->name('admin.eventTypes.store');
       Route::get('/eventTypes/{id}/edit', [EventypeController::class, 'edit'])->name('admin.eventTypes.edit');
       Route::put('/eventTypes/{id}', [EventypeController::class, 'update'])->name('admin.eventTypes.update');
       Route::delete('/eventTypes/{id}', [EventypeController::class,'destroy'])->name('admin.eventTypes.destroy');
});
// Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::post('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::get('/reservation/{id}/ticket', [ReservationController::class, 'showTicket'])->name('reservations.ticket');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');

});



require __DIR__.'/auth.php';
