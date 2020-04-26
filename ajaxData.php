<?php
//Include the database configuration file
include 'dbConfig.php';

if(!empty($_POST["id"])){
    //Fetch all branch data
    $query = $db->query("SELECT * FROM c_branch WHERE year_id = ".$_POST['id']." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //branch option list
    if($rowCount > 0){
        echo '<option value="">Select Branch</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['bid'].'">'.$row['br_name'].'</option>';
        }
    }else{
        echo '<option value="">Branch not available</option>';
    }
}
?>