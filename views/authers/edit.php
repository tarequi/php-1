<?php
include "../../models/authers.php";
include "../../header.php";
$db = new Authers();

$auth_id = $_GET['id']; 



if(isset($_GET['id']) && is_numeric($_GET['id'])){
    //if there is data for this id
    if($db->find('auth_id='.$auth_id)){
        //get the data
        $row = $db->select('auth_id='.$auth_id);
        foreach ($row as $data);
    }
    else{
        header("location:index.php");
    }
}



?>

<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../../controllers/auther_control.php">
                    <div class="form-group">
                        <label> Auther Name </label><br>
                        <input type="text" class="form-control" name="auth_name" value="<?php echo $data['auth_name']?>"><br>
                    </div>
                    <div class="form-group">
                        <label> Auther Email </label>
                        <input type="text" class="form-control" name="auth_email" value="<?php echo $data['auth_email']?>">
                    </div>
                    <input type="hidden" name="auth_id" value="<?= $auth_id?>">
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="update" value="Update">
                </form>
            </div>
        </div> 
    </div>
</body>
</html>