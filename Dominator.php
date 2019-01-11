<?php

//https://app.codility.com/programmers/lessons/8-leader/dominator/start/
//https://app.codility.com/demo/results/training5CUXAM-D83/

function solution($A) {
    // write your code in PHP7.0

    $l = count($A);
    $max = 0;
    $map = [];

    foreach ($A as $k => $val) {

        @$map[$val]++;

        if ($map[$val] > $max) {
            $max = $map[$val];
        }

        if ($max > $l/2) {
            return $k;
        }
    }

    return -1;
}

var_dump(solution([3, 4, 3, 2, 3, -1, 3, 3]));