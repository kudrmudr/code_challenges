<?php

/*
 * Given a word, calculate the smallest number of letters that must be removed in order for the letters of the remaining word to be sorted in lexicographical order.
 * The resulting word need not appear in the dictionary of any particular language
 */

function solution($S)
{
    $result = 0;

    $l = strlen($S);

    /* Initialize LIS values for all indexes */
    $lis = array_pad([], $l, 1);
    $lis[$l] = 0;

    /* Compute optimized LIS values in bottom up manner */
    for ($i = 1; $i < $l; $i++ ) {
        for ($j = 0; $j < $i; $j++ ) {
            if ($S[$i] >= $S[$j] && $lis[$i] < $lis[$j] + 1) {
                $lis[$i] = $lis[$j] + 1;
            }
        }
    }

    /* Pick resultimum of all LIS values */
    for ($i = 0; $i < $l; $i++ ) {
        if ($result < $lis[$i]) {
            $result = $lis[$i];
        }
    }

    return $l - $result;
}


print_R(solution('banana'));

echo PHP_EOL;

print_R(solution('aaa'));

echo PHP_EOL;


print_R(solution('cabcde'));

echo PHP_EOL;

print_R(solution('abc'));

echo PHP_EOL;

print_R(solution('abcdefa'));

echo PHP_EOL;

print_R(solution('abcdefg'));

echo PHP_EOL;

print_R(solution('abcdefaz'));

echo PHP_EOL;

print_R(solution('zyx'));

echo PHP_EOL;

print_R(solution('zxy'));

echo PHP_EOL;

print_R(solution('abcdefgabcdefghk'));

echo PHP_EOL;

print_R(solution('cba'));

echo PHP_EOL;

print_R(solution('abcb'));

echo PHP_EOL;

print_R(solution('vwzyx'));

echo PHP_EOL;

print_R(solution('zvwzyx'));

echo PHP_EOL;

print_R(solution('adabcef'));

echo PHP_EOL;

print_R(solution('fantastic'));

echo PHP_EOL;

print_R(solution(''));

echo PHP_EOL;

print_R(solution('a'));