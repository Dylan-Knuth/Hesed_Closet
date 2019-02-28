<?php
session_start();
?>
<style>
@import url('https://fonts.googleapis.com/css?family=Titillium+Web');

*{
    font-family: 'Titillium Web', sans-serif;
}
.product{
    border: 1px solid #eaeaec;
    margin: -1px 19px 3px -1px;
    padding: 10px;
    text-align: center;
    background-color: #efefef;
}
table, th, tr{
    text-align: center;
}
.title2{
    text-align: center;
    color: #66afe9;
    background-color: #efefef;
    padding: 2%;
}
h2{
    text-align: center;
    color: #66afe9;
    background-color: #efefef;
    padding: 2%;
}
table th{
    background-color: #efefef;
}
</style>



<title>Shopping Cart</title>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<div class="container" style="width: 65%">
    <form method="POST" action="order.php">

        <h2>Shopping Cart for <?php echo "</br>ID: ". $_SESSION["rec_id"] . " Name: ".  $_SESSION["rec_fname"] . " " . $_SESSION["rec_lname"]; ?>
    </br><button type="submit" name="order" style="margin-top: 5px;" class="btn btn-success">Place Order</button></h2></form>

    <?php include 'sql_connection.php';
    
    $query = "SELECT * FROM items ORDER BY item_id ASC ";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0) {
       
        while ($row = mysqli_fetch_array($result)) {
           
            ?>
            <div class="container">
               <?php $item_id=$row["item_id"]; ?>
                <form method="post" action="cart.php?action=add&item_id=<?php echo $item_id; ?>">
               
                <!-- <form method="post" action="addToCart.php?>"> -->
                   
                    <div class="product">
                        <h5 class="text-info"><?php echo $row["item_name"]; ?></h5>


                        <input type="text" name="quantity" class="form-control" value="1">

                        <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>">
                        <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                      
                        value="Add to Cart">
                    </div>
                </form>
            </div>
            <?php
        }
    }


    ?>
    
    <div style="clear: both"></div>
    <form method="post" action="empty_cart.php">
        <h3 class="title2">Shopping Cart Details For Order #<?php echo $_SESSION["orderid"]  ?>  
        <button type="submit" name="empty_cart" style="margin-left: 225px;" class="btn btn-danger"> Empty Cart</button>
    </form>
</h3>
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
            // echo '<script>
            // window.location.href=cart.php
            // </script>';
            
            ?>
        </table>
    </div>
    
</div>



<!-- ADD TO CART -->

<?php include 'sql_connection.php';



if(isset($_GET["action"] )){
    if($_GET["action"] == "add"){
       
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"], 'product_id');
            
            if (!in_array($_GET["item_id"], $item_array_id)){

                $count = count($_SESSION["cart"]);
       
                $item_array = array(
                    'product_id' => $_GET["item_id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_qty' => $_POST["quantity"]
                );

                echo '<script>alert("Adding to cart!!")</script>';
                $_SESSION["cart"][$count] = $item_array;
                echo "<script> window.location.href ='cart.php'  </script>";
            }

            else{
                echo '<script>alert("Product is already in cart")</script>';
                echo '<script>window.location=cart.php</script>';
            }
        }

            else{
                $item_array = array(    
                'product_id' => $_GET["item_id"],
                'product_name' => $_POST["hidden_name"],
                'product_qty' => $_POST["quantity"]
            );
                echo '<script>alert("Adding to front of cart!!")</script>';
            $_SESSION["cart"][0] = $item_array;
            
        }echo "<script> window.location.href ='cart.php'  </script>";  //echo '<script>window.location.replace("cart.php")</script>';
        
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