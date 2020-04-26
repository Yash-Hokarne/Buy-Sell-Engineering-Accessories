<!DOCTYPE html>
<html>
    <?php
        //Include the database configuration file
        include 'dbConfig.php';

        //Fetch all the year data
        $query = $db->query("SELECT * FROM c_year ");

        //Count total number of rows
        $rowCount = $query->num_rows;
    ?>

    <head>
        <title>E-MART SIGN-UP Form</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            a{color:black;}
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body id="su_body">
        <header id="si_header">
        <h1 align="center"><a href="index.html" id="logo" title="Home Page">E-Mart</a></h1>
        <h2 align="center">(: An Online Destination for Engineering Essentials :)</h2>
        </header>
        <br><br><br><br>

        <script>
            
            function formCheck(){
                var correct_name = /^[A-Za-z]+$/;
                var valid;
                var name    = document.getElementById("fname").value;
                var surname = document.getElementById("lname").value;
                var mail    = document.getElementById("email").value;
                var dob     = document.getElementById("dob").value;
                var mob     = document.getElementById("mob").value;
                var addr    = document.getElementById("address").value;
                var pword   = document.getElementById("password").value;
                
                var at      = mail.indexOf("@");
                var dot     = mail.lastIndexOf(".");
                var year    = document.getElementById("year").value;
                var branch  = document.getElementById("branch").value;
                
                
                if (name==""){
                    document.getElementById("fname").placeholder="**Name Cannot be empty**";
                    name.focus;
                    valid = false;
                }else if(name.length<3 || name.length>20){
                    document.getElementById("fname").value = ""
                    document.getElementById("fname").placeholder="**Name between 3 to 20 characters**"
                    name.focus;
                    valid = false;
                }
                
                else if(name.match(correct_name))
                    true;
                
                else{
                    document.getElementById("fname").value="";
                    document.getElementById("fname").placeholder = "**Only Alphabets allowed**";
                    name.focus;
                    valid = false;
                }
                
                if (surname==""){
                    document.getElementById("lname").placeholder="**Surname Cannot be empty**";
                    surname.focus;
                    valid = false;
                }
                
                else if(surname.length<3 || surname.length>20){
                    document.getElementById("lname").value = ""
                    document.getElementById("lname").placeholder="**Surname between 3 to 20 characters**"
                    surname.focus;
                    valid = false;
                }
                
                else if(surname.match(correct_name))
                    true;
                
                else{
                    document.getElementById("lname").placeholder = "**Only Alphabets allowed";
                    surname.focus;
                    valid = false;
                }
                
                if (mail == ""){
                    document.getElementById("email").placeholder = "**Mail Cannot be Empty**";
                    valid = false;
                }
                
                else if (at<1 || dot>mail.length-2 ||dot - at <3){
                    document.getElementById("email").value = "";
                    document.getElementById("email").placeholder = "**Invalid Email**";
                    valid = false;
                }
                
                if(mob==""){
                    document.getElementById("mob").placeholder = "**Mobile Number cannot be empty**";
                    mob.focus;
                    valid = false;
                }
                
                else if (isNaN(mob)){
                    document.getElementById("mob").value = "";
                    document.getElementById("mob").placeholder = "** No alphabets allowed**";
                }
                
                else if(mob.charAt(0)!="9" && mob.charAt(0)!="8" && mob.charAt(0)!="7"){
                    document.getElementById("mob").value = "";
                    document.getElementById("mob").placeholder = " **Invalid Mobile Number**";
                    mob.focus;
                    valid = false;
                }
                
                else if (mob.length != "10"){
                    document.getElementById("mob").value = "";
                    document.getElementById("mob").placeholder = "** Mobile Number should be 10 digit**";
                    mob.focus;
                    valid = false;
                }
                
                if(year==""){
                    document.getElementById("year").placeholder = "**Year cannot be empty**";
                    year.focus;
                    alert("Choose Year");
                    valid = false;
                }
                else if(branch==""){
                    document.getElementById("branch").placeholder = "**Branch cannot be empty**";
                    branch.focus;
                    alert("Choose Branch");
                    valid = false;
                }
                
                if (addr == ""){
                    document.getElementById("address").placeholder = "**Address cannot be empty**";
                    valid = false;
                }
                
                if (pword==""){
                    document.getElementById("password").placeholder="**Password Cannot be empty**";
                    pword.focus;
                    valid = false;
                }
                
                else if(pword.length<6 || pword.length>30){
                    document.getElementById("password").value = ""
                    document.getElementById("password").placeholder="**Password between 6 to 30 characters**"
                    pword.focus;
                    valid = false;
                }
                return valid;
            }
        </script>
        
        <div id="su_div" style="margin-left:650px;">
            <p style="text-align: center;font-family: cursive;font-size: 20px;color: brown;"> SIGN UP FORM</p>
            <br>
            <form id="su_form"  action="upload.php" method="post"  onsubmit="return formCheck()" style="margin-left:80px;">
                <b class="su_form_field">First Name:</b><br>
                <input class="su_form_input" type="text" id="fname" name="fname" checked>
                <br><br>
                <b class="su_form_field">Last Name:</b>
                <br>
                <input type="text" id="lname" name="lname" class="su_form_input" checked>
                <br><br>
                <b class="su_form_field">Email ID:</b><br>
                <input type="email" class="su_form_input" name="email" id="email" checked><br>
                <br>
                <b class="su_form_field">Date of Birth:</b><br>
                <input class="su_form_input" type="date" id="dob" name="dob"   min="1840-12-31" max="2018-12-30">
                <br><br>
                <b class="su_form_field" type="number">Mobile Number:</b>
                <br>
                <input class="su_form_input" type="text" id="mob" name="mob">
                <br><br>
                <b class="su_form_field">Select Year and Branch:</b><br>
                <select id="year" class="su_form_input" name="year"  style="width:30%; margin:10px">
                    <option value="">Select Year</option>
                    <?php
                    if($rowCount > 0){
                        while($row = $query->fetch_assoc()){ 
                            echo '<option value="'.$row['id'].'">'.$row['yr_name'].'</option>';
                        }
                    }else{
                        echo '<option value="">Year not available</option>';
                    }
                    ?>
                </select>
                <select id="branch" class="su_form_input" name="branch"  style="width:30%; margin:10px">
                    <option value="" >Select year first</option>
                </select>
                <br><br>
                <b class="su_form_field">Address:</b>
                <br>
                <input class="su_form_input "  type="textarea" id="address" name="address"  row="5" col="20">
                <br><br>
                <b class="su_form_field">Password:</b><br>
                <input type="password" class="su_form_input" id="password" name="password">
                <br><br>
                <input class="su_form_button" type="submit"  id="submit"  value="REGISTER" >
                <input class="su_form_button" style="border-radius: 5px;font-size: 18px; margin:0px 30px;padding: 3px 15px" type="reset" id="RESET" value="RESET" >
                <button class="su_form_button" style="border-radius: 5px;font-size: 18px; margin:0px -5px; padding: 3px 10px;"><a href="signin.php">Back to Sign In</a></button>
            </form>
        </div>

        <!--for drop down list-->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#year').on('change',function(){
                    var yearID = $(this).val();
                    if(yearID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'id='+yearID,
                            success:function(html){
                                $('#branch').html(html); 
                            }
                        }); 
                    }else{
                        $('#branch').html('<option value="">Select year first</option>');
                    }
                });
                
                
            });
        </script>
    </body>
</html>
