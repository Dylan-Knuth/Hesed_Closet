<link rel="stylesheet" href="global.css">
<link rel="stylesheet" href="search-act.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


<style>


</style>

<?php
session_start();

include 'sql_connection.php';

$total = 0; 
$days = $_POST['numOfDays'];
$days = mysqli_real_escape_string($conn, $days);

echo "<title>Reports</title>



				<form method='post' action='report-act.php'>
				<div class = 'searchBar'>		
				<div>
				<div class='input-group'>


				<select name ='numOfDays' 'id='numOfDays'>
				  <option value='30'>30 Days</option>
				  <option value='90'>90 Days</option>
				  <option value='365'>A year</option>
				</select>
				<span class='input-group-addon'>
			<button class='btn btn-primary' type='submit' name ='reportbtn'>Go</button>
			</span>

			</div>
			</div>
			</div>
			</form>";

	//display error if it doesnt connect
if(mysqli_connect_errno()){
	echo "Failed to Connect: " . mysqli_connect_error();
}


if($conn){
			//Check database for what user is searching for
	$report_query = "create temporary table orderBeforeDate 
					AS
					SELECT orders.order_id, orders.recieve_date,
					order_details.item_name, order_details.qty 
					FROM orders join order_details ON orders.order_id = order_details.order_id 
					WHERE orders.recieve_date >= 
					DATE_SUB(CURRENT_DATE(), INTERVAL '$days' DAY);
					SELECT item_name, sum(qty)
					FROM orderBeforeDate
					GROUP BY item_name ASC;";


	if (mysqli_multi_query($conn,$report_query))
	{
		do
		{
    // Store first result set
			if ($result=mysqli_store_result($conn)) {

				
      // Fetch one and one row

			

				echo "<table>
					<tr>
					<th>Item Name</th>
					<th>Qty</th>
					</tr><tboby>";


				while ($row=mysqli_fetch_row($result))
				{
					$item_name = $row['0'];
				$qty = $row['1'];
				$total += $qty;
				

					echo 	   "<tr><td>" . $item_name . "</td>
								<td>" . $qty . " </td></tr>";
				}

				echo "<tr><td>Item Total</td><td>" . $total . "</td></tr>
						</tbody></table></div>";
      // Free result set
				mysqli_free_result($result);
			}
		}
		while (mysqli_next_result($conn));
	}

}
?>