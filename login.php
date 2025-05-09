<?php require("header.php"); ?>
<?php require("nav.php");?>
<?php
       if(isset($_SESSION["useruid"]) && isset($_SESSION["email_verified_at"])){
            header("location:index.php");
        }
       ?>
<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="includes/login.inc.php" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="uid" id="username" class="form-control" placeholder="Username/Email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="remember" class="text-info"><span>Remember me</span> <span>
                            <input id="remember" name="remember" type="checkbox"></span></label><br>
                            <button type="submit" name="submit" class="btn btn-info btn-md" value="submit">login</button>
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="signup.php" class="text-info">Register here</a>
                        
                        </div>
                    </form>
                    <?php
                          //ERROR MESSAGES//
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptyInput"){
                                echo '<p style="color:red;">You should fill all form fields!</p>';
                            }else if($_GET["error"] == "wronglogin"){
                                echo"<p>Wrong user or password!</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>
