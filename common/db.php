<?php
//define('DBCONNECTION', mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME));
$DBCONNECTION = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
if (!$DBCONNECTION) {
    die("Connection failed: " . mysqli_connect_error());
}