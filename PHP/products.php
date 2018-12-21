<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/contents.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
session_start();
// echo $_SESSION['_id'];
// echo $_SESSION['userid'];

// if (!isset($_SESSION['_id'])) {
//   echo "<script>location.href='./auth/login.php';</script>";
// }

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
      "cache-control: no-cache",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $result = json_decode($response);
}

$targetpage = "products.php";

if (!isset($_REQUEST["pagenumber"]) || empty($_REQUEST["pagenumber"])) {
    $pagenumber = 1;
} else {
    $pagenumber = $_REQUEST["pagenumber"];
}

if (!isset($_REQUEST["pagesize"]) || empty($_REQUEST["pagesize"])) {
    $pagesize = 10;
} else {
    $pagesize = $_REQUEST["pagesize"];
}

$pagecount = ceil(count($result) / $pagesize);

?>

<div class="container">
  <h2>Grocery Products</h2>

  <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#addEditModal">
    Add New Product
  </button>
  <!-- <a href="addNewProduct.php">
  </a> -->

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
$pagestart = ($pagenumber - 1) * $pagesize;
$pageend = min($pagenumber * $pagesize, $itemcount);
$pagedisplaycount = $pageend - $pagestart;

for ($i = $pagestart; $i < $pageend; $i++) {?>
      <tr>
        <td class="_id"><?php echo $result[$i]->_id; ?></th>
        <td class="productname"><?php echo $result[$i]->ProductName; ?></td>
        <td class="supplierid"><?php echo $result[$i]->SupplierID; ?></td>
        <td class="categoryid"><?php echo $result[$i]->CategoryID; ?></td>
        <td class="quantityperunit"><?php echo $result[$i]->QuantityPerUnit; ?></td>
        <td class="unitprice"><?php echo $result[$i]->UnitPrice; ?></td>
        <td class="unitsinstock"><?php echo $result[$i]->UnitsInStock; ?></td>
        <td>
          <a href="delete.php?_id=<?php echo $result[$i]->_id; ?>">
            <button type="button" class="btn btn-danger">Delete</button>
          </a>
          <button type="button" class="btn btn-warning btn-edit" data-toggle="modal" data-target="#addEditModal">
            Edit
          </button>
        </td>
      </tr>
<?php }?>
    </tbody>
  </table>
  <?php include './class_paging.inc';?>
</div>



<!-- Modal -->
<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addeditform" action="editProduct.php" method="get">
        <div class="modal-header">
          <label id="addEditModalLabel">Add/Edit Product</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="form-group spacer-lg _id">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="productid">Product ID</label>
                </div>
                <div class="col-lg-7">
                  <input readonly="readonly" type="text" class="form-control" id="_id" name="_id" aria-describedby="productid">
                  <small id="productidHelp" class="form-text text-muted">Product ID is very important.</small>
                </div>
              </div>
              <div class="form-group spacer-md productname">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="productname">Product Name</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name">
                </div>
              </div>
              <div class="form-group spacer-md supplierid">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="supplierid">Supplier ID</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="supplierid" name="supplierid" placeholder="Supplier ID">
                </div>
              </div>
              <div class="form-group spacer-md categoryid">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="categoryid">Category ID</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="categoryid" name="categoryid" placeholder="Category ID">
                </div>
              </div>
              <div class="form-group spacer-md quantityperunit">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="quantityperunit">Quantity per Unit</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="quantityperunit" name="quantityperunit" placeholder="Quantity per Unit">
                </div>
              </div>
              <div class="form-group spacer-md unitprice">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitprice">Unit Price</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitprice" name="unitprice" placeholder="Unit Price">
                </div>
              </div>
              <div class="form-group spacer-md unitsinstock">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitsinstock">Units in Stock</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitsinstock" name="unitsinstock" placeholder="Units in Stock">
                </div>
              </div>
              <div class="form-group spacer-md unitsonorder">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitsonorder">Units on Order</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitsonorder" name="unitsonorder" placeholder="Units on Order">
                </div>
              </div>
              <div class="form-group spacer-md reorderlevel">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="reorderlevel">Reorder Level</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="reorderlevel" name="reorderlevel" placeholder="Reorder Level">
                </div>
              </div>
              <div class="form-group spacer-md discontinued">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="discontinued">Discontinued</label>
                </div>
                <div class="col-lg-7">
                  <!-- <input type="text" class="form-control" id="discontinued" name="discontinued"> -->
                  <select class="form-control" id="discontinued" name="discontinued">
                    <option></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary btn-modal-save" value="Save Changes"/>
          <!-- <button type="button" class="btn btn-primary btn-save">Save Changes</button> -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script typ='text/javascript'>

$('.btn-add').on('click', function(e) {
  $('#addeditform').attr('action', 'addNewProduct.php');
  $('.btn-modal-save').attr('value','Add Product');
  $('#addEditModalLabel').text('Add New Product');

  $('div._id').hide();
  $('div.productname').show();
  $('div.supplierid').show();
  $('div.categoryid').show();
  $('div.quantityperunit').show();
  $('div.unitprice').show();
  $('div.unitsinstock').show();
  $('div.unitsonorder').show();
  $('div.reorderlevel').show();
  $('div.discontinued').show();
});

$('.btn-edit').on('click', function(e) {
  $('#addeditform').attr('action', 'editProduct.php');
  $('.btn-modal-save').attr('value', 'Update Product');
  $('#addEditModalLabel').text('Update Product');

  $('div._id').show();
  $('div.productname').show();
  $('div.supplierid').show();
  $('div.categoryid').show();
  $('div.quantityperunit').show();
  $('div.unitprice').show();
  $('div.unitsinstock').show();
  $('div.unitsonorder').hide();
  $('div.reorderlevel').hide();
  $('div.discontinued').hide();

  var _id = GetColumnValue($(this), '_id');
  var productName = GetColumnValue($(this), 'productname');
  var supplierID = GetColumnValue($(this), 'supplierid');
  var categoryID = GetColumnValue($(this), 'categoryid');
  var quantityPerUnit = GetColumnValue($(this), 'quantityperunit');
  var unitPrice = GetColumnValue($(this), 'unitprice');
  var unitsInStock = GetColumnValue($(this), 'unitsinstock');

  $('#_id').val(_id);
  $('#productname').val(productName);
  $('#supplierid').val(supplierID);
  $('#categoryid').val(categoryID);
  $('#quantityperunit').val(quantityPerUnit);
  $('#unitprice').val(unitPrice);
  $('#unitsinstock').val(unitsInStock);
});

$('#addEditModal').on('hidden.bs.modal', function () {
  $('#_id').val("");
  $('#productname').val("");
  $('#supplierid').val("");
  $('#categoryid').val("");
  $('#quantityperunit').val("");
  $('#unitprice').val("");
  $('#unitsinstock').val("");
  $('#unitsonorder').val("");
  $('#reorderlevel').val("");
  $('#discontinued').val("");
})

function GetColumnValue(cell, columnName) {
  var row = $(cell.parent().parent()[0]);
  var val = ProcessString(row.children('.'+columnName)[0].innerHTML.trim());
  return val;
}

function ProcessString(str){
  if (str)
    return str.trim();
  else
    return ""; 
}
</script>