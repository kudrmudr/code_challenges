<?php

/**
 * Write a function that, given two strings S and T consisting of N and M characters, respectively, determines whether string T can be obtained from string S by at most one simple operation from the set specified below.
 * The function should return a string:
 * INSERT c" if string T can be obtained from string S by inserting a single character "<tt style="white-space:pre-wrap">c</tt>";
 * REPLACE c d" if string T can be obtained from string S by replacing a single occurrence of character "c" with a single character "d" (these characters should be distinct);
 * SWAP c d" if string T can be obtained from string S by swapping two adjacent characters "c" and "d" (these characters should be distinct and in the same order as in string S; exactly one swap is performed);
 * EQUAL" if no operation is needed (strings T and S are equal);
 * IMPOSSIBLE" if none of the above works.
 */

function solution($S, $T)
{
    $l = max(strlen($S), strlen($T));

    $diff_s = '';
    $diff_t = '';

    for ($i = 0; $i < $l; $i++) {
        if (!(isset($S[$i]) && isset($T[$i]) && $S[$i] == $T[$i])) {
            $diff_s .= isset($S[$i]) ? $S[$i] : '';
            $diff_t .= isset($T[$i]) ? $T[$i] : '';
        }
    }

    $ls = strlen($diff_s);
    $lt = strlen($diff_t);

    if ($lt > $ls && abs($lt - $ls) == 1) {
        return 'INSERT ' . str_replace($diff_s, '', $diff_t);
    } elseif ($ls == $lt && $ls == 1) {
        return 'REPLACE ' . $diff_s . ' ' . $diff_t;
    } elseif ($ls == $lt && $ls == 2) {
        return 'SWAP ' . $diff_s;
    } elseif ($ls == $lt && $ls == 0) {
        return 'EQUAL';
    } else {
        return 'IMPOSSIBLE';
    }
}

print_R(solution("nice", "niece"));

echo PHP_EOL;

print_R(solution("niece", "nice"));

echo PHP_EOL;

print_R(solution("test", "tent"));

echo PHP_EOL;

print_R(solution("form", "from"));

echo PHP_EOL;

print_R(solution("o", "odd"));

echo PHP_EOL;

print_R(solution("bbddd", "bbddb"));

echo PHP_EOL;

print_R(solution("tenttent", 'testtentsddsd'));

echo PHP_EOL;

print_R(solution('from', 'form'));

echo PHP_EOL;

print_R(solution('frrm', 'form'));

echo PHP_EOL;

print_R(solution("abcdezzz", "abcQdezzz"));

echo PHP_EOL;

print_R(solution("", ""));

echo PHP_EOL;

print_R(solution("1", "1"));

echo PHP_EOL;

print_R(solution("ddd", "ddd"));

echo PHP_EOL;

print_R(solution("nicenice", "niceniece"));

echo PHP_EOL;

print_R(solution("sdsdsd", "sdsdsdsdaewasasddssdsdsdddddddddddddddddddd"));

echo PHP_EOL;

print_R(solution("aaaa", "aaaaa"));

echo PHP_EOL;
