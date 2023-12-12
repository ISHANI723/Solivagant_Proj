<?php
require_once "config.php";

$username = $password = $confirm_password = $email= $state = $first_name = $dob= "";
$username_err = $password_err = $confirm_password_err = $email_err = $state_err = $first_name_err = $dob_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        } mysqli_stmt_close($stmt);
    }

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 8){
    $password_err = "Password cannot be less than 8 characters";
}
else{
    $password = trim($_POST['password']);
}

//check name
if(empty(trim($_POST['first_name']))){
    $first_name_err = "Name  cannot be blank";
}
else{
    $first_name = trim($_POST['first_name']);
}

//check state
if(isset($_POST['state']) || isset($_POST['dob'])){
    if(empty(trim($_POST['state']))){
    $state_err = "State  cannot be blank";
}
else{
    $state = trim($_POST['state']);
}



//check dob
if(empty(trim($_POST['dob']))){
    $dob_err = "DOB cannot be blank";
}
else{
    $dob = trim($_POST['dob']);
}
}
// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}

//check email is empty 
if(empty(trim($_POST["email"]))){
    $email_err = "email cannot be blank";
}
else{
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param username
            $param_email = trim($_POST['email']);

            // Try to execute  emil this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $email_err = "This email is already taken"; 
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                echo "Something went wrong";
            }
        } 
        mysqli_stmt_close($stmt);
    }


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($state_err) && empty($email_err) && empty($dob_err))
{
    $sql = "INSERT INTO users (username, password,first_name,email,state,dob) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password,$param_first_name,$param_state,$param_email,$param_dob);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_first_name=$first_name;
        $param_state=$state;
        $param_email=$email;
        $param_dob=$dob;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
// mysqli_close($conn);
}
?>
<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        } 
        mysqli_stmt_close($stmt);
    }

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err))
{
    $sql = "INSERT INTO users (username, password,first_name) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password, $param_first_name);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_first_name = $first_name;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Registration Page</title>
    <link rel="icon" href="images/Solivagant_LOGO.jpeg" type="image/gif" />
  </head>
  <body >
  
<section class="h-100 h-custom" style="background-color: #e91e63;">
<div class="view" style="background-image: url('http://mdbootstrap.com/img/Photos/Others/images/91.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
<!--<section class="vh-100 bg-image"
  style="background-image: url('C:\xamppn\htdocs\login\images\travel.webp');">-->
     <div class="navigation-bar">
        <div class="logo">
        <div class="circular_img">
                <img src="images/Solivagant_LOGO1.jpg" width="100px" height="100px">
        </div>
        </div>
                <nav>
                    <ul id='MenuItems'>
                    <li class="nav-item active">
                     <a class="nav-link" href="index.html">Home <span class="sr-only"><hr></span></a></li>
            
                        <li class="nav-item"><a class="nav-link" href="login.php">Login<hr></a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout<hr></a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About Us<hr></a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us<hr></a></li> -->
                    </ul>
                </nav>
            </div>
    <div class="container py-5 h-100" >
    <div class="row justify-content-center align-items-center h-100">
    <div class="card shadow-2-strong card-registration"  style="border-radius: 15px; background-color: 	#ffb6c1" style="box-shadow: 0 20px 20px rgba(0,0,0,0.15)">
        <div class="card-body p-4 p-md-5">
        <form action="register.php" method="post">
        <h3 class="text-center"><font color="black" font size="08" style="font-family:Times New Roman">Please Register Here:</font></h3>
        <hr style=" color: black";>

        <div class="form-group">
         <label for="inputPassword4"> Name</label>
         <input type="text" class="form-control" name ="first_name" id="first_name" placeholder="First name">
        </div>

       <div class="form-row">
       <div class="form-group col-md-6">
        <label for="dob">Date Of Birth</label>
        <input type="date" class="form-control" name ="dob" id="dob" placeid="start"  placeholder="enter dob" min="1990-01-01-" max="2024-01-01-">
       </div>
       <div class="form-group col-md-6">
        <label for="phone_number">Phone Number</label>
        <input type="tel" id="phoneNumber"  class="form-control" name ="phone_number" placeholder="Phone no.">
       </div>
      </div>

      <div class="form-row">
       <div class="form-group col-md-12">
        <label for="inputState"><i class ="fab fa-twitter"></i>State</label>
        <input type="text" class="form-control" name="state" id="state" placeholder="e.g Maharashtra">
        </div>
      </div>

      <div class="form-group ">
       <label for="inputEmail4"><font color="black">Username</b></label>
       <input type="text" class="form-control" name="username" id="username" placeholder="User name">
      </div>
      <div class="form-row">
       <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" name ="password" id="password" placeholder="Password">
       </div>
       <div class="form-group col-md-6">
        <label for="inputPassword4">Confirm Password</label>
        <input type="password" class="form-control" name ="confirm_password" id="confirm_assword" placeholder="Confirm Password">
       </div>
      </div>
      
      <div class="form-group">
       <label for="inputAddress2" ><font color="black">Email</label>
       <input type="email" class="form-control"  name ="email" id="email" placeholder="Enter your email">
      </div>
      
      <div class="d-grid gap-2 col-6 mx-auto"> 
      <button type="submit" class="btn btn-danger btn-rounded btn-lg" style="background-color:	#f08080"><font color="black">sign up</button>
    </div>
    
    </form>
   </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</section>

<style>
  
  @media (max-width: 1440px) {
    #mdb-footer {
      padding-left: 0;
    }
  }
  .btn-rounded
  {
    border-radius: 15px;
    width: 70%;
    box-shadow: 0 9px #999;
    text-align: center;
  }

  /*register form css */
  .gradient-custom {
/* fallback for old browsers */
background:#db7093;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;

}
.card-registration .select-arrow {
top: 13px;
}

/*date of birth css*/
label {
    display: block;
    font: 1rem 'Fira Sans', sans-serif;
}

input,
label {
    margin: 0.4rem 0;

}
.opacity{
    background-color:#03acf0;
    opacity: 0.5;
    color:black;
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
</style>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>