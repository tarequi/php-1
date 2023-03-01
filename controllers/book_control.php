<?php
include "../models/book.php";
include "../models/authers.php";
include "../models/cati_book.php";
include "../models/catigory.php";
include "../header.php";


$db_book = new Book();
$db_auth = new Authers();
$db_catigory = new Catigory();
$db_book_cati = new Cati_Book();


// function check_img($image){
//     $image = $_FILES['img'];//array
    
//     $img_name = $_FILES["img"]['name'];
//     $img_type = $_FILES["img"]['type'];
//     $img_tmpName = $_FILES['img']['tmp_name'];
//     $img_Error = $_FILES["img"]['error'];
//     $img_size = $_FILES["img"]["size"];

//     $img_Ext = explode('.',$img_name);
//     $img_ActualExt = strtolower(end($img_Ext));


//     $allowed_Ext = array('jpg','jpeg','png','pdf');

//     //conditions for images
//     if(in_array($img_ActualExt,$allowed_Ext))
//     {
//         if($img_Error === 0)
//         {
//             if($img_size < 1000000)
//             {
//                 $img_destination = '../img/'.$img_name;
//                 move_uploaded_file($img_tmpName,$img_destination);
//                 // echo "uploded";
//                 return $img_name;
//             }
//             else{
//                 echo "<div class='alert alert-danger text-center' role='alert'>your file is too big!!</div>";
//             }
//         }
//         else{
//             echo "<div class='alert alert-danger text-center' role='alert'>There was an error uploding your file</div>";
//         }
//     }
//     else{
//         echo "<div class='alert alert-danger text-center' role='alert'>Invalid Type Img</div>";
//     }

// }



//insert book & book_catigori table
if(isset($_POST['add_book'])){
    $cati_name = $_POST['select_cati'];//get array of cati && inserted in table (book&catigory)
    // print_r($cati_name);



    $img = $_FILES['img'];//array
    // print_r($img);
    $img_name = $_FILES["img"]['name'];
    // echo "here it is ". $img_name."<br>";
    $img_type = $_FILES["img"]['type'];
    // echo "type ". $img_type."<br>";
    $img_tmpName = $_FILES['img']['tmp_name'];
    // echo "tmpName ". $img_tmpName."<br>";
    $img_Error = $_FILES["img"]['error'];
    // echo "Error ". $img_Error."<br>";
    $img_size = $_FILES["img"]["size"];
    // echo "size ". $img_size."<br>";

    $img_Ext = explode('.',$img_name);
    $img_ActualExt = strtolower(end($img_Ext));


    $allowed_Ext = array('jpg','jpeg','png');




    //data to inserted in book table
    $insert_data = array(
            'book_name' => trim($_POST['book_name']),
            'auther_id' => $_POST['select_auth'],
            'description' =>trim($_POST['description']),
            'book_img' => $img_name//image book
        );




    //insert in database
    if(!empty($_POST['book_name']) && !empty($_POST['select_auth']) && !empty($_POST['description'])){
        //conditions for images
        if(in_array($img_ActualExt,$allowed_Ext))
        {
            if($img_Error === 0)
            {
                if($img_size < 1000000)
                {
                    $img_destination = '../img/'.$img_name;
                    move_uploaded_file($img_tmpName,$img_destination);

                    //insert in table `book`
                    if($db_book->insert($insert_data)){

                        //(to get the curent id now created)
                        $id = mysqli_insert_id($db_book->con);

                        //insert id_book & id_catygory to table (book&catigory)
                        foreach($cati_name as $cati_list){
                            $insert_cati = array(
                                'book_id' => $id,//curent id now created
                                'cati_id' => $cati_list
                            );
                            $db_book_cati->insert($insert_cati); 
                        }    
                        echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
                        header("Refresh:1; url=../views/book/");
                    }
                    else{
                    echo "<div class='alert alert-warning' role='alert'>Error</div>";
                    }
                }
                else{
                    echo "<div class='alert alert-danger text-center' role='alert'>your file is too big!!</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger text-center' role='alert'>There was an error uploding your file</div>";
            }
        }
        else{
            echo "<div class='alert alert-danger text-center' role='alert'>Invalid Type Img</div>";
        }

    }
    else{
        echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";
    }
}





//update book & delete from (book_catigory) then insert
if(isset($_POST['update'])){
    $id_book = $_POST['update_id_book'];
    $sel_cati = $_POST['select_cati'];//for book_catigory table

    
   


    //check if the user choose a new img or not
    //if (not) the current img will be not change

    $old_img = $_POST['old_img'];//old image
    if(isset($_FILES["img"]['name'])){
        $current_img = $_FILES["img"]['name'];
        // $img_Ext = explode('.',$img_name);
        // $img_ActualExt = strtolower(end($img_Ext));
        // $allowed_Ext = array('jpg','jpeg','png','pdf');
    }
    else{
        $current_img = $old_img;
    }
    
    
    

    $updating_value_in_book = array(
        'book_name' => $_POST['book_name'],
        'auther_id' => $_POST['select_auth'],
        'description' => $_POST['description'],
        'book_img' => $current_img
    );


    // echo $new_img."<br>";
    // echo $id_book."<br>";
    // print_r($sel_cati)."<br>";
    // echo $_POST['book_name']."<br>";
    // echo $_POST['auth_id']."<br>";
    // echo $_POST['description']."<br>";

    if(!empty($_POST['book_name']) && !empty($_POST['select_auth']) && $_POST['select_auth'] !="" && !empty($_POST['description'])){
        if($db_book->main_update($updating_value_in_book,'id_book='.$id_book)){
            echo "<div class='alert alert-success' role='alert'>Updated</div>";
            header("Refresh:1; url=../views/book/");
        }
        else{
            echo "<div class='alert alert-warning' role='alert'>Error</div>";
        }
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>fill</div>";
    }
// }
// else{
//     echo "<div class='alert alert-warning' role='alert'>Chose Image</div>";
// }




    //update in book_catigory table
    $db_book_cati->delete('book_id='.$id_book);//delete all record before insert new record
    foreach($sel_cati as $cati_list){
        if(!empty($cati_list) && $cati_list != ""){

        $arr_val = array(
            'cati_id' => $cati_list,
            'book_id' => $id_book
        );
        $db_book_cati->insert($arr_val);
        }
        else{
            echo "<div class='alert alert-warning' role='alert'>fill select catigory</div>";
        }
    }



}

 


//Deleted book

if(isset($_POST['del'])){
    $id_book = $_POST['delete_id_book'];
    if($db_book->delete('id_book='.$id_book)){
        echo "<div class='alert alert-danger' role='alert'>Deleted successfully</div>";
        header("Refresh:1; url=../views/book/");
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>Error</div>";
    }
}


?> 