<?php
    session_start();
    
    
    
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You have to log in first";
        echo "<script type='text/javascript'> document.location = 'video.php'; </script>";
    }
    

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        echo "<script type='text/javascript'> document.location = 'video.php'; </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
        body{
            background-color: burlywood;
        }
        .content2{
            border: 2px solid #000;
            width: 100%;
            min-height: 200px;
            margin-top: 100px;
        }

        .content2 h1{
            text-align: left;
            margin-top: -10px;
            height: 20px;
            line-height: 20px;
            font-size: 15px;
        }

        .content2 h1 span{
            background-color: white;
        }
        .content2{
            position: relative;
        }
        .input-div1{
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            
        }
        .input-div2{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .input-div3{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .btn{
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .para{
            position: absolute;
            top: 95%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Home Page</h2>
    </div>
    <div class="content">
  
       
        <?php  if (isset($_SESSION['username'])) : ?>
             
            <p style="display: inline-block; float: left;">
                Welcome
                <strong>
                    <?php echo $_SESSION['username']; ?>
                    
                </strong>
            </p>
 
             
            <p style="display: inline-block; float: right;">
                
                <FORM method="POST">
                    <input style=" float: right;" type="submit" name="Submit3" value="Log out">
                </FORM>
                <?php 
                    if(isset($_POST['Submit3']))
                    { 
                        session_destroy();
                        echo "<script type='text/javascript'> document.location = 'video.php'; </script>";
                    }
                ?>
            </p>
 
        <?php endif ?>
    </div>

    <div class="content2">

        <h1><span>Book Availability</span></h1>
        <form action="after_login.php" method="post" name="form1" target="_self">
            <div  class="input-div1 one">
                <div class="div">
                    <h5 >Search for book availability</h5>
                    <input  name="search" type="text" class="input">
                </div>
            </div>
            <input name="submit1" type="submit" class="btn" value="submit">
        </form>
        
        <div class="para">
            <?php
                if(isset($_POST['submit1'])){
                    $name=$_POST['search'];
                    
                    $con=new mysqli("localhost","root","","login");
                    $sql="select * from books where book_name='".$name."'";
                    $result=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($result);
                    while($row=mysqli_fetch_row($result)){
                        $status=$row[3];
                        if($status==1){
                            echo "".$name." Book available";
                        }
                        else{
                            echo "".$name." Book not available";
                        }
                    }
                    if($count==0){
                        echo "".$name." Book not available";
                    }
                  }
            ?>
        </div>
    </div>

    <div class="content2">
        <h1><span>Borrow book</span></h1>
        <form action="after_login.php" method="post" name="form1" target="_self">
            <div  class="input-div1 one">
                <div class="div">
                    <h5 >Book name</h5>
                    <input  name="bookname" type="text" class="input">
                </div>
            </div>
            <div  class="input-div2 one">
                <div class="div">
                    <h5 >Writer name</h5>
                    <input  name="writername" type="text" class="input">
                </div>
            </div>
            <input name="submit2" type="submit" class="btn" value="Borrow">
        </form>
        <div class="para">
            <?php
                if(isset($_POST['submit2'])){
                    $bname=$_POST['bookname'];
                    $rname=$_POST['writername'];
                    
                    $con=new mysqli("localhost","root","","login");
                    $sql="select * from books where book_name='".$bname."' and writer_name='".$rname."'";
                    $result=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($result);
                    while($row=mysqli_fetch_row($result)){
                        $status=$row[3];
                        $id=$row[0];
                        if($status==1){
                            $sql2="UPDATE books SET status='0' WHERE book_name='".$bname."' and writer_name='".$rname."'";
                            $result2=mysqli_query($con,$sql2);
                            $date = date('Y-m-d H:i:s');
                            $sql3="INSERT INTO ".$_SESSION['id']."_history VALUES ('".$bname."','".$rname."','".$date."')";
                            $result2=mysqli_query($con,$sql3);
                            $randomValue=rand(1,100000);
                            $sql4="INSERT INTO current_borrow VALUES ('".$id."','".$date."','".$_SESSION['id']."','".$randomValue."')";
                            $result3=mysqli_query($con,$sql4);
                            echo "book borrowed. your book id is ".$id."";
                        }
                        else{
                            echo "".$bname." Book not available";
                        }
                    }
                    if($count==0){
                        echo "".$bname." Book not available";
                    }
                  }
            ?>
        </div>
    </div>

    <div class="content2">
        <h1><span>Return book</span></h1>
        <form action="after_login.php" method="post" name="form1" target="_self">
            <div  class="input-div1 one">
                <div class="div">
                    <h5 >Book ID</h5>
                    <input  name="bookid" type="text" class="input">
                </div>
            </div>
            <div  class="input-div2 one">
                <div class="div">
                    <h5 >Book Number</h5>
                    <input  name="booknum" type="text" class="input">
                </div>
            </div>
            <input name="submit3" type="submit" class="btn" value="Return">
        </form>
        <div class="para">
            <?php
                if(isset($_POST['submit3'])){
                    $bid=$_POST['bookid'];
                    $bnum=$_POST['booknum'];
                    
                    $con=new mysqli("localhost","root","","login");
                    $sql="select * from current_borrow where book_id='".$bid."'";
                    $result=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($result);
                    while($row=mysqli_fetch_row($result)){
                        $number=$row[3];
                        if($number==$bnum){
                            $sql2="DELETE FROM current_borrow WHERE book_id='".$bid."';";
                            $result2=mysqli_query($con,$sql2);
                            $sql3="UPDATE books SET status='1' WHERE id='".$bid."'";
                            $result3=mysqli_query($con,$sql3);
                            echo "".$bid." Book removed";
                        }
                        else{
                            echo "".$bid." Book not removed";
                        }
                    }
                    if($count==0){
                        echo "".$bid." Book not removed";
                    }
                  }
            ?>
        </div>
    </div>

    <div class="content2">
        <h1><span>Borrow History</span></h1>
           <div  class="input-div3 one">
                <table>
                    <tr>
                        <th>Book_name</th>
                        <th>Writer_name</th>
                        <th>date of borrow</th>
                    </tr>
                    <?php
                        $con=new mysqli("localhost","root","","login");
                        $sql="SELECT book_name, writer_name, dob FROM ".$_SESSION['id']."_history";
                        $result=$con->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                echo "<tr><td>".$row["book_name"]."</td><td>".$row["writer_name"]."</td><td>".$row["dob"]."</td></tr>";
                            }
                            echo "</table>";
                        }
                        else{
                            echo "No history";
                        }
                        $con->close();
                    ?>
                </table>
            </div>
           
        
    </div>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    
</body>
</html>