<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

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
// Route::prefix('categorie')->group(function () {
// Route::get('concert', [EventTypeController::class, 'concert'])->name('categorie.concert');
// Route::get('conference', [EventTypeController::class, 'conference'])->name('categorie.conference');
// Route::get('exposition', [EventTypeController::class, 'exposition'])->name('categorie.exposition');
// });
// route cart
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');

//   route payement
Route::middleware('auth')->group(function () {
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::resource('admin/events', EventController::class);
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/reservations', [AdminController::class, 'showReservations'])->name('admin.reservations');
    Route::get('/utilisateurs', [AdminController::class, 'showUsers'])->name('admin.utilisateurs');
Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{event}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{event}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{event}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('categories',[EventypeController::class,'index'])->name('categorie');


       // Route pour afficher la liste des types d'événements
       Route::get('/eventTypes', [EventypeController::class,'index'])->name('admin.eventTypes.index');
       Route::get('/eventTypes/create', [EventypeController::class, 'create'])->name('admin.eventTypes.create');
       Route::post('/eventTypes', [EventypeController::class, 'store'])->name('admin.eventTypes.store');
       Route::get('/eventTypes/{id}/edit', [EventypeController::class, 'edit'])->name('admin.eventTypes.edit');
       Route::put('/eventTypes/{id}', [EventypeController::class, 'update'])->name('admin.eventTypes.update');
       Route::delete('/eventTypes/{id}', [EventypeController::class,'destroy'])->name('admin.eventTypes.destroy');
});




require __DIR__.'/auth.php';
