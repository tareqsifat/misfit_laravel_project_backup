<?php 


function miniMaxSum($arr) {
    // Write your code here
    $lowest_sum = 0;
    $highest_sum = 0;
    
    $oldsum = 0;
    // $newsum = null;
    $max = 0;
    $maxId=0;
    $min = $arr[0];
    $minId=0;
    foreach($arr as $i => $value) {
        if($max < $arr[$i]) {
            $max = $value;
            $maxId = $i;
        }
        if($min > $arr[$i]) {
            $min = $value;
            $minId = $i;
        }
        $j = $i+$minId;
        $k = $i-$maxId;
        $highest_sum += $arr[$j];
        $lowest_sum += $arr[$k];
        
        
        // if($i !== count($arr)) {    
            
        //     $j = $i+1;
        //     $k = $i-1;
            
        //     // $next_item = $arr[$j];
        //     $highest_sum += $arr[$j];
        //     $lowest_sum += $arr[$k];
            
        //     // echo $i . " " . count($arr) . " ";
        // }
        
    }
    // print($oldsum);
    // echo " " . $min . " " . $max;
    echo $lowest_sum . " " . $highest_sum;
}


?>