<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotosController;

Route::get('/', function () {
    return view('frontend.home');
});


Route::get('/registro', [UserController::class, 'registro'])->name('registro');
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/autenticar', [UserController::class, 'autenticar'])->name('autenticar');
Route::post('/cadastrar', [UserController::class, 'cadastrar'])->name('cadastrar');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('backend')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');
    Route::get('/categorias/get', [CategoriaController::class, 'getCategorias'])->name('get.categorias');
    Route::post('/categorias/add', [CategoriaController::class, 'cadastrar'])->name('add.categoria');
    Route::post('/categorias/update/', [CategoriaController::class, 'update'])->name('update.categoria');
    Route::post('/categorias/trash/', [CategoriaController::class, 'deletar'])->name('categorias.deletar');
    Route::get('/categorias/get-by-id/{id}', [CategoriaController::class, 'getById'])->name('categorias.getById');


    Route::get('/fotos', [FotosController::class, 'index'])->name('fotos');
    Route::get('/fotos/get-all', [FotosController::class, 'getAll'])->name('fotos.get.all');
    Route::post('/fotos/trash/', [FotosController::class, 'deletar'])->name('fotos.deletar');
    Route::post('/fotos/add', [FotosController::class, 'addFotos'])->name('fotos.add');

    Route::get('/usuarios', [UserController::class, 'home'])->name('usuarios');
    Route::post('/usuarios/trash/', [UserController::class, 'deletar'])->name('usuarios.deletar');
    Route::get('/usuarios/get', [UserController::class, 'getAll'])->name('usuarios.get.all');
    Route::post('/usuarios/add', [UserController::class, 'cadastrar'])->name('usuarios.add');

});