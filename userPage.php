<?php require("header.php");?>
<?php require("nav.php");?>
<body>
    <div class="animated-text">
        <?php
        if(isset($_SESSION["useruid"]) && isset($_SESSION["email_verified_at"])){
            echo"<h1>Welcome! ". $_SESSION["useruid"] ."</h1>"; 
        }else{
            header("location:index.php");
        }
        ?>
    </div>
</body>

<?php require("footer.php"); ?>
