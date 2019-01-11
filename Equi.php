<?php

//https://app.codility.com/demo/take-sample-test/equi/
//https://app.codility.com/demo/results/trainingHXQUVD-658/

function solution($A) {
    // write your code in PHP7.0
    $right = array_sum($A);
    $left = 0;


    foreach ($A as $k=>$val) {

        $right = $right - $val;

        if ($left == $right) {
            return $k;
        }

        $left = $left + $val;
    }

    return -1;
}

var_dump(solution([-1, 3, -4, 5, 1, -6, 2, 1]));