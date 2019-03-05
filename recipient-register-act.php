<?php 
session_start();

include 'sql_connection.php';

$errors = array(); 


// register recipient
if (isset($_POST['reg_recip'])) {
  // receive all input values from the form
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	$userid2 = mysqli_real_escape_string($conn, $_POST['userid2']);


  if (!$conn) {
      die(mysqli_error($conn)); //If there no connection displays sql error
    }

    if($conn){

      if($userid != $userid2){      //error is IDs do not match

        echo "<script> alert ('User IDs do not match.');
            window.location.href ='recipientRegister.php'  </script>";

      }

	$user_check_query = "SELECT * FROM recipients WHERE recipient_id ='$userid'";  // check database for recipient with that entered ID
	$result = mysqli_query($conn, $user_check_query);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);

  if (!$result) {
      die(mysqli_error($conn)); 
    }


    if ($count == 0) {  
   	
  	$query = "INSERT INTO recipients (hesed_id, first_name, last_name, dob) 
  	VALUES('$userid', '$first_name', '$last_name', '$dob')";
  	
  	mysqli_query($conn, $query);       //insert into database

        //alert user recipient has been created then link back to admin page

    echo "<script> alert ('Recipient Created.');       
            window.location.href ='adminpage.html'  </script>";
  }

    //if user does already exist, alert user and redirect to recipient registration page
   if ($count > 0){
      echo "<script> alert ('User already exist. Try again.');
            window.location.href ='recipientRegister.php'  </script>";
  }
}
}

// upload cvs

if(isset($_POST["upload_btn"])) {
  
  if($_FILES['file']['name']) {       // if theres a file
      $filename = explode(".", $_FILES['file']['name']);    // Seperates file name by .
  
        if($filename[1] != 'csv'){    // if it not a cvs file alert user
          echo "<script>alert('ERROR: This is not a CSV file. Try again.');
              window.location.href ='recipientRegister.php'  </script>";
        }

        if($filename[1] == 'csv')  {        // if its a csv file
          $handle = fopen($_FILES['file']['tmp_name'], "r");    // open and read file
          
          while($data = fgetcsv($handle)){

            $item1 = mysqli_real_escape_string($conn, $data[0]);  
            $item2 = mysqli_real_escape_string($conn, $data[1]);
            $item3 = mysqli_real_escape_string($conn, $data[2]);
            $item4 = mysqli_real_escape_string($conn, $data[3]);
            
            $csv_query = "INSERT into recipients (hesed_id,first_name, last_name, dob) values('$item1','$item2','$item3', '$item4')";
            
            mysqli_query($conn, $csv_query);
            
          }
        
          fclose($handle);
          echo "<script>alert('Import done');
              window.location.href ='adminpage.html'  </script>";
        }
  }
}
 
?>