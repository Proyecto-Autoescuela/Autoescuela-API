<?php

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

Auth::routes([ 'register' => false ]);

//Views menus
Route::middleware('auth:web')->get('/users', 'HomeController@index')->name('users');
Route::middleware('auth:web')->get('/users/teachers', 'HomeController@teachers')->name('teachers');
Route::middleware('auth:web')->get('/users/admins', 'HomeController@admins')->name('admins');
Route::middleware('auth:web')->get('/units', 'HomeController@units')->name('units');
Route::middleware('auth:web')->get('/tests', 'HomeController@tests')->name('tests');
Route::middleware('auth:web')->get('/options', 'HomeController@options')->name('options');

// Rutas funcionalidades students
Route::middleware('auth:web')->get('/users/students/search', 'StudentController@listByName');
Route::middleware('auth:web')->post('/users/students/add','StudentController@addStudent');
// Route::middleware('auth:web')->put('/users/students/modify','StudentController@updateStudent');
Route::middleware('auth:web')->delete('/users/students/delete','StudentController@deleteStudent');

// Rutas funcionalidades teachers
Route::middleware('auth:web')->get('/users/teachers/search', 'TeacherController@listByName');
Route::middleware('auth:web')->post('/users/teachers/add', 'TeacherController@addTeacher');
Route::middleware('auth:web')->put('/users/teachers/modify', 'TeacherController@updateTeacher');
Route::middleware('auth:web')->delete('/users/teachers/delete', 'TeacherController@deleteTeacher');

// Rutas funcionalidades admins
Route::middleware('auth:web')->get('/users/admins/search', 'UserController@listByName');
Route::middleware('auth:web')->post('/users/admins/add', 'UserController@addAdmin');
Route::middleware('auth:web')->put('/users/admins/modify', 'UserController@updateAdmin');
Route::middleware('auth:web')->delete('/users/admins/delete', 'UserController@deleteAdmin');

// Rutas funcionalidades units
Route::middleware('auth:web')->get('/units/search', 'UnitController@listByName');
Route::middleware('auth:web')->post('/units/add','UnitController@addUnit');
Route::middleware('auth:web')->put('/units/update','UnitController@updateUnit');
Route::middleware('auth:web')->delete('/units/delete','UnitController@deleteUnit');

//Rutas funcionalidades unit content
Route::middleware('auth:web')->get('/units/unitcontent/search', 'UnitContentController@listByName');
Route::middleware('auth:web')->post('/units/unitcontent/add','UnitContentController@addUnitContent');
Route::middleware('auth:web')->put('/units/unitcontent/update','UnitContentController@updateUnitContent');
Route::middleware('auth:web')->delete('/units/unitcontent/delete','UnitContentController@deleteUnitContent');

//Rutas funcionalidades tests
Route::middleware('auth:web')->get('/tests/search', 'UnitContentController@listByName');
Route::middleware('auth:web')->post('/tests/add','UnitContentController@addTest');
Route::middleware('auth:web')->put('/tests/update','UnitContentController@updateTest');
Route::middleware('auth:web')->delete('/tests/delete','UnitContentController@deleteTest');


Route::get('prueba', 'TestController@generateTest');
Route::get('prueba2', 'TestController@listForPass');