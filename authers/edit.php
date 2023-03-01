<?php
include "../models/authers.php";
include "../header.php";
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





if(isset($_POST['update'])){

    $updating_values = array(
        'auth_name' => $_POST['auth_name'],
        'auth_email' => $_POST['auth_email']
    );

    if($db->main_update($updating_values,'auth_id='.$auth_id)){
        echo "<div class='alert alert-success' role='alert'>Updated</div>";
        header("Refresh:1; url=index.php");
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>Error</div>";
    }
}

?>

<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" >
                    <div class="form-group">
                        <label> Auther Name </label><br>
                        <input type="text" class="form-control" name="auth_name" value="<?php echo $data['auth_name']?>"><br>
                    </div>
                    <div class="form-group">
                        <label> Auther Email </label>
                        <input type="text" class="form-control" name="auth_email" value="<?php echo $data['auth_email']?>">
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="update" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>
</html>