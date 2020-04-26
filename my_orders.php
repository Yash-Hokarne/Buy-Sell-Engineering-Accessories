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
<head>
    <style>
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
    </style>
</head>
<body style="border: 1px solid black; margin:50px; padding:50px;">
<div id="list" style="border:1px solid black; margin:5px; padding:20px;">
                <h2>Your Ordered Items:</h2>
                <table>
                    <tr>
                        <td align="center"><b><a class="index_a" href="#" id="FY">FY</a></b>
                            <table id="first">
                            <tr>
                                <td>
                                    <?php
                                        $myord="SELECT * FROM orders WHERE CUID=".$_SESSION['ID'];
                                        $res=$conn->query($myord);
                                        $pdl="SELECT * FROM product_list";
                                        $res2=$conn->query($pdl);
                                        if($res->num_rows>0){
                                            $row1=$res->fetch_assoc();
                                            $row=$res2->fetch_assoc();
                                            if($row1['CUID']==$_SESSION['ID']){
                                                while($row1['PID']==$row['PID']){
                                                   // echo "<tr><th>ProductName</th><th>ProductCategory</th></tr>";
                                                   // echo "<tr><td>".$row['ProductName']."</td></td>".$row["ProductCategory"]."</td></tr>";
                                                }
                                            }
    
                                        }
                                        else{
                                            //echo "No data found!!";
                                        }
                                    ?>
                                    <?php
                                        $fy="SELECT * FROM orders WHERE CUID=".$_SESSION['ID'];
                                        $res1=$conn->query($fy);
                                        if($res1->num_rows>0){
                                            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
                                            <th>PrductPrice</th><th>SellerContact</th><th>ACTIONS</th>";
                                            while ($row1=$res1->fetch_assoc()){
                                                //$img=fopen($row["ProductImage"],"r");
                                                //header("Content-type: image/png");
                                                //$_SESSION['PID']=$row1['PID'];
                                                //echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                //$row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                //$row["SellerContact"]."</td><td><button><a href='add_to_cart.php'>Add to Cart</a></button><br><br><button><a href='orders.php'>Buy Now</a></button></td></tr>";
                                            //echo"</table>";
                                                $pd="SELECT * FROM product_list WHERE PID=".$row1['PID'];
            
                                                $res2=$conn->query($pd);
                                                if($res2->num_rows>0){
                                                    while($row=$res2->fetch_assoc()){
                                                        echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                        $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                        $row["SellerContact"]."</td><td><button><a href='cancel_order.php'>Cancel Order</a></button></td></tr>";
                                                        
                                                    }
                                                    echo"</table>";
                        
                                                }
                                                else{
                                                    echo"Oops!!";
                                                }
                                        }}
                                        else{
                                            echo "No data found!!";
                                        }
                                    ?>
                                </td>
                            </tr>
                            </table>

                        </td>
                    </tr>
                </table>
</div>
<br><br>
<button><a href="home.php">Back</a></button>
</body>
</html>