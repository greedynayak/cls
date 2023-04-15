<?php
@include 'connection.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 <!--Navbar-->
 
 <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
  <div class="container">
    <img class="logo" src="assets/imgs/logofash.jpg"/>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact Us</a>
        </li>
         
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

        <li class="nav-item">
          <a href="cart.php"><i class="fas fa-shopping-bag"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    




<?php


if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<div class="container">

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="assets/imgs/<?php echo $fetch_product['Prod_image']; ?>" alt="">
            <h3><?php echo $fetch_product['Prod_name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['Prod_price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['Prod_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['Prod_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['Prod_image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->





      <!--Footer-->
<footer class="mt-5 py-5">
  <div class="row container mx-auto pt-5">
  <div class="footer-one col-lg-3 col-md-6 col-sm-12">
  <img class="logo" src="assets/imgs/logofash.jpg"/>
  <p class="pt-3"> We provide the best fashion for the most affordable prices</p>
  </div>
  <div class="footer-one col-lg-3 col-md-6 col-sm-12">
  <h5 class="pb-2"> Featured</h5>
  <ul class="text-uppercase">
  <li><a href="#">men</a></li>
  <li><a href="#">women</a></li>
  <li><a href="#">boys</a></li>
  <li><a href="#">newarrivals</a></li>
  <li><a href="#">clothes</a></li>
  </ul>
 </div>

 <div class="footer-one col-lg-3 col-md-6 col-sm-12">
<h5 class="pb-2"> Contact Us</h5>
<div>
<h6 class="text-uppercase">Address </h6>
<p class="textclass"> B.B Borkar Road Near Art Park,Porvorim-Goa</p>
</div>

<div>
<h6 class="text-uppercase">Phone </h6>
<p class="textclass"> +91 9518510830</p>
</div>

<div>
  <h6 class="text-uppercase">email </h6>
  <p class="textclass"> yashnayak@gmail.com
      vipulasail2001@gmail.com
  </p>
  </div>
  </div>



  </div>
</footer>











<script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
    
</body>
</html>