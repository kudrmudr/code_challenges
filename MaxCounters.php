<?php

//https://app.codility.com/programmers/lessons/4-counting_elements/max_counters/

function solution($N, $A) {

    $counters = array_fill(0, $N, 0);

    $max = 0;
    $counterMaxVal = 0;

    foreach ($A as $K=>$val) {

        if ($val <= $N) {
            $counters[$val - 1] = max($max, $counters[$val - 1]) + 1;
            $counterMaxVal = max($counterMaxVal, $counters[$val - 1]);
        } else {
            $max = $counterMaxVal;
        }
    }

    foreach ($counters as $k=>$val) {
        $counters[$k] = max($max, $val);
    }

    return $counters;
}

var_dump(solution(5, [3, 4, 4, 6, 1, 4, 4]));