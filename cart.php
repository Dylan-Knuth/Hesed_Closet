<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>

    h2{
    text-align: center;
    font-size: 22px;
    color: black;
    background-color: #efefef;
    padding: 2%;
}

.card{

    background-color:#F3F3F3;
    margin: 5px;
}


</style>

<div class="container" style="width: 90%">
    <form method="POST" action="order.php">

        <h2>Shopping Cart for <br><?php echo "ID: ". $_SESSION["rec_id"] . " Name: ".  $_SESSION["rec_fname"] . " " . $_SESSION["rec_lname"]; ?><br>
        <button type="submit" name="order" style="margin-left:20px;  margin-top: 5px;" class="btn btn-success">Place Order</button></h2>
</form>
</div>
<div class="container">
<div class="row">

    <?php include 'sql_connection.php';
    
    $query = "SELECT * FROM items ORDER BY item_id ASC ";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {

            ?>




<form method="post" action="cart.php?action=add&item_id=<?php echo $row["item_id"]; ?>">
                <div class="card" style="width:15rem;">
                  <div class="card-body">
                    <h5 class="card-title" style="font-size: 15px;"><?php echo $row["item_name"]; ?></h5>
                    <input type="text" name="quantity" class="form-control" value="1">
                        <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>">
                    <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-primary" value="Add to Cart">
                </div>
            </div>
        </form>
                        <?php


                    }
                }


                ?>
</div>
</div>
                <div class="card" style="padding-top:15px; margin-bottom: 0px;">
                <form method="post" action="empty_cart.php">
                    <h3 style="text-align:center;">Shopping Cart Details For Order #<?php echo $_SESSION["orderid"]  ?> <button type="submit" name="empty_cart" style="margin-left: 225px;" class="btn btn-danger"> Empty Cart</button> 
                    </h3>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Product Name</th>
                        <th width="20%">Quantity</th>
                        <th width="17%">Remove Item</th>
                    </tr>

                    <?php
                    if(!empty($_SESSION["cart"])){
                        $total = 0;
                        foreach ($_SESSION["cart"] as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $value["product_name"]; ?></td>
                                <td><?php echo $value["product_qty"]; ?></td>   
                                <td><a href="cart.php?action=delete&item_id=<?php echo $value["product_id"]; ?>"><span
                                    class="text-danger">Remove Item</span></a></td>

                                </tr>
                                <?php
                            }
                        } 

                        ?>
                    </table>
                </div>


</body>
</html>
<?php


include 'sql_connection.php';



if(isset($_GET["action"] )){
    if($_GET["action"] == "add"){

        //     ADD TO END CART IF CART ISNT EMPTY       
        // $item_id=$_GET["item_id"]
        if (isset($_SESSION["cart"])){

            $item_array_id = array_column($_SESSION["cart"], "product_id");

            if (!in_array($_GET["item_id"], $item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["item_id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_qty' => $_POST["quantity"]
                );

                $_SESSION["cart"][$count] = $item_array;
                echo '<script>alert("Adding to cart!!")</script>';
            }
                
                //  IF ITEM IS IN CART, DO NOT ADD AND ALERT USER

            else{
                echo '<script>alert("Product is already in cart")</script>';
            }
        }
//                  ADD TO FRONT OF CART IF CART EMPTY
        else{
            $item_array = array(    
                'product_id' => $_GET["item_id"],
                'product_name' => $_POST["hidden_name"],
                'product_qty' => $_POST["quantity"]
            );
            $_SESSION["cart"][0] = $item_array;
            echo '<script>alert("Adding to cart!!")</script>';

        }echo "<script> window.location.href ='cart.php'  </script>";  
        
    }
}


//      ------ DELETE FROM CART -----

if(isset($_GET["action"] )){
    if($_GET["action"] == "delete"){
        foreach ($_SESSION["cart"] as $keys => $value){
            if ($value["product_id"] == $_GET["item_id"]){
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Product has been removed.")</script>';
                echo '<script>window.location.replace("cart.php")</script>';

            }
        }
    }
}



?>