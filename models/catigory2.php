<?php
include_once "db.php";



class Cati extends Db{
    public $table = "category";
    public $total; 
    public $count_rows;
    

    public function getDataForDataTable(){
		$query='SELECT * FROM '.$this->table;
		
        
        //all record (before filtering)
        $total_query = mysqli_query($this->con,$query);
        $this->total = mysqli_num_rows($total_query);



        //Searching By User Name
        if(isset($_POST['search']['value'])){
            $search = $_POST['search']['value'];
            $query .= " WHERE category_name LIKE '%".$search."%' ";
        }


        //for Ordering
        if(isset($_POST['order'])){
            $column_name = $_POST['order'][0]['column'];
            $order = $_POST['order'][0]['dir'];
            $query .= " ORDER BY ".$column_name." ".$order." ";
        }
        else{
            $query .= " ORDER BY category_id asc";
        }

        //Limit for number per page
        if(isset($_POST['length'])){
            $start = $_POST['start'];
            $length = $_POST['length'];
            $query .= " LIMIT ".$start.",".$length;
        }

       

        // record (after filtering)
        $result = mysqli_query($this->con,$query);
        $this->count_rows = mysqli_num_rows($result);
        $soso = [];
        
        if($result){
            if($this->count_rows > 0){
                
                while($row = mysqli_fetch_assoc($result)){
                    $data = array();
                    $data[] = $row['category_id'];
                    $data[] = $row['category_name'];
                    $data[] = ' 
                    <a class="btn btn-success" id="update_cati" data-role="update" data-id="'. $row["category_id"] .'">Edit</a>
                    <a class="btn btn-danger" id="delete_cati"  data-role="delete" data-id="'. $row['category_id'] .'">Delete</a>
                             ';
                    $soso[] =$data;
                }
            }
            return   $soso;
        }
        else{
            die("Error :".mysqli_errno($this->con));
        }
	}
}

    $obj = new Cati();

    // $tot = ;
    $data =  $obj->getDataForDataTable(); 

    $output = array(
        'draw' => intval($_POST['draw']),//draw => case sensitive
        'recordsFiltered' => $obj->total,//recordsFiltered => case sensitive
        'recordsTotal' => $obj->count_rows,//recordsTotal => case sensitive
        'data' =>  $data,//data => case sensitive
        
    );
    
    echo  json_encode($output);



