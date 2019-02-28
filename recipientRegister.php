<!DOCTYPE html>
<html>
<head>
  <title>Register Reciepent</title>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="recipientRegister.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      h2{
        color: white;
        background-color:#337AB7;
        padding:20px;
        border-radius: 10px;
      }
      .lg{
        padding-top: 20px;
        padding-bottom: 10px;
      }
    </style>
</head>
<body>

<div class="loginBox">
  <div class="lg">

  <form method="post" action="recipient-register-act.php">
    <div>
      <h2 >Register Recipient</h2>
    </div>
   
    <div class="form-group">
      <label> First Name</label>
      <input type="text" name="first_name" class= "form-control" placeholder="First Name" required >
    </div>

    <div class="form-group">
      <label>Last Name</label>
      <input type="text" name="last_name" class="form-control"  placeholder="Last Name" required>
    </div>
    
    <div class="form-group">
      <label>Date of Birth</label>
      <input type="text" name="dob" class="form-control"  placeholder="Date of Birth" required>
    </div>
    
    <div class="form-group">
      <label>User ID </label>
      <input type="text" name="userid" class="form-control"  placeholder="User ID " required>
    </div>

    <div class="form-group">
      <label>Confirm User ID </label>
      <input type="text" name="userid2" class="form-control"  placeholder="Confirm User ID " required>
    </div>

      <button type="submit" name="reg_recip" class="btn btn-primary btn-block">Register</button></br>
</form>


      <form method="post" action="recipient-register-act.php" enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" name="file"></br></br>
          <input type="submit" class="btn btn-block" name="upload_btn" value="Upload File">
        </div>
      </form>   

      </div>


</div>
 
</body>
</html>