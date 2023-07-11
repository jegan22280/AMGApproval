<?php 
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/mysqlConnector.php';


  if ($_SESSION['ULevel'] < 700) {
    $_SESSION['errorMessage'] = 'You do not have permission to preform this action';
    redirect_to('error.php');
  }

  if (isset($_POST['Approve'])) {
    swapAuthStatus('A',$_SESSION['queryParameter'],$_POST['comment']);
  }

  if (isset($_POST['Reject'])) {
    swapAuthStatus('R',$_SESSION['queryParameter'],$_POST['comment']);
  }
  
?>
