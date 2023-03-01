<?php

class Db{
    
    public $server = "localhost";
    public $username = "root"; 
    public $password = "";
    public $dbname = "books";
    public $con;


        //connection to database
        public function __construct()
        {
            $this->con = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
            if(!$this->con){
                die("Error Connect :".mysqli_connect_errno());
            }
        }
    
}



class Functions extends Db{

    public function select($where=null,$order=null){
		$query='SELECT * FROM '.$this->table;
		if($where!=null){
			$query.=' WHERE '.$where;
		}
		if($order!=null){
			$query.=' ORDER BY ';
		}
        $result = mysqli_query($this->con,$query);
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



    public function insert($value){
        $string = "INSERT INTO ".$this->table." (";
        $string .= implode(",", array_keys($value)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($value)) . "')";
        if(mysqli_query($this->con, $string))//$result (later)
        {
            return true;
        }
        else
        {
            echo mysqli_error($this->con);
        }
	}


     //Delete function
     public function delete($where=null){
		if($where == null)
            {
                $delete = "DELETE ".$this->table;//refer to the object that crteated from this class
            }
            else
            {
                $delete = "DELETE  FROM ".$this->table." WHERE ".$where;
            }
			
                $result = mysqli_query($this->con,$delete);
			if($result){
				return true;
			}else{
				return false;
			}
	}


    //check if there is value of id selected (for update function) 
    public function find($where){
		$query='SELECT * FROM '.$this->table.' WHERE '.$where;
        $result = mysqli_query($this->con,$query);
        if($result){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                return $row;
            }
            else{
                return false;
            }
        }
        else{
            die("Error :".mysqli_errno($this->con));
        }
	}


    //(accept array)
    public function main_update($values,$where){
        // Parse the where values
           // even values (including 0) contain the where rows
           // odd values contain the clauses for the row
           

           $update = 'UPDATE '.$this->table.' SET ';
           $keys = array_keys($values);
           for($i = 0; $i < count($values); $i++)
           {
                if(is_string($values[$keys[$i]]))
                {
                   $update .= $keys[$i].'="'.$values[$keys[$i]].'"';
                }
               else
               {
                   $update .= $keys[$i].'='.$values[$keys[$i]];
               }


                // Parse to add commas
                if($i != count($values)-1)
                {
                    $update .= ',';
                }

           }
           $update .= ' WHERE '.$where;
           $result = mysqli_query($this->con,$update);
           if($result)
           {
               return true;
           }
           else
           {
               return false;
           }
       
        }

}







class Authers extends Functions{
    public $table = "authers";
}

class Catigory extends Functions{
    public $table = "category";
}

class Cati_Book extends Functions{
    public $table = "book_catigory";
}


class Book extends Functions{
    public $table = "book";

    //get values for index(book)
    public function selectBook(){
        $sql = "SELECT book.id_book,book.book_name,book.auther_id,book.description ,GROUP_CONCAT(category.category_name),authers.auth_name FROM book LEFT JOIN book_catigory ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id LEFT JOIN authers ON authers.auth_id = book.auther_id GROUP BY book_catigory.book_id";
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
        $sql = "SELECT book.book_name,book.description,authers.auth_name FROM book LEFT JOIN authers ON authers.auth_id = book.auther_id";
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














//Email validation
function validEmail($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
    




?>