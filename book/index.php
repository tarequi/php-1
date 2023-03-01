<?php
include "../models/book.php";
include "../head_index.php";

//left join table (book) on table (auther)
// $sql = "SELECT book.id_book,book.book_name,book.auther_id,book.description ,GROUP_CONCAT(category.category_name),authers.auth_name FROM book LEFT JOIN book_catigory ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id LEFT JOIN authers ON authers.auth_id = book.auther_id GROUP BY book_catigory.book_id";
// $result = mysqli_query($conn,$sql);
$obj_book = new Book();


// $sql2 = "SELECT book_catigory.book_id ,GROUP_CONCAT(category.category_name) 
// FROM book_catigory INNER JOIN book ON book.id_book = book_catigory.book_id 
// INNER JOIN category ON category.category_id = book_catigory.cati_id 
// GROUP BY book_catigory.book_id";

// $result2 = mysqli_query($conn,$sql2);
// $rr = mysqli_fetch_assoc($result2);


// "SELECT book_catigory.book_id ,GROUP_CONCAT(category.category_name) FROM book_catigory LEFT JOIN book ON book.id_book = book_catigory.book_id LEFT JOIN category ON category.category_id = book_catigory.cati_id GROUP BY book_catigory.book_id; "

//"SELECT * FROM `book` LEFT JOIN `authers` ON book.auther_id = authers.auth_id LEFT JOIN `book_catigory` ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id; "


?>






    <div class="container">
        <div class="head pt-3 pb-3">
            <h4>Books</h4>
            <a href="add_book.php" class="btn btn-primary float-end">Add Book</a>
        </div>

        <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Auther</th>
                <th scope="col">category</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($obj_book->selectBook() as $row)://for (book table)
            ?>
            <tr>
                <th scope="row"><?php echo $row['id_book']?></th>
                <th scope="row"><?php echo $row['book_name']?></th>
                <th scope="row"><?php echo $row['auth_name']?></th><!--auth_name from auther table-->
                <th scope="row"><?php echo $row['GROUP_CONCAT(category.category_name)']?></th>
                <th scope="row"><?php echo $row['description']?></th>
                <th scope="row">
                    <a class="btn btn-success" href="edit.php?id=<?php echo $row['id_book']?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id_book']?>">Delete</a>
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