<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
        *
        {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        }
        header
        {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 40px 100px;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        header .logo
        {
        color: #fff;
        text-transform: uppercase;
        cursor: pointer;
        }
        .toggle
        {
        position: relative;
        width: 60px;
        height: 60px;
        background-repeat: no-repeat;
        background-size: 30px;
        background-position: center;
        
        }
        .toggle.active
        {
        background: url(https://i.ibb.co/rt3HybH/close.png);
        background-repeat: no-repeat;
        background-size: 25px;
        background-position: center;
        cursor: pointer;
        }
        .showcase
        {
        position: absolute;
        right: 0;
        width: 100%;
        min-height: 100vh;
        padding: 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #111;
        transition: 0.5s;
        z-index: 2;
        }
        .showcase.active
        {
        right: 300px;
        }

        .showcase video
        {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
        }
        .overlay
        {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #03a9f4;
        mix-blend-mode: overlay;
        }
        .text
        {
        position: relative;
        z-index: 10;
        }

        .text h2
        {
        font-size: 5em;
        font-weight: 800;
        color: #fff;
        line-height: 1em;
        text-transform: uppercase;
        }
        .text h3
        {
        font-size: 4em;
        font-weight: 700;
        color: #fff;
        line-height: 1em;
        text-transform: uppercase;
        }
        .text p
        {
        font-size: 1.1em;
        color: #fff;
        margin: 20px 0;
        font-weight: 400;
        max-width: 700px;
        }
        .text a
        {
        display: inline-block;
        font-size: 1em;
        padding: 10px 30px;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: 500;
        margin-top: 10px;
        color: #fff;
        letter-spacing: 2px;
        transition: 0.2s;
        }
        .text a:hover
        {
        letter-spacing: 4px;
        color: #fff;
        }
        .social
        {
        position: absolute;
        z-index: 10;
        bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .social li
        {
        list-style: none;
        }
        .social li a
        {
        display: inline-block;
        margin-right: 20px;
        filter: invert(1);
        transform: scale(0.5);
        transition: 0.5s;
        }
        .social li a:hover
        {
        transform: scale(0.5) translateY(-15px);
        }
        .menu
        {
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .menu ul
        {
        position: relative;
        }
        .menu ul li
        {
        list-style: none;
        }
        .menu ul li a
        {
        text-decoration: none;
        font-size: 24px;
        color: #111;
        }
        .menu ul li a:hover
        {
        color: #03a9f4; 
        }
        

        @media (max-width: 991px)
        {
        .showcase,
        .showcase header
        {
            padding: 40px;
        }
        .text h2
        {
            font-size: 3em;
        }
        .text h3
        {
            font-size: 2em;
        }
        }
        .signup{
          display: none;
        }
        #btn1{
          position: absolute;
          bottom: -70px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <section class="showcase">
        <header>
          <h2 class="logo">Welcome</h2>
          <div class="toggle"></div>
        </header>
        <video src="explore.mp4" muted loop autoplay></video>
        <div class="overlay"></div>
        
        <div id = "form1" class="login-content text">
          <form action="video.php" method="post" name="form1" target="_self">
            <img style="width: 100px;" src="img/avatar.svg">
            <h2  class="title">Welcome</h2>
                   <div  class="input-div one">
                      <div class="i">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="div">
                          <h5 style="color: white;">Username</h5>
                          <input style="color: white;" name="username" type="text" class="input">
                      </div>
                   </div>
                   <div class="input-div pass">
                      <div class="i"> 
                         <i class="fas fa-lock"></i>
                      </div>
                      <div class="div">
                         <h5 style="color: white;">Password</h5>
                         <input style="color: white;" name="password1" type="password" class="input">
                     </div>
                  </div>
                  
                  <a href="Admin_login.php">Admin Login</a>
                  <input name="submit1" type="submit" class="btn" value="Login">
                </form>
                <button class="btn" id="btn1">Dont have an account?</button>
            </div>
            
              
              <?php


                if(isset($_POST['submit1'])){
                  $name=$_POST['username'];
                  $pass= $_POST['password1'];
                  
                  $con=new mysqli("localhost","root","","login");
                  $sql="select * from login_info where name='".$name."' and password='".$pass."'";
                  $result=mysqli_query($con,$sql);
                  while($row=mysqli_fetch_row($result)){
                    $id=$row[1];
                    $_SESSION['id'] = $id;
                  }
                  $found=mysqli_num_rows($result);
                  if($found>=1){
                    
                    $_SESSION['username'] = $name;
                    
                    
                    echo "<script type='text/javascript'> document.location = 'after_login.php'; </script>";
                    //header('location: after_login.php');
                    exit();
                  }
                }
              ?>


            <div id="form2" class="login-content2 text">
              <form action="video.php" method="post" name="form2" target="_self">
                
                       <div class="input-div one">
                          <div class="i">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="div">
                              <h5 style="color: white;">Full name</h5>
                              <input name="fullname" type="text" class="input">
                          </div>
                       </div>
                       <div class="input-div one">
                          <div class="i">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="div">
                              <h5 style="color: white;">ID</h5>
                              <input name="ID" type="text" class="input" required>
                          </div>
                       </div>
                       <div  class="input-div one">
                          <div class="i">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="div">
                              <h5 style="color: white;">Email</h5>
                              <input name="email" type="text" class="input" required>
                          </div>
                       </div>
                       <div  class="input-div one">
                          <div class="i">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="div">
                              <h5 style="color: white;">Address</h5>
                              <input name="address" type="text" class="input">
                          </div>
                       </div>
                       <div  class="input-div one">
                          <div class="i">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="div">
                              <h5 style="color: white;">Department</h5>
                              <select name="dept" size="2">
                                <option value="BBA">BBA</option>
                                <option value="Civil">Civil</option>
                                <option value="CSE" selected="selected">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="English">English</option>
                              </select>
                          </div>
                       </div>
                       <div class="input-div pass">
                          <div class="i"> 
                             <i class="fas fa-lock"></i>
                          </div>
                          <div class="div">
                          <h5 style="color: white;">Date of birth</h5>
                             <input style="color: transparent;" name="dob" type="date" class="input">
                         </div>
                      </div>
                       <div class="input-div pass">
                          <div class="i"> 
                             <i class="fas fa-lock"></i>
                          </div>
                          <div class="div">
                             <h5 style="color: white;">Password</h5>
                             <input name="password" type="password" class="input">
                         </div>
                      </div>
                      <input name="submit2" type="submit" class="btn" value="Register">
                    </form>
                </div>
                <?php
                  if(isset($_POST['submit2'])){
                    $name=$_POST['fullname'];
                    $id= $_POST['ID'];
                    $email=$_POST['email'];
                    $address=$_POST['address'];
                    $dept=$_POST['dept'];
                    $dob=$_POST['dob'];
                    $pass=$_POST['password'];
                    
                    $con=new mysqli("localhost","root","","login");
                    $equery="select * from login_info where email='".$email."'";
                    $query=mysqli_query($con,$equery);
                    $emailcount=mysqli_num_rows($query);
                    
                    if($emailcount>0){
                      
                      echo '<script>alert("Email already exist");</script>';
                      $emailcount=0;
                    }
                    else{
                      $equery2="select * from login_info where id='".$id."'";
                      $query2=mysqli_query($con,$equery2);
                      $emailcount2=mysqli_num_rows($query2);

                      if($emailcount2>0){
                        echo '<script>alert("ID already exiet")</script>';
                        $emailcount2=0;
                      }
                      else{
                        $sql="INSERT INTO login_info VALUES ('".$name."','".$id."','".$email."','".$address."','".$dept."','".$dob."','".$pass."')";
                    
                        if(mysqli_query($con,$sql)){
                          echo '<script>alert("You Registered!")</script>';
                          $_SESSION['id']=$id;

                          $sql2="create table ".$id."_history(
                            book_name varchar(50),
                              writer_name varchar(50),
                              dob varchar(20)
                          );";
                          $query3=mysqli_query($con,$sql2);
                          $emailcount=0;
                          $emailcount2=0;
                        }
                        else{
                          echo '<p style="color: white;">error</p>';
                          $emailcount=0;
                          $emailcount2=0;
                        }
                    }
                  }
                }
                $id= null;
                $email=null;
              ?>
           
        <ul class="social">
          <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
          <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
          <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
        </ul>
      </section>
      <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
      <script type="text/javascript" src="js/main.js"></script>
</body>
<script>
  document.getElementById("btn1").addEventListener("click",function(){
	var box1=document.getElementById("form1");
  var box2=document.getElementById("form2");
	if(box1.style.display=="none"){
		box1.style.display="block";
    box2.style.display="none";
	}
	else{
		box1.style.display="none";
    box2.style.display="block";
	}
});
</script>
</html>