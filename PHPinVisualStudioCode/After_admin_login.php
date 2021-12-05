<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You have to log in first";
        echo "<script type='text/javascript'> document.location = 'Admin_login.php'; </script>";
    }
    

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        echo "<script type='text/javascript'> document.location = 'Admin_login.php'; </script>";
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
                
            </p>
 
             
            <p style="display: inline-block; float: right;">
                
                <FORM method="POST">
                    <input style=" float: right;" type="submit" name="Submit3" value="Log out">
                </FORM>
                <?php 
                    if(isset($_POST['Submit3']))
                    { 
                        session_destroy();
                        echo "<script type='text/javascript'> document.location = 'after_login.php'; </script>";
                    }
                ?>
            </p>
 
        <?php endif ?>
    </div>

    
   
    </div><div class="content2">
        <h1><span>Insert Book</span></h1>
        <form action="After_admin_login.php" method="post" name="form1" target="_self">
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
            <input name="submit2" type="submit" class="btn" value="Insert">
        </form>
        <div class="para">
            <?php
                if(isset($_POST['submit2'])){
                    $bname=$_POST['bookname'];
                    $rname=$_POST['writername'];
                    
                    $con=new mysqli("localhost","root","","login");
                    $sql="SELECT * FROM books WHERE id=(SELECT max(id) FROM books)";
                    $result=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($result);
                    while($row=mysqli_fetch_row($result)){
                        $id=$row[0];
                        $id=$id+1;
                            $sql3="INSERT INTO books VALUES ('".$id."','".$bname."','".$rname."','1')";
                            $result2=mysqli_query($con,$sql3);
                            echo "Book inserted";
                       
                    }
                    
                  }
            ?>
        </div>
    </div>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <div class="content2">
        <h1><span>Current Borrowers</span></h1>
           <div  class="input-div3 one">
                <table>
                    <tr>
                        <th>Book_id</th>
                        <th>date of borrow</th>
                        <th>Borrower_id</th>
                        <th>Number</th>
                    </tr>
                    <?php
                        $con=new mysqli("localhost","root","","login");
                        $sql="SELECT book_id, dob, borrower_id, number FROM current_borrow";
                        $result=$con->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                echo "<tr><td>".$row["book_id"]."</td><td>".$row["dob"]."</td><td>".$row["borrower_id"]."</td><td>".$row["number"]."</td></tr>";
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

    
</body>
</html>