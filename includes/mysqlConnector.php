<?php
//this function is here for my ease of use. I can make changes to the connection string here and they will now be applied site wide.
function my_conn() {
  // Static variables are remembered between function calls. Otherwise, each call
  // to the function would make a new connection.
  static $myConn = null;
  // Checks if there is a value assigned from a previous call.
  if ($myConn === null)
  {
      // If no connection was made before, it is made now and assigned to
      // the static variable $con.
      $myConn = mysqli_connect('192.168.0.16', 'amg', 'amg@1359', 'AMGApprovals');
      $myConn -> set_charset("utf8");
  }
  // The connection is returned, whether it was made now or during a previous call.
  return $myConn;
}
?>