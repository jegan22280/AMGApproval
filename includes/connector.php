<?php

try {
        // $connStr = 'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=p:\\AmerigasPHPTest.accdb';
        $connStr = 'odbc:Provider=Microsoft.ACE.OLEDB.12.0;Data Source=P:\\AmerigasPHPTest.accdb;mode=Read';
        $invDbh = new PDO($connStr);
        $invDbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOexception $e) {
        echo "Connection failed: " . $e->getMessage();
        }


?>