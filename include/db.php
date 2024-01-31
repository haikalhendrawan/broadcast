<?php

$hostname = "";
$username = "";
$password ="";
$database ="";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn){
    echo "connection failed";
}

