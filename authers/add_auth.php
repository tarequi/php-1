<?php
include "../header.php";
// include "../models/authers.php";

// $db = new Authers();

// if(isset($_POST['add_auth'])){
    


//     //key of array is (column name in database)
//     $insert_data = array(
//         'auth_name' => $_POST['auth_name'],
//         'auth_email' => $_POST['auth_Email'],
//         );



//     if(!empty($_POST['auth_name']) && !empty($_POST['auth_Email'])){
//         if(validEmail($_POST['auth_Email'])){
//             if($db->insert($insert_data)){
//                 echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
//                 header("Refresh:1; url=index.php");
//             }
//             else{
//             echo "<div class='alert alert-warning' role='alert'>Error</div>";
//             }
//         }
//         else{
//             echo "<div class='alert alert-danger' role='alert'>Invalid Email</div>";
//         }
//     }
//     else{
//         echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";

//     }

//     }

?>




<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../controllers/auther_control.php">
                    <div class="form-group">
                        <label>Auther Name</label><br>
                        <input type="text" class="form-control" name="auth_name"><br>
                    </div>
                    <div class="form-group">
                        <label> Auther Email </label>
                        <input type="text" class="form-control" name="auth_Email">
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="add_auth" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>
</html>