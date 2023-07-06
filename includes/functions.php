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
      $_SESSION['ID']=$id;
      setcookie('user', $uinit, 0);
      $_SESSION['LUser']=$user;
      $_SESSION['ULevel']=$userlevel;
      }
    }  else {
      $loginResult = false;
    }
    return $loginResult;
    $loginConn->close();
  }

?>
