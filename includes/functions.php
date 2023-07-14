<?php
function splooge($x){
  echo '<pre>';
  var_dump($x);
  echo '</pre>';
}

function redirect_to($navLocation){
  header('Location:'.$navLocation);
  exit;
}

function loginAttempt($username, $password){
  $loginConn = my_conn();
  $scrubbedUsername = $loginConn->real_escape_string($username);
  $scrubbedPassword = $loginConn->real_escape_string($password);
  $loginSQL = $loginConn->prepare("SELECT id, userName, password, identifier, isAdmin FROM users where BINARY userName = ? and BINARY password = ?");
  $loginSQL -> bind_param("ss",$scrubbedUsername,$scrubbedPassword);
  $loginSQL -> execute();
  $loginSQL -> bind_result($id, $user, $pwd, $uinit, $userlevel);
  $loginSQL -> store_result();

  if ($loginSQL ->num_rows == 1){
    if ($loginSQL->fetch()) {
      $loginResult = true;
      $_SESSION['userID']=$id;
      $_SESSION['user']=$uinit;
      $_SESSION['LUser']=$user;
      $_SESSION['ULevel']=$userlevel;
      }
    }  else {
      $loginResult = false;
    }
    return $loginResult;
    $loginConn->close();
  }

  function getInfo($param) {
    $infoConn = my_conn();
    $infoQuery = 'SELECT * from held_invoices where uniqueID = ?';
    $stmt = $infoConn->prepare($infoQuery);
    $stmt -> bind_param('i', $param);
    $stmt -> execute();
    $result = $stmt->get_result();
    $info = $result->fetch_assoc();
    return $info;
    $infoConn -> close();
  }

  function swapAuthStatus($action, $uniqueID, $comments)  {
    $date = date('Y-m-d');
    $statConn = my_conn();
    $authID = $_SESSION['user'];
    $statSQL = "UPDATE held_invoices set auth_status =?, auth_note=?, auth_id=?, auth_date=? where uniqueID =?";
    $statStmt = $statConn->prepare($statSQL);
    $statStmt -> bind_param('ssssi', $action, $comments, $authID, $date, $uniqueID);
    $statStmt -> execute();
    //not closing sql connect here as we need to leave this open to run two statements in a row  
  }

  function logWriter($action, $uniqueID, $comments, $scac, $pro, $ship) {
    //variable sets
    if ($action == 'A') {
      $logAction = 'Approve';
    } elseif ($action == 'R') {
      $logAction = 'Reject';
    }else {
      $logAction = 'Comment';
    }
    $date = date('Y-m-d');
    $logConn = my_conn();
    $authID = $_SESSION['user'];

    // sql query sets
    $logSql = "INSERT into approval_log (uniqueID, ship_date, note_date, user, comment, `action`, scac, pro) values (?,?,?,?,?,?,?,?)";
    $logStmt = $logConn->prepare($logSql);
    $logStmt -> bind_param('isssssss', $uniqueID, $ship, $date, $authID, $comments, $logAction, $scac, $pro);
    $logStmt -> execute();
    $logConn -> close();

  }
?>
