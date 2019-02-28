<!DOCTYPE html>
<html>
<head>
  <title>Hesed House: Login</title>
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
 
<style>
body{
  background-image:none;
  background-color: lightgray;
}
</style>


<body class="loginpage">
  <div class="loginBox">

    <form method="POST" action="login.php" class="lg">

      <img src="hesed_house.jpg" alt="Hesed House">

      <div class="form-group">
        <label for="username"></label>
        <input type="text" name="username" class= "form-control" placeholder="User Name" required>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password"  placeholder="Password" required>
      </div>

      <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>

  <!-- LOGIN PHP -->

  <?php

  include 'sql_connection.php';

  if(isset($_POST["login"])){
   $username=$_POST['username'];
   $password=$_POST['password'];

   if (!$conn) {
      die(mysqli_error($conn)); //If there no connection displays sql error
    }
    
    if($conn){               
     $query= ("SELECT * FROM employees WHERE name = '$username'");  //While connected to db sql runs this select to check for user info from login
     $result = mysqli_query($conn, $query);
     $count = mysqli_num_rows($result);
     $row = mysqli_fetch_array($result);

     $hash = $row['password'];

     if (!$result) {
      die(mysqli_error($conn)); //If there no connection displays sql error
    }

    if($count==1){
 
               // if the user exist and is an admin redirects to admin page
        
        if($row["user_type"] == "Admin") { 
          echo "<script> window.location.href ='adminpage.html'  </script>";
        } 
                            //if the user exist and is just a user redirects to serch page
        if ($row["user_type"] == "User"){ 
          echo "<script> window.location.href ='searchpage.html'  </script>";
       } 



     
      }

     else {
       echo "<script>
       alert ('Login unsuccessful. Please check the username and password');
       </script>";
     }
   }

   if($count==0){

        //javascript alert if users login credentials dont match any in database
    echo "<script>
    alert ('Login unsuccessful. Please check the username and password');
    </script>";
  }

}

?>

</body>
</html>