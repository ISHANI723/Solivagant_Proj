<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.html");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.html");
                            
                        }
                    }

                }

    }
}    

}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/Solivagant_LOGO.jpeg" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="full-page" style="background-image: url('http://mdbootstrap.com/img/Photos/Others/images/91.jpg'); background-repeat: no-repeat; background-size: cover; background-position: absolute;">
        <div class="sub-page">
            <div class="navigation-bar">
                <div class="logo">
                <div class="circular_img">
                    <img src="images/Solivagant_LOGO1.jpg" width="100px" height="100px">
                </div>
                </div>
                <nav>
                    <ul id='MenuItems " font-family: 'Kaushan Script', cursive>
                    <li class="nav-item active">
                     <a class="nav-link" href="index.html">Home <span class="sr-only"><hr></span></a></li>
            
                        <li class="nav-item"><a class="nav-link" href="login.php">Login<hr></a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout<hr></a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About Us<hr></a></li>
                        

                    </ul>
                </nav>
            </div> 
            
            <div class="row">
                <div class="col-1">
                    <div class="form-box">
                        <div class="form">
                            <form class="login-form">
                                <center><h1 class="main-heading">Login Form<hr></h1></center>
				                <input type="text"placeholder="user name"/>
				                <input type="password"placeholder="password"/>
				                <button>LOGIN</button>
				                <p class="message">Not Registered? <a  href="register.php">Register</a></p>
				            </form>
                            <form class="register-form">
                                <center><h1 class="main-heading"><a  href="register.php">Register Form<a></h1></center>
				                <input type="text" placeholder="user name"/>
				                <input type="text" placeholder="email-id"/>
				                <input type="password" placeholder="password"/>
				                <button>REGISTER</button>
				                <p class="message">Already Registered?<a href="#">Login</a>
				                </p>
				            </form>
			             </div>
	                </div>
                </div>
            <div class="col-1">
                <p class='defination'>“The journey of a thousand miles <br>begins with a single step.” <br><br>Follow your heart & Make a new routine<br> Journey. Explore. Discover. Repeat.</p>
            </div>
            </div>
        </div>
    </div>

    <script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    </script>
    <script>
        $('.message a').click(function(){$('form').animate({height: "toggle",opacity: "toggle"},"slow");});
    </script>
</body>
</html>

<style>
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.full-page
{
    height: 100vh;
    width: 100%;
    background: coral;
    position: absolute;
}
.sub-page
{
    width: 1266px;
    height: 559px;
    position: absolute;
    background: url(bg1.jpg);
    background-size: cover;
    background-position: center;
    left: 50px;
    top: 50px;
}
.navigation-bar
{
    display: flex;
    align-items: center;
    padding: 20px;
    padding-left: 80px;
    padding-right: 30px;
    padding-top: 50px;
}
.logo
{
    position: fixed;
    margin-top: 10px;
}
.logo a
{
    text-decoration: none;
    color: palevioletred;
    font-size: 30px;
}
nav
{
    flex: 1;
    position: fixed;
    right: 0;
}

nav ul 
{
    display: inline-block;
    list-style: none;
}
nav ul li
{
    display: inline-block;
    margin-right: 90px;
    margin-top: 17px;
}
nav ul li a
{
    text-decoration: none;
    font-size: 20px;
    color:white;
    font-family: sans-serif;
}
nav ul li a:hover
{
    color: saddlebrown;
}
.row
{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: space-around;
}
.col-1
{
    flex-basis: 50%;
    min-width: 300px;
}
.form-box
{
    width: 350px;
	height: 450px;
	position: relative;
    top: 50px;
    left: 120px;
	background: rgba(0,0,0,0.6);
}
.main-heading
{
    color: palevioletred;
    padding-bottom: 20px;
}
.form
{
	position: relative;
	margin: 0 auto 100px;
	padding: 45px;
    text-align: center;
}
.form input
{
	font-family: sans-serif;
	outline: none;
    border: none;
    border-bottom: 1px solid black;
	width: 100%;
	margin: 0 0 15px;
	padding: 15px;
	font-size: 14px;
}
.form button
{
	font-family: sans-serif;
	width: 100%;
    color: white;
	font-size: 14px;
	cursor: pointer;
	padding: 15px;
    border: none;
    background:  palevioletred;
}
.form .message
{
    font-size: 18px;
	margin: 15px 0 0;
    color: white;
}
.form .message a
{
	color: palevioletred;
	text-decoration: none;
}
.form .register-form{
	display: none;
}
.defination
{
    text-align: left;
    font-size: 30px;
    color: white;
    font-family: 'Kaushan Script', cursive;
    padding-left: 60px;
}
</style>