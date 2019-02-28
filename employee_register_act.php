<?php
session_start(); 

include 'sql_connection.php';

// REGISTER USER PHP
if (isset($_POST['reg_user'])) {              
  

  //  Get variables from registration page, sanitize them, then set to php variable
// sdfghjk
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);  
  $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

  if (!$conn) {
      die(mysqli_error($conn)); //If there no connection displays sql error
    }

  if($conn){

          if($password_1 != $password_2){ // Error if passowrds do not match

        echo "<script> alert ('Passwords do not match.');
            window.location.href ='employeeRegister.php'  </script>";

      }


  $user_check_query = "SELECT * FROM employees WHERE email='$email'";  // SQL Statement to check if user already exist by email provided
  $result = mysqli_query($conn, $user_check_query);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  

  
    //Check to see if employee already exist

  // if employee not exist does exist
  if ($count == 0) {

  	 $password = $password_1

      
  	$query = "INSERT INTO employees (name, email, password, user_type) VALUES('$username', '$email', '$password', '$user_type')";
  	
    mysqli_query($conn, $query);       //insert into databse

    //alert user employee has been created then link back to admin page

    echo "<script> alert ('User Created.');       
            window.location.href ='adminpage.html'  </script>";
  }

        //if user does already exist, alert user and redirect to employee registration page

    if ($count >=1){
      echo "<script> alert ('User already exist. Try again.');
            window.location.href ='employeeRegister.php'  </script>";
  }
}
}

?>