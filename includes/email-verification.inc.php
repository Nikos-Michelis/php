<?php

if (isset($_POST["verify_email"])){
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // create a type of error messages//
    if(verificationEmail($conn, $email, $verification_code, $email_verified_at) !== false){
        header("location: ../email-verification.php?error=Verificationcodefailed");
        exit();
    }
        header("location: ../succregister.php");
        exit();

}else{
    header("location: ../email-verification.php?error=EmailVerificationError");
    exit();

}