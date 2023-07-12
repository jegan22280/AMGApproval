<?php
require_once 'mysqlConnector.php';

$readLogConn = my_conn();

$readLogSql = "SELECT * from approval_log order by `date` desc";
if ($result = $readLogConn->query($readLogSql)) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $myArray[] = $row;
  }
  echo json_encode($myArray);
}
?>