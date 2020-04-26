<?php
   if(isset($_FILES['pimg'])){
      $errors= array();
      $file_name = $_FILES['pimg']['name'];
      $file_size = $_FILES['pimg']['size'];
      $file_tmp = $_FILES['pimg']['tmp_name'];
      $file_type = $_FILES['pimg']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['pimg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 5097152) {
         $errors[]='File size must be excately 5 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"E:\XAMPP\htdocs\project\final_battle\testing\images".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>