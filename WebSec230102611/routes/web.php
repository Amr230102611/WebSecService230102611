<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome'); //welcome.blade.php
});

// Route::get('/multable', function () {
//     return view('multable', ['j' => 5]); // j is variable for mult table (multable.blade.php)
// });

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