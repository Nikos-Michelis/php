<?php

if(isset($_POST["submit"])){
    $username =  $_POST["uid"];
    $password =  $_POST["password"];
    $email =  $_POST["uid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($username, $password ) !== false){
        header("location: ../login.php?error=emptyInput");
        exit();
    }
    loginUser($conn, $username, $password,$email);
    $user = mysqli_fetch_object($result);
}else{
    header("location: ../login.php");
    exit();

}
