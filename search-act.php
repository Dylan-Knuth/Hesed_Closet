<link rel="stylesheet" href="global.css">
<link rel="stylesheet" href="search-act.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- <style>
body{
	background-image:none;
	background-color: lightgray;
}

</style> -->

<?php
session_start();

include 'sql_connection.php';

$orderid;
$first_name;
$last_name;
$rec_date;
$last_id;

if (isset($_GET['searchbtn'])) {	

	$searchid = mysqli_real_escape_string($conn, $_GET['searchid']);


	//display error if it doesnt connect
	if(mysqli_connect_errno()){
		echo "Failed to Connect: " . mysqli_connect_error();
	}
	
	if($conn){

			//Check database for what user is searching for
		$search_query = "SELECT * FROM `hesed_house`.`recipients` WHERE (CONVERT(`recipient_id` USING utf8) LIKE '%$searchid%' OR CONVERT(`first_name` USING utf8) LIKE '%$searchid%' OR CONVERT(`last_name` USING utf8) LIKE '%$searchid%' OR CONVERT(`dob` USING utf8) LIKE '%$searchid%')";


		$search_result = mysqli_query($conn, $search_query);	
		$count = mysqli_num_rows($search_result );

		if (!$search_result) {
			die(mysqli_error($conn)); 
		}

			//if there are no results display search page with no reults alert
		if($count == 0) {
			echo " <title>Search Results</title>";

				//display search bar to research on results page
			echo "<form method='get' action='search-act.php'>
			<div class = 'searchBar'>		
			<div>
			<div class='input-group'>

			<label for='searchid'></label>
			<input class= 'form-control' type='text' name='searchid' placeholder='Enter Recipient Info' required>

			<span class='input-group-addon'>
			<button class='btn btn-secondary' type='submit' name ='searchbtn'>Search</button>
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
			echo "<form method='get' action='search-act.php'>
			<div class = 'searchBar'>		
			<div>
			<div class='input-group'>

			<label for='searchid'></label>
			<input class= 'form-control' type='text' name='searchid' placeholder='Enter Recipient Info' required>

			<span class='input-group-addon'>
			<button class='btn btn-secondary' type='submit' name ='searchbtn'>Search</button>
			</span>

			</div>
			</div>
			</div>
			</form>";

			echo "<table>";
			echo "<tr><th>ID</th><th>Name</th><th>Birth Date</th><th></th></tr>";
			
			while($row = mysqli_fetch_array($search_result)) {


				$first_name = $row['first_name'];
				$first_name = mysqli_real_escape_string($conn, $first_name);

				$last_name = $row['last_name'];
				$last_name = mysqli_real_escape_string($conn, $last_name);

				$recipient_id = $row['recipient_id'];
				$recipient_id = mysqli_real_escape_string($conn, $recipient_id);


				$dob = $row['dob']; 
				$dob= mysqli_real_escape_string($conn, $dob);



				$dob_display = date("F jS, Y", strtotime($dob));
				$recieve_date = date('Y-m-d');


				// $recipient_id = $row['recipient_id'];


				$form_id = 'recipient_id' . $row['recipient_id'];

					//Display results table

				echo "<tr><form method='post'>";

						 
				echo 	   "<td id='recipient_id" . $row['recipient_id']."'>" . $row['recipient_id'] . "</td>
							<td>" . $row['first_name'] . " " . $row['last_name'] . " </td>
							<td>" . $dob_display . " </td>
							<td><button type='submit' name='" . $form_id . "' class='btn btn-primary btn-block'>Order</button>";

				if (isset($_POST[$form_id])) {

					$order_query = "INSERT INTO orders (first_name, last_name, recieve_date, recipient_id)	
					VALUES('$first_name', '$last_name', CURDATE(), '$recipient_id') ";

                    //echo $order_query;

					$order_result = mysqli_query($conn, $order_query) or die(mysqli_error($conn));


					if ($order_result === TRUE) {
							$last_id = mysqli_insert_id($conn);
							$_SESSION["orderid"] = $last_id;
							$_SESSION["rec_id"] = $recipient_id;
							$_SESSION["rec_fname"] = $first_name;
							$_SESSION["rec_lname"] = $last_name;
									
					}

					else {
						echo "Error: " . $order_result . "<br>" . $conn->error;
					}

					header('location: cart.php');
				}
				echo "</td></form></tr>";
			}

			echo "</table>";




		}
	}
	


}


?>