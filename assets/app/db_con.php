<?php
    $server = "localhost";
    $dbusername = "gabie";
    $dbpassword = "Gu*r7Fr#y_1Knx2F"; 
    $dbname = "ng_scholars";


    $connectDB = mysqli_connect($server,$dbusername,$dbpassword,$dbname);
    if (!$connectDB) {
        die('failed to connect').mysqli_connect_error();

    }

    $connectDBB = mysqli_connect($server,$dbusername,$dbpassword,$dbname);
    if (!$connectDBB) {
        die('failed to connect').mysqli_connect_error();

    }
?>