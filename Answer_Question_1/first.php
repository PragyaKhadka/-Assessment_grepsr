<?php
$check_for = [51,"55","apple",12.10,null,true,false];
echo"1.Let's see examples of is_int:";
foreach($check_for as $cf){
    echo"</br>";
    echo"is_int(";
    var_export($cf);
    echo")=";
    var_dump(is_int($cf));
}
echo"</br>";
echo"</br>";
echo"2.Let's see examples of is_integer:";
foreach($check_for as $cf){
    echo"</br>";
    echo"is_integer(";
    var_export($cf);
    echo")=";
    var_dump(is_integer($cf));
}
echo"</br>";
echo"</br>";
echo"3.Let's see examples of is_numeric:";
foreach($check_for as $cf){
    echo"</br>";
    echo"is_numeric(";
    var_export($cf);
    echo")=";
    var_dump(is_numeric($cf));
}
?>