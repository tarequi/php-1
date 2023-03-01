<?php
include "../models/catigory.php";
include "../header.php";
$db = new Catigory();
if(isset($_POST['add_cati'])){
    

    //key of array is (column name in database)
    $insert_array = array(
        'category_name' => trim($_POST['cati_name'])
    );

    if(!empty($_POST['cati_name'])){

        if($db->insert($insert_array)){
            echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
            header("Refresh:1; url=index.php");
        } 
        else{
            echo "<div class='alert alert-warning' role='alert'>Error</div>";
    
        }
    }
    else{
        echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";

    }
}


?>




<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST">
                    <div class="form-group">
                        <label> Catigory Name </label><br>
                        <input type="text" class="form-control" name="cati_name"><br>
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="add_cati" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>
</html>