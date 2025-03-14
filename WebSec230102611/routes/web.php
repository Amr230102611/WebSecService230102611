<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Users2Controller;

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

// Users 2 //
Route::prefix('users2')->group(function () {
    Route::get('/users2', [Users2Controller::class, 'index'])->name('users2.index');
    Route::get('/', [Users2Controller::class, 'index'])->name('users2.index');
    Route::get('/create', [Users2Controller::class, 'create'])->name('users2.create');
    Route::post('/store', [Users2Controller::class, 'store'])->name('users2.store');
    Route::get('/edit/{id}', [Users2Controller::class, 'edit'])->name('users2.edit');
    Route::post('/update/{id}', [Users2Controller::class, 'update'])->name('users2.update');
    Route::get('/delete/{id}', [Users2Controller::class, 'destroy'])->name('users2.delete');


});
