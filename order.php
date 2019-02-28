<?php include 'sql_connection.php';
session_start();

$order = $_SESSION["cart"];
$order_date = date('Y-m-d');


if ($conn) {

	$orderid = $_SESSION["orderid"];

   // array containing data
	if(!empty($_SESSION["cart"])){
		$total = 0;
		foreach ($_SESSION["cart"] as $key => $value) {
			$item_id = $value["product_id"];
			$item_name = $value["product_name"];
			$qty = $value["product_qty"];  

			$detail_sql =
			"INSERT INTO order_details (order_id, item_id, item_name, qty) values ('$orderid', '$item_id', '$item_name', '$qty');";

			$detail_result = mysqli_query($conn, $detail_sql);

			if (!$detail_result) {
				die(mysqli_error($conn)); 
			}

		}
		echo "<script>alert('Cart was imported.');</script>";
		unset ($_SESSION["cart"]);
		header('location: searchpage.html');
	}

	else{
		echo "<script>alert('cart is empty');</script>";
	}

}
if(mysqli_connect_errno()){
	echo "Failed to Connect: " . mysqli_connect_error();
}


?>
