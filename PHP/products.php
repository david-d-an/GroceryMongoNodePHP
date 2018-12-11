<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

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
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: 54552f0b-3b4a-4d4e-a936-227034ca38f1",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else { $yummy = json_decode($response); }
?>

<div class="container">
  <h2>Striped Rows</h2>
  <p>The .table-striped class adds zebra-stripes to a table:</p>            

  <a href="new.php">
    <button class="btn btn-primary">Add New</button>
  </a>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>ProductName</th>
        <th>SupplierID</th>
        <th>CategoryID</th>
        <th>QuantityPerUnit</th>
        <th>UnitPrice</th>
        <th>UnitsInStock</th>
      </tr>
    </thead>

    <tbody>
<?php
for($i=0; $i<count($yummy); $i++)
{  ?>
      <tr>
        <td><?php echo $yummy[$i]->_id; ?></th>
        <td><?php echo $yummy[$i]->ProductName; ?></td>
        <td><?php echo $yummy[$i]->SupplierID; ?></td>
        <td><?php echo $yummy[$i]->CategoryID; ?></td>
        <td><?php echo $yummy[$i]->QuantityPerUnit; ?></td>
        <td><?php echo $yummy[$i]->UnitPrice; ?></td>
        <td><?php echo $yummy[$i]->UnitsInStock; ?></td>
      </tr>
<?php } ?>
    </tbody>
  </table>
</div>
