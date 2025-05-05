<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [UsuarioController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::get('/signin', [UsuarioController::class, 'create']);
Route::post('/signin', [UsuarioController::class, 'store']);

Route::delete('/usuario/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

Route::get('/crear-evento', function () {
    return view('formCreaEvento');
});

Route::get('/miseventos', function () {
    return view('perfilAlumno');
});

Route::get('/detalle-evento', function () {
    return view('detalleEvento');
});


Route::middleware(['auth'])->group(function (){
    Route::get('/home', function () {
        $user = Auth::user();

        return view('home', compact('user'));
    });
});


