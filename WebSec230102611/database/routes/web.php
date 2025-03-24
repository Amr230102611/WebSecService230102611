<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ForgetPasswordController;

Route::get('/', function () {
    return view('welcome'); //welcome.blade.php
});

Route::get('/even', function () {
    return view('even');  //even.blade.php
});

Route::get('/prime', function () {
    return view('prime'); //prime.blade.php
});


Route::get('/multable/{number?}', function ($number = null) {
    return view('multable', ['j' => $number ?? 2]); // commented the first one because it already gets the default value from here (multable.blade.php)
});

Route::get('/factorial/{number?}', function ($number = null) {
    return view('factorial', ['number' => $number ?? 5]); //factorial.blade.php (merged both mul)
});

// ---------------------------------------------------------------------- //

Route::get('/minitest', function () {
    $bill = [
        ['item' => 'Milk', 'quantity' => 2, 'price' => 20],
        ['item' => 'Bread', 'quantity' => 1, 'price' => 15],
        ['item' => 'Eggs', 'quantity' => 12, 'price' => 50],
    ];

    $id="#123412";
    $cashier = "kamel";
    $total = array_reduce($bill, function ($sum, $entry) {
        return $sum + ($entry['quantity'] * $entry['price']);
    }, 0);

    return view('minitest', compact('id','bill', 'cashier', 'total'));
});


Route::get('/transcript', function () {
    $courses= [
        ["name" => "Cyber and Information Security", "degree" => 80 , "credit" => 3],
        ["name" => "Advanced Networks", "degree" => 90 , "credit" => 4],
        ["name" => "Social Responsibility", "degree" => 70 , "credit" => 2],
    ];
    $calculateGPA = function ($courses) {
        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($courses as $course) {
            $totalPoints += ($course['degree'] * $course['credit']);
            $totalCredits += $course['credit'];
        }

        return ($totalCredits > 0) ? round($totalPoints / ($totalCredits * 100) * 4, 2) : 0;
    };

    $gpa = $calculateGPA($courses);

    return view('transcript', compact('courses', 'gpa'));
});

// Lecture 3 //

Route::get('products', [ProductsController::class, 'list'])->name('products_list');
Route::get('products/edit/{product?}', [ProductsController::class, 'edit'])->name('products_edit');
Route::post('products/save/{product?}', [ProductsController::class, 'save'])->name('products_save');
Route::get('products/delete/{product}', [ProductsController::class, 'delete'])->name('products_delete');

// Users

Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'doLogin'])->name('do_login');
Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::post('/register', [UsersController::class, 'doRegister'])->name('do_register');

// Password Reset Routes
Route::get('/forgot-password', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgetPasswordController::class, 'reset'])->name('password.update');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UsersController::class, 'doLogout'])->name('do_logout');
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::post('/profile/change-password', [UsersController::class, 'changePassword'])->name('change_password');

    // User Management Routes (Only for Admins)
// Users Routes
Route::prefix('users')->group(function () {
    Route::get('/', function () {
        return app(UsersController::class)->index(request()); // Pass the request object
    })->name('users.index');

    Route::get('/create', function () {
        return app(UsersController::class)->create();
    })->name('users.create');

    Route::post('/store', function () {
        return app(UsersController::class)->store(request());
    })->name('users.store');

    Route::get('/edit/{id}', function ($id) {
        return app(UsersController::class)->edit($id);
    })->name('users.edit');

    Route::put('/update/{id}', function ($id) { // Change to PUT method
        return app(UsersController::class)->update(request(), $id);
    })->name('users.update');

    Route::get('/delete/{id}', function ($id) {
        return app(UsersController::class)->destroy($id);
    })->name('users.delete');
});

// Roles Routes
Route::prefix('roles')->group(function () {
    Route::get('/', [RolesController::class, 'index'])->name('roles.index');
    Route::get('/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::put('/update/{id}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('/delete/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');
});

// Permissions Routes
Route::prefix('permissions')->group(function () {
    Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('/store', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('/edit/{id}', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::put('/update/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('/delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
});

});