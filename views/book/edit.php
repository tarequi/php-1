<?php
include "../../models/book.php";
include "../../models/authers.php";
include "../../models/catigory.php";
// include "../../models/cati_book.php";
include "../../header.php";

$db_book = new Book();
$db_auth = new Authers();
$db_cati = new Catigory();
// $db_cati_book = new Cati_Book();

$id_book = $_GET['id'];


if(isset($_GET['id']) && is_numeric($_GET['id'])){
    if($db_book->find('id_book='.$id_book)){
        foreach($db_book->select('id_book='.$id_book) as $row);
        // echo  $row['book_img'];
    }
    else{
        header("location:index.php");
    }
}



// if(isset($_POST['update'])){
 
//     $sel_cati = $_POST['select_cati'];//for book_catigory table

//     $updating_value_in_book = array(
//         'book_name' => $_POST['book_name'],
//         'auther_id' => $_POST['auth_id'],
//         'description' => $_POST['description']
//     );


//     if(!empty($_POST['book_name']) && !empty($_POST['auth_id']) && $_POST['auth_id'] !="" && !empty($_POST['description'])){
//         if($db_book->main_update($updating_value_in_book,'id_book='.$id_book)){
//             echo "<div class='alert alert-success' role='alert'>Updated</div>";
//             header("Refresh:1; url=index.php");
//         }
//         else{
//             echo "<div class='alert alert-warning' role='alert'>Error</div>";
//         }
//     }
//     else{
//         echo "<div class='alert alert-warning' role='alert'>fill</div>";
//     }

//     //update in book_catigory table
//     $db_cati_book->delete('book_id='.$id_book);//delete all record before insert new record
//     foreach($sel_cati as $cati_list){
//         if(!empty($cati_list) && $cati_list != ""){

//         $arr_val = array(
//             'cati_id' => $cati_list,
//             'book_id' => $id_book
//         );
//         $db_cati_book->insert($arr_val);
//         }
//         else{
//             echo "<div class='alert alert-warning' role='alert'>fill select catigory</div>";
//         }
//     }
    




// }

?>


 
<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../../controllers/book_control.php" enctype="multipart/form-data">
                    <input type="hidden" name="book_id" value="<?= $id_book?>">
                    <div class="form-group">
                        <label> Book Name </label><br>
                        <input type="text" class="form-control" name="book_name" value="<?php echo $row['book_name']?>"><br>
                    </div>



                    <div class="form-group">
                        <label> Auther Name </label>
                        <select class="form-select mt-3" name="auth_id" aria-label="Floating label select example">
                            <option selected value="">Select</option>
                            <?php foreach($db_auth->select() as $row_auth):?>
                            <option value="<?php echo $row_auth['auth_id']?>"><?php echo $row_auth['auth_name']?></option>
                            <?php endforeach?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label> Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description']?>">
                    </div>



                    <div class="form-group">
                        <label> catigory</label>
                        <select class="form-select mt-3" multiple name="select_cati[]"aria-label="Floating label select example">
                            <option selected value="">Select</option>
                            <?php foreach($db_cati->select() as $row_cati):?>
                            <option value="<?php echo $row_cati['category_id']?>"><?php echo $row_cati['category_name']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <input type="file" name="img" class="btn btn-success mt-3" value="<?= $row['book_img']?>">
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="update" value="Update">
                </form>
            </div>
        </div>
    </div>
</body>
</html>