<?php

$s = "the sky is blue";

$arr = explode(' ', $s);
$arr = array_reverse($arr);
// print_r($arr);

$result = "";
foreach($arr as $a){
    $result = $result . $a . " ";
}

echo trim($result);