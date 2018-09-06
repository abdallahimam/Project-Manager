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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    Route::post('companies/adduser', 'CompaniesController@addUser')->name('companies.adduser');
    Route::resource('companies', 'CompaniesController');
    Route::post('projects/adduser', 'ProjectsController@addUser')->name('projects.adduser');
    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::resource('projects', 'ProjectsController');
    Route::post('tasks/adduser', 'TasksController@addUser')->name('tasks.adduser');
    Route::resource('tasks', 'TasksController');
    Route::resource('roles', 'RolesController');
    Route::resource('comments', 'CommentsController');
    Route::get('/posts', function() {
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://jsonplaceholder.typicode.com/comments');
        return json_decode($res->getBody(), true);
    });

    Route::post('upload/file', 'UploadController@upload');
    Route::post('upload/files', 'UploadController@upload_multiple');

});

Route::group(['middleware' => 'admin'], function () {
    Route::post('users/deleteSelected', 'UsersController@deleteSelected')->name('users.deleteSelected');
    Route::resource('users', 'UsersController');
});

Route::get('/about', function() {
    return view('layouts.about');
});
Route::get('/contact', function() {
    return view('layouts.contact');
});



