<!DOCTYPE html>
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
        // echo "<br>Connected successfully";
        }

        include_once('dbConfig.php');
        if(isset($_POST['signin'])){
        extract($_POST);
        //print_r($_POST);die;
        $sql="SELECT * FROM info WHERE FirstName='$un' AND UPassword='$ps'";
        //print_r($sql);die;
        $result=$conn->query($sql);
        //print_r($result);die;
        $row=$result->fetch_assoc();
        //print_r($row);die;
        if($_POST['un']==="" && $_POST['ps']===""){
        // echo "<script>alert('ENter Details!!')</script>";
            echo '<script>window.open(signin.php)</script>';
        }
        else{
            if($_POST['un']==$row['FirstName']){
                if($_POST['ps']==$row['UPassword']){
                    $_SESSION['signin']==true;
                    $_SESSION['ID'] = $row['ID'];
                    $_SESSION['un'] = $_POST['FirstName'];
                    $_SESSION['ps'] = $_POST['UPassword'];
                    echo '<script>window.loaction.href="upload.php"</script>';
                    header("Location: home.php");
                    //echo 'Ohoy';
                    }
                    else{
                        echo'enter correct passward';
                    }
                }
                else{
                    echo 'enter correct username' ;
                }
                
            }
        }
?>


<html>
    <head>
        <title> Welcome to E-Mart! </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            th{
                border:1px solid black;
                border-collapse:collapse;
                padding:10px 10px;
            }
        </style>
    </head>
    
    <body id="index_body">
        <header id="index_header" style="background-color:lightgreen;">
        <h1 align="center"><a class="index_a" href="index.html" id="logo" title="Home Page">E-Mart</a></h1>
        <h2 align="center">(: An Online Destination for Engineering Essentials :)</h2>
        </header>
        <br><br><br><br><br><br>
        <div name="navbar">
            <ul>
                <li class="index_ul_li" style="margin:10px"><a class="index_a" href="test_home.php">Home</a></li>
                <li class="index_ul_li" style="margin:10px"><a class="index_a" href="#" id="about"><abbr title="Double click to view/Single click to go back">About</abbr></a></li>
                <li class="index_ul_li" style="margin:10px"><a class="index_a" href="#" id="prof"><abbr title="Double click to view/Single click to go back">Profile</abbr></a></li>
                <li class="index_ul_li" style="margin:10px"><a class="index_a" href="#" id="cart"><abbr title="Click to view/Single click to go back">Cart</abbr></a></li>
            	<li class="index_ul_li" style="margin:10px"><a class="index_a" href="sell.php" id="sell"><abbr title="Click to view/Single click to go back">Sell</abbr></a></li>
            </ul>
        </div>

        <br><br><br><br><br>

        <div id="abt" style="border:1px solid black; padding:10px;" hidden>
            <br>
            <h2>E-Mart:</h2>
            <p>
                It is an online platform for enginerring students from all branches and years to order the study material they need.
                You can order the stuff from this website so that you don't need to stand in line and can preorder stuff according 
                to your need.
            </p>
        </div>

        <div id="pf" hidden>
            <br><br>
            <table>
                <tr>
                    <td colspan="2" style="width:30%">
                        <img src="" alt="Profile Image">
                    </td>
                    <td colspan="4">
                        <br><br><br>
                        <table>
                                <tr>
                                        <td style="width:10%">Name:</td>
                                        <td></td>
                                </tr>
                                <tr>
                                        <td style="width:10%">Email:</td>
                                        <td></td>
                                </tr>
                                <tr>
                                        <td style="width:10%">Contact:</td>
                                        <td></td>
                                </tr>
                                <tr>
                                        <td style="width:10%">Address:</td>
                                        <td></td>
                                </tr>
                        </table>
                    </td>
                </tr>
                <br>
                <tr>
                        <p>
                        <button><a href="logout.php">LOGOUT</button>  
                        </p>
                </tr>
            </table>
        </div>

        <br>


           <div id="list" style="border:1px solid black; margin:5px; padding:20px;">
                <h2>Select Year:</h2>
                <table>
                    <tr>
                        <td align="center"><b><a class="index_a" href="#" id="FY">FY</a></b>
                            <table id="first" hidden>
                            <tr>
                                <td>
                                    <?php
                                        $fy="SELECT * FROM product_list WHERE ProductCategory='FY'";
                                        $res1=$conn->query($fy);
                                        if($res1->num_rows>0){
                                            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
                                            <th>PrductPrice</th><th>SellerContact</th><th>ACTIONS</th>";
                                            while ($row=$res1->fetch_assoc()){
                                                //$img=fopen($row["ProductImage"],"r");
                                                //header("Content-type: image/png");
                                                $row['PID']=$_SESSION['PID'];
                                                echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                $row["SellerContact"]."</td><td><button><a href='add_to_cart.php'>Add to Cart</a></button><br><br><button><a href=''>Buy Now</a></button></td></tr>";
                                            }
                                            echo"</table>";
                                        }
                                        else{
                                            echo "No data found!!";
                                        }
                                    ?>
                                </td>
                            </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td align="center"><b><a class="index_a" href="#" id="SY">SY</a></b>
                            <table id="second" hidden>
                            <tr>
                                <td>
                                    <?php
                                        $fy="SELECT * FROM product_list WHERE ProductCategory='SY'";
                                        $res1=$conn->query($fy);
                                        if($res1->num_rows>0){
                                            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
                                            <th>PrductPrice</th><th>SellerContact</th><th>ACTIONS</th>";
                                            while ($row=$res1->fetch_assoc()){
                                                //$img=fopen($row["ProductImage"],"r");
                                                //header("Content-type: image/png");
                                                echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                $row["SellerContact"]."</td><td><button><a href='add_to_cart.php'>Add to Cart</a></button><br><button><a href=''>Buy Now</a></button></td></tr>";
                                            }
                                            echo"</table>";
                                        }
                                        else{
                                            echo "No data found!!";
                                        }
                                    ?>
                                </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><b><a class="index_a" href="#" id="TY">TY</a></b>
                            <table id="third" hidden>
                            <tr>
                                <td>
                                    <?php
                                        $fy="SELECT * FROM product_list WHERE ProductCategory='TY'";
                                        $res1=$conn->query($fy);
                                        if($res1->num_rows>0){
                                            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
                                            <th>PrductPrice</th><th>SellerContact</th><th>ACTIONS</th>";
                                            while ($row=$res1->fetch_assoc()){
                                                //$img=fopen($row["ProductImage"],"r");
                                                //header("Content-type: image/png");
                                                echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                $row["SellerContact"]."</td><td><button><a href='add_to_cart.php'>Add to Cart</a></button><br><button><a href=''>Buy Now</a></button></td></tr>";
                                            }
                                            echo"</table>";
                                        }
                                        else{
                                            echo "No data found!!";
                                        }
                                    ?>
                                </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><b><a class="index_a" href="#" id="BE">BE</a></b>
                            <table id="forth" hidden>
                            <tr>
                                <td>
                                    <?php
                                        $fy="SELECT * FROM product_list WHERE ProductCategory='SY'";
                                        $res1=$conn->query($fy);
                                        if($res1->num_rows>0){
                                            echo "<table><tr><th>PID</th><th>UID</th><th>ProductName</th><th>ProductImage</th><th>ProductCategory</th><th>ProductDescription</th>
                                            <th>PrductPrice</th><th>SellerContact</th><th>ACTIONS</th>";
                                            while ($row=$res1->fetch_assoc()){
                                                //$img=fopen($row["ProductImage"],"r");
                                                //header("Content-type: image/png");
                                                echo "<tr><td>".$row["PID"]."</td><td>".$row["UID"]."</td><td>".$row["ProductName"]."</td><td><img src='data:image/jpeg/png;base64,'".base64_encode($row['ProductImage'])."</td><td>".
                                                $row["ProductCategory"]."</td><td>".$row["ProductDescription"]."</td><td>".$row["ProductPrice"]."</td><td>".
                                                $row["SellerContact"]."</td><td><button><a href='add_to_cart.php'>Add to Cart</a></button><br><br><button><a href=''>Buy Now</a></button></td></tr>";
                                            }
                                            echo"</table>";
                                        }
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

        <footer>
            <div style="border:1px solid black; margin:5px; padding:20px; height:120px">
                <p style="text-align: center;font-size: 20px;" title="© Copyright 2018 EMART GROUPS - All Rights Reserved"> © Copyright 2018 EMART GROUPS - All Rights Reserved</p>
                <hr>
                <p style="float: left;font-size: 20px;margin-left:300px"><b>Grow with us on Social Media aswell--</b></p>
                <a style=" height: 20px; width:20px; padding:5px 5px; float:center; margin: 15px 15px;" title="EM Facebook Page" href="https://www.facebook.com/" target="_blank" class="fa fa-facebook" style="float: right"></a>
                <a style=" height: 20px; width:20px; padding:5px 5px; float:center; margin: 5px 5px;" title="EM Twitter Page" href="https://twitter.com/"  target="_blank" class="fa fa-twitter" style="float: right"></a>
                <a style=" height: 20px; width:20px; padding:5px 5px; float:center; margin: 5px 5px;" title="EM Google Page" href="https://google.com/"  target="_blank" class="fa fa-google" style="float: right"></a>
                <a style=" height: 20px; width:20px; padding:5px 5px; float:center; margin: 5px 5px;" title="EM linkedin Page" href="https://linkedin.com/"  target="_blank" class="fa fa-linkedin" style="float: right"></a>
                <br>
            </div>
        </footer>
        
        <script>
            $(document).ready(function(){
                $("#FY").click(function(){
                    $("#first").toggle("fast");
                })

                $("#SY").click(function(){
                    $("#second").toggle("fast");
                })

                $("#TY").click(function(){
                    $("#third").toggle("fast");
                })

                $("#BE").click(function(){
                    $("#forth").toggle("fast");
                })

                $("#prof").on(
                    {dblclick:function(){
                    $("footer").hide();
                    $("#list").hide("fast",function(){
                        $("#pf").show("fast");
                    });
                    },
                    click:function(){
                        $("#list").show();
                        $("footer").show();
                        $("#pf").hide();
                    }
                })

                $("#about").on(
                    {dblclick:function(){
                    $("footer").hide();
                    $("#list").hide("fast",function(){
                        $("#abt").show("fast");
                    })},
                    click:function(){
                        $("#list").show();
                        $("footer").show();
                        $("#abt").hide();
                    }
                })

                $("#cart").on(
                {dblclick:function(){
                $("footer").hide();
                $("#list").hide("fast",function(){
                    $("").show("fast");
                })},
                click:function(){
                    $("#list").show();
                    $("footer").show();
                    $("").hide();
                }
                })

                $("#sell").on(
                    {dblclick:function(){
                    $("footer").hide();
                    $("#list").hide("fast",function(){
                        $("").show("fast");
                    })},
                    click:function(){
                        $("#list").show();
                        $("footer").show();
                        $("").hide();
                    }
                })
            })
        </script>
    </body>
</html>