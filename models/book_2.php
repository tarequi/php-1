<?php


include "db.php";

class Book extends Db{
    public $table = "book";
    public $total_rec;
    public $filter_rows;

    public function dataFor_DataTable(){
        $sql = "SELECT book.book_img,book.id_book,book.book_name,book.auther_id,book.description ,GROUP_CONCAT(category.category_name),authers.auth_name FROM book LEFT JOIN book_catigory ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id LEFT JOIN authers ON authers.auth_id = book.auther_id GROUP BY book_catigory.book_id";
        
        //all record (before filtering)
        $total_result = mysqli_query($this->con,$sql);
        $this->total_rec = mysqli_num_rows($total_result);

        //Searching
        // if(isset($_POST['search']['value'])){
            
        //     $search = $_POST['search']['value'];
        //     $sql .= " WHERE book_name LIKE '%".$search."%' ";
        // }
        // LIKE '%".$search."%' "
        $sql .=" ";


        //for Ordering
        if(isset($_POST['order'])){
            $column_name = $_POST['order'][0]['column'];
            $order = $_POST['order'][0]['dir'];
            $sql .= " ORDER BY ".$column_name." ".$order." ";
        }
        else{
            $sql .= " ORDER BY id_book asc";
        }

        //Limit for number per page
        if(isset($_POST['length'])){
            $start = $_POST['start'];
            $length = $_POST['length'];
            $sql .= " LIMIT ".$start.",".$length;
        }

        

        //record after filltering
        $filter_result = mysqli_query($this->con,$sql);
        $this->filter_rows = mysqli_num_rows($filter_result);

        $data = [];
        if($filter_result){
            if($this->filter_rows > 0){
                
                while($row = mysqli_fetch_assoc($filter_result)){
                    $data_row = array();
                    $data_row[] = $row['id_book'];
                    $data_row[] = $row['book_name'];
                    $data_row[] = $row['description'];
                    $data_row[] = $row['GROUP_CONCAT(category.category_name)'];
                    $data_row[] = $row['auth_name'];
                    $data_row[] = '<img src="../../img/'.$row['book_img'].'"  style="width: 40px; height:40px"></th>';
                    $data_row[] = ' 
                                <a class="btn btn-success" id="update_book" data-role="update_book" data-id="'.$row['id_book'].'" style="width: 80px;">Edit</a>
                                <a class="btn btn-danger" id="delete_book" data-role="delete" data-id="'.$row['id_book'].'" style="width: 80px;">Delete</a>
                                ';
                    $data[] =$data_row;
                }
                return $data;
            }
        }
        else{

        }
    }
}

$obj = new Book();

$data = $obj->dataFor_DataTable();

$output = array(
    'draw' => intval($_POST['draw']),//draw => case sensitive
    'recordsFiltered' => $obj->total_rec, //recordsFiltered => case sensitive
    'recordsTotal' => $obj->filter_rows, //recordsTotal => case sensitive
    'data' =>  $data,//data => case sensitive
    
);

echo  json_encode($output);
?>