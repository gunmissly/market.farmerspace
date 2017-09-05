<?php
$servername = "28128477-22-20170313120252.webstarterz.com";
$dbname = "cp157440_farmerspace";
$username = "cp157440_admin";
$password = "@Dmin1234";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>