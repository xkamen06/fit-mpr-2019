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
    return redirect('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'DashboardController@index')->name('home');

    Route::get('/projekty', 'ProjectController@index')->name('project.index');

    Route::get('/projekt/{projectId}', 'ProjectController@detail')->name('project.detail');

    Route::get('/projekty/vytvorit', 'ProjectController@create')->name('project.create');

    Route::post('projekty/ulozit', 'ProjectController@store')->name('project.save');

    Route::get('projekty/upravit/{projectId}', 'ProjectController@edit')->name('project.edit');

    Route::post('projekty/update/{projectId}', 'ProjectController@update')->name('project.update');

    Route::get('projekty/status/upravit/{projectId}', 'ProjectController@editStatus')->name('project.status.edit');

    Route::post('projekty/status/update/{projectId}', 'ProjectController@updateStatus')->name('project.status.update');


    Route::get('/uzivatele', 'UserController@index')->name('user.index');

    Route::get('uzivatel/{userId}', 'UserController@detail')->name('user.detail');

    Route::get('uzivatele/upravit/{userId}', 'UserController@edit')->name('user.edit');

    Route::post('uzivatele/update/{userId}', 'UserController@update')->name('user.update');

    Route::get('/uzivatele/vytvorit', 'UserController@create')->name('user.create');

    Route::post('uzivatele/ulozit', 'UserController@store')->name('user.save');


    Route::post('projekty/komentar/pridat/{projectId}', 'NoteController@create')->name('note.create');


    Route::get('projekty/faze/vsechny/{projectId}', 'PhaseController@index')->name('phase.index');

    Route::get('projekty/faze/upravit/{phaseId}', 'PhaseController@edit')->name('phase.edit');

    Route::post('projekty/faze/update/{phaseId}', 'PhaseController@update')->name('phase.update');

    Route::get('projekty/faze/zmenit/{projectId}', 'PhaseController@changePhase')->name('phase.change');

    Route::post('projekty/faze/zmenit/{projectId}', 'PhaseController@changeUpdatePhase')->name('phase.change.update');
    
    /**
     * Routes for file handling
     */
    Route::get('soubor/{file}', 'FileController@show')->name('file.download');
    Route::get('soubor/{file}/smazat', 'FileController@destroy')->name('file.delete');
});



