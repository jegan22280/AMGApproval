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
    logWriter('A',$_SESSION['queryParameter'],$_POST['comment'],$_SESSION['scac'],$_SESSION['pro'],$_SESSION['shipDate']);
    unset($_SESSION['queryParameter']);
    unset($_SESSION['scac']);
    unset($_SESSION['pro']);
    unset($_SESSION['shipDate']);
    redirect_to('home.php');
  }

  if (isset($_POST['Reject'])) {
    swapAuthStatus('R',$_SESSION['queryParameter'],$_POST['comment']);
    logWriter('R',$_SESSION['queryParameter'],$_POST['comment'],$_SESSION['scac'],$_SESSION['pro'],$_SESSION['shipDate']);
    unset($_SESSION['queryParameter']);
    unset($_SESSION['scac']);
    unset($_SESSION['pro']);
    unset($_SESSION['shipDate']);
    redirect_to('home.php');
  }

  if (isset($_POST['Comment'])) {
    logWriter('C',$_SESSION['queryParameter'],$_POST['comment'],$_SESSION['scac'],$_SESSION['pro'],$_SESSION['shipDate']);
    unset($_SESSION['queryParameter']);
    unset($_SESSION['scac']);
    unset($_SESSION['pro']);
    unset($_SESSION['shipDate']);
    redirect_to('home.php');
  }
?>
