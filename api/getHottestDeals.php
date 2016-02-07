<?php

$HDUK_API_KEY = "978d5968702d684a799f5dc4bb8ed54a";
$BB_API_KEY   = "xwxyr9ukuyygqn4fjqcq5uvp";
$value        = "An error has occured";
// Possibility to add more API methods here, hence the switch statement.
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "argosDeals":
            $value = getArgosDeals();
            break;
    }
}
// Tell the requester that the resulting output is in JSON form.
header('Content-type: application/json');
print_r(json_encode($value));

/*
 * Retreives an xml response from the UKHotDeals API, containing the top 10 hottest deals spotted on the Argos site.
 * Extracts main details, and forms a JSON object. Generates product links, and calls the method to find similar
 * products on the BestBuy site. Sorts the products returned by the largest difference in price between Argos and BestBuy.
 */
function getArgosDeals()
{
    global $HDUK_API_KEY;
    $response       = file_get_contents("http://api.hotukdeals.com/rest_api/v2/?key=$HDUK_API_KEY&order=hot&forum=deals&merchant=argos&results_per_page=10");
    $argosDeals     = new SimpleXMLElement($response);
    $deals          = $argosDeals->deals;
    $returnProducts = array();
    foreach ($deals->api_item as $api_item) {
        $title           = htmlspecialchars($api_item->title);
        $description     = htmlspecialchars($api_item->description);
        $dealLink        = (string) $api_item->deal_link;
        $image           = (string) $api_item->deal_image_highres;
        $linkAdd         = substr(strrchr($image, "/"), 1, strpos(strrchr($image, "/"), ".") - 1);
        $productLink     = "http://www.hotukdeals.com/visit?m=5&q=" . $linkAdd;
        $temperature     = (float) $api_item->temperature;
        $price           = extractArgosPrice($title);
        $altPrice        = $price; //getBestBuyPrice($title); //TODO! - see method.
        $priceDifference = $altPrice - $price;
        $product         = buildProductJSON($title, $description, $price, $dealLink, $productLink, $temperature, $image, $altPrice, $priceDifference);
        array_push($returnProducts, $product);
    }
    usort($returnProducts, 'my_sort');
    return $returnProducts;
}

/*
 * Extracts the product price from the title of the product using Regex.
 * If a string containing the £ sign is not found, it then looks for a decimal value. Otherwise it returns 0, (Not found).
 */
function extractArgosPrice($title)
{
    preg_match('/\£([0-9]+[\.]*[0-9]*)/', $title, $match);
    if (empty($match)) {
        preg_match('/\?*([0-9]+[\.]*[0-9]*)/', $title, $match);
        if (empty($match)) {
            return 0;
        } else
            return floatval($match[1]);
    } else
        return floatval($match[1]);
}

/*
 * Calls the BestBuy API, searching using the first 3 words from the title given by the HotUKDeals API. 
 * Returns the price of the top result (Most relevent).
 */
function getBestBuyPrice($title)
{
    global $BB_API_KEY;
    $words    = explode(" ", $title);
    $response = file_get_contents("https://api.bestbuy.com/v1/products((search=$words[0]&search=$words[1]&search=$words[2]))?apiKey=$BB_API_KEY&facet=regularPrice&callback=JSON_CALLBACK&format=json");
    // TODO
    /* Search results in no results/ results with products not matching enough....
    Would be useful to have some uniform product ID or barcode from HotUKDeals to send across
    other API's such as this one!
    */
}

/*
 * Takes in a set of parameters, and generates an object representing a product to be converted to JSON.
 * Returns the associative array, for sending back to the requesting page.
 */
function buildProductJSON($title, $description, $price, $dealLink, $productLink, $temperature, $image, $altPrice, $priceDifference)
{
    $arr = array(
        "title" => $title,
        "description" => $description,
        "price" => $price,
        "dealLink" => $dealLink,
        "productLink" => $productLink,
        "temperature" => $temperature,
        "image" => $image,
        "altPrice" => $altPrice,
        "priceDifference" => $priceDifference
    );
    return $arr;
}

/*
 * A sort function, sorting by largest price difference first.
 */
function my_sort($a, $b)
{
    if ($a[priceDifference] > $b[priceDifference]) {
        return -1;
    } else if ($a[priceDifference] < $b[priceDifference]) {
        return 1;
    } else {
        return 0;
    }
}

?>
