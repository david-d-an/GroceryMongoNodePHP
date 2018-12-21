<?php 
// echo $yummy[$i]->_id; exit();
echo $_REQUEST['_id'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/product/".$_REQUEST['_id'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "DELETE",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: accddc79-f9a2-4322-b568-e6b5c0191912",
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

<meta http-equiv="refresh" content="0;url=./index.php">
