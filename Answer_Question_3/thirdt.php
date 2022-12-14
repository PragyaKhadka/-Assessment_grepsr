<?php
$timestamp_2=$_GET['second'];
//  $given_date = "09092022";
function conversion($toconvert){
    $tocon =$toconvert;
    $arr1 = str_split($tocon,4);
    $arr2 = str_split($arr1[0],2);
    $slash = "/";
    $result = $arr2[0].$slash.$arr2[1].$slash.$arr1[1];
    return $result;
}
$required_format = conversion($timestamp_2);

if($_GET['second']){
 echo date("M d Y",strtotime($required_format));
}
?>