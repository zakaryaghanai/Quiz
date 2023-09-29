<?php


/* 
    '.' => match any character
    '*' => match zero or more of the preceding character
    examples :
    [
        {
            input: "ab",
            pattern: "a.",
            output: true
        },
        {
            input: "ab",
            pattern: ".*",
            output: true
        }
    ]

*/

function getNextChar($arr) {
    if (!count($arr)) {
        yield null;
    }
    for ($i = 0; $i < count($arr); $i++) {
        yield $arr[$i];
    }

}

function isMatch($str, $pattern) {
    $strArr = str_split($str);
    $patternArr = str_split($pattern);
    $currentPatternChar = getNextChar($patternArr)->current();
    $currentStrChar = getNextChar($strArr)->current();
    
    // always return true when length of string and pattern equals to zero
    if (!strlen($str) && !strlen($pattern)) {
        return true;
    }
    
    // current pattern character is null
    if ($currentPatternChar === null) {
        return false;
    }
    
    // always return true when the last pattern character is star (*)
    if ($currentPatternChar === '*' && count($patternArr) === 1) {
        return true;
    }
    
    // pattern has charecters after the start (*)
    if ($currentPatternChar === '*' && count($patternArr) != 1) {
        $str = substr($str, 1, strlen($str));
        $pattern = substr($pattern, 1, strlen($pattern));
        return isMatch($str, $pattern);
    }

    // pattern still has characters to match against and string is empty
    if ($currentStrChar === null && strlen($pattern) != 0) {
        return false;
    }
    
    $charectersAreEqual = $currentStrChar === $currentPatternChar;
    $isCurrentPatternCharDot = $currentPatternChar === '.';

    if ($charectersAreEqual || $isCurrentPatternCharDot) {
        $str = substr($str, 1, strlen($str));
        $pattern = substr($pattern, 1, strlen($pattern));

        return isMatch($str, $pattern);
    }
    
    return false;
}

$result = isMatch("translate the word", "t..nsl*te the w*");
echo $result;

?>
<!-- 
pwwkew 
0 p 
0 w 
2 w 
2 k 
2 e 
3 w
 -->
