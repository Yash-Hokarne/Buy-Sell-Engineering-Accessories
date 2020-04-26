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
            session_start();
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

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Mart SignIn Form</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            a{color: black}
        </style>
    </head>
    
    <body id="si_body">
        <header id="si_header">
        <h1 align="center"><a href="index.html" id="logo" title="Home Page">E-Mart</a></h1>
        <h2 align="center">(: An Online Destination for Engineering Essentials :)</h2>
        </header>
        <br><br><br><br>
    
        <div id="si_div" style="margin-left:650px">
            <p title="SignIN Form" style="text-align: center;font-size: 35px;color:brown;font-family:cursive;"> <u>SignIn Form</u></p>
            <form id="si_form" name="form2" action="" method="POST"  >
                <br>
                <b class="si_form_field" >Username:</b>
                <br>
                <input class="si_form_input" type="text" name="un">
                <br><br>
                <b class="si_form_field">Password:</b>
                <br>
                <input class="si_form_input" type="password" name="ps">
                <br><br>
                <button class="si_button" name="signin" type="submit" value="submit" style="padding:10px 10px;margin:0px 20px;border-radius: 9px;">SIGN-IN</button>
                <button class="si_button" type="reset" style="padding:10px 10px;border-radius: 9px;margin-left:20px">RESET</button>
                <br><br><br><br><br>
                <p style="font-size: 20px;margin:0px 20px;">New User?? <a href="signup.php"><b>SIGN UP</b></a></p>
            </form>
            <a href="try.html" id="url" hidden></a>
        </div>
        <?php
        $un="SELECT * FROM info";
        $result=$conn->query($un);
        
        ?>
        <script>
            function login(){
                var u=document.form2.un.value;
                var p=document.form2.ps.value;
            
                if(u.length<4 || u.length>8 || p.length<4 || p.length>8){
                    alert("Invalid Info!!");
                    return false;
                }

                else{
                    
                    alert('Submitting form.....');
                    window.open("try.html");
                
                    return true;  
                }
                
            }
            function signup(){
                alert('reverting to Sign Up page...')
                window.open("signUp.html")
            }
    
        </script>
    </body>
</html>