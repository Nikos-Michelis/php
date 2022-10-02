<?php require("header.php"); ?>
<?php require("nav.php");?>
<?php
    if(isset($_SESSION["useruid"]) && isset($_SESSION["email_verified_at"])){
        header("location:index.php");
    }
?>
<div id="login">
    <h3 class="text-center text-white pt-5">Successfuly Register</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                        <h3 class="text-center text-info ">You are successfuly register! </br>Now you can login! </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>
