<?php 
   require_once("connection.php");
   if(isset($_POST['add_product'])){
$p_name=$_POST['pname'];
$p_price=$_POST['pprice'];
$p_image=$_FILES['pimage']['name'];
$p_image_tmp_name=$_FILES['pimage']['tmp_name'];
$p_image_folder='assets/imgs/'.$p_image;


  $insert_query= mysqli_query($con,"INSERT INTO `products` (Prod_name,Prod_price,Prod_image) values('$p_name','$p_price','$p_image')") or die('query failed1');
  if($insert_query){
    move_uploaded_file($p_image_tmp_name,$p_image_folder);
    $message[]='product add succesfully';
  }
  else{
    $message[]='product couldnt be added';
  }


   };

   if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query= mysqli_query($con,"DELETE FROM `products` where Prod_id=$delete_id");
    if($delete_query){
        header('location:products.php');
        $message[]='product deleted';

        }
        else{
            header('location:products.php');
            $message[]='product could not be deleted';

        };
   };

  

   if(isset($_POST['update_product'])){
    $update_p_id=$_POST['update_p_id'];
    $update_p_name=$_POST['update_p_name'];
    $update_p_price=$_POST['update_p_price'];
    $update_p_image=$_FILES['update_p_image']['name'];
    $update_p_image_tmp_name=$_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder='assets/imgs/'.$update_p_image;


    $update_query= mysqli_query($con,"UPDATE`products` SET Prod_name='$update_p_name',Prod_price='$update_p_price',
    Prod_image='$update_p_image' WHERE  Prod_id='$update_p_id'");
    if($update_query){
      move_uploaded_file($update_p_image_tmp_name,$update_p_image_folder);
        $message[]='product updated succesfully';
        header('location:products.php');
       
        }
        else{
          $message[]='product could not be updated';
           header('location:products.php');
           
        }
      }; 
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="js/script.js"></script>  
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>



<?php

if(isset($message))
{
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display=`none`;"></i></div>';
    };
};
?>
<!--navbar-->

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





<div class="container1">
<section class="my-5 py-5" >
<div class="container text-center mt-3 pt-5">
      <form action="" method="post" class="addproductform" enctype="multipart/form-data">

       <h3>Add a new product </h3>
<input type="text" class="box"  name="pname" placeholder="Enter the Product name"required>  
<input type="number" class="box"  name="pprice" placeholder="Enter the Product price"required>      
<input type="file" class="box"  name="pimage" accept="image/png, image/jpg, image/jpeg"required>   
<input type="submit" value="Add the Product" name="add_product" class="btn"required>   
</form> 
</div>
</section>




<section class="display-prod-table">
<table>
    <thead>
        <th> Product image</th>
        <th> Product name</th>
        <th> Product price</th>
        <th>action</th>
</thead>
<tbody>
    <?php
    $select_products=mysqli_query($con,"SELECT *FROM `products`");
    if(mysqli_num_rows($select_products)>0){
        while($row=mysqli_fetch_assoc( $select_products)){
            ?>

      <tr>
        <td><img src="assets/imgs/<?php echo $row['Prod_image'] ?>" height="100" alt=""></td>
        <td><?php echo $row['Prod_name']; ?> </td>
        <td><?php echo $row['Prod_price']; ?> /-</td>
        <td>
            <a href="products.php? delete=<?php echo $row['Prod_id'];?>" class="delete-btn" 
        onclick="return confirm('are you sure you want to delete this?');"><i class="fas fas-trash"></i> Delete </a>
        <a href="products.php? edit=<?php echo $row['Prod_id'];?>" class="option-btn" ><i class="fas fas-edit"></i> Update</a> </td>

        </tr>
       <?php     
        };
    } else{
        echo"<div class='empty'> No product added </div>";
    };
    ?>

</tbody>

</table>
</section>

<section class="edit-form-container">
<?php
if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
    $edit_query= mysqli_query($con,"SELECT * FROM `products` where Prod_id=$edit_id");
    if(mysqli_num_rows($edit_query)>0){
        while($fetch_edit=mysqli_fetch_assoc($edit_query)){
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <img src="assets/imgs/"  <?php echo $fetch_edit['Prod_image'];?> height="200" alt="">
                <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['Prod_id'];?>">
                <input type="text"  class="box" required name="update_p_name" value="<?php echo $fetch_edit['Prod_name'];?>">
                <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['Prod_price'];?>">
                <input type="file"  class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                <input type="submit" value="update the product" name="update_product" class="btn"> 
                <input type="reset"  value="cancel" id="close-edit" class="option-btn">


        </form>
        <?php
        };

        };
        echo "<script> document.querySelector('.edit-form-container').style.display= 'flex';</script>";
      
      };
     


?>
</section>
</div>











 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
 <script src="js/script.js"></script>   
</body>
</html>