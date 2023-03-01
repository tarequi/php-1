<?php
include "../models/book.php";
include "../head_index.php";

$db = new Book();
?>


<div class="container mt-5">
    <div class="card-deck d-flex flex-wrap">
          <?php
          foreach($db->selectView() as $row):
          ?>
            <div class="card col-lg-4 col-md-6  border-info mb-3">
            <div class="card-body">
                <label>Book name</label>
                <h5 class="card-title"><?= $row['book_name']?></h5>
                <label>Book Description</label>
                <h6 class="card-text"><?= $row['description']?></h6>
                <label>Aurher Name</label>
                <h6 class="card-text"><?= $row['auth_name']?></h6>
            </div>
        </div> 
    <?php endforeach?>
</div>
</div>