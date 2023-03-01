<?php

use Catigory as GlobalCatigory;

include_once "db.php";


class Catigory extends Functions{
    public $table = "category";
}


if(isset($_POST['get_cati_data'])){
    $getdata = new Catigory();
    $data =  $getdata->select('category_id='.$_POST['cati_id']);
    echo json_encode($data);
}
?>