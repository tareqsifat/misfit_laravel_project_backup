<?php

function longestCommonPrefix($strs) {
    if (empty($strs)) {
        return "";
    }

    $minLen = PHP_INT_MAX;

    foreach ($strs as $str) {
        $minLen = min($minLen, strlen($str));
    }

    $commonPrefix = "";

    for ($i = 0; $i < $minLen; $i++) {
        $currentChar = $strs[0][$i];

        foreach ($strs as $str) {
            if ($str[$i] !== $currentChar) {
                return $commonPrefix;
            }
        }

        $commonPrefix .= $currentChar;
    }

    return $commonPrefix;
}

$strs1 = ["flower", "flow", "flight"];
echo longestCommonPrefix($strs1);

$strs2 = ["dog", "racecar", "car"];
echo longestCommonPrefix($strs2);
