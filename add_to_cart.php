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
<body style="border: 1px solid black; margin:50px; padding:50px;">
    <?php
    $sql="CREATE TABLE cart(CID INT PRIMARY KEY AUTO_INCREMENT, PID INT, CUID INT)";
    if($conn->query($sql)==true){
        echo "Table created!!";
    }
    else{
        echo "Error!!".$conn->error;
    }
    $id = $conn->real_escape_string($_SESSION['ID']);
    $pid=$conn->real_escape_string($_SESSION['PID']);
    $sql="INSERT INTO cart(PID,CUID) VALUES ('$pid','$id')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $last_id=$conn->insert_id;
    echo "<br>Last ID:".$last_id;
    ?>
<br><br>
<button><a href="home.php">Back</a></button>
</body>
</html>