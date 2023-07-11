<?php 
  require_once 'includes/functions.php';
  require_once 'includes/sessions.php';
  require_once 'includes/mysqlConnector.php';


//   if (!isset($_SESSION['ID'])) {
//     redirect_to('home.php');
//   }

  if (isset($_POST['Approve'])) {
    swapAuthStatus('A',$_SESSION['queryParameter'],$_POST['comment']);
  }

  if (isset($_POST['Reject'])) {
    swapAuthStatus('R',$_SESSION['queryParameter'],$_POST['comment']);
  }
  
splooge($_POST);
splooge($_SESSION);
// unset($_SESSION['queryParameter']);
?>
