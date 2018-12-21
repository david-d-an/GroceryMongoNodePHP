<?php

$userid = $_REQUEST['username'];
$password = $_REQUEST['password'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/authentication/".$userid."/".$password,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  // CURLOPT_POSTFIELDS => "{\n    \"ProductID\": \"6\",\n    \"ProductName\": \"My Boysenberry Spread\",\n    \"SupplierID\": \"3\",\n    \"CategoryID\": \"2\",\n    \"QuantityPerUnit\": \"12 - 8 oz jars\",\n    \"UnitPrice\": 25,\n    \"UnitsInStock\": 120,\n    \"UnitsOnOrder\": 0,\n    \"ReorderLevel\": 25,\n    \"Discontinued\": 0\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: 402cc4f8-162d-446b-9738-a5152a9d0923",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $json = json_decode($response, true);

  if (count($json) == 0){
    echo "<script>location.href='./login.php';</script>";
  } elseif (!isset($json['_id'])) {
    echo "<script>location.href='./login.php';</script>";
  } else {
    session_start();
    $_SESSION['_id'] = $json['_id'];
    $_SESSION['userid'] = $json['CustomerID'];

    // echo $_SESSION['_id'];
    // echo $_SESSION['userid'];

    echo "<script>location.href='../product/index.php';</script>";
  }
}
