<?php
function floor_acc_pre($num, $precision, $separator)
{
$number_parts=explode($separator, $num);
// print_r($number_parts[1]);
$number_parts[1]=substr_replace($number_parts[1],$separator,$precision,0);
// print_r($number_parts[1]);
if($number_parts[0]>=0)
{$number_parts[1]=floor($number_parts[1]);}
else
{$number_parts[1]=ceil($number_parts[1]);}

$ceil_num= array($number_parts[0],$number_parts[1]);
return implode($separator,$ceil_num);
}
echo"<pre>";
print_r("The floored result of 1.155 with precision 2 is: ".floor_acc_pre(1.155, 2, ".")."\n");

echo"<pre>";
print_r("The floored result of 2.99999 with precision 2 is: ".floor_acc_pre(2.99999, 2, ".")."\n");

echo"<pre>";
print_r("The floored result of 199.999999 with precision 4 is: ".floor_acc_pre(199.999999, 4, ".")."\n");

echo"<pre>";
print_r("The floored result of -3.9346 with precision 3 is: ".floor_acc_pre(-3.9346, 3, ".")."\n");

?>