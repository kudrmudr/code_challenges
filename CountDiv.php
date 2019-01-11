<?php

//https://app.codility.com/programmers/lessons/5-prefix_sums/count_div/

function solution($A, $B, $K) {
    // write your code in PHP7.0

    $all = intval( $B / $K );

    if ($A == 0) {
        return $all + 1;
    }

    $left = intval( ($A - 1) / $K);

    return $all - $left;
}

var_dump(solution(  6, 11, 2));