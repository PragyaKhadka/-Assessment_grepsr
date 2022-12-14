<?php

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;
$dom = new DomDocument;
    
//getting url  
$client = new \GuzzleHttp\Client(['base_uri'=>'https://books.toscrape.com/']);

//go get the data from url 
$response = $client->request('GET', '/catalogue/category/books/science-fiction_16/index.html');

$html =''. $response->getBody();
//echo $html;
$crawler = new crawler($html);

//loop through the data 
$nodeVal1 = $crawler->filter('div.side_categories>ul > li > ul >li:nth-child(odd)')->each(function (Crawler $node, $i){
   $odd_cat_urls = $node->filter("a")->attr("href"); 
   $arr = ["odd_cat_urls"=>$odd_cat_urls];
   return $arr;
});
// print_r($nodeVal1);

$nodeVal2 = $crawler->filter('div.side_categories>ul > li > ul >li:nth-child(even)')->each(function (Crawler $node, $i){
    $even_cat_urls =  $node->filter("a")->attr("href");  
    $arr = ["even_cat_urls"=>$even_cat_urls];
    return $arr;
 });
//  print_r($nodeVal2);

function random_strings($length_of_string){
 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
    }


$nodeValues = $crawler->filter('.product_pod')->each(function (Crawler $node) {
   //search the value that I want 
    $title = $node->filter('h3>a')->attr('title');
    $price =  $node->filter('.price_color')->text();
    $stock = $node->filter('.availability.instock')-> text();
    $book_url = $node->filter('h3>a')->attr('href');
    $star_count = $node->filter('.star-rating')->attr('class');
    if($star_count == 'star-rating One'){
          $star_count = "1.0";
      }
    if($star_count == 'star-rating Two'){
        $star_count = "2.0";
    }
    if($star_count == 'star-rating Three'){
        $star_count = "3.0";
    }
    if($star_count == 'star-rating Four'){
        $star_count = "4.0";
    }

    if($star_count == 'star-rating Five'){
        $star_count = "5.0";
    }
    $id = random_strings(8);
    $category= "Science";
    $arr =array('id'=>$id,
           'category'=>$category,
           'title'=> $title,
           'price'=>$price,
           'stock'=>$stock,
           'book_url'=>$book_url,
           'rating'=>$star_count);    
    //print_r($arr);
    //echo '<br>';
    return $arr;  
});
//print_r($nodeValues);

//create a csv file with the data collected
$file = fopen('science_listing.csv','w');
foreach ($nodeValues as $n){
    fputcsv($file,$n);
}
foreach ($nodeVal1 as $nv){
    fputcsv($file,$nv);
}
foreach ($nodeVal2 as $nv){
    fputcsv($file,$nv);
}
fclose($file);
echo"CSv File Has Been Created";
echo"<br>";
echo"Scroll to see all the collected data";
echo"<br>";
?>

<!-- echo back the data in tabular format-->
<table border ='1' width='600' align='center'>
    <tr>
    <td>Id </td>
    <td>Category</td>
    <td>Title</td>
    <td>Price</td>
    <td>Stock</td>
    <td>Book_URL</td>
    <td>Ratings</td>
    </tr>
    <tr>
    <?php foreach($nodeValues as $nodeValues) {
        ?>
    <td><?php echo $nodeValues['id']?></td>
    <td><?php echo $nodeValues['category']?></td>
    <td><?php echo $nodeValues['title']?></td>
    <td><?php echo $nodeValues['price']?></td>
    <td><?php echo $nodeValues['stock']?></td>
    <td><?php echo $nodeValues['book_url']?></td>
    <td><?php echo $nodeValues['rating']?></td>
    </tr>
    <?php } ?>
</table>
<table border ='1' align='center'>
    <tr>
    <th>Category_URL</th>
    </tr>
    <?php foreach($nodeVal1 as $nodeVal1) { ?>
    <tr><td><?php echo $nodeVal1['odd_cat_urls']?></td></tr>
    <?php } ?>
    <?php foreach($nodeVal2 as $nodeVal2) { ?>
    <tr><td><?php echo $nodeVal2['even_cat_urls']?></td></tr>
    <?php } ?>
</table>