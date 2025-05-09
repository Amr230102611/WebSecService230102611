<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\SocialAuthController;

Route::get('register', [UsersController::class, 'register'])->name('register');
Route::post('register', [UsersController::class, 'doRegister'])->name('do_register');
Route::get('login', [UsersController::class, 'login'])->name('login');
Route::post('login', [UsersController::class, 'doLogin'])->middleware('throttle:5,1')->name('do_login');
Route::get('logout', [UsersController::class, 'doLogout'])->name('do_logout');

// Social Login Routes
Route::get('auth/redirect/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('auth/callback/{provider}', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::get('users', [UsersController::class, 'list'])->name('users');
Route::get('profile/{user?}', [UsersController::class, 'profile'])->name('profile');
Route::get('users/edit/{user?}', [UsersController::class, 'edit'])->name('users_edit');
Route::post('users/save/{user}', [UsersController::class, 'save'])->name('users_save');
Route::get('users/delete/{user}', [UsersController::class, 'delete'])->name('users_delete');
Route::get('users/edit_password/{user?}', [UsersController::class, 'editPassword'])->name('edit_password');
Route::post('users/save_password/{user}', [UsersController::class, 'savePassword'])->name('save_password');

// Customer credit management
Route::post('users/add_credit/{user}', [UsersController::class, 'addCredit'])->name('add_credit');
// Customer listing for employees
Route::get('customers', [UsersController::class, 'listCustomers'])->name('customers');
// Employee creation for admins
Route::get('employees/create', [UsersController::class, 'createEmployee'])->name('create_employee');
Route::post('employees/create', [UsersController::class, 'createEmployee'])->name('do_create_employee');

Route::get('products', [ProductsController::class, 'list'])->name('products_list');
Route::get('products/edit/{product?}', [ProductsController::class, 'edit'])->name('products_edit');
Route::post('products/save/{product?}', [ProductsController::class, 'save'])->name('products_save');
Route::get('products/delete/{product}', [ProductsController::class, 'delete'])->name('products_delete');
// Product purchase
Route::get('products/buy/{product}', [ProductsController::class, 'buy'])->name('products_buy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/multable', function (Request $request) {
    $j = $request->number??5;
    $msg = $request->msg;
    return view('multable', compact("j", "msg"));
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function () {
    return view('prime');
});

Route::get('/test', function () {
    return view('test');
});
