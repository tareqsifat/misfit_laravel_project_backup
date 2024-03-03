<?php
class solution{
    
    function reverseVowels($s) {
        $vowels = [
            'a' => 1,
            'A' => 1,
            'e' => 1,
            'E' => 1,
            'i' => 1,
            'I' => 1,
            'o' => 1,
            'O' => 1,
            'u' => 1,
            'U' => 1
        ];
        $pointer1 = 0;
        $pointer2 = strlen($s) - 1;
        for ($pointer1 = 0; $pointer1 <= $pointer2; $pointer2--) {
            if (isset($vowels[$s[$pointer1]])) {
                echo "pointer1: $pointer1\n";
                echo "s: $s[$pointer1]\n";
                echo "vowels: " . $vowels[$s[$pointer1]] . "\n";
                while (!isset($vowels[$s[$pointer2]]) && $pointer1 !== $pointer2) {
                    $pointer2--;
                }
                $temp = $s[$pointer2];
                $s[$pointer2] = $s[$pointer1];
                $s[$pointer1] = $temp;
            } elseif (isset($vowels[$s[$pointer2]])) {
                while (!isset($vowels[$s[$pointer1]]) && $pointer1 !== $pointer2) {
                    $pointer1++;
                }
                // var_dump($pointer1, $pointer2);
                $temp = $s[$pointer2];
                $s[$pointer2] = $s[$pointer1];
                $s[$pointer1] = $temp;
            }
            $pointer1++;
        }
        return $s;
    }
}

$s = "leetcode";

$solution = new Solution();

$solution->reverseVowels($s) . "output\n";