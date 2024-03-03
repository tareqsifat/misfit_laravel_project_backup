<?php
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function reverseVowels($s) {
            $vowel_arr = array();
            $str_arr = str_split($s);
            $count = count($str_arr);
            foreach($str_arr as $str){
                if(strtolower($str) == 'a' || strtolower($str) == 'e' || strtolower($str) == 'i'
                || strtolower($str) == 'o' || strtolower($str) == 'u'){
                    array_push($vowel_arr, $str);
                }
            }
            $rev_arr = array_reverse($vowel_arr);
            $k = 0;
            for($i = 0; $i < $count; $i++){
                if(strtolower($str_arr[$i]) == 'a' || strtolower($str_arr[$i]) == 'e' || strtolower($str_arr[$i]) == 'i'
                || strtolower($str_arr[$i]) == 'o' || strtolower($str_arr[$i]) == 'u'){
                    $str_arr[$i] = $rev_arr[$k];
                    $k++;
                }
            }

        return implode("",$str_arr);
    }
}

$s = "leetcode";

$solution = new Solution();

echo $solution->reverseVowels($s);