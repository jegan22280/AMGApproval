<?php

$connStr = 
        'Driver={Microsoft Access Driver (*.mdb, *.accdb)};' .
        'Dbq=\\\\192.168.0.22\\n-drive\\AmerigasPHPTest.accdb';
$invDbh = new PDO($connStr);
$invDbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)

// $con = new COM("ADODB.Connection", NULL, CP_UTF8);  // specify UTF-8 code page
// $con->Open($connStr);

?>