<?php require("header.php"); ?>
<?php require("nav.php"); ?>
<?php
       if(isset($_SESSION["useruid"]) && isset($_SESSION["verification_code_at"])){
         header("location:index.php");
       }
       ?>
<div id="login">
    <h3 class="text-center text-white pt-5">Code Verification</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="includes/email-verification.inc.php" method="post">

                        <h3 class="text-center text-info">Code Verification</h3>
                        <div class="form-group">
                            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
                            <input class="form-control" type="number" name="verification_code" placeholder="Enter verification code" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control button" type="submit" name="verify_email" value="Verify Email">
                        </div>
                        
                    </form>
                        <?php
                            //ERROR MESSAGES//
                            if(isset($_GET["error"])){
                                if($_GET["error"] == "Verificationcodefailed"){
                                    echo "<p>Try the code we sent to your email!</p>";
                                }
                                else if($_GET["error"] == "EmailVerificationError"){
                                    echo"<p>Somthing wrong try again!</p>";
                                }
                            }
                        ?>
                </div>        
            </div>      
        </div>
    </div>
</div>
<?php require("footer.php"); ?>