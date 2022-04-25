<?php

use Illuminate\Support\Facades\Route;

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


    return view('auth.login');
})->middleware('guest');

Auth::routes();



Route::middleware(['auth'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::group(['middleware' => ['role:Employee|Admin']],function() {


        Route::get('/categories', [\App\Http\Livewire\CategoriesController::class, '__invoke'])->name('categories');

        Route::get('/products', [\App\Http\Livewire\ProductsController::class, '__invoke'])->name('products');

        Route::get('/sales', [\App\Http\Livewire\PosController::class, '__invoke'])->name('sales');



        });
    Route::group(['middleware' => ['role:Admin']],function() {
        Route::get('/roles', [\App\Http\Livewire\RolesController::class, '__invoke'])->name('roles');

        Route::get('/permisos', [\App\Http\Livewire\PermisosController::class, '__invoke'])->name('permisos');

        Route::get('/asignar', [\App\Http\Livewire\AsignarController::class, '__invoke'])->name('asignar');

        Route::get('/users', [\App\Http\Livewire\UsersController::class, '__invoke'])->name('users');

        Route::get('/cashput', [\App\Http\Livewire\CashoutController::class, '__invoke'])->name('cashouts');

        Route::get('/reportes', [\App\Http\Livewire\ReportsController::class, '__invoke'])->name('reports');
    });
//Reportes Pdf
Route::get('/report/pdf/{user}/{type}/{f1}/{f2}', [\App\Http\Controllers\ExportController::class, 'reportPDF']);
Route::get('/report/pdf/{user}/{type}', [\App\Http\Controllers\ExportController::class, 'reportPDF']);

//Reportes excel
Route::get('/report/excel/{user}/{type}/{f1}/{f2}', [\App\Http\Controllers\ExportController::class, 'reporteExcel']);
Route::get('/report/excel/{user}/{type}', [\App\Http\Controllers\ExportController::class, 'reporteExcel']);


});
