<?php

$service_url = 'http://api.hotukdeals.com/rest_api/v2/';
       $curl = curl_init($service_url);
       $curl_post_data = array(
            "key" => "978d5968702d684a799f5dc4bb8ed54a",
            "order" => "hot",
            "forum" => "vouchers",
            "results_per_page" => 5
            );
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($curl, CURLOPT_POST, true);
       curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
       $curl_response = curl_exec($curl);
       curl_close($curl);

       $xml = new SimpleXMLElement($curl_response);

echo $xml;


?>
