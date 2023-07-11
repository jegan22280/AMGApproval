<?php

try {
        $connStr = 'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=\\\\192.168.0.22\\n-drive\\AmerigasPHPTest.accdb';
        $invDbh = new PDO($connStr);
        $invDbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOexception $e) {
        echo "Connection failed: " . $e->getMessage();
        }


?>