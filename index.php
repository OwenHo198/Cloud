<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ATNStore - Toy Store</title>
  <link rel="stylesheet" href="StyleStore.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  session_start();
  include_once("Connect.php");
  ?>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a style="width:100px" class="navbar-brand" href="index.php">
          <img style="width: 50px;height:auto; margin-top:-14px" src="images/ATN-Store.png" />
        </a> 
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="?page=Product">Products</a></li>
          <li><a href="?page=Suplier">Supplier</a></li>
          <li><a href="?page=Store">Store</a></li>
          <li><a href="?page=Category">Category</a></li>
          <li><a href="#About">About Us</a></li>
         <?php
          if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="#" id="btnUser"><i class="glyphicon glyphicon-user"  style="margin-left:20px"></i> Hi, <?php echo $_SESSION['us'] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=logout" id="btnLogout" class="glyphicon glyphicon-log-out">Logout <i class="bi bi-box-arrow-right"></i></a>
            </li>
          <?php
          } else {
          ?>
            
            <li class="nav-item">
              <a class="nav-link" href="?page=login" id="btnLogin" style="margin-left:30px" >Login&nbsp;<i class="bi bi-box-arrow-in-right"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=Register" id="btnRegister" >Register&nbsp;</i></a>
            </li>
          <?php
          }
          ?>
        </ul>
        <!--<div class="search">
          <div class="search_box pull-right">
            <input class="margin-top:-10px" type="text" placeholder="Searching..." />
          </div>
        </div>-->
      </div>
    </div>
  </nav>
 
  <?php
  if (isset(($_GET['page']))) {
    $page = $_GET['page'];
    if ($page == "Register") {
      include_once("Register.php");
    } 
    elseif ($page == "login") {
      include_once("Login.php");
    } 
    elseif ($page == "logout") {
      include_once("Logout.php");
    } 
    elseif ($page == "Category") {
      include_once("Category.php");
    } 
    elseif ($page == "Product") {
      include_once("Product.php");
    } 
    elseif ($page == "Update_Category") {
      include_once("Update_Category.php");
    } 
    elseif ($page == "Update_Product") {
      include_once("Update_Product.php"); 
    } 
    elseif ($page == "Add_Category") {
      include_once("Add_Category.php");
    } 
    elseif ($page == "Add_Product") {
      include_once("Add_Product.php");
    }
    elseif ($page == "Suplier") {
      include_once("Suplier.php");
    }
    elseif ($page == "Add_Suplier") {
      include_once("Add_Suplier.php");
    }
    elseif ($page == "Update_Suplier") {
      include_once("Update_Suplier.php");
    } 
    elseif ($page == "Store") {
      include_once("Store.php");
    }
    elseif ($page == "Add_Store") {
      include_once("Add_Store.php");
    }
    elseif ($page == "Update_Store") {
      include_once("Update_Store.php");
    }
  }
  else {
    include("Content.php");
}
  ?>

</body>
<footer>
<div class="jumbotron text-center" style="margin-bottom:0">
      <p>
        Address: Can Tho, Vietnam
      </p>
      <p>
        Tel: +84 766 874 949
      </p>
      <p>
        Copyright © 2022. All rights reserved.
      </p>
</div>  
</footer>
</html>