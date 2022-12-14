<?php
$data = file_get_contents("dummyfile.json");
// echo $data;
$j_data = json_decode($data,true);
echo "<pre>";
// print_r($j_data);
echo"</pre>";

$file = fopen("laptop.csv","w");
$col = ["Title","Price","Brand"];

fputcsv($file,$col);
//echo $j_data['products'][0]['title'];
foreach($j_data as $keys =>$values){
    if (is_array($values) || is_object($values)){
    foreach($values as $data){
        foreach($data as $k=>$v){ 
        if($k == 'title'|| $k== 'price'||$k== 'brand'){
            fwrite($file,$v.",");   
        }  
    }
        fwrite($file,"\n");  
    }
    } 
}

fclose($file);
echo"The ‘CSV’ file named ‘laptop.csv’ has been created"; 