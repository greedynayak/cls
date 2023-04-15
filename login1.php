

<?php              
  include('connection.php');        //validation for login
  if(isset($_POST['submit']) )
  {
      $uname=$_POST['name'];
      $pass=$_POST['password'];
  $username="SELECT * FROM users where user_name='$uname' AND user_password='$pass';";
   $query=mysqli_query($con,$usernname);
    $usernamecount=mysqli_num_rows($query);
  $row = mysqli_fetch_assoc($query);
  if($usernamecount)
  {
      // echo "<script>console.log($row[username]);";
      $cookie_name = "user_id";
      $cookie_value = $row['id'];
      setcookie($cookie_name, $cookie_value, time()+3600);
      header("location:home.php");
  }
  else{
      echo "login unsuccessful, check details entered";
  }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>



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

            </ul>
           
          </div>
        </div>
      </nav>
    



      <!--Login-->
      <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
     <h2 class="form-weight-bold"> Login</h2>
     <hr class="mx-auto">
      </div>  

      <div class="mx-auto container">
       <form id ="loginform" action="validation.php" method="post">
       
        <div class="form-group" >
       <label>Name</label> 
       <input type="text" class="form-control" id="login-email" name="name" placeholder="Name"required>
       </div>

       <div class="form-group" >
        <label>Password</label> 
        <input type="password" class="form-control" id="login-password" name="password" required>
        </div>

        <div class="form-group" >
            <input type="submit" class="btn" id="login-btn" value="login" name="submit">
            </div>
          
         <div class="form-group" >
            <a id="register-url" class="btn" href="index.php" > Dont have an account? Register</a>
          </div>
       </form>
      </div>
      </section>
     

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







 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
    
</body>
</html>