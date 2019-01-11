<?php

header("Content-Type: text/plain");

function solution($S, $T)
{
    $l = max(strlen($S), strlen($T));

    $diff_s = '';
    $diff_t = '';

    for ($i=0; $i < $l; $i++) {
        if (!(isset($S[$i]) && isset($T[$i]) && $S[$i] == $T[$i])) {
            $diff_s.= isset($S[$i]) ? $S[$i] : '';
            $diff_t.= isset($T[$i]) ? $T[$i] : '';
        }
    }

    $ls = strlen($diff_s);
    $lt = strlen($diff_t);


    echo $S .' and '.$T . PHP_EOL;
    echo 'diff: '.$diff_s.' and '.$diff_t . PHP_EOL;


    if ($lt > $ls && abs($lt - $ls ) == 1) {
        echo 'INSERT '.str_replace($diff_s, '', $diff_t);
    }

    elseif ($ls == $lt && $ls == 1) {
        echo 'REPLACE '.$diff_s.' '.$diff_t;
    }

    elseif ($ls == $lt && $ls == 2) {

        echo 'SWAP '.$diff_s;
    }

    elseif ($ls == $lt && $ls == 0) {

        echo 'EQUAL';
    } else {
        echo 'IMPOSSIBLE';
    }

    echo PHP_EOL;
    echo PHP_EOL;
}


solution("nice" ,  "niece");

solution( "niece", "nice");

solution("test" , "tent");

solution("form" , "from");

solution("o" , "odd");

solution("bbddd" , "bbddb");

solution("tenttent", 'testtentsddsd');

solution('from', 'form');

solution('frrm', 'form');

solution("abcdezzz" , "abcQdezzz");

solution("" , "");

solution("1" , "1");

solution("ddd" , "ddd");

solution("nicenice" ,  "niceniece");

solution("sdsdsd" ,  "sdsdsdsdaewasasddssdsdsdddddddddddddddddddd");

solution("aaaa" ,  "aaaaa");