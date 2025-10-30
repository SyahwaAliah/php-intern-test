<?php

$n = 7;

for ($i = 1; $i <= $n; $i++) {
    for ($j = 1; $j <= $n; $j++) {
        echo ($j === $i || $j === ($n - $i + 1) ? 'X ' : 'O ');
    }
    echo PHP_EOL;
}
