<!-- Welcome <?php echo $_GET["_id"]; ?> -->
<?php

$_id = $_GET["_id"];
$productName = $_GET["productname"];
$supplierId = $_GET["supplierid"];
$categoryId = $_GET["categoryid"];
$quantityPerUnit = $_GET["quantityperunit"];
$unitPrice = $_GET["unitprice"];
$unitsInStock = $_GET["unitsinstock"];

$updateString =
  '{'.
    // '"_id"      '.': '.'"'.$_id.'",'.
    '"ProductName"    '.': '.'"'.$productName.'",'.
    '"SupplierID"     '.': '.'"'.$supplierId.'",'.
    '"CategoryID"     '.': '.'"'.$categoryId.'",'.
    '"QuantityPerUnit"'.': '.'"'.$quantityPerUnit.'",'.
    '"UnitPrice"      '.': '.'"'.$unitPrice.'",'.
    '"UnitsInStock"   '.': '.'"'.$unitsInStock.'"'.
    // '"UnitsOnOrder"   '.': '.'"'.$unitsonorder.'",'.
    // '"ReorderLevel"   '.': '.'"'.$reorderlevel.'",'.
    // '"Discontinued"   '.': '.'"'.$discontinued.'"'.
  '}';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "3000",
  CURLOPT_URL => "http://localhost:3000/product/".$_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => $updateString,
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