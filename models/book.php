
<?php

use Book as GlobalBook;

include_once "db.php";


class Book extends Functions{
    public $table = "book";

    //get values for index(book) 
    public function selectBook(){
        $sql = "SELECT book.book_img,book.id_book,book.book_name,book.auther_id,book.description ,GROUP_CONCAT(category.category_name),authers.auth_name FROM book LEFT JOIN book_catigory ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id LEFT JOIN authers ON authers.auth_id = book.auther_id GROUP BY book_catigory.book_id";
        $result = mysqli_query($this->con,$sql);
        $data = []; 
        if($result){ 
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }
            }
            return $data;
        }
        else{
            die("Error :".mysqli_errno($this->con));
        }
    }

    //view select
    public function selectView(){
        $sql = "SELECT book.book_img,book.book_name,book.description,authers.auth_name FROM book LEFT JOIN authers ON authers.auth_id = book.auther_id";
        $result = mysqli_query($this->con,$sql);
        $data = [];
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }
            }
            return $data;
        } 
        else{
            die("Error :".mysqli_errno($this->con));
        }
    }

    //select edit
    public function select_for_edit($id_book){
        $sql = "SELECT book.id_book,book.book_name,book.auther_id,book.description,authers.auth_name FROM book LEFT JOIN authers ON authers.auth_id = book.auther_id where `id_book` ='$id_book'";
        $result = mysqli_query($this->con,$sql);
        $data = [];
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }
            }
            return $data;
        }
        else{
            die("Error :".mysqli_errno($this->con));
        }
    }



}

//select for edit book in popup 
if(isset($_POST['getData'])){
    $getdata = new Book();
    $data = $getdata->select("id_book=".$_POST['book_id']);
    echo json_encode($data);
}
