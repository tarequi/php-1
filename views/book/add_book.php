<?php
// include "../../models/book.php";
include "../../models/authers.php";
// include "../../models/cati_book.php";
include "../../models/catigory.php";
include "../../header.php";

// $db_book = new Book();
$db_auth = new Authers();
$db_catigory = new Catigory();
// $db_book_cati = new Cati_Book();

// if(isset($_POST['add_book'])){
//     // $bookname = $_POST['book_name'];
//     $cati_name = $_POST['select_cati'];//get array of cati && inserted in table (book&catigory)

//     //data to inserted in book table
//     $insert_data = array(
//             'book_name' => trim($_POST['book_name']),
//             'auther_id' => $_POST['select_auth'],
//             'description' =>trim($_POST['description'])
//         );





//     if(!empty($_POST['book_name']) && !empty($_POST['select_auth']) && !empty($_POST['description'])){
//         //insert in table `book`
//         if($db_book->insert($insert_data)){

//             //(to get the curent id now created)
//             $id = mysqli_insert_id($db_book->con);

//             //insert id_book & id_catygory to table (book&catigory)
//             foreach($cati_name as $cati_list){
//                 $insert_cati = array(
//                     'book_id' => $id,
//                     'cati_id' => $cati_list
//                 );
//                 $db_book_cati->insert($insert_cati); 
//             }    
//             echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
//             header("Refresh:1; url=index.php");
//         }
//         else{
//         echo "<div class='alert alert-warning' role='alert'>Error</div>";
//         }
//     }
//     else{
//         echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";
//     }
// }


?>




<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../../controllers/book_control.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Book Name </label><br>
                        <input type="text" class="form-control" name="book_name"><br>
                    </div>
                    <div class="form-group">
                        <label> Auther Name </label>
                        <select class="form-select"  name="select_auth" aria-label="Floating label select example">
                        <option value="" selected>Select Auther</option>

                            <?php
                            foreach($db_auth->select() as $row){
                            ?>

                        <option value="<?= $row['auth_id'] ?>"><?= $row['auth_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label> Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>

                    <div class="form-group">
                        <label> Catigory </label>
                        <select class="form-select mt-3" multiple name="select_cati[]" aria-label="Floating label select example">
                        <option value="" selected>Select Catigory</option>
                            <?php
                                foreach($db_catigory->select() as $row){
                            ?>
                            <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                        
                        <?php 
                         }
                        ?>
                        </select>
                    </div>
                        <input type="file" name="img" class="btn btn-success mt-3">
                        <input type="submit" class="btn btn-primary mt-3 float-end" name="add_book" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>
</html>