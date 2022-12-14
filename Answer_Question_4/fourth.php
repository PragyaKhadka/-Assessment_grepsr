<?php
$regular_expression = "#[@ ]#";
$given_string = "abc@grepsr.com";

$result = preg_split($regular_expression, $given_string);

print_r($result);
echo"<pre>";
print_r("The first item in the array is:".$result[0]);
echo"<pre>";
print_r("The second item in the array is:".$result[1]);
?>