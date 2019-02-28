<?php
session_start();

unset ($_SESSION["cart"]);
echo '<script>alert("Cart has been Emptied.")</script>';
echo '<script>window.location.replace("cart.php")</script>';
?>