<?php
  session_start();
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="Admin_login.php" method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Admin Login</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input style="color: black;" name="username" type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input style="color: black;" name="password" type="password" class="input">
            	   </div>
            	</div>

            	<input name="submit1" type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['submit1'])){
            $name=$_POST['username'];
            $pass= $_POST['password'];
            if($name=='tamimjd' && $pass=='12369'){
                $_SESSION['username']=$name;
                echo "<script type='text/javascript'> document.location = 'After_admin_login.php'; </script>";
                exit();
            }
        }
    ?>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>