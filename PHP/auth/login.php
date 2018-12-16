<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login to POS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="../packages/dist/css/formValidation.css"/>
  <script type="text/javascript" src="../packages/dist/js/formValidation.js"></script>
  <script type="text/javascript" src="../packages/dist/js/framework/bootstrap.js"></script>
</head>

<style>
  body {
    margin-top:20px;
  }
  .modal-footer {
    border-top: 0px;
  }
</style>

<body>

<?php
session_start();
session_unset();

if (!empty($_REQUEST['username']) and !empty($_REQUEST['password'])) {
?>
	<form id="lol" action="passport.php" 	method="post">
    <input type="hidden" name="void" 		value="yes">
    <input type="hidden" name="username" 	value="<?php echo $_REQUEST['username']; ?>">
    <input type="hidden" name="password" 	value="<?php echo $_REQUEST['password']; ?>">
    <input type="hidden" name="log" 		value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
	</form>
  
  <script>
    document.getElementById('lol').submit();
  </script>
<?php
}
?>

<br />
<br />
<br />
<br />
<br />

<p class="text-center">
  <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#loginModal">
    &nbsp;Login&nbsp;
  </button>
  &nbsp;&nbsp;&nbsp;&nbsp;
	<a href="https://www.google.com" class="btn btn-lg btn-success">Cancel</a>
</p>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Login</h5>
      </div>

      <div class="modal-body">
        <!-- The form is placed inside the body of modal -->
        <form id="loginForm" method="post" class="form-horizontal">
          <div class="form-group">
            <label class="col-xs-3 control-label">Username</label>
            <div class="col-xs-5">
              <input type="text" class="form-control" name="username"/>
            </div>
          </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Password</label>
              <div class="col-xs-5">
                <input type="password" class="form-control" name="password" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-5 col-xs-offset-3">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#loginForm').formValidation({
    framework: 'bootstrap',
    excluded: ':disabled',
    icon: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      username: {
        validators: {
          notEmpty: {
            message: 'The username is required'
          }
        }
      },
      password: {
        validators: {
          notEmpty: {
            message: 'The password is required'
          }
        }
      }
    }
  });
});
</script>

</body>
</html>
