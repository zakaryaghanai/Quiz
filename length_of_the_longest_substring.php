<?php

/* 
    [
        {
            "input": "abcabcbb",
            "output": 3
        },
        {
            "input": "bbbbb",
            "output": 1
        },
        {
            "input": "pwwkew",
            "output": 3
        }
    ]
*/

function getLongestSubstringLength($str) {
    $strArr = str_split($str);
    $maxLength = 0;
    $sliderStartIndex = 0;
    $charMap = [];

    foreach($strArr as $sliderEndIndex => $char) {
        
        // if $charMap is empty by default adding one character and the max length would be 1
        if (empty($charMap)) {
            $charMap[$char] = $sliderEndIndex;
            $maxLength = 1;
            continue;
        }
        
        // we check if current character already exists in characters map.
        // if so, then we check if the current character stored index is greater then the slider start index,
        // if so, we update the slider start index by one step, based on the stored character index in $charMap
        // ensuring that there is no recurring characters in the slide view.
        $existingCharacters = array_keys($charMap);
        if (in_array($char, $existingCharacters) && $charMap[$char] >= $sliderStartIndex) {
            $sliderStartIndex = $charMap[$char] + 1;
        }
        
        $charMap[$char] = $sliderEndIndex;
        
        // we check if current the slider length is greater then the an old max length value 
        if (($max = $sliderEndIndex - $sliderStartIndex + 1) > $maxLength) {
            $maxLength = $max;
        }
    }
    
    return $maxLength;
}


$result = getLongestSubstringLength("abcabcbbabcabcbbzxwytu");
echo $result;

?>