<?php
    // $host = "140.123.102.98";
    $host = "localhost";
    // $dBUser = "610238007";
    $dBUser = "root";
    // $dBPassword = "610238007";
    $dBPassword = "";
    // $dB = "610238007";
    $dB = "userlogin";
    $dBport = "3306";

    $connect = new mysqli($host, $dBUser, $dBPassword, $dB, $dBport);
    if ($connect->connect_error) {
        die("Connection Failed: " . $connect -> connect_error);
    }
?>