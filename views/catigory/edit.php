<?php
include "../../models/catigory.php";

include "../../header.php";

$id_cati = $_GET['id'];

$db = new Catigory();



if(isset($_GET['id']) &&  is_numeric($_GET['id'])){
    if($db->find('category_id='.$id_cati)){
        $row = $db->select('category_id='.$id_cati);
        foreach($row as $data);
    }
    else{
        header("location:index.php");
    }
}





// if(isset($_POST['update'])){
    
//     $updating_values = array(
//         'category_name' => $_POST['cati_name']
//     );

//     if($db->main_update($updating_values,'category_id='.$id_cati)){
//         echo "<div class='alert alert-success' role='alert'>Updated</div>";
//         header("Refresh:1; url=index.php");
//     }
//     else{
//         echo "<div class='alert alert-warning' role='alert'>Error</div>";
//     }
// }

?>


<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../../controllers/catigory_control.php">
                    <input type="hidden" name="cati_id" value="<?=$id_cati ?>">
                    <div class="form-group">
                        <label> Catigory Name </label><br>
                        <input type="text" class="form-control" name="cati_name" value="<?php echo $data['category_name']?>"><br>
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="update" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>
</html>