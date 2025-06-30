<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController; // Asegúrate de que esta línea esté presente

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    // Rutas de perfil de usuario (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para la gestión de Álbumes
    Route::get('/albumes', [AlbumController::class, 'index'])->name('album.mostrar');
    Route::get('/albumes/crear', [AlbumController::class, 'create'])->name('album.create');
    Route::post('/albumes', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/albumes/{album}/editar', [AlbumController::class, 'getActualizar'])->name('album.getActualizar');
    Route::put('/albumes/{album}', [AlbumController::class, 'postActualizar'])->name('album.postActualizar');

    // Rutas para la gestión de Fotos
    // CAMBIO IMPORTANTE AQUÍ: La ruta para ver fotos ahora es '/fotos'
    // y el 'album_id' se pasará como un parámetro de consulta (ej. /fotos?album_id=1).
    // Esto se adapta a tu FotoController@index actual sin modificarlo.
     // Rutas para la gestión de Fotos
    Route::get('/fotos', [FotoController::class, 'index'])->name('foto.index');

    // Rutas para añadir fotos a un álbum específico
    // El {album} es para Route Model Binding en el método create y store de FotoController
    Route::get('/album/{album}/fotos/crear', [FotoController::class, 'create'])->name('foto.create');
    Route::post('/album/{album}/fotos', [FotoController::class, 'store'])->name('foto.store');

    // Rutas para editar y actualizar fotos específicas
    // El {foto} es para Route Model Binding en los métodos edit y update de FotoController
    Route::get('/fotos/{foto}/editar', [FotoController::class, 'edit'])->name('foto.edit');
    Route::put('/fotos/{foto}', [FotoController::class, 'update'])->name('foto.update');

    // Opcional: Ruta para eliminar una foto
    Route::delete('/fotos/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');
});

// Incluye las rutas de autenticación de Laravel Breeze (login, register, etc.)
require __DIR__.'/auth.php';
