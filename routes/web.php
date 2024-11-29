<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\TurnoController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SurtidorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TanqueController;

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


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/precios',[WelcomeController::class,'precios']);
Route::get('/quienessomos', [WelcomeController::class, 'quienessomos'])->name('quienessomos');
Route::get('/licencias', [WelcomeController::class, 'licencias'])->name('licencias');


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user'])->prefix('user')->namespace('User')->group(function () {
	Route::get('/turnonuevo',[TurnoController::class, 'turnonuevo'])->name('turno.nuevo'); 						//crear un turno nuevo
	Route::get('/turno/editaforadores/{id}/edit',[TurnoController::class, 'editaforadores'])->name('editaaforadores'); //Editar aforadores
	Route::post('/turnonuevo',[TurnoController::class, 'crearturno'])->name('turno.crear');						//Crear un turno nuevo
	Route::post('/aforadores', [TurnoController::class, 'storeaforadores'])->name('aforadores'); 					//Registrar los aforadores
	Route::get('/turno/edit/{id}', [TurnoController::class, 'editarturno'])->name('showturno');					//Editar Turno
	Route::get('/turno/cerrarturno/{id}', [TurnoController::class, 'cerrarturno'])->name('showcierreturno');			//Llamada al form para Cerrar Turno
	Route::post('/turno/cerrarturno', [TurnoController::class, 'confirmarcierreturno'])->name('cerrarturno');		//Confirmar cierre de turno
    Route::get('/turno/cierres/pdf/{id}', [TurnoController::class, 'cierreAforadoresPDF'])->name('formcierretopdf');   //Generar pdf
    Route::get('/turno/cierres/imprimir/{id}', [TurnoController::class, 'imprimircierre'])->name('imprimircierre');   //Generar pdf
    Route::get('/turnoscheck', [TurnoController::class, 'turnocheck'])->name('admin.turnoscheck');   //Control de Cierres de Turnos

});

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
	//Productos
	Route::get('/products',[ProductController::class, 'index'])->name('admin.products');				            //LIsta de Productos
	Route::get('/products/create',[ProductController::class, 'create'])->name('admin.product.create');	        //LIsta de Productos
	Route::post('/products',[ProductController::class, 'store'])->name('admin.product.store');			        //Registrar alta del Producto
	Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');            //Actualizar datos del producto
	Route::get('/products/{id}/edit',[ProductController::class, 'edit'])->name('admin.products.edit');           //Editar productos
    Route::delete('/products/{id}/delete', [productController::class, 'delete'])->name('admin.product.delete');   //vproducto para eliminar

	//Surtidores
	Route::get('/surtidors',[SurtidorController::class, 'index'])->name('admin.surtidors');           			    //LIsta de Surtidores
    Route::get('/surtidors/create', [SurtidorController::class, 'create'])->name('admin.surtidors.create');           //vista creacion de surtidor
    Route::post('/surtidors', [SurtidorController::class, 'store'])->name('admin.surtidors.store');              //Registrar surtidor en la BD
	Route::get('/surtidors/{id}/edit', [SurtidorController::class, 'edit'])->name('admin.surtidors.edit');    	    //Edita Surtidor
	Route::put('/surtidors/update/{id}', [SurtidorController::class, 'update'])->name('admin.surtidors.update');	    //Update Surtidor
    Route::delete('/surtidors/{id}/delete', [SurtidorController::class, 'delete'])->name('admin.surtidors.delete');   //Delete surtidor
    Route::get('/surtidors/{id}/tanque/change', [SurtidorController::class, 'changetanque'])->name('admin.surtidors.changetanque');
    Route::put('/surtidors/{id}/tanque/change', [SurtidorController::class, 'updatetanque'])->name('admin.surtidors.updatetanque');

	//Route::get('/turnonuevo',[TurnoController::class, 'turnonuevo']); 						//crear un turno nuevo

	//Route::post('/turnonuevo',[TurnoController::class, 'crearturno']);						//Crear un turno nuevo
	//Route::post('/aforadores', [TurnoController::class, 'storeaforadores']); 					    //Registrar los aforadores
	Route::get('/turno/edit/{id}', [TurnoController::class, 'editarturno'])->name('editarturno');		//Editar Turno
    Route::put('/turno/edit/{id}', [TurnoController::class, 'update'])->name('updateturno');          //Update turno
	//Route::get('/turno/cerrarturno/{id}', [TurnoController::class, 'cerrarturno']);			//Llamada al form para Cerrar Turno
	//Route::post('/turno/cerrarturno', [TurnoController::class, 'confirmarcierreturno']);		//Confirmar cierre de turno
    Route::post('/verificaraforador', [TurnoController::class, 'verificaraforador'])->name('verificaraforador');   //Control de Cierres de Turnos
    Route::post('/actualizaraforador', [TurnoController::class, 'actualizaraforador'])->name('actualizaraforador');   //Control de Cierres de Turnos

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');


//     Route::get('/tanques', [TanqueController::class, 'index'])->name('tanques.index');
//     Route::get('/tanques/create', [TanqueController::class, 'create'])->name('tanques.create');
//     Route::post('/tanques/store/{id}', [TanqueController::class, 'store'])->name('tanques.store');
// //    Route::put('/tanques/update/{id}', [TanqueController::class, 'update'])->name('tanques.update');
//     Route::put('/tanques/{id}/update', [TanqueController::class, 'update'])->name('tanques.update');

//     Route::delete('/tanques/destroy/{id}', [TanqueController::class, 'destroy'])->name('tanques.destroy');
//     Route::get('/tanques/edit/{id}', [TanqueController::class, 'edit'])->name('tanques.edit');

     Route::get('/tanques/surtidores/{id}', [TanqueController::class, 'surtidores'])->name('tanques.surtidores');
     Route::delete('/tanques/surtidores/{id}', [TanqueController::class, 'quitardeltanque'])->name('tanques.surtidores.destroy');
     Route::post('tanques/{tanque_id}/surtidores/add/{surtidor_id}', [TanqueController::class, 'addSurtidor'])->name('tanques.surtidores.add');


    //Route::resource('/user', UserController::class);
/*
    //Tanques

*/
    Route::get('/page-expired', function () {
        return view('exceptions/errors419');
    })->name('custom-419-page');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('tanques', TanqueController::class);
});
// Route::get('/', function () {
//     return view('welcome');
// });
