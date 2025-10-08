<?php 


//String Format Function
function formatString($string){
    $string = trim($string, '/');

    // Replace special characters (., _, -) and slashes with a space
    $string = preg_replace('/[._\-\/]+/', ' ', $string);

    // Capitalize each word
    $formattedString = ucwords($string);

    // Remove the first word
    $formattedString = preg_replace('/^\w+\s/', '', $formattedString);

    return $formattedString;
}