
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/product",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"ProductID\": \"2222\",\n    \"ProductName\": \"Chang22\",\n    \"SupplierID\": \"122\",\n    \"CategoryID\": \"122\",\n    \"QuantityPerUnit\": \"222 - 1222 oz bottles\",\n    \"UnitPrice\": 1922,\n    \"UnitsInStock\": 1722,\n    \"UnitsOnOrder\": 420,\n    \"ReorderLevel\": 2522,\n    \"Discontinued\": 0\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: a4c98706-dda9-447f-b9a4-02c810e26d92",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>

<meta http-equiv="refresh" content="0;url=products.php">