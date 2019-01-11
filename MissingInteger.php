<?php

//https://app.codility.com/programmers/lessons/4-counting_elements/missing_integer/

function solution($A) {
    // write your code in PHP7.0

    $min = PHP_INT_MAX;

    $newA = array_flip($A);

    if (!isset($newA[1])) {
        return 1;
    }

    foreach ($newA as $k=>$val) {

        $p = $k + 1;

        if (!isset($newA[$p]) && $p > 0 && $p < $min) {
            $min = $p;
        }
    }

    if ($min == PHP_INT_MAX) {
        $min = 1;
    }

    return $min;
}

var_dump(solution([1, 3, 6, 4, 1, 2]));

var_dump(solution([1, 2, 3]));

var_dump(solution([-1, -3]));