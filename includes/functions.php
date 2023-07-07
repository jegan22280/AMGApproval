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

  function buildURL() {
    // Get the id attribute value for the table.
    $id = "dataTable";
    // Get the HTML source code for the table.
    $html = file_get_contents("home.php");
    // Load the HTML source code into a DOMDocument object.
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    // Get the table object.
    $table = $dom->getElementById(id);
    // Get the rows of the table.
    $rows = $table->getElementsByTagName("tr");
    // Iterate through the rows of the table.
    foreach ($rows as $row) {
        // Get the cells of the row.
        $cells = $row->getElementsByTagName("td");
        // Use the cell values to do whatever you need to do with them.
        echo $cells[0]->textContent . " " . $cells[1]->textContent . "<br>";
    }
  }
?>
