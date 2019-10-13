<?php

    $server    = 'localhost';
    $username  = 'root';
    $password  = '12345678';
    $dbname    = 'ltax';
    $charset   = 'utf8';


    // Create connection
    $conn = new mysqli($server, $username, $password,$dbname);
    $conn->set_charset($charset);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
 ?>
