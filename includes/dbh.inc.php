<?php
//connect to data base//
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBname = "logindb";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBname);
if(!$conn){
   die("Connection failed: " . mysqli_connect_error());
}
