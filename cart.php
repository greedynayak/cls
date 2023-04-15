

  <?php

@include 'connection.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE Prod_id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($con, "DELETE FROM `cart` WHERE Prod_id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($con, "DELETE FROM `cart`");
   header('location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartpage</title>

   
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
  </nav>>

      

  
  <body>
  
  
  <div class="container">
  
  <section class="shopping-cart">
  
     <h1 class="heading">shopping cart</h1>
  
     <table>
  
        <thead>
           <th > image</th>
           <th> name </th>

           <th> price </th>
           <th> quantity  </th>
           <th>  total price  </th>
           <th>  action  </th>
        </thead>
  
        <tbody>

        <?php 
         
         $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>
          
           <tr>
              <td><img src="assets/imgs/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
              <td><?php echo $fetch_cart['name']; ?></td>
              <td>$<?php echo number_format($fetch_cart['price']); ?>/-</td>
              <td>
                 <form action="" method="post">
                    <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['Prod_id']; ?>" >
                    <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                    <input type="submit" value="update" name="update_update_btn">
                 </form>   
              </td>
              <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
              <td><a href="cart.php?remove=<?php echo $fetch_cart['Prod_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
           </tr>
           <?php
             $grand_total += $sub_total;  
              };
            };
           ?>
           <tr class="table-bottom">
              <td><a href="shop.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
              <td colspan="3">grand total</td>
              <td>$<?php echo $grand_total; ?>/-</td>
              <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
           </tr>
  
        </tbody>
  
     </table>

  
  </section>
  
  </div>
     



    <!--footer-->
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