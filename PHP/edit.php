<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/product/".$_REQUEST['_id'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "{\"ProductID\": \"6\",\"ProductName\": \"Your Boysenberry Spread\",\"SupplierID\": \"3\",\"CategoryID\": \"2\",\"QuantityPerUnit\": \"12 - 8 oz jars\",\"UnitPrice\": 25,\"UnitsInStock\": 120,\n    \"UnitsOnOrder\": 0,\n    \"ReorderLevel\": 25,\n    \"Discontinued\": 0\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: c1d19e09-7e5e-4104-b3ca-51b235c5566a",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}
else {
  echo $response;
}
?>

<meta http-equiv="refresh" content="0;url=products.php">
