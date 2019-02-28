<!DOCTYPE html>
<html>
<head>
  <title>Registration Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="employeeRegister.css">
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
        padding-bottom: 20px;
      }
    </style>
</head>
<body>

<div class="loginBox" >

  <form method="post" action="employee_register_act.php" class="lg">
  <div>
  <h2>Employee Registration</h2>
</div>

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="username" class= "form-control"placeholder="Username" required >
  </div>

  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control"  placeholder="Email" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password_1" class="form-control"  placeholder="Password" required>
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="password_2" class="form-control"  placeholder="Confirmed Password" required>
  </div>

<div class="form-group">
  <label>User Type:</label>
  <select name="user_type">
    <option value="User">User</option>
    <option value="Admin">Admin</option>
  </select>
</div>
  <button type="submit" name="reg_user" class="btn btn-primary btn-block">Register</button>
  
  
</form>
</div>

 
 
</body>
</html>