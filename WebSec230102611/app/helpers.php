<?php

if (!function_exists('isPrime')) {
    function isPrime($number) {
        if ($number <= 1) return false;
        $i = $number - 1;
        while ($i > 1) {
            if ($number % $i == 0) return false;
            $i--;
        }
        return true;
    }
}

if (!function_exists('factorial')) {
    function factorial($n) {
        if ($n < 0) { //negative number error handling
            return "undefined";
        }

        if ($n <= 1) { // (if its a 0 or a 1)
            return 1;
        }

        return $n * factorial($n - 1);
    }
}