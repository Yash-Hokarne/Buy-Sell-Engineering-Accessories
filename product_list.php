<!DOCTYPE html>
<html>
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
    <head>
        <style>
            table,th,td{
                border:1px solid black;
                border-collapse:collapse;
            }
        </style>
    </head>
    <body>
    <?php
        $sql="SELECT * FROM product_list";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
            <th>PrductPrice</th><th>SellerContact</th><th>TIMESTAMP</th>";
            while ($row=$result->fetch_assoc()){
                //$img=fopen($row["ProductImage"],"r");
                //header("Content-type: image/png");
                echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                $row["SellerContact"]."</td><td>".$row["Reg_Date"]."</td></tr>";
            }
            echo"</table>";
        }
        else{
            echo "No data found!!";
        }
    ?>
    </body>
</html>