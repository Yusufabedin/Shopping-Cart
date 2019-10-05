<?php
session_start();
$servername = "localhost";
$username = "yusuf";
$password = "yusuf";
$dbname = "yusuf_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//remove items
if(isset($_POST["remove"]))
{  
    if($_GET["action"] == "remove")
    {
        foreach ($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values['item_id'] == $_GET['id'])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="cart.php"</script>';
            }

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    
    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
<!-- bootstrap Cdn -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- stylesheet -->
<link rel="stylesheet" href="style.css">
</head>
<body class="bg-light details">
    <?php
    require_once('php/header.php');
    ?>
<div class="details">
<div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6 class="my-text">shopping cart</h6>
                    <hr>
                    <?php
                    $total = 0;
                    if(isset($_SESSION["shopping_cart"])){
                        $product_id = array_column($_SESSION["shopping_cart"],'item_id');
                        $query = "SELECT * FROM shopcart ORDER BY id ASC";
                        $result = mysqli_query($conn, $query);
                        while($row =mysqli_fetch_assoc($result)){
                        foreach($product_id as $id){ 
                            if($row['id'] == $id){
                                    
                            
                                ?>
                                <form action="cart.php?action=remove&id=<?php echo $row["id"]; ?> " method="post" class="cart-items">
                                <div class="border rounded">
                                    <div class="row bg-white">
                                        <div class="col-md-3 pl-0">
                                            <img src="<?php echo $row["image"]; ?>" alt="image1" class="img-fluid">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="pt-2"><?php echo $row["name"] ?></h5>
                                            <small class="text-secondary">Seller: Esoft</small>
                                            <h5 class="pt-2">$<?php echo $row["price"] ?> </h5>
                                            <button type="submit" class="btn btn-warning">Save for Later</button>
                                            <button  type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                        </div>
                                        <div class="col-md-3 py-5">
                                         <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                         <input type="text" value="1" class="form-control w-25 d-inline">
                                         <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                            <?php
                            $total = $total + (int) $row['price'];
                            }
                        }
                        }
                       
                    }
                    else{
                        ?>
                        <h5 class="text-danger"><?php echo " Cart is Empty "; ?></h5>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
             <div class="col-md-6">
                 <?php
                 if(isset($_SESSION["shopping_cart"])){
                $count = count($_SESSION["shopping_cart"]);
                echo "<h6>Price($count items)</h6>";
                 }
                 else{
                    echo "<h6>Price(0 items)</h6>";
                 }
                 ?>
                 <h6>Delivery Charges</h6>
                 <hr>
                 <h6>Amount Payable</h6>
             </div>
             <div class="col-md-6">
                 <h6>$<?php echo $total?></h6>
                 <h6 class="text-success">FREE</h6>
                 <hr>
                 <h6>$<?php
                 echo $total;
                 ?></h6>
             </div>

                </div>
            </div>
            </div>
           
        </div>
        <div class="row text-center d-block">
         <div class="mt-5">
            <a href="index.php" class="btn btn-primary">MORE ORDER</a>
           <a href="login.php" class="btn btn-dark mx-2">ORDER NOW</a>
         </div>
           </div>

    </div>
  

</div>



<script src="https://kit.fontawesome.com/d7804158f3.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>