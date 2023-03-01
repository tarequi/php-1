<?php
include "../models/catigory.php";
// include "../header.php";

$db_catigory = new Catigory();


//insert catigory
if(isset($_POST['add_cati'])){ 
    
   
    //key of array is (column name in database)
    $insert_array = array(
        'category_name' => trim($_POST['cati_name'])
    );

    if(!empty($_POST['cati_name'])){

        if($db_catigory->insert($insert_array)){
            echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
            // header("Refresh:1; url=../views/catigory/");
        } 
        else{
            echo "<div class='alert alert-warning' role='alert'>Error</div>";
    
        }
    }
    else{
        echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";

    }
}
 

//update catigory
if(isset($_POST['update'])){
    $id_cati = $_POST['cati_id_update'];
    $updating_values = array(
        'category_name' => $_POST['cati_name']
    );

    if($db_catigory->main_update($updating_values,'category_id='.$id_cati)){
        echo "<div class='alert alert-success' role='alert'>Updated</div>";
        // header("Refresh:1; url=../views/catigory/");
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>Error</div>";
    }
}

//Delete catigory
if(isset($_POST['del'])){
    if($db_catigory->delete('category_id='.$_POST['cati_id_delete'])){
        echo "<div class='alert alert-danger' role='alert'>Deleted successfully</div>";
        // header("Refresh:1; url=../views/catigory/");
    }
}


?>