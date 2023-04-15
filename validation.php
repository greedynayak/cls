<?php              
  include('connection.php');        //validation for login
  if(isset($_POST['submit']) )
  {
      $uname=$_POST['name'];
      $pass=$_POST['password'];
  $username="SELECT * FROM users where user_name='$uname' AND user_password='$pass';";
   $query=mysqli_query($con,$username);
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
      echo "Login Error!";
  }
  }
  ?>
