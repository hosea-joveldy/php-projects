<?php

function multiply($x, $y)
{
    return $x * $y;
}

function output($x, $y)
{
    echo "$x x $y = ";
    echo "<br>";
    $result = multiply($x, $y);

    echo "$result";
}

output(4, 3);
