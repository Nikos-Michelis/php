<?php
// check if form fields is empty//
if (isset($_POST["submit"])){
   
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username =  $_POST["uid"];
  $password =  $_POST["password"];
  $pwdRepeat =  $_POST["pwdrepeat"];
  
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  //check if form fields is empty and create a type of error message//
  if(emptyInputSignup($name, $email, $username, $password, $pwdRepeat ) !== false){
      header("location: ../signup.php?error=emptyInput");
      exit();
  }
  //ERROR HANDLERS//
  // check form fields and create a type of error messages//
  if(invalidName($name) !== false){
    header("location: ../signup.php?error=invalidName");
    exit();
}
  if(invalidUid($username) !== false){
      header("location: ../signup.php?error=invalidUid");
      exit();
  }
  if(invalidEmail($email) !== false){
      header("location: ../signup.php?error=invalidEmail");
      exit();
  }
  if(pwdMatch($password, $pwdRepeat) !== false){
      header("location: ../signup.php?error=passwordsdontmatch");
      exit();
  }
  if(securepwd($password) !==false){
      header("location: ../signup.php?error=isSecure");
      exit();
  }
  // check if username(uid) is exists//
  if(uidExists($conn, $username,$email, $email_verified_at) !== false){
      header("location: ../signup.php?error=usernametaken");
      exit();
  }
  //if all checks of the form are done then create a user and connect to the webpage//
  createUser($conn, $name, $email, $username, $password, $verification_code, $email_verified_at);

}else{
  header("location: ../signup.php");
  exit();
}
