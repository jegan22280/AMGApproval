<?php

$connStr = 
        'Driver={Microsoft Access Driver (*.mdb, *.accdb)};' .
        'Dbq=\\\\192.168.0.22\\n-drive\\AmerigasPHPTest.accdb';
$con = odbc_connect($connStr, '', '');
// new COM("ADODB.Connection", NULL, CP_UTF8);  // specify UTF-8 code page
// $con->Open($connStr);

// $rst = new COM("ADODB.Recordset");
$sql = "SELECT * FROM frtbill";
$rst = odbc_exec($con, $sql);

$data = array();
$i = 0;

while ($row = odbc_fetch_array($rst)) {
    $data[$i] = $row;
    $i++;# code...
}

// var_dump($data);

odbc_close($con);
echo json_encode($data);
?>