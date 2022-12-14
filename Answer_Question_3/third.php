<?php
$timestamp=$_GET['first'];
 if($_GET['first']){
    echo date("Y-m-d",strtotime($timestamp));
   }
?>
