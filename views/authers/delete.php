<?php

$auth_id = $_GET['id'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .sec{
            position: relative;
            width: 100%;
            height: 100vh; 
        }
        .box{
            position: absolute;
            left: 50%;
            top:50%;
            transform: translate(-50%,-50%);
        }
    </style>
</head>
<body>
    <div class="sec">
        <div class="box col-md-6">
            <div class='alert alert-danger text-center mb-5' role='alert'>Are You Sure</div>
                <form method="POST" action="../../controllers/auther_control.php">
                <a href="index.php" class="btn btn-success">No</a>
                    <input type="hidden" name="auth_id" value="<?php echo $auth_id?>">
                    <input type="submit" name="del" class="btn btn-danger float-end" value="Yes">
                </form>
        </div>
    </div>

</body>
</html>