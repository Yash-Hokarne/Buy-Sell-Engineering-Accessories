<!DOCTYPE html>
<head>
    <style>
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
    </style>
</head>
<html>
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
$sql="CREATE TABLE info(ID INT primary key AUTO_INCREMENT, FirstName varchar(255) , LastName varchar(255), 
Email varchar(255) , DOB DATE , ContactNumber varchar(10) ,CollegeYear INT, CollegeBranch INT, 
UAddress varchar(500) ,UPassword varchar(255) NOT NULL, Reg_Date TIMESTAMP)";

if($conn->query($sql)===False){
    echo"<br>Error creating table: ".$conn->error;
}
else{
    echo "<br>Table created!!";
}
/*
$stmt=$stmt=$conn->prepare("INSERT INTO info(FirstName,LastName,Email,DOB,ContactNumber,CollegeYear,CollegeBranch,UAddress,UPassword) 
VALUES(?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssdsssd",$_POST["fname"],$_POST["lname"],$_POST["email"],$_POST["dob"],$_POST["mob"],
$_POST["year"],$_POST["branch"],$_POST["address"],$_POST["password"]);
$stmt->execute();
if($stmt->execute()){
    echo "<br>Success In Data Insertion!!";
}
else{
    echo "<br>Failed To Insert Data!!";
}
$stmt->close();*/
/*
$sql='INSERT INTO info(FirstName,LastName,Email,DOB,ContactNumber,CollegeYear,CollegeBranch,UAddress,UPassword) 
VALUES("ABC","XYZ","abc@gmail.com","31-10-1998",7276514078,"TY","IT","PUNE","12345678")';
*/

$fname = $conn->real_escape_string($_REQUEST['fname']);
$lname = $conn->real_escape_string($_REQUEST['lname']);
$email = $conn->real_escape_string($_REQUEST['email']);
$dob = $conn->real_escape_string($_REQUEST['dob']);
$mob = $conn->real_escape_string($_REQUEST['mob']);
$year = $conn->real_escape_string($_REQUEST['year']);
$branch = $conn->real_escape_string($_REQUEST['branch']);
$addr = $conn->real_escape_string($_REQUEST['address']);
$pass = $conn->real_escape_string($_REQUEST['password']);
// Attempt insert query execution
$sql = "INSERT INTO info(FirstName,LastName,Email,DOB,ContactNumber,CollegeYear,CollegeBranch,UAddress,UPassword)
VALUES ('$fname', '$lname', '$email','$dob','$mob','$year','$branch','$addr','$pass')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//echo "<br>Success In Data Insertion!!";
$last_id=$conn->insert_id;
echo "<br>Last ID:".$last_id;
echo"<br>UPDATED DATABASE :";
$sql="SELECT * FROM info";
$result=$conn->query($sql);
if($result->num_rows>0){
    echo "<table><tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>DOB</th><th>ContactNumber</th>
    <th>CollegeYear</th><th>CollegeBranch</th><th>ADDRESS</th><th>PASSWORD</th><th>TIMESTAMP</th>";
    while ($row=$result->fetch_assoc()){
        echo "<tr><td>".$row["ID"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["Email"]
        ."</td><td>".$row["DOB"]."</td><td>".$row["ContactNumber"]."</td><td>".$row["CollegeYear"]."</td><td>".$row["CollegeBranch"]
        ."</td><td>".$row["UAddress"]."</td><td>".$row["UPassword"]."</td><td>".$row["Reg_Date"]."</td></tr>";
    }
    echo"</table>";
}
else{
    echo "No data found!!";
}
//for sending mail
//ini_set('SMTP','localhost');
//ini_set('smtp_port',25);
//ini_set('sendmail_from','asrede@mitaoe.ac.in');
/*
$msg="Your Order Has Been Placed Successfully!!";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <asrede@mitaoe.ac.in>' . "\r\n";
mail($_POST["email"],"Order Confirmation.",$msg,$headers);
/*
$sql="INSERT INTO info(name,email) VALUES($_POST[name],$_POST[email])";
if(mysqli_query($conn,$sql)){
    echo "New record created!!";
}
else{
    echo "Error inserting new record!!\n";
}
*/

$conn->close();
?>
<button><a href="signin.php">Sign In</a></button>
</body>
</html>

