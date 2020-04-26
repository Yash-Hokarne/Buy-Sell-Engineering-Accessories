<!DOCTYPE html>
<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$db="uploads";

$conn=new mysqli($servername,$username,$password,$db);
if($conn->connect_error){
    die("<br>connection failed".$conn->connect_error);
}
else{
   // echo "<br>Connected successfully";
}
?>
<html>
<body style="border:1px solid black; padding:50px; margin:50px;">
<?php
$sql="DELETE FROM orders WHERE CUID=".$_SESSION['ID'];
if($conn->query($sql)==true){
    echo "ENtry Deleted!!";
}
else{
    echo "Error Deleting ENtry!!".$conn->error;
}
?>
<br><br>
<button id="btn" type="click"><a href="my_orders.php">Ok</a></button>
</body>