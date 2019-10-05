<?php
$servername = "localhost";
$username = "yusuf";
$password = "yusuf";
$dbname = "yusuf_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// if (isset($_POST['log'])){
//     $name = $_POST['email'];
//     $pwd = $_POST['password_f'];
  

//     $sql = "SELECT * FROM cart WHERE email= '$email' AND password='$pwd' ";
//     $result = mysqli_query($conn, $sql);
    
//     if (mysqli_num_rows($result) > 0) {
        // output data of each row
        // echo "successfully";
    $email = $password = '';
    $error = ['email' => '', 'password' => '', 'invalid' => ''];
    if(isset($_POST['log'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(empty($email)) {
            $error['email'] = "An email is required <br />";
        }else {
            
        }
        if(empty($password)) {
            $error['password'] = 'password is required <br />';
        }else {

        }
        if(array_filter($error)) {
            echo 'errors in the form';
        } else {
            $email = stripcslashes($email);
            $password = stripcslashes($password);
            $mdpass = md5($password);

            $sql = "SELECT * FROM cart WHERE email='$email' AND password='$mdpass'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 1) {
                $_SESSION['email'] = $email;
                echo 'Login Successfull';
                echo $_SESSION['email'];
                header("Location: home.php");
            } else {
                $error['invalid'] = "Email or Password is incorrect.";
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
    <title>Sign Up Form by Colorlib</title>

     <!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
<!-- bootstrap Cdn -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- index start -->
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <a href="registration.php" class="signup-image-link">Create an account</a>
                    </div>

                  <div class="row text-center">
                   <div class="col-md-4"></div>
                   <div class="col-md-4">
                   <div class="signin-form">
                        <h2 class="form-title">Log in</h2>
                        <form action="login.php" method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="form-control" type="text" name="email" id="your_name" placeholder="Your Email" required/>
                            </div>
                            <span id="span"><?php echo $error['email']; ?></span>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input class="form-control" type="password" name="password" id="your_pass" placeholder="Password" required/>
                            </div>
                            <span id="span"><?php echo $error['password']; ?></span>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <span id="span"><?php echo $error['invalid']; ?></span>
                            <div class="form-group form-button">
                                <input type="submit" class="btn btn-primary" name="log" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    
                    </div>
                   </div>
                   <div class="col-md-4"></div>
                  </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>