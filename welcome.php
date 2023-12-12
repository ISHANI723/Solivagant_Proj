<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true)
{
    header("location: login.php");
}

else{
    echo"Welcome";
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
                        <!-- <li class="nav-item"><a class="nav-link" href="#"><?php echo "Welcome ".$_SESSION['username']?><hr></a></li> -->

                    </ul>
                <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a class="nav-link" href="#"><?php echo "Welcome ".$_SESSION['username']?><hr></a>
                </li>
                </ul>
                </div>
            
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