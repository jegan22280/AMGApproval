<?php
require_once "includes/functions.php";
require_once "includes/mysqlConnector.php";

      // If no connection was made before, it is made now and assigned to
      // the static variable $con.
      
$x=1;      

$conn = my_conn();
$sql = $conn->prepare("SELECT userName, password from users where id = ?");
$sql -> bind_param("s", $x);
$sql -> execute();
splooge($sql);
?>