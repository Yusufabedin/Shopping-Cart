<?php
session_start();
$servername = "localhost";
$username = "yusuf";
$password = "yusuf";
$dbname = "yusuf_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))  
    {
      $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
      if(!in_array($_GET["id"], $item_array_id)) 
      {
         $count = count($_SESSION["shopping_cart"]);  
         $item_array = array(
            'item_id' =>  $_GET["id"],
            'item_name' =>  $_POST["hidden_name"],
            'item_price' =>  $_POST["hidden_price"],
            'item_quantity' =>  $_POST["quantity"]
 
         );
         $_SESSION["shopping_cart"][$count] = $item_array;
       
      }
    }else{
        $item_array = array (
           'item_id'          =>  $_GET["id"],
           'item_name'        =>  $_POST["hidden_name"],
           'item_price'       =>  $_POST["hidden_price"],
           'item_quantity'    =>  $_POST["quantity"]

        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
    
}
//remove items
if(isset($_GET["action"]))
{  
    if($_GET["action"] == "delete")
    {
        foreach ($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values['item_id'] == $_GET['id'])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="index.php"</script>';
            }

        }
    }
}


// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// sql to create table
// $sql = "CREATE TABLE shopcart(
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
//     name VARCHAR(30) NOT NULL,
//     image VARCHAR(30) NOT NULL,
//     price INT(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";
    
//     if (mysqli_query($conn, $sql)) {
//         echo "Table shopcart created successfully";
//     } else {
//         echo "Error creating table: " . mysqli_error($conn);
//     }
    
// $sql = "INSERT INTO shopcart (id,name, image, price)
// VALUES (1,'Samsung A70', 'A70.jpg', '100.00'),
//        (2,'HP Notebook', 'hp.jpg', '299.00'),
//        (3,'Huawei', 'h.jpg', '125.00')";

// if (mysqli_query($conn, $sql)) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
    


// mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping-Cart</title>


    <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
<!-- bootstrap Cdn -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- stylesheet -->
<link rel="stylesheet" href="style.css">
</head>
<body>
  <?php require_once("php/header.php"); ?>
  <div class="all-pro">
      
  <div class="container">
       <h3 class="cart-text">shopping cart</h3> <br/>
       <div class="row">
       <?php
       $query = "SELECT * FROM shopcart ORDER BY id ASC";
       $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
       {
         while($row = mysqli_fetch_array($result)) 
         {
        
        ?>
        
        <div class="col-md-4">
         <form method="POST" action="index.php?action=add&id=<?php echo $row["id"]; ?> ">
          <div class="shopping">
              <img src="<?php echo $row["image"]; ?>" class="img-fluid" alt="">
              <h4 class="text-info"><?php echo $row["name"]; ?></h4>
              <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
              <input type="text" name="quantity" class="form-control" value="1">
              <input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $row["price"] ?>">
              <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to cart">

          </div>

         </form>
        </div>
        <?php

         }
       } 
       ?>
       </div>
       <div style="clear:both"></div>
       <br/>
      <h3>order Ditails</h3>
      <div class="table-responsive">
          <table class="table table-striped">
          <tr>
              <th  width="40%">Item Name</th>
              <th  width="10%">Quantity</th>
              <th  width="20%">Price</th>
              <th  width="15%">Total</th>
              <th  width="5%">Action</th>
          </tr>
          <?php
          if(!empty($_SESSION["shopping_cart"]))
          {
              $total = 0;
              foreach ($_SESSION["shopping_cart"] as $keys => $value)
         {

          ?>
          <tr>
            <td><?php echo $value["item_name"]; ?></td>
            <td><?php echo $value["item_quantity"]; ?></td>
            <td>$ <?php echo $value["item_price"]; ?></td>
            <td><?php number_format(intval($value["item_quantity"]) * intval( $value["item_price"]), 2); ?></td>
            <td><a href="index.php?action=delete&id=<?php echo $value["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
          </tr>
          <?php
             $total = $total + intval($value["item_quantity"]) * intval($value["item_price"]);
           }
          ?> 
          <tr>
              <td colspan="3" align="right">Total</td>
              <td align="right">$ <?php echo number_format($total, 2); ?></td>
              <td></td>

          </tr>
          <?php
          }
          
          ?>
          </table>
      </div>
   </div>
  

   </div>



    




 





<script src="https://kit.fontawesome.com/d7804158f3.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>