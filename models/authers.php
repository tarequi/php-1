<?php

// use Authers as GlobalAuthers;

include_once "db.php";


class Authers extends Functions{
    public $table = "authers";

    
}
// echo "soso";

//for get info => update auther  (Update (index.php))
if(isset($_POST['get_auth']))
    {
        $_test = new Authers();
        $tareq=$_test->select('auth_id='.$_POST['auth_id']);
        echo json_encode($tareq);//(JSON) => (Array Of Object)
        exit();
    }




    
    // class Auth extends Functions{
    //     public $table = "authers";
    //     public $total;
    //     public $count_rows;
        
    
    //     public function getDataForDataTable(){
    //         $query='SELECT * FROM '.$this->table;
            
            
    //         //all record (before filtering)
    //         $total_query = mysqli_query($this->con,$query);
    //         $this->total = mysqli_num_rows($total_query);
    
    
    
    //         //Searching By User Name
    //         if(isset($_POST['search']['value'])){
    //             $search = $_POST['search']['value'];
    //             $query .= " WHERE auth_name LIKE '%".$search."%' ";
    //             $query .= " OR auth_email LIKE '%".$search."%' ";
    //         }
    
    
    //         //for Ordering
    //         if(isset($_POST['order'])){
    //             $column_name = $_POST['order'][0]['column'];
    //             $order = $_POST['order'][0]['dir'];
    //             $query .= " ORDER BY ".$column_name." ".$order." ";
    //         }
    //         else{
    //             $query .= " ORDER BY auth_id asc";
    //         }
    
    //         //Limit for number per page
    //         if(isset($_POST['length'])){
    //             $start = $_POST['start'];
    //             $length = $_POST['length'];
    //             $query .= " LIMIT ".$start.",".$length;
    //         }
    
           
    
    //         // record (after filtering)
    //         $result = mysqli_query($this->con,$query);
    //         $this->count_rows = mysqli_num_rows($result);
    //         $soso = [];
            
    //         if($result){
    //             if($this->total > 0){
                    
    //                 while($row = mysqli_fetch_assoc($result)){
    //                     $data = array();
    //                     $data[] = $row['auth_id'];
    //                     $data[] = $row['auth_name'];
    //                     $data[] = $row['auth_email'];
    //                     $data[] = ' 
    //                          <a class="btn btn-success" id="update" data-role="update" data-id="'.$row['auth_id'].'">Edit</a>&nbsp; 
    //                          <a class="btn btn-danger" id="del" data-role="delete" data-id="'.$row['auth_id'].'">Delete</a>
    //                              ';
    //                     $soso[] =$data;
    //                 }
    //                 // $curent_data[] = $data; 
    //             }
    //             return   $soso;
    //         }
    //         else{
    //             die("Error :".mysqli_errno($this->con));
    //         }
    //     }
    // }
    
    //     $obj = new Auth();
    
    //     // $tot = ;
    //     $data =  $obj->getDataForDataTable(); 
    
    //     $output = array(
    //         'draw' => intval($_POST['draw']),//draw => case sensitive
    //         'recordsFiltered' => $obj->total,//recordsFiltered => case sensitive
    //         'recordsTotal' => $obj->count_rows,//recordsTotal => case sensitive
    //         'data' =>  $data,//data => case sensitive
            
    //     );
        
    //     echo  json_encode($output);
    
    










// $table = 'authers';
 
// // Table's primary key
// $primaryKey = 'auth_id';




// $columns = array(
//     array( 'db' => 'auth_id', 'dt' => 0 ),
//     array( 'db' => 'auth_name',  'dt' => 1 ),
//     array( 'db' => 'auth_email',   'dt' => 2 ),
//     array( 
//         'db'        => 'auth_id', 
//         'dt'        => 3, 
//         'formatter' => function( $d ) { 
//             return ' 
//             <a class="btn btn-success" id="update" data-role="update" data-id="'.$d.'">Edit</a>&nbsp; 
//             <a class="btn btn-danger" id="del" data-role="delete" data-id="'.$d.'">Delete</a>
//             '; 
//         } 
//     )   
    
// );
 
// // SQL server connection information
// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'books',
//     'host' => 'localhost'
// );
 
 
// /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
//  * If you just want to use the basic configuration for DataTables with PHP
//  * server-side, there is no need to edit below this line.
//  */
 
// require( '../ssp.class.php' );
 
// echo json_encode(
//     SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
// );
    
?>