<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ATN Store</title>
  <link rel="stylesheet" href="StyleStore.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<?php
include_once("connect.php");
?>
<body>
<table>
  <tr>
    <td>
      <img style="width:fix;height:fix"  src="images/ToyStore-OwenStore.png" />
    </td>
  </tr>
  <!--<tr>
    <td>
      <p style="font-size:80px; color:black; margin-left: 455px; margin-top:50px">
        Oh. So. Pro.
      </p>
    </td>
  </tr>
  <tr>
    <td>
      <img src="images/iPhone13Pro.PNG" style="width:450px; margin-left:450px" />
    </td>
  </tr>
  <tr> -->
    <!-- <td>
      <br>
      <p style="font-size:80px; color:black; margin-left:350px; margin-top: 50px">
        Supercharged for pros.
      </p>
    </td>
  </tr> -->
  <!-- <tr>
    <td>
      <img src="images/MacBookPro.jpg" style="width:650px; margin-left:350px" />
    </td>
  </tr>
  <tr>
    <td>
      <p style="font-size:80px; margin-top: 30px; margin-left: 50px; color:#000;">
        Light. Bright.
      </p>
      <p style="font-size:80px; margin-top: 10px; margin-left: 50px; color:#000;">
        Full of might.
      </p>
    </td>
  </tr>
  <tr>
    <td>
      <img src="images/iPadProMainPage.PNG" style="width:500px; margin-left:400px" />
    </td>
  </tr>
  <tr>
    <td>
      <p style="font-size:80px; margin-top: 20px; margin-left: 300px; margin-right: 250px; color:#000;">
        Love the power. Love the price.
      </p>
    </td>
  </tr>
  <tr>
    <td>
      <img src="images/iPhoneSEMainPage.PNG" style="width:600px; margin-left:350px" />
    </td>
  </tr>
</table>  -->
<!-- <table>
  <br>
  <div id="About">
    <h1>About Us</h1>
    <p class="aboutus">
      <strong><i> ATN Store</i></strong> is Authorised Reseller of<b><i> Toy</i>.</b><strong><i> ATN Store</i></strong> is a leading retailer in the Vietnam market, focusing in supplying authentic technological items.</br>
      <strong><i> ATN Store</i></strong> opened in 2020, quickly becoming a trusted location for Vietnamese customers.
      We have been and will continue to work to deliver different and rich authentic technological items at the greatest rates under the slogan
      <i>"If what we don't have, then you don't need it."</i> market in order to meet the needs of customers.
      <br/>
    </p>
  </div>
</table>
<table> -->
  <!-- show -->

  <table class="text-center">
    <hr style="margin-left:80px; margin-right:80px">
    <tr>
      <?php
      $No = 1;
      $res = pg_query($conn, "SELECT ProductName, ProductImg, Price FROM Product");
      if (!$res) {
        die("Invalid query:  " . mysqli_error($conn));
      }
      while ($row = pg_fetch_array($res)) 
      {
        if($No %7 !=0)
        {
      ?>
          <td>
            <div class="card-body text-center">
              <img src="images/<?php echo $row['ProductImg'] ?>" class="card-img-top " width="400px" height="250px">
              <h5 class="card-title"><?php echo $row['ProductName'] ?></h5>
              <p class="card-text">From $<?php echo $row['Price'] ?></p>
              <a href="#" class="btn btn-primary">Learn More</a>
            </div>
          </td>
      <?php
        }
        else
        {
          echo "</tr><tr>";
          ?>
          <td>
            <div class="card-body text-center">
              <img src="images/<?php echo $row['ProductImg'] ?>" class="card-img-top " width="400px" height="250px">
              <h5 class="card-title"><?php echo $row['ProductName'] ?></h5>
              <p class="card-text">From $<?php echo $row['Price'] ?></p>
              <a href="#" class="btn btn-primary">Learn More</a>
            </div>
          </td>
          <?php
        }
          $No++;
      }
      ?>
    </tr>
  </table>
</table>
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













<!--
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:400px">LEARN MORE</a>
  <img class="card-img-top" src="images/iPhone13Pink.png" alt="Card image cap" style="width: 230px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:620px">iPhone 13</p>
    <p class="card-text" style="margin-left:550px">
        From $33.29/mo or $799.
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:370px">LEARN MORE</a>
  <img class="card-img-top" src="images/iP13Pro.png" alt="Card image cap" style="width: 300px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:600px">iPhone 13 Pro</p>
    <p class="card-text" style="margin-left:550px">
        From $41.62/mo or $999.
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:400px">LEARN MORE</a>
  <img class="card-img-top" src="images/iPhone13Pink.png" alt="Card image cap" style="width: 250px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:600px">iPhone 13 mini</p>
    <p class="card-text" style="margin-left:550px">
        From $29.12/mo or $699.
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:370px">LEARN MORE</a>
  <img class="card-img-top" src="images/AWSeries7.png" alt="Card image cap" style="width: 300px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:570px">Apple Watch series 7</p>
    <p class="card-text" style="margin-left:610px">
        From $399
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:370px">LEARN MORE</a>
  <img class="card-img-top" src="images/AWSE.png" alt="Card image cap" style="width: 300px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:600px">Apple Watch SE</p>
    <p class="card-text" style="margin-left:625px">
        From $279
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:370px">LEARN MORE</a>
  <img class="card-img-top" src="images/AWSeries3.png" alt="Card image cap" style="width: 300px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:580px">Apple Watch Series 3</p>
    <p class="card-text" style="margin-left:625px">
        From $199
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:400px">LEARN MORE</a>
  <img class="card-img-top" src="images/AP3.png" alt="Card image cap" style="width: 250px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:625px">AirPods 3</p>
    <p class="card-text" style="margin-left:625px">
        From $179
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:400px">LEARN MORE</a>
  <img class="card-img-top" src="images/APPro.png" alt="Card image cap" style="width: 250px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:620px">AirPods Pro</p>
    <p class="card-text" style="margin-left:625px">
        From $249
    </p>
  </div>
</div>
<div class="card">
    <a href="#" class="btn px-auto" id="details" style="font-size:15px; margin-left:360px">LEARN MORE</a>
  <img class="card-img-top" src="images/APMax.png" alt="Card image cap" style="width:350px; margin-left:10px">
    <a href="#" class="btn px-auto" id="cart" style="font-size:15px">ADD TO CART</a>
  <div class="card-block">
    <p class="card-text" style="margin-left:615px">AirPods Max</p>
    <p class="card-text" style="margin-left:623px">
        From $549
    </p>
  </div>
</div>
-->
