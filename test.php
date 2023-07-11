<?php
require_once "includes/functions.php";
require_once "includes/mysqlConnector.php";
?>
      // If no connection was made before, it is made now and assigned to
      // the static variable $con.
      <html>
      <body>
      
      <form action="action.php" method="post">
      Name: <input type="text" name="name"><br>
      E-mail: <input type="text" name="email"><br>
      <input type="submit" name='go'>
      </form>
      
      </body>
      </html>