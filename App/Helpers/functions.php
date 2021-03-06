<?php

function copyImage($url, $dir, $name){

    if (!is_dir($dir)) mkdir($dir, 0777, true);
    if ( copy($url, "$dir/$name")) return $name;
    return false;
}

// отображает данные
function dd($var, $die = true, $pretty = true)
{
    $backtrace = debug_backtrace();

    echo "\n<pre>\n";

    if (isset($backtrace[0]['file'])) {
        echo $backtrace[0]['file'] . "\n\n";
    }

    echo "Type: " . gettype($var) . "\n";
    echo "Time: " . date('c') . "\n";
    echo "---------------------------------\n\n";

    ($pretty) ? print_r($var) : var_dump($var);

    echo "</pre>\n";

    if ($die) die;
}