<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/admin');
});

Auth::routes();

Route::get('/register', function () {
    abort(403, 'Registro no permitido'); // O redirigir a otra ruta
})->name('register'); 

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home')->middleware('auth');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//rutas para configuraciones
Route::get('/admin/configuraciones', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth');
Route::post('/admin/configuraciones/create', [App\Http\Controllers\ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth');

//rutas para gestiones
Route::get('/admin/gestiones', [App\Http\Controllers\GestionController::class, 'index'])->name('admin.gestiones.index')->middleware('auth');
Route::get('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'create'])->name('admin.gestiones.create')->middleware('auth');
Route::post('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'store'])->name('admin.gestiones.store')->middleware('auth');
Route::get('/admin/gestiones/{id}/edit', [App\Http\Controllers\GestionController::class, 'edit'])->name('admin.gestiones.edit')->middleware('auth');
Route::put('/admin/gestiones/{id}', [App\Http\Controllers\GestionController::class, 'update'])->name('admin.gestiones.update')->middleware('auth');
Route::delete('/admin/gestiones/{id}', [App\Http\Controllers\GestionController::class, 'destroy'])->name('admin.gestiones.destroy')->middleware('auth');

//rutas para carreras
Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin.carreras.index')->middleware('auth');
Route::get('/admin/carreras/create', [App\Http\Controllers\CarreraController::class, 'create'])->name('admin.carreras.create')->middleware('auth');
Route::post('/admin/carreras/create', [App\Http\Controllers\CarreraController::class, 'store'])->name('admin.carreras.store')->middleware('auth');
Route::get('/admin/carreras/{id}/edit', [App\Http\Controllers\CarreraController::class, 'edit'])->name('admin.carreras.edit')->middleware('auth');
Route::put('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'update'])->name('admin.carreras.update')->middleware('auth');
Route::delete('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('admin.carreras.destroy')->middleware('auth');

//rutas para niveles
Route::get('/admin/niveles', [App\Http\Controllers\NivelController::class, 'index'])->name('admin.niveles.index')->middleware('auth');
Route::get('/admin/niveles/create', [App\Http\Controllers\NivelController::class, 'create'])->name('admin.niveles.create')->middleware('auth');
Route::post('/admin/niveles/create', [App\Http\Controllers\NivelController::class, 'store'])->name('admin.niveles.store')->middleware('auth');
Route::get('/admin/niveles/{id}/edit', [App\Http\Controllers\NivelController::class, 'edit'])->name('admin.niveles.edit')->middleware('auth');
Route::put('/admin/niveles/{id}', [App\Http\Controllers\NivelController::class, 'update'])->name('admin.niveles.update')->middleware('auth');
Route::delete('/admin/niveles/{id}', [App\Http\Controllers\NivelController::class, 'destroy'])->name('admin.niveles.destroy')->middleware('auth');

//rutas para materias
Route::get('/admin/materias', [App\Http\Controllers\MateriaController::class, 'index'])->name('admin.materias.index')->middleware('auth');
Route::get('/admin/materias/create', [App\Http\Controllers\MateriaController::class, 'create'])->name('admin.materias.create')->middleware('auth');
Route::post('/admin/materias/create', [App\Http\Controllers\MateriaController::class, 'store'])->name('admin.materias.store')->middleware('auth');
Route::get('/admin/materias/{id}', [App\Http\Controllers\MateriaController::class, 'show'])->name('admin.materias.show')->middleware('auth');
Route::get('/admin/materias/{id}/edit', [App\Http\Controllers\MateriaController::class, 'edit'])->name('admin.materias.edit')->middleware('auth');
Route::put('/admin/materias/{id}', [App\Http\Controllers\MateriaController::class, 'update'])->name('admin.materias.update')->middleware('auth');
Route::delete('/admin/materias/{id}', [App\Http\Controllers\MateriaController::class, 'destroy'])->name('admin.materias.destroy')->middleware('auth');

//rutas para roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth'); 
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

//rutas para administrativos
Route::get('/admin/administrativos', [App\Http\Controllers\AdministrativoController::class, 'index'])->name('admin.administrativos.index')->middleware('auth'); 
Route::get('/admin/administrativos/create', [App\Http\Controllers\AdministrativoController::class, 'create'])->name('admin.administrativos.create')->middleware('auth');
Route::post('/admin/administrativos/create', [App\Http\Controllers\AdministrativoController::class, 'store'])->name('admin.administrativos.store')->middleware('auth');
Route::get('/admin/administrativos/{id}', [App\Http\Controllers\AdministrativoController::class, 'show'])->name('admin.administrativos.show')->middleware('auth');
Route::get('/admin/administrativos/{id}/edit', [App\Http\Controllers\AdministrativoController::class, 'edit'])->name('admin.administrativos.edit')->middleware('auth');
Route::put('/admin/administrativos/{id}', [App\Http\Controllers\AdministrativoController::class, 'update'])->name('admin.administrativos.update')->middleware('auth');
Route::delete('/admin/administrativos/{id}', [App\Http\Controllers\AdministrativoController::class, 'destroy'])->name('admin.administrativos.destroy')->middleware('auth');
