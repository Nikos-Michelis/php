<?php require("header.php"); ?>
<?php require("nav.php");?>
<?php if(isset($_SESSION["useruid"]) && isset($_SESSION["email_verified_at"])){
            header("location:index.php");
        }
        ?>
<div id="register">
    <h3 class="text-center text-white pt-5">Register form</h3>

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <section>
                        <form id="login-form" class="form" action="includes/signup.inc.php" method="post">


                            <h3 class="text-center text-info">Register</h3>
                            <div class="form-group">
                                <label for="name" class="text-info">Fullname:</label><br>
                                <input type="text" name="name" id="Fullname" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="uid" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="repeat-password" class="text-info">Repeat password:</label><br>
                                <input type="password" name="pwdrepeat" id="repeat-password" class="form-control" placeholder="Repeat-password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info btn-md" >register</button>
                            </div>
                            <div id="login-link" class="text-right">
                                <a href="login.php" class="text-info">Login here</a>
                            </div>
                        </form>
                            <?php
                                //ERROR MESSAGES//
                                if(isset($_GET["error"])){
                                    if($_GET["error"] == "emptyInput"){
                                        echo "<p class='function'>Fill in all fields!</p>";
                                    }
                                    else if($_GET["error"] == "invalidName"){
                                        echo"<p>Full Name must not contain special characters!</p>";
                                    }
                                    else if($_GET["error"] == "invalidUid"){
                                        echo"<p>Choose a proper username!</p>";
                                    }
                                    else if($_GET["error"] == "invalidEmail"){
                                        echo"<p>Choose a proper email!</p>";
                                    }
                                    else if($_GET["error"] == "passwordsdontmatch"){
                                        echo"<p>Password doesn't match!</p>";
                                    }
                                    else if($_GET["error"] == "isSecure"){
                                        echo "Password must be at least 8 characters long and must contain at least 1 number and 1 letter";
                                    }
                                    else if($_GET["error"] == "stmtfailed"){
                                        echo"<p>Somethhing went wrong, try again!</p>";
                                    }
                                    else if($_GET["error"] == "usernametaken"){
                                        echo"<p>Username or email already taken!</p>";
                                    }
                                    else if($_GET["error"] == "none"){
                                        echo"<p>You have signed up!</p>";
                                    }
                                }
                            ?>
                    </section>
                </div>
            </div>  
        </div>
    </div>
</div>

<?php require("footer.php"); ?>
