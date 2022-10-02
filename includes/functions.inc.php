<?php
require("../header.php");
function emptyInputSignup($name, $email, $username, $password, $pwdRepeat ){
  $result;
  if(empty($name) || empty($email) || empty($username) || empty($password) || empty($pwdRepeat)){
      $result= true;
  }else{
      $result = false;
  }
return $result;
}
//this function (preg_match()) check parameters for username is special characters//
//if is true then appears error message//
function invalidName($name){
  $result;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
      $result = true;

  }else{
      $result = false;
  }
return $result;
}
function invalidUid($username){
  $result;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      $result = true;

  }else{
      $result = false;
  }
return $result;
}
//Use function (filter_var()) with parameter FILTER_VALIDATE_EMAIL//
// to check special characters in email field if this function is true then appears error message//
function invalidEmail($email){
  $result;
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $result= true;
  }else{
      $result = false;
  }
return $result;
}
//check password and pwdRepeat it's the same, if this is true then appears error message//
function pwdMatch($password, $pwdRepeat){
  $result;
  if($password !== $pwdRepeat){
      $result= true;
  }else{
      $result = false;
  }
return $result;
}
function securepwd($password){
$result;
if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)){
      $result= true;
  }else{
      $result = false;
  }
return $result;
}
function uidExists($conn, $username, $email, $email_verified_at){
  $sql = "SELECT * FROM users WHERE usersUId = ? OR usersEmail = ? OR email_verified_at = ?";
  $stmt = mysqli_stmt_init($conn);
  $stmtc = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $email_verified_at);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }else{
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}
//send email for account verification//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require ("../vendor/autoload.php");
function createUser($conn, $name, $email, $username, $password, $verification_code, $email_verified_at){

      //Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
          //Enable verbose debug output
          $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
  
          //Send using SMTP
          $mail->isSMTP();
  
          //Set the SMTP server to send through
          $mail->Host = 'smtp.gmail.com';
  
          //Enable SMTP authentication
          $mail->SMTPAuth = true;
  
          //SMTP username
          $mail->Username = 'YourEmailHere';
  
          //SMTP password
          $mail->Password = 'YourEmailAppCodeHere';
  
          //Enable TLS encryption;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  
          //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
          $mail->Port = 587;
  
          //Recipients
          $mail->setFrom('YourEmailHere', 'loginForm.com');
  
          //Add a recipient
          $mail->addAddress($email, $name);
  
          //Set email format to HTML
          $mail->isHTML(true);
  
          $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
  
          $mail->Subject = 'Email verification';
          $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
  
          $mail->send();
          // echo 'Message has been sent';

  $sql = "INSERT INTO users (usersName, usersEmail, usersUId, usersPwd, verification_code, email_verified_at) VALUES  (?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
   
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $email_verified_at=NULL;
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $username, $hashedPwd, $verification_code, $email_verified_at);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION["userid"]=$uidExists["usersId"];
    $_SESSION["useruid"]=$uidExists["usersUId"];
    header("Location: ../email-verification.php?email=" . $email);
    exit();
  }catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
function verificationEmail($conn, $email, $verification_code){

  $result;
        //mark email as verified
        $sql = "UPDATE users SET email_verified_at = NOW() WHERE usersEmail = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $stmt = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 0){
            //die("Verification code failed.");
            $result = true;
        }else{
            $result = false;
        }
        return $result;
}
function emptyInputLogin($username, $password){
  $result;
  if(empty($username) || empty($password)){
      $result= true;
  }else{
      $result = false;
  }
return $result;
}
function loginUser($conn, $username, $password, $email){
  $uidExists = uidExists($conn, $username, $username, $email);
  if($uidExists === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  $pwdHashed = $uidExists["usersPwd"];
  $checkVer =  $uidExists["email_verified_at"];
  $checkPwd = password_verify($password, $pwdHashed);
  
  if($checkPwd === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }else if($checkPwd === true){
      if ($checkVer === null){
        header("Location: ../email-verification.php?email=" . $email);
        exit();  
      }else{
        session_start();
        $_SESSION["userid"]=$uidExists["usersId"];
        $_SESSION["useruid"]=$uidExists["usersUId"];
        $_SESSION["email_verified_at"]=$uidExists["verification_code"];
        header("location: ../userPage.php");
        exit();
      }
  }
}




