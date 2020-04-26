<!DOCTYPE html>
<html>
    <head>
        <title>Seller:E-Mart</title>
    </head>

    <body>
        <div style="border:1px solid black; margin-left:280px;margin-top:25px; padding:50px; width:50%">
                <h2>For selling your products fill the form below:</h2>
                <br>
                <form name="form3" action="add_to_productlist.php"  method="POST" enctype="multipart/form-data">
                    <p>Product Name:</p>
                    <input type="text" name="pname" required>
                    <br>
                    <p>Product Image:</p>
                    <input type="file" name="pimg" id="pimg" >
                    <br>
                    <p>Product Category:</p>
                    <select name="pcat" value="default" required>
                            <option value="default">--Select Category--</option>
                            <option value="FY">FY</option>
                            <option value="SY">SY</option>
                            <option value="TY">TY</option>
                            <option value="BE">BE</option>
                    </select>
                    <br>
                    <p>Product Description:</p>
                    <textarea rows="5" cols="40" name="pdesc" required></textarea>
                    <br>
                    <p>Price To Sell At(in Rs.):</p>
                    <input type="number" name="pcost" required>
                    <br>
                    <p>Your Email For Contact:</p>
                    <input type="email" name="pmail" required>
                    <br><br>
                    <button type="submit" value="submit" id="post" name="post">POST</button><br><br>
                    <button type="button"><a href="home.php">BACK</a></button>
                </form>
                
                <script>
                    $(document).ready(function(){
                        $("#post").click(function(){
                        var img=$("#img").val();
                            if(img==""){
                                alert("plese select image")
                                return false;
                            }
                            else{
                                var extn=$("#img").val().split('.').pop().toLowerCase();
                                if(jQuery.inArray(extn,['png','jpg','jpeg'])==-1){
                                    alert("Invalid File!!");
                                    $("#img").val('');
                                    return false;
                                }
                            }
                        })
                    })
                </script>
        </div>
    </body>
</html>