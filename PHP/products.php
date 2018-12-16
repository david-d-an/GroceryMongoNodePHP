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
}
else {
  $result = json_decode($response);
}

$targetpage = "products.php";

if (!isset($_REQUEST["pagenumber"]) || empty($_REQUEST["pagenumber"])){
	$pagenumber = 1;
}
else{
  $pagenumber = $_REQUEST["pagenumber"];
}

if (!isset($_REQUEST["pagesize"]) || empty($_REQUEST["pagesize"])){
  $pagesize = 10;
}
else{
	$pagesize = $_REQUEST["pagesize"];
}

$pagecount = ceil(count($result) / $pagesize);

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
        <th style="width: 150px;">Options</th>
      </tr>
    </thead>

    <tbody>
<?php
// for($i=0; $i<count($result); $i++)

$itemcount = count($result);
$pagestart = ($pagenumber-1)*$pagesize;
$pageend = min($pagenumber*$pagesize, $itemcount);
$pagedisplaycount = $pageend - $pagestart;

for($i=$pagestart; $i < $pageend; $i++)
{  ?>
      <tr>
        <td><?php echo $result[$i]->_id; ?></th>
        <td><?php echo $result[$i]->ProductName; ?></td>
        <td><?php echo $result[$i]->SupplierID; ?></td>
        <td><?php echo $result[$i]->CategoryID; ?></td>
        <td><?php echo $result[$i]->QuantityPerUnit; ?></td>
        <td><?php echo $result[$i]->UnitPrice; ?></td>
        <td><?php echo $result[$i]->UnitsInStock; ?></td>
        <td>
          <a href="delete.php?_id=<?php echo $result[$i]->_id; ?>">
            <button type="button" class="btn btn-danger">Delete</button>
          </a>
          <!-- <a href="edit.php?_id=<?php echo $result[$i]->_id; ?>">
            <button type="button" class="btn btn-warning">Edit</button>
          </a> -->
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
            Edit
          </button>
        </td>
      </tr>
<?php } ?>
    </tbody>
  </table>
  <?php include './class_paging.php'; ?>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>