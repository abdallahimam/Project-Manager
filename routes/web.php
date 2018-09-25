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
    if (auth()->user()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function() {
    return view('layouts.about');
});
Route::get('/contact', function() {
    return view('layouts.contact');
});

Route::middleware(['auth'])->group(function () {

    /**
     * manual route
     */
    Route::post('companies/adduser', 'CompaniesController@addUser')->name('companies.adduser');
    Route::post('companies/delete', 'CompaniesController@delete')->name('companies.delete');
    Route::post('companies/restore', 'CompaniesController@restore')->name('companies.restore');
    Route::post('companies/force_delete', 'CompaniesController@force_delete')->name('companies.force_delete');
    Route::post('projects/adduser', 'ProjectsController@addUser')->name('projects.adduser');
    Route::post('projects/delete', 'ProjectsController@delete')->name('projects.delete');
    Route::post('projects/restore', 'ProjectsController@restore')->name('projects.restore');
    Route::post('projects/force_delete', 'ProjectsController@force_delete')->name('projects.force_delete');
    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('tasks/adduser', 'TasksController@addUser')->name('tasks.adduser');
    Route::post('tasks/delete', 'TasksController@delete')->name('tasks.delete');
    Route::post('tasks/restore', 'TasksController@restore')->name('tasks.restore');
    Route::post('tasks/force_delete', 'TasksController@force_delete')->name('tasks.force_delete');
    Route::get('tasks/create/{project_id?}', 'TasksController@create')->name('tasks.create');
    
    Route::get('/posts', function() {
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        return json_decode($res->getBody(), true);
    });

    Route::post('upload/file', 'UploadController@upload');
    Route::post('upload/files', 'UploadController@upload_multiple');

    //Route::get('/users/profile/{id?}', 'UsersController@show');
    //Route::get('/users/profile/{id?}/edit', 'UsersController@edit');
    //Route::post('/users/profile/update', 'UsersController@update');

    Route::post('users/delete', 'UsersController@delete')->name('users.delete');
    Route::post('users/restore/{user_id?}', 'UsersController@restore')->name('users.restore');
    Route::post('users/force_delete/{user_id?}', 'UsersController@force_delete')->name('users.force_delete');

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/help', 'HomeController@help');
    Route::get('/settings', 'HomeController@settings');
    /**
     * resources
     */
    Route::resource('companies', 'CompaniesController');
    Route::resource('projects', 'ProjectsController');
    Route::resource('tasks', 'TasksController');
    Route::resource('roles', 'RolesController');
    Route::resource('comments', 'CommentsController');
    Route::resource('users', 'UsersController');

});

Route::group(['middleware' => ['admin']], function () {

    Route::post('users/deleteSelected', 'UsersController@deleteSelected')->name('users.deleteSelected');

    Route::get('admin/all/companies', 'AdminController@get_all_companies');
    Route::get('admin/all/projects', 'AdminController@get_all_projects');
    Route::get('admin/all/tasks', 'AdminController@get_all_tasks');

    Route::get('/admin/send/mail', 'AdminController@send_mail');

});

Route::get('/hello', function () {
    if (Gate::allows('admin', auth()->user())) {
        return 'Hello From Admin Gate.';
    } else {
        return 'you are not the admin to say show welcome message.';
    }
});




