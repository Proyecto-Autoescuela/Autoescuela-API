<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

//CRUD Estudiantes
Route::middleware('auth:api')->get('/students','StudentController@listAllStudent');
Route::middleware('auth:api')->get('/students/teacher/{id}','StudentController@listByTeacher');
Route::middleware('auth:api')->post('/students/add','StudentController@addStudent');
Route::middleware('auth:api')->put('/students/update/{id}','StudentController@updateStudent');
Route::middleware('auth:api')->delete('/students/delete/{id}','StudentController@deleteStudent');

//CRUD Profesores
Route::middleware('auth:api')->get('/teachers','TeacherController@listAllTeacher');
Route::middleware('auth:api')->post('/teachers/add','TeacherController@addTeacher');
Route::middleware('auth:api')->put('/teachers/update/{id}','TeacherController@updateTeacher');
Route::middleware('auth:api')->delete('/teachers/delete/{id}','TeacherController@deleteTeacher');

//CRUD User
Route::middleware('auth:api')->get('/users','UserController@listAllUser');
Route::middleware('auth:api')->post('/users/add','UserController@addUser');
Route::middleware('auth:api')->put('/users/update/{id}','UserController@updateUser');
Route::middleware('auth:api')->delete('/users/delete/{id}','UserController@deleteUser');

// Login App
Route::middleware('auth:api')->get('/loginApp','AppLoginController@logingApp');

// CRUD UnitContent    
Route::middleware('auth:api')->get('/unitcontent', 'UnitContentController@listAllUnitContent');
Route::middleware('auth:api')->get('/unitcontent/{id}', 'UnitContentController@listByID');
Route::middleware('auth:api')->get('/unitcontent/unit/{id}', 'UnitContentController@findByID2');

// CRUD Unit
Route::middleware('auth:api')->get('/unit', 'UnitController@listAllUnits');
Route::middleware('auth:api')->get('/unit/{id}', 'UnitController@findByID');
// //Filtros AppLoginController
// Route::middleware('auth:api')->get('/students/{$license}', 'StudentController@listByLicense');
//Route::get('estadistica/{idAlumno}/{idUnidad}', 'TestController@generateTest');
Route::post('prueba/add/{idStudent}/{idUnit}/{calification}', 'TestController@saveTest');
Route::get('prueba', 'TestController@generateTest');
Route::get('prueba2', 'TestController@generateTestUnit');
Route::get('prue/{idAlumno}', 'TestController@porcentajeUnit');