<?php

// $serveName = "localhost";
// $dbUsername = "root";
// $dbPassword = "";
// $dbName = "gym";

$serveName = "remotemysql.com";
$dbUsername = "fVM4QtnG9J";
$dbPassword = "XjbHLZvrVc";
$dbName = "fVM4QtnG9J";

$conn = mysqli_connect($serveName,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    // echo "Success from dbh";
}