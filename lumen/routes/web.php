<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
 * cambio empleado search employee
 */
$router->get('/cambio_empleado/search_empleado', 'CambioEmpleadoController@searchEmpleado');

/*
 * crud cambio empleado
 */
$router->get('/cambio_empleado', 'CambioEmpleadoController@index');
$router->get('/cambio_empleado/{id}/show', 'CambioEmpleadoController@show');
$router->post('/cambio_empleado/store', 'CambioEmpleadoController@store');
$router->post('/cambio_empleado/delete', 'CambioEmpleadoController@delete');


/*
 * crud horarios
 */
$router->get('/horarios', 'HorariosController@index');
$router->get('/horarios/{id}/show', 'HorariosController@show');
$router->post('/horarios/store', 'HorariosController@store');
$router->post('/horarios/delete', 'HorariosController@delete');

/*
 * crud rutas
 */
$router->get('/rutas', 'RutasController@index');
$router->get('/rutas/{id}/show', 'RutasController@show');
$router->post('/rutas/store', 'RutasController@store');
$router->post('/rutas/delete', 'RutasController@delete');

/*
 * search horario y autobus
 */
$router->get('/rutas/search_horario', 'RutasController@searchHorario');
$router->get('/rutas/search_autobus', 'RutasController@searchAutobus');