
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
  CURLOPT_POSTFIELDS => '{"ProductID":"27894","ProductName":"Chang22","SupplierID":"122","CategoryID":"122","QuantityPerUnit":"222 - 1222 oz bottles","UnitPrice":"1922","UnitsInStock":"1722","UnitsOnOrder":"420","ReorderLevel":"2522","Discontinued":"0"}',
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

<meta http-equiv="refresh" content="0;url=./index.php">