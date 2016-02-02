<?php

$API_KEY = "978d5968702d684a799f5dc4bb8ed54a";

function getArgosDeals()
{
    global $API_KEY;
    $response = file_get_contents("http://api.hotukdeals.com/rest_api/v2/?key=$API_KEY&order=hot&forum=deals&merchant=argos&results_per_page=10");
    $argosDeals = new SimpleXMLElement($response);
    $deals = $argosDeals->deals;
    foreach ($deals->api_item as $api_item)
      {
          $title = htmlspecialchars($api_item->title);
          $dealLink = $api_item->deal_link;
          $image = $api_item->deal_image;
          $linkAdd = substr(strrchr($image, "/"), 1, strpos(strrchr($image, "/"), ".")-1);
          $productLink = "http://www.hotukdeals.com/visit?m=5&q=".$linkAdd;
          $temperature = $api_item->temperature;
          preg_match('/\£([0-9]+[\.]*[0-9]*)/', $title, $match);
          $price = $match[1];

          echo "<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
          echo $price; 
          echo "<br>";
          echo $title;
          echo "<br>";
          echo $dealLink;
          echo "<br>";
          echo $productLink;
          echo "<br>";
          echo $temperature;
          echo "<br>";
          echo $image;
          echo "<br>";
          echo "<hr>";
      }
 //   print_r($deals);
     // var_dump($response);
    return $response;
}

getArgosDeals();

?>
