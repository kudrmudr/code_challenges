<?php

//https://app.codility.com/demo/results/trainingEN25SG-N9F/
//https://app.codility.com/programmers/lessons/7-stacks_and_queues/brackets/start/

function solution($S) {
    // write your code in PHP7.0

    $symbols = [')' => '(',']' => '[','}' => '{'];

    $stack = [];

    $l = strlen($S);

    if ($l % 2 <> 0) {
        return 0;
    }

    for ($i = 0; $i < $l; $i++) {
        //if the tag is open
        if (in_array($S[$i], $symbols)) {
            //put it to the stack
            $stack[] = $S[$i];
        } elseif ($symbols[$S[$i]] == end($stack)) {
            //remove it from stack if they are much
            array_pop($stack);
        }
    }

    if (count($stack) > 0) {
        return 0;
    }

    return 1;
}

var_dump(solution('{[()()]}'));

var_dump(solution('([)()]'));