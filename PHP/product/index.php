<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/contents.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../packages/FormValidation/css/formValidation.css"/>
  <script type="text/javascript" src="../packages/FormValidation/js/formValidation.js"></script>
  <script type="text/javascript" src="../packages/FormValidation/js/framework/bootstrap.js"></script>
</head>

<?php
session_start();
// echo $_SESSION['_id'];
// echo $_SESSION['userid'];

if (!isset($_SESSION['_id'])) {
  echo "<script>location.href='../auth/login.php';</script>";
}

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

$targetpage = "index.php";

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

<?php include '../master/fullHeader.php';?>

<div class="container">
  <h2>Grocery Products</h2>

  <button type="button" class="btn btn-primary btn-add pull-right" data-toggle="modal" data-target="#addEditModal">
    Add New Product
  </button>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Supplier</th>
        <th>Category</th>
        <th>Quantity/Unit</th>
        <th>Unit Price</th>
        <th>In Stock</th>
        <th></th>
        <th></th>
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
          <p data-placement="bottom" data-toggle="tooltip" title="Edit">
            <button type="button" class="btn btn-warning btn-edit" data-toggle="modal" data-target="#addEditModal">
              <span class="glyphicon glyphicon-pencil"></span>
            </button>
          </p>
        </td>
        <td>
          <p data-placement="top" data-toggle="tooltip" title="Delete">
            <a href="./delete.php?_id=<?php echo $result[$i]->_id; ?>">
              <button type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-trash"></span>
              </button>
            </a>
          </p>
        </td>
      </tr>
<?php }?>
    </tbody>
  </table>
  <?php include './pagination.inc';?>
</div>



<!-- Modal -->
<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addeditform" action="./edit.php" method="get" class="form-horizontal">
        <div class="modal-header">
          <label id="addEditModalLabel">Add/Edit Product</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="form-group _id">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="productid">Product ID</label>
                </div>
                <div class="col-lg-7">
                  <input readonly="readonly" type="text" class="form-control" id="_id" name="_id" aria-describedby="productid">
                  <small id="productidHelp" class="form-text text-muted">Product ID is very important.</small>
                </div>
              </div>
              <div class="form-group productname">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="productname">Product Name</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="productname" name="productname" >
                </div>
              </div>
              <div class="form-group supplierid">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="supplierid">Supplier ID</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="supplierid" name="supplierid" placeholder="Supplier ID">
                </div>
              </div>
              <div class="form-group categoryid">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="categoryid">Category ID</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="categoryid" name="categoryid" placeholder="Category ID">
                </div>
              </div>
              <div class="form-group quantityperunit">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="quantityperunit">Quantity per Unit</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="quantityperunit" name="quantityperunit" placeholder="Quantity per Unit">
                </div>
              </div>
              <div class="form-group unitprice">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitprice">Unit Price</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitprice" name="unitprice" placeholder="Unit Price">
                </div>
              </div>
              <div class="form-group unitsinstock">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitsinstock">Units in Stock</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitsinstock" name="unitsinstock" placeholder="Units in Stock">
                </div>
              </div>
              <div class="form-group unitsonorder">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="unitsonorder">Units on Order</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="unitsonorder" name="unitsonorder" placeholder="Units on Order">
                </div>
              </div>
              <div class="form-group reorderlevel">
                <div class="col-lg-3 col-lg-offset-1">
                  <label for="reorderlevel">Reorder Level</label>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="form-control" id="reorderlevel" name="reorderlevel" placeholder="Reorder Level">
                </div>
              </div>
              <div class="form-group discontinued">
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
  $('#addeditform').attr('action', './create.php');
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

  $('#_id').addClass("no-validation");
});

$('.btn-edit').on('click', function(e) {
  $('#addeditform').attr('action', './edit.php');
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

  $('#unitsonorder').addClass("no-validation");
  $('#reorderlevel').addClass("no-validation");
  $('#discontinued').addClass("no-validation");

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

  $('#productname').removeClass("no-validation");
  $('#supplierid').removeClass("no-validation");
  $('#categoryid').removeClass("no-validation");
  $('#quantityperunit').removeClass("no-validation");
  $('#unitprice').removeClass("no-validation");
  $('#unitsinstock').removeClass("no-validation");
  $('#unitsonorder').removeClass("no-validation");
  $('#reorderlevel').removeClass("no-validation");
  $('#discontinued').removeClass("no-validation");
})

function GetColumnValue(cell, columnName) {
  var row = $(cell.parent().parent().parent()[0]);
  var val = ProcessString(row.children('.'+columnName)[0].innerHTML.trim());
  return val;
}

function ProcessString(str){
  if (str)
    return str.trim();
  else
    return ""; 
}

$(function() {
  $('#addeditform').formValidation({
    framework: 'bootstrap',
    excluded: '.no-validation',
    icon: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      productname: {
        validators: {
          notEmpty: {
            message: 'Product Name is required'
          }
        }
      },
      supplierid: {
        validators: {
          notEmpty: {
            message: 'Supplier ID is required'
          }
        }
      },
      categoryid: {
        validators: {
          notEmpty: {
            message: 'Category ID is required'
          }
        }
      },
      quantityperunit: {
        validators: {
          notEmpty: {
            message: 'Quantity per Unit is required'
          }
        }
      },
      unitprice: {
        validators: {
          notEmpty: {
            message: 'Unit Price is required'
          },
          regexp: {
            regexp: /^\d+(?:\.\d{0,2})?$/,
            message: 'Unit Price must be a dollar value'
          }
        }
      },
      unitsinstock: {
        validators: {
          notEmpty: {
            message: 'Units in Stock is required'
          },
          integer: {
            message: 'Units in Stock must be a number'
          }
        }
      },
      unitsonorder: {
        validators: {
          notEmpty: {
            message: 'Units on Order is required'
          },
          integer: {
            message: 'Units on Order must be a number'
          }
        }
      },
      reorderlevel : {
        validators: {
          notEmpty: {
            message: 'Reorder Level is required'
          },
          integer: {
            message: 'Reorder Level must be a number'
          }
        }
      },     discontinued: {
        validators: {
          notEmpty: {
            message: 'Discontinued is required'
          }
        }
      }
    }
  });
});
</script>
