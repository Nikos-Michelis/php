<?php require("header.php"); ?>
<?php   
    session_start();
?>
<style>
  .menu {
  background-color: #4CAF50; 
  border: none;
  border-radius:20px;
  color: white;
  padding: 15px 30px;
  margin:5px 5px 5px 5px;
  text-align: center;
  text-decoration: none;
  font-size: 20px;
  
}
.menu:hover {
  color: #17a2b8;
  text-decoration: none;
  font-size: 23px;
  
}
li{
  float:left;
  list-style: none;
  margin-top:10px
}
  </style>
<div>
  <nav>
      <ul>
        <?php
          if(isset($_SESSION["useruid"])){
              echo"<li><a class='menu' href='userPage.php'>userPage</a></li>";
              echo "<li><a  class='menu' href='includes/logout.inc.php'>Logout</a></li>";
          
          }else{
              echo"<li><a class='menu' href='signup.php'>Signup</a></li>";
              echo "<li><a  class='menu' href='login.php'>Login</a></li>";
          }
            
        ?>
        <li><a  class="menu" href="index.php">index</a></li>
      </ul>

  </nav>
</div>

