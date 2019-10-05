<?php
session_start();
session_unset();

// session_destroy();

// header('location:index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logout page</title>
    <!-- bootstrap Cdn -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- stylesheet -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<a href="index.php" class="btn btn-success mx-2 my-2"> LOGOUT</a>
<div class="container">
    <h1 class="text-center text-info py-4">Online Shopping</h1>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1 class="py text-center">Thanks</h1>
            <h3>Your order successful..</h3>
        </div>
        <div class="col-3"></div>
    </div>
</div>


    
</body>
</html>