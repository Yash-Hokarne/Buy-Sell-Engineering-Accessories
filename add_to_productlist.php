<!DOCTYPE html>
<?php
 session_start();
?>
<html>
<head>
    <style>
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
    </style>
</head>
<body style="border:1px solid black; margin:50px; padding:50px;">

<?php 
        $servername="localhost";
        $username="root";
        $password="";
        $db="uploads";

        $conn=new mysqli($servername,$username,$password,$db);

        if($conn->connect_error){
            die("<br>connection failed".$conn->connect_error);
        }
        else{
            echo "<br>Connected successfully";
        }

        $sql="CREATE DATABASE uploads";
        if($conn->query($sql)===False){
            echo "Error creating database".$conn->error;
        }
        else{
            echo "Database created!!";
        }
        $sql="CREATE TABLE product_list(PID INT primary key AUTO_INCREMENT,UID INT , ProductName varchar(255) , ProductImage LONGBLOB,
        ProductCategory varchar(255), ProductDescription varchar(500) , ProductPrice INT, SellerContact varchar(255) ,Reg_Date TIMESTAMP)";

        if($conn->query($sql)===False){
            echo"<br>Error creating table: ".$conn->error;
        }
        else{
            echo "<br>Table created!!";
        }
        $uid   = $_SESSION['ID'];
        $pname = $conn->real_escape_string($_REQUEST['pname']);
        $pimg  = addslashes(file_get_contents($_FILES["pimg"]["tmp_name"]));
        $pcat  = $conn->real_escape_string($_REQUEST['pcat']);
        $pdesc = $conn->real_escape_string($_REQUEST['pdesc']);
        $pcost = $conn->real_escape_string($_REQUEST['pcost']);
        $pmail = $conn->real_escape_string($_REQUEST['pmail']);
    
        // Attempt insert query execution
        $sql = "INSERT INTO product_list(UID, ProductName, ProductImage, ProductCategory, ProductDescription, ProductPrice, SellerContact)
        VALUES ('$uid','$pname','$pimg','$pcat','$pdesc','$pcost','$pmail')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        //echo "<br>Success In Data Insertion!!";
        $last_id=$conn->insert_id;
        echo "<br>Last ID:".$last_id;
?>
<br><br>
<button align="center"><a href="home.php">BackToHome</a></button>
</body>
</html>