<?php
include "../models/catigory.php";

include "../head_index.php";

$db = new Catigory();


?>

    <div class="container">
        <div class="head pt-3 pb-3">
            <h4>Catigory</h4>
            <a href="add_cati.php" class="btn btn-primary float-end">Add Catigory</a>
        </div>

        <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($db->select() as $row):
            ?>
            <tr>
                <th scope="row"><?php echo $row['category_id']?></th>
                <th scope="row"><?php echo $row['category_name']?></th>
                <th scope="row">
                    <a class="btn btn-success" href="edit.php?id=<?= $row['category_id']?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $row['category_id']?>">Delete</a>
                </th>
            </tr>
            <?php
            endforeach
            ?>
        </tbody>
        </table>
    </div>

</body>
</html>