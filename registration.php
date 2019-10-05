<?php
$servername = "localhost";
$username = "yusuf";
$password = "yusuf";
$dbname = "yusuf_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//sql to create table
// $sql = "CREATE TABLE cart (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
// username VARCHAR(30) NOT NULL,
// password VARCHAR(200) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// if (mysqli_query($conn, $sql)) {
//     echo "Table cart created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }if(!mysqli_query($conn, $sql)){}
//     else{}
    
    $error = ['name' => '', 'password' => '','email' => ''];
	$name = $password = $email =   '';
	if(isset($_POST['register'])) {
        $name = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        if(empty($name)){
        	$error['name'] = 'Name is required <br/>';
        }
        if(empty($password)) {
            $error['password'] = 'password is required <br/>';
        }else {
            // echo htmlspecialchars($password);
        }
        if(empty($email)) {
            $error['email'] = "An email is required <br />";
        }elseif(!empty($email)){
            $sql_email = "SELECT * FROM cart WHERE email='$email'";
            $result = mysqli_query($conn, $sql_email);
            if(mysqli_num_rows($result)>0) {
                $error['email'] = "Sorry... Email Address Is Already Registered";
            }
        }else{

        }
        if(array_filter($error)) {
            echo 'you have an error';
        } else {
            echo 'form is valid';
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = md5($password);
            $sql = "INSERT INTO cart (username, password, email) VALUES ('$name', '$password', '$email')";
            if (!mysqli_query($conn,$sql)) {
                echo "SQL Insert data failed..".mysqli_error($conn);
            }else{
                header('Location: login.php');
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
    <title>resgistration</title>

    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<form action="registration.php" method="POST" class="my">
    <h1 class="singin">Create a new account</h1>
<label>Username</label>
<input type="text"  placeholder="Your Name" name="username" required>
<span id="span"><?php echo $error['name'] ?></span>
<label>Password</label>
<input type="password"  placeholder="password" name="password" required>
<span id="span"><?php echo $error['password'] ?></span>
<label>Email</label>
<input type="email"  placeholder="email" name="email" required>
<span id="span"><?php echo $error['email'] ?></span>
<button type="submit" name="register">Register</button>
</body>
</html>




