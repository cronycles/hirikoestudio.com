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

Route::get('/', ['as' => 'index', 'uses' => 'PagesController@index']);

//projects
Route::get(__('routes.projects'), ['as' => 'projects', 'uses' => 'PagesController@projects']);
Route::get('projects/{id}', ['as' => 'projects.show', 'uses' => 'PagesController@projectShow']);

//contact
Route::get(__('routes.contact'), ['as' => 'contact', 'uses' => 'PagesController@contact']);
Route::post('contact', ['as' => 'contact.send', 'uses' => 'ContactController@send']);


//Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//Confirm Password Routes
Route::get('password/confirm', ['as' => 'password.confirm', 'uses' => 'Auth\ConfirmPasswordController@showConfirmForm']);
Route::post('password/confirm', ['as' => 'password.confirm', 'uses' => 'Auth\ConfirmPasswordController@confirm']);

//Forgot Password Routes...
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);

Route::post('password/reset', ['as' => 'password.update', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

//Registration Routes...
//Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth', ['as' => 'auth', 'uses' => 'Auth\AuthPagesController@index']);

    //Auth Categories
    Route::get('/auth/categories', ['as' => 'auth.categories', 'uses' => 'Auth\AuthPagesController@categories']);
    Route::get('/auth/categories/create', ['as' => 'auth.categories.create', 'uses' => 'Auth\AuthPagesController@categoryCreate']);
    Route::get('/auth/categories/{id}/edit', ['as' => 'auth.categories.edit', 'uses' => 'Auth\AuthPagesController@categoryEdit']);
    Route::get('/auth/categories/sort', ['as' => 'auth.categories.sort', 'uses' => 'Auth\AuthPagesController@categoriesSort']);

    Route::post('/auth/categories/create', ['as' => 'auth.categories.create', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@store']);
    Route::post('/auth/categories/{id}/edit', ['as' => 'auth.categories.update', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@update']);
    Route::delete('/auth/categories/{id}', ['as' => 'auth.categories.delete', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@delete']);

    Route::post('/auth/categories/sort', ['as' => 'auth.categories.sort', 'uses' => 'Auth\Categories\AuthCategoriesSortingController@updateSort']);


    //Auth Projects
    Route::get('/auth/projects', ['as' => 'auth.projects', 'uses' => 'Auth\AuthPagesController@projects']);
    Route::get('/auth/projects/create', ['as' => 'auth.projects.create', 'uses' => 'Auth\AuthPagesController@projectCreate']);
    Route::get('/auth/projects/{id}/edit', ['as' => 'auth.projects.edit', 'uses' => 'Auth\AuthPagesController@projectEdit']);
    Route::get('/auth/projects/sort', ['as' => 'auth.projects.sort', 'uses' => 'Auth\AuthPagesController@projectsSort']);
    Route::get('/auth/projects/{id}/images', ['as' => 'auth.projects.images', 'uses' => 'Auth\AuthPagesController@projectImages']);

    Route::post('/auth/projects/create', ['as' => 'auth.projects.create', 'uses' => 'Auth\Projects\AuthProjectsCrudController@store']);
    Route::post('/auth/projects/{id}/edit', ['as' => 'auth.projects.update', 'uses' => 'Auth\Projects\AuthProjectsCrudController@update']);
    Route::delete('/auth/projects/{id}', ['as' => 'auth.projects.delete', 'uses' => 'Auth\Projects\AuthProjectsCrudController@delete']);

    Route::post('/auth/projects/sort', ['as' => 'auth.projects.sort', 'uses' => 'Auth\Projects\AuthProjectsSortingController@updateSort']);

    Route::post('/auth/projects/{id}/images', ['as' => 'auth.projects.images.upload', 'uses' => 'Auth\Projects\AuthProjectsImagesController@uploadImages']);
    Route::post('/auth/projects/{id}/images-sort', ['as' => 'auth.projects.imagesSort', 'uses' => 'Auth\Projects\AuthProjectsImagesController@updateImagesSort']);
    Route::delete('/auth/projects/{id}/images/{imageId}', ['as' => 'auth.projects.images.delete', 'uses' => 'Auth\Projects\AuthProjectsImagesController@deleteImage']);

    Route::post('/auth/projects/{id}/images/{imageId}/small-view', ['as' => 'auth.projects.images.changeSmallView', 'uses' => 'Auth\Projects\AuthProjectsImagesController@changeSmallView']);

});

