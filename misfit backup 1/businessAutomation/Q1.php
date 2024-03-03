<?php

$nums = [0,1,0,3,12];

$length = count($nums);

for($i = 0; $i < $length; $i++){
    if($nums[$i] == 0){
        unset($nums[$i]);
    }
    array_push($nums, 0);
}





?>