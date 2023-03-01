<?php
include "../models/authers.php";
include "../head_index.php";

$db = new Authers();

?>

 

    <div class="container">
        <div class="head pt-3 pb-3">
            <h4>Authers</h4>
            <a href="add_auth.php" class="btn btn-primary float-end">Add Auther</a>
        </div>

        <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

                foreach($db->select() as $row):

            ?>
            <tr>
                <th scope="row"><?php echo $row['auth_id']?></th>
                <th scope="row"><?php echo $row['auth_name']?></th>
                <th scope="row"><?php echo $row['auth_email']?></th>
            <th>
                    <a class="btn btn-success" href="edit.php?id=<?php echo $row['auth_id']?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['auth_id']?>">Delete</a>
            </th>

            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
        </table>
    </div>

</body>
</html>