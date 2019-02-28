<link rel="stylesheet" href="global.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- 
<style>
body{
	background-image:none;
	background-color: lightgray;
}

</style>
 -->
<?php

include 'sql_connection.php';

$orderid;
$first_name;
$last_name;
$rec_date;
$last_id;

if (isset($_GET['deleteSearchBtn'])) {

	$searchid = mysqli_real_escape_string($conn, $_GET['searchid']);


	//display error if it doesnt connect
	if(mysqli_connect_errno()){
		echo "Failed to Connect: " . mysqli_connect_error();
	}
	
	if($conn){

			//Check database for what user is searching for
		$search_query = "SELECT * FROM `hesed_house`.`employees` WHERE (CONVERT(`employee_id` USING utf8) LIKE '%$searchid%' OR CONVERT(`name` USING utf8) LIKE '%$searchid%' OR CONVERT(`email` USING utf8) LIKE '%$searchid%')";


		$search_result = mysqli_query($conn, $search_query);	
		$count = mysqli_num_rows($search_result );

		if (!$search_result) {
			die(mysqli_error($conn)); 
		}

			//if there are no results display search page with no reults alert
		if($count == 0) {
			echo " <title>Search Results</title>";

				//display search bar to research on results page
			echo "<form method='get' action='delete-act.php'>
			<div class = 'searchBar'>		
			<div>
			<div class='input-group'>

			<label for='searchid'></label>
			<input class= 'form-control' type='text' name='searchid' placeholder='Enter Employee Info' required>

			<span class='input-group-addon'>
			<button class='btn btn-secondary' type='submit' name ='deleteSearchBtn'>Search</button>
			</span>";

			//display box alerting user there are no results
			echo "</div>
			</div>
			</div>
			</form>
			<div class='noResults'>
			No user found. Please try again.  
			</div>";
		}

				//while there are results display results in table
		else{

			echo   "<title>Search Results</title>";

					//display search bar to research on results page
			echo "<form method='get' action='employee_delete_act.php'>
			<div class = 'searchBar'>		
			<div>
			<div class='input-group'>

			<label for='searchid'></label>
			<input class= 'form-control' type='text' name='searchid' placeholder='Enter Employee Info' required>

			<span class='input-group-addon'>
			<button class='btn btn-secondary' type='submit' name ='deleteSearchBtn'>Search</button>
			</span>

			</div>
			</div>
			</div>
			</form>";

			echo "<table>";
			echo "<tr><th>ID</th><th>Name</th><th>Email</th><th></th></tr>";
			
			while($row = mysqli_fetch_array($search_result)) {


				$employee_name = $row['name'];
				$employee_name = mysqli_real_escape_string($conn, $employee_name);

				$employee_email = $row['email'];
				$employee_email = mysqli_real_escape_string($conn, $employee_email);

				$employee_id = $row['employee_id'];
				$employee_id = mysqli_real_escape_string($conn, $employee_id);


				// $recipient_id = $row['recipient_id'];


				$delete_id = 'employee_id' . $row['employee_id'];

					//Display results table

				echo "<tr><form method='post'>";

						 
				echo 	   "<td id='employee_id" . $row['employee_id']."'>" . $row['employee_id'] . "</td>
							<td>" . $row['name'] . " </td>
							<td>" . $row['email'] . " </td>
							<td><button type='submit' name='" . $delete_id . "' class='btn btn-danger btn-block'>Delete</button>";

				if (isset($_POST[$delete_id])) {
					
					//php form starts
                    //this is what happens when button is pressed
                    //button SHOULD be named delete -- check that shit
                    //change delete statement to delete people from recipients table
                    //order test -> recipients

					$delete_query = "DELETE FROM employees WHERE employee_id = '$employee_id'";

                    //echo $order_query;
                    //change to delete result

					$delete_result = mysqli_query($conn, $delete_query);
					//add alert box saying person has been deleted --- java script


                    if(!$delete_result){

                            echo "<script> alert ('No users found.');
                                    window.location.href ='adminpage.html'  </script>";
                        die(mysqli_error($conn));
                    }

/////////////////////This is where the loop for confirmation would go

                    echo "<script> alert ('User deleted.');
            window.location.href ='adminpage.html'  </script>";

				}
				echo "</td></form></tr>";
			}

			echo "</table>";




		}
	}
	


}


?>