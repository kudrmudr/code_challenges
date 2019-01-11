<?php

//https://app.codility.com/programmers/lessons/7-stacks_and_queues/fish/
//https://app.codility.com/demo/results/training94RH3G-TPE/

function solution($A, $B) {
    // write your code in PHP7.0
    $stack = [];
    $l = count($A);
    $died = 0;

    foreach ($A as $i => $strong) {
        if ($B[$i] == 1) {
            $stack[] = $strong;
        } else {
            while (count($stack) > 0) {
                $strong_up = array_pop($stack);
                $died++;
                if ($strong_up > $strong) {
                    $stack[] = $strong_up;
                    break;
                }
            }
        }
    }

    return $l - $died;
}

var_dump(solution([4, 3, 2, 1, 5], [0, 1, 0, 0, 0]));

var_dump(solution([0, 1], [1, 1]));
