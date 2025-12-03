<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminReservaController;
use App\Http\Controllers\CanchaPublicController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Solo usuarios logueados pueden entrar al index
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->name('home');

    // Canchas
    Route::get('/canchas', [CanchaController::class,'index'])->name('canchas.index');
    Route::get('/crear_cancha', [CanchaController::class,'create']);
    Route::post('/canchas', [CanchaController::class,'store'])->name('canchas.store');
   Route::get('detalle/{id}', [CanchaPublicController::class, 'show'])->name('detalle.cancha');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show');
    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
});
Route::get('/admin/dashboard', [AdminProfileController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');
    Route::middleware(['auth','admin'])->group(function(){
    Route::get('/crear_cancha', [CanchaController::class, 'create'])->name('crear_cancha');
         Route::get('admin/canchaAdmi', [CanchaController::class, 'indexAdmin'])->name('canchaA');
    Route::post('admin/canchaAdmi', [CanchaController::class, 'store'])->name('canchaA.store');
    Route::get('admin/canchaAdmi/{id}/edit', [CanchaController::class, 'edit'])->name('canchaA.edit');

    Route::put('admin/canchaAdmi/{id}', [CanchaController::class, 'update'])->name('canchaA.update');
    Route::delete('admin/canchaAdmi/{id}', [CanchaController::class, 'destroy'])->name('canchaA.destroy');

     Route::get('admin/profile', [\App\Http\Controllers\AdminProfileController::class, 'show'])->name('admin.profile');
    Route::get('admin/profile/edit', [\App\Http\Controllers\AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile/update', [\App\Http\Controllers\AdminProfileController::class, 'update'])->name('admin.profile.update');

        Route::get('admin/reservas', [App\Http\Controllers\AdminReservaController::class, 'index'])
        ->name('admin.reservas');
        
    Route::delete('admin/reservas/{id}', [App\Http\Controllers\AdminReservaController::class, 'destroy'])
        ->name('admin.reservas.destroy');



    

});




require __DIR__.'/auth.php';

