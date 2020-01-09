<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@vista')->middleware('evaluar.rol')->name('home');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function()
{
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::group(['prefix' => 'second_register', 'middleware' => 'second.register'], function()
    {
        Route::get('/vista_registrar', 'SecondRegisterController@vista')->name('second_register');
        Route::get('/selec_sucursales', 'SecondRegisterController@sucursalesEnEmpresa');

        Route::post('/registrar', 'SecondRegisterController@accionRegistrar');
        Route::post('/eliminar', 'SecondRegisterController@accionEliminar');
    });
});

// Rutas para Gerente General.
Route::group(['prefix' => 'gg', 'namespace' => 'GG', 'middleware' => 'gerente.general'], function()
{
    Route::get('/home', 'HomeController@vista')->name('gg_home');

    Route::group(['prefix' => 'productos', 'namespace' => 'Productos'], function()
    {
        Route::get('/vista_registrar', 'RegistrarController@vista')->name('gg_prod_registrar');
        Route::get('/marcas', 'RegistrarController@marcasEnProveedor');
        Route::get('/estadisticas/vista_estadisticas', 'EstadisticaController@vista')->name('gg_prod_estadisticas');
        
        Route::post('/registrar', 'RegistrarController@accion');
        Route::get('/estadisticas/vista_estadisticas/prod_empresa', 'EstadisticaController@productosEnEmpresa');
        Route::post('/estadisticas/vista_grafico', 'EstadisticaController@accion');
    });
});

// Rutas para Gerente Sucursal.
Route::group(['prefix' => 'gs', 'namespace' => 'GS', 'middleware' => 'gerente.sucursal'], function()
{
    Route::get('/home', 'HomeController@vista')->name('gs_home');

    Route::group(['prefix' => 'productos', 'namespace' => 'Productos'], function()
    {
        Route::get('/vista_registrar', 'RegistrarController@vista')->name('gs_prod_registrar');
        Route::get('/vista_modificar', 'ModificarController@vista')->name('gs_prod_modificar');
        Route::get('/vista_listar', 'ListarController@vista')->name('gs_prod_listar');
        Route::get('/vista_buscar', 'BuscarController@vista')->name('gs_prod_buscar');
        Route::get('/vista_stock_critico', 'ListarCriticosController@vista')->name('gs_stock_critico');
        Route::get('/vista_orden_compra/paso_1', 'OrdenCompraController@vista')->name('gs_orden_compra');
        Route::get('/vista_orden_compra/paso_1/prod_proveedor', 'OrdenCompraController@productosDeProveedor');
        Route::get('/vista_registro_inventario','RegistroInventarioController@vista')->name('gs_registro_inventario');

        Route::post('/vista_orden_compra/paso_2', 'OrdenCompraController@productosSeleccionados');
        Route::post('/vista_orden_compra/paso_3', 'OrdenCompraController@cantidadesProductos');
        Route::post('/vista_orden_compra/confirmar_orden', 'OrdenCompraController@accion');
        Route::post('/registrar', 'RegistrarController@accion');
        Route::post('/modificar', 'ModificarController@accion');
        Route::post('/listar', 'ListarController@accion');
        Route::post('/buscar', 'BuscarController@accion');
    });
});

// Rutas para Bodeguero.
Route::group(['prefix' => 'bo', 'namespace' => 'BO', 'middleware' => 'bodeguero'], function()
{
    Route::get('/home', 'HomeController@vista')->name('bo_home');

    Route::group(['prefix' => 'productos', 'namespace' => 'Productos'], function()
    {
        Route::get('/vista_ingresar', 'IngresarController@vista')->name('bo_prod_ingresar');
        Route::get('/prod_sucursal', 'IngresarController@productoEnSucursal');

        Route::get('/ingresar', 'IngresarController@accion')->name('ingresar');
    });
});

// Rutas para Cajero.
Route::group(['prefix' => 'ca', 'namespace' => 'CA', 'middleware' => 'cajero'], function()
{
    Route::get('/home', 'HomeController@vista')->name('ca_home');

    Route::group(['prefix' => 'ventas', 'namespace' => 'Ventas'], function()
    {
        Route::get('/vista_registrar', 'RegistrarController@vista')->name('ca_venta_registrar');

        Route::post('/agregar', 'RegistrarController@agregar');
        Route::post('/eliminar', 'RegistrarController@eliminar');
        Route::post('/cancelar', 'RegistrarController@cancelar');
        Route::post('/limpiar', 'RegistrarController@limpiar');
        Route::post('/registrar', 'RegistrarController@accion');
    });
});
