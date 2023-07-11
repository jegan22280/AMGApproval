<?php
define ("TITLE", "Login | Amerigas approvals");
require_once 'includes/mysqlConnector.php';
require_once 'includes/sessions.php';
require_once 'includes/functions.php';


if (isset($_SESSION['userID'])) {
  redirect_to('home.php');
}

if (isset($_POST['Submit'])){
  $username = $_POST['User'];
  $password =$_POST['Password'];
  if (empty($username)||empty($password)) {
    $_SESSION['errorMessage'] = 'All Fields must be filled out';
    redirect_to('index.php');
    }  else  {
  $foundAccount=loginAttempt($username, $password);

  if ($foundAccount) {
    // $_SESSION['loggedIn'] = '1';
    redirect_to('home.php');
  } else {
    $_SESSION['errorMessage'] = 'Incorrect Username/Password';
    redirect_to("index.php");
      }
    }
  }



require_once 'includes/loginheader.php';
?>

<div class="container">
  <div class="row">
    <div class="col-4 offset-4">
      <form class="form-signin" action="index.php" method="post">
        <div class="text-center">
            <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
        </div>
        <!-- username field -->
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="User" class="form-control" placeholder="Username">
          </div>
        </div>
        <!-- password field -->
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="Password" class="form-control" placeholder="Password">
          </div>
        </div>
          <button class="btn btn-lg btn-primary btn-block mt-2 mb-3" type="submit" name="Submit">Sign in</button>
          <?php  echo successMessage() ?>
          <?php  echo errorMessage() ?>
      </form>
    </div>
  </div>
</div>

<?php  require_once 'includes/footer.php'  ?>