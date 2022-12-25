<?php
require('phpQuery/phpQuery.php');
//initialising curl resources
$curl = curl_init();

//MAKING HTTP REQUEST
$nav_string ="science-fiction_16";
$url ="https://books.toscrape.com/catalogue/category/books/$nav_string/index.html";
curl_setopt($curl, CURLOPT_URL,"$url");
// for displaying result through a variable 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
echo $result;

//initialising phpQuery
$doc = phpQuery::newDocument($result);
//query to pull the required data from the document 
foreach($doc['.product_pod h3 a' ] as $a ){
   $title[] = pq($a)->attr('title');
   $book_url[] = pq($a)->attr('href');
};
// print_r($title);
// print_r($book_url);
foreach($doc['.product_pod .price_color' ] as $p ){
    $price[] = pq($p)->text();
};
// print_r($price);
foreach($doc['.product_pod .availability.instock' ] as $s ){
    $stock[] = pq($s)->text();
};
// echo "<pre>";
// print_r($stock);
// echo "</pre>";
foreach($doc['.product_pod .star-rating' ] as $sr ){
    $star_rating[] = pq($sr)->attr('class');
};
foreach($star_rating as $srr){
    if($srr == 'star-rating One'){
        $srr= "1.0";
    }
    if($srr == 'star-rating Two'){
       $srr= "2.0";
     }
     if($srr == 'star-rating Three'){
      $srr= "3.0";
    }
    if($srr == 'star-rating Four'){
      $srr= "4.0";
    }
    if($srr == 'star-rating Five'){
      $srr = "5.0";
     }
     $b[]= $srr;
};
// print_r($b);

function random_strings($length_of_string){
 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
    }

for($i=0; $i<=15; $i++){
$id[] = random_strings(8);
$category[] ="Science";
}
// print_r($id);
// print_r($category);

foreach($doc['ul.nav.nav-list li ul li:nth-child(odd) a'] as $li){
    $odd_url[] = pq($li)->attr("href");
}
// print_r($odd_url);

foreach($doc['ul.nav.nav-list li ul li:nth-child(even) a'] as $li){
    $even_url[] = pq($li)->attr("href");
}
// print_r($even_url);

$category_url = array_merge($odd_url,$even_url);
// print_r($category_url);


// DISPLAYING DATA IN THE TABLE:
echo"<table border='1' cellpadding='10' cellspacing='0'>";
   echo "<tr> 
   <th>Id</th>
   <th>Category</th>
   <th>Title</th>
   <th>Price</th>
   <th>Stock</th>
   <th>Book_URL</th>
   <th>Ratings</th>
   </tr>";
   for($i=0;$i<=15;$i++){
   echo "<tr><td>$id[$i]</td><td>$category[$i]</td><td>$title[$i]</td><td>$price[$i]</td><td>$stock[$i]</td><td>$book_url[$i]</td><td>$b[$i]</td></tr>";
   };
echo"</table>";
echo"<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Category_Url</th>";
foreach($category_url as $val){
    echo"<tr>";
    echo "<td>$val</td>";
    echo"<tr>";
        }  
echo"</table>";

//DATA INTO CSV FILE:
$arr = array(
    'id'=> $id,
    'category'=>$category,
    'title'=>$title,
    'price'=>$price,
    'stock'=>$stock,
    'book_url'=>$book_url,
    'star_rating'=>$b,
    'category_url'=>$category_url,
);
$file = fopen('science_listing.csv','w');
foreach ($arr as $nodes=>$val){
     foreach($val as $data){
        fwrite($file,"\r".$data.',');
    }  
}
echo"CSV FILE FORMED";
fclose($file);
curl_close($curl);
?>