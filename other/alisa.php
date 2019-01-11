<?php

function solution($AX, $AY, $BX, $BY)
{
    //calculate vector for alisa direction
    $v_x = $BX - $AX;
    $v_y = $BY - $AY;

    $g = gcd($v_x, $v_y);

    $v_x = $v_x / $g;
    $v_y = $v_y / $g;

    //turn the vector right (90 degrees clockwise)
    $v_turn_x = $v_y;
    $v_turn_y = -1 * $v_x;

    //B point + turn right vector is first alisa coordinate after turn
    return [$BX + $v_turn_x, $BY + $v_turn_y];
}

function gcd($a, $b)
{

    $a = abs($a);
    $b = abs($b);

    if ($a < $b) {
        list($b, $a) = [$a, $b];
    }
    if ($b == 0) {
        return $a;
    }

    $r = $a % $b;

    while ($r > 0) {
        $a = $b;
        $b = $r;
        $r = $a % $b;
    }
    return $b;
}

var_dump(solution(-1, 3, 3, 1));

var_dump(solution(2, 2, 2, -3));