<?php
$s="LVIII";
        $value = 0;
        $len = strlen($s);

        while($len > 0){
            $last = substr($s, -1);
            if($last == 'V' || $last == 'X'){
                $temp = ($last == 'V' ? 5 : 10);
                if(substr($s, -2, 1) == 'I'){
                    $temp = $temp - 1;
                    $s = substr($s, 0, -2);
                    $len = $len - 2;
                }else{
                    $s = substr($s, 0, -1);
                    $len--;
                }
                $value = $value + $temp;
                
            }else if($last == 'L' || $last == 'C'){
                $temp = ($last == 'L' ? 50 : 100);
                if(substr($s, -2, 1) == 'X'){
                    $temp = $temp - 10;
                    $s = substr($s, 0, -2);
                    $len = $len - 2;
                }else{
                    $s = substr($s, 0, -1);
                    $len--;
                }
                $value = $value + $temp;

            }else if($last == 'D' || $last == 'M'){
                $temp = ($last == 'D' ? 500 : 1000);
                if(substr($s, -2, 1) == 'C'){
                    $temp = $temp - 100;
                    $s = substr($s, 0, -2);
                    $len = $len - 2;
                }else{
                    $s = substr($s, 0, -1);
                    $len--;
                }
                $value = $value + $temp;

            }else if($last == 'I'){
                $s = substr($s, 0, -1);
                $value = $value + 1;
                $len--;
            }
        }
        return $value;

?>