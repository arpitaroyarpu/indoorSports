<?php 
include 'session.php';
Session:: init();
?>

<?php

include('database.php');

?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form | CoderGirl</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="asset/style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">


      <header>Log in</header>

      <?php
       $db=new database();
  if($_SERVER['REQUEST_METHOD'] =='POST'){			 
 $email= mysqli_real_escape_string($db->link,$_POST['email']);
 $password= $_POST['password'];
 $query= "SELECT * FROM  user WHERE email='$email' AND password= '$password' ";
 $result= $db->select($query);
 if($result != false){
   $value=$result->fetch_array();
    Session::set("login",true);
    Session::set("email",$value['email']);
    Session::set("password",$value['password']);
    //Session::set("usertype",$value['usertype']);
    //Session::set("fname",$value['fname']);
    //Session::set("lname",$value['lname']);
    //Session::set("id",$value['id']);
    
    header("Location:../admin/index.php");
    }else{
     echo   "<script>alert('user name or password not match')</script>";
 }
}   
 
 
?>
    

      <form action="" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <!--<a href="#">Forgot password?</a>-->
        <input type="submit" name="submit" class="button" value="sign in">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div> 
    <div class="registration form">

 <!-- php code end for registration -->




      <header>Signup</header> 
	    <!-- php code start for registration -->
		
		
		<?php

				
         
        if(isset($_POST['submit'])) {
          $fullname = $_POST['fullname'];
          $email = $_POST['email'];

          $password = $_POST['password'];
          $con_password= $_POST['con_password'];			      

          if($password != $con_password){
            echo "<script>alert('password not match!')</script>";
            
          }elseif(!preg_match("/^([a-zA-Z' ]+)$/", $fullname)){
            
          echo "<script>alert('Error! Only Alphabets and Whitespace are allowed')</script>";
          }elseif(!preg_match("/^\\S+@\\S+\\.\\S+$/", $email)){
            
          echo "<script>alert('this is not valid email')</script>";
          }else{
          $emailquery= "select *from  user  where email='$email' limit 1";
                  $mailcheck= $db->select($emailquery);
          if($mailcheck != false){
          echo "<script>alert('email already exist')</script>";

        }
          
          else{
            
          $sqlinsert = "INSERT INTO user(fullname,email,password) VALUES('$fullname','$email','$password')";

          $resultinsert= $db->insert($sqlinsert);

              if ($resultinsert) {

              echo "<script>alert(registration success.')</script>";
			  
			 

                   
            }
            else{
            echo "<script>alert('something wrong')</script>";
            }

            }
            }
            }


?>
   
      <form action="" method="post">
        <input type="text" name="fullname" placeholder="Enter your full name" required />
        <input type="email" name="email" placeholder="Enter your email" required />
        <input type="password" name="password" placeholder="Create a password" required />
        <input type="password" name="con_password" placeholder="Confirm your password" required />
        <input type="submit" name="submit" class="button" value="Sign up">
       
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
     </div>
    </div>
  </div>
</body>
</html>
