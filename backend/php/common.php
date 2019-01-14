<?php
function xss_cleaner($input_str)
{
    $return_str = str_replace(array('<', ';', '|', '&', '>', "'", '"', ')', '('), array('&lt;', '&#58;', '&#124;', '&#38;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), $input_str);
    $return_str = str_ireplace('%3Cscript', '', $return_str);
    return $return_str;
}

function remove_special_char($str)
{
    $result = preg_replace('/([^\pL\ \']+)/u', ' ', strip_tags($str));
    return $result;
}

function compound_word($str)
{
    $word = ['je', 'le', 'la', 'de', 'du', 'ne'];
    $vowel = ['u', 'e', 'o', 'a', 'i'];
    $word_first = ['j', 'l', 'd', 'd', 'n'];
    $res = ['j\'u', 'j\'e', 'j\'o', 'j\'a', 'j\'i',
            'l\'u', 'l\'e', 'l\'o', 'l\'a', 'l\'i',
            'd\'u', 'd\'e', 'd\'o', 'd\'a', 'd\'i',
            'n\'u', 'n\'e', 'n\'o', 'n\'a', 'n\'i'];

    $str = strtolower($str);
    for ($i = 0; $i < count($word); $i++) {
        $pos = strpos($word[$i], $str);
    }

    foreach ($str as $key => $value) {

    }


}