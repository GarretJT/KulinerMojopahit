<?php

use App\Gallery;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return redirect('/home'); });
Route::get('/home', 'UserController@home')->name('home');
Route::get('/blog', 'UserController@blog')->name('blog');
Route::get('/blog/{slug}', 'UserController@show_article')->name('blog.show');
Route::get('/destination', 'UserController@destination')->name('destination');
Route::get('/destination/{slug}', 'UserController@show_destination')->name('destination.show');
// Define route for displaying menus of a specific tenant (destination)
Route::get('/destination/{slug}/menus', [UserController::class, 'showTenantMenus'])->name('destination.menu');

Route::get('/contact', 'UserController@contact')->name('contact');
// Route for showing all souvenirs
Route::get('/suvenir', 'UserController@suvenir')->name('suvenir');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route for showing a specific souvenir by ID
Route::get('/suvenir/{id}', 'UserController@show_suvenir')->name('suvenir.show');

Route::prefix('admin')->group(function(){

    Route::get('/', function(){
        return view('auth/login');
    });

    // Handle route register
    Auth::routes();

    Route::get('/register', function() {
        return redirect('/admin/login'); // Redirect to login
        // Or use abort(404) to show a 404 error
    });

    // Route Dashboard
    Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
  
    // Route for souvenirs
    Route::post('/suvenirs/upload', 'SuvenirController@upload')->name('suvenirs.upload')->middleware('auth');
    Route::resource('/suvenirs', 'SuvenirController')->middleware('auth');
  
    // Route categories
    Route::get('/categories/{category}/restore', 'CategoryController@restore')->name('categories.restore');
    Route::delete('/categories/{category}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
    Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
    Route::resource('categories', 'CategoryController')->middleware('auth');
  
    // Route articles
    Route::post('/articles/upload', 'ArticleController@upload')->name('articles.upload')->middleware('auth');
    Route::resource('/articles', 'ArticleController')->middleware('auth');
  
    // Route destinations
    Route::resource('/destinations', 'DestinationController')->middleware('auth');
    
    // Route about
    Route::get('/abouts', 'AboutController@index')->name('abouts.index')->middleware('auth');
    Route::get('/abouts/{about}/edit', 'AboutController@edit')->name('abouts.edit')->middleware('auth');
    Route::put('/abouts/{about}', 'AboutController@update')->name('abouts.update')->middleware('auth');

    Route::resource('/menu', 'MenuController')->middleware('auth'); // This will create all menu routes, including 'edit'
    Route::post('/menu/upload', 'MenuController@upload')->name('menus.upload')->middleware('auth');
    
    Route::resource('/gallery', 'GalleryController')->middleware('auth');
      
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

});
