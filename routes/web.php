<?php

use App\Http\Middleware\AdminCheckMiddleWare;
use App\Http\Middleware\UserCheckMiddleWare;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin#profile');
        } else {

            return redirect()->route('user#index');
        }
    }
})->name('dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => AdminCheckMiddleWare::class], function () {
    Route::get('profile', 'ProfileController@showProfile')->name('admin#profile');
    Route::get('category', 'CategoryController@category')->name('admin#category');
    Route::get('add-category', 'CategoryController@addCategory')->name('admin#add-category');
    Route::post('create-category', 'CategoryController@createCategory')->name('admin#create-category');
    Route::get('category-items/{id}', 'CategoryController@getCategoryItem')->name('admin#category#items');
    Route::get('pizza', 'PizzaController@pizza')->name('admin#pizza');
    Route::get('user', 'AdminController@user')->name('admin#user');
    Route::get('order', 'OrderController@order')->name('admin#order');
    Route::get('carrier', 'AdminController@carrier')->name('admin#carrier');
    Route::get('confirm-delete/{id}', 'CategoryController@confirmDelete')->name('admin#confirm-delete');
    Route::get('delete/{id}', 'CategoryController@delete')->name('admin#delete');
    Route::get('edit/{id}', 'CategoryController@edit')->name('admin#edit');
    Route::post('update/{id}', 'CategoryController@update')->name('admin#update');
    Route::get('category-search', 'CategoryController@search')->name('admin#search');
    Route::get('add-pizza', 'PizzaController@addPizza')->name('admin#add#pizza');
    Route::post('create-pizza', 'PizzaController@createPizza')->name('admin#create#pizza');
    Route::get('p-confirm-delete/{id}', 'PizzaController@confirmDelete')->name('admin#p-confirm-delete');
    Route::post('p-delete/{id}', 'PizzaController@delete')->name('admin#p#delete');
    Route::get('pizza-info/{id}', 'PizzaController@pizzaInfo')->name('admin#pizza#info');
    Route::get('pizza-edit/{id}', 'PizzaController@pizzaedit')->name('admin#pizza#edit');
    Route::post('pizza-update/{id}', 'PizzaController@pizzaupdate')->name('admin#pizza#update');
    Route::get('pizza-search', 'PizzaController@pizzaSearch')->name('admin#pizza#search');
    Route::get('profild-edit/{id}', 'ProfileController@editProfile')->name('admin#edit#profile');
    Route::post('profile-update/{id}', 'ProfileController@updateProfile')->name('admin#update#profile');
    Route::post('profile-passowrd-update/{id}', 'ProfileController@updatePassword')->name('admin#profile#update#password');
    Route::get('profile-passowrd-change/{id}', 'ProfileController@changePasswordView')->name('admin#profile#change#password');
    Route::get('user-list', 'UserController@userView')->name('admin#user#list');
    Route::get('admin-list', 'UserController@adminView')->name('admin#admin#list');
    Route::get('admin-user-search', 'UserController@userSearch')->name('admin#user#search');
    Route::get('admin-user-confirm-delete/{d}', 'UserController@confrimDelete')->name('admin#user#confirm#delete');
    Route::get('admin-user-delete/{d}', 'UserController@userDelete')->name('admin#user#delete');
    Route::get('admin-admin-search', 'UserController@adminSearch')->name('admin#admin#search');
    Route::get('admin-admin-confirm-delete/{d}', 'UserController@confrimAdminDelete')->name('admin#admin#confirm#delete');
    Route::get('admin-admin-delete/{d}', 'UserController@adminDelete')->name('admin#admin#delete');
    Route::get('admin-order-search', 'OrderController@orderSearch')->name('admin#order#search');
    Route::get('admin-category-download', 'CategoryController@categoryDownload')->name('admin#category#download');
    Route::get('admin-pizza-download', 'PizzaController@pizzaDownload')->name('admin#pizza#download');
    Route::get('admin-order-download', 'OrderController@orderDownload')->name('admin#order#download');

});
Route::group(['prefix' => 'user', 'namespace' => 'user', 'middleware' => UserCheckMiddleWare::class], function () {
    Route::get('home', 'UserController@home')->name('user#index');
    Route::get('pizza-details/{id}', 'UserController@pizzaDetails')->name('user#pizza#details');
    Route::post('contact', 'ContactController@createContact')->name('user#contact');
    Route::get('category-search/{id}', 'UserController@categorySearch')->name('user#category#search');
    Route::get('pizza-search', 'UserController@searchPizza')->name('user#pizza#search');
    Route::get('search-pizza-items', 'UserController@searchPizzaByItem')->name('user#pizza#search#items');
    Route::get('order', 'UserController@orderPage')->name('user#order');
    Route::post('order-post', 'UserController@placeorder')->name('user#place#order');

});

//Custom
Route::get('admin-contatct-list', 'user\ContactController@getContactList')->name('admin#contact#list')->middleware(AdminCheckMiddleWare::class);
Route::get('admin-contatct-search', 'user\ContactController@contactSearch')->name('admin#contact#search')->middleware(AdminCheckMiddleWare::class);
