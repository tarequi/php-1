<?php

include "../models/authers.php";

$auth_db = new Authers(); 

        //add Auther
        if(isset($_POST['add_auth']))
        {
            $insert_data = array(
            'auth_name' => $_POST['auth_n'],
            'auth_email' => $_POST['auth_E'],
            );

            if(!empty($_POST['auth_n']) && !empty($_POST['auth_E']))
            {
                if($auth_db->validEmail($_POST['auth_E']))
                {
                    if($auth_db->insert($insert_data))
                    {
                        echo "<div class='alert alert-success' role='alert'>Inserted successfully</div>";
                        // header("Refresh:1; url=../views/authers/index.php");
                    }
                    else{
                    echo "<div class='alert alert-warning' role='alert'>Error</div>";
                    }
                }
                else{
                    echo "<div class='alert alert-danger' role='alert'>Invalid Email</div>";
                }
            }
            else{
                echo "<div class='alert alert-danger text-center' role='alert'>fill all inputs</div>";
        
            }
        }


        //Delete auther
        if(isset($_POST['del'])){
            $auth_id = $_POST['delete_auth_id'];
            if($auth_db->delete('auth_id='.$auth_id)){
                echo "<div class='alert alert-danger' role='alert'>Deleted successfully</div>";
                exit();
                // header("Refresh:1; url=../views/authers/index.php");
            }
        }



        //update auther

 
        if(isset($_POST['update'])){
            $auth_id = $_POST['update_auth_id'];

            $updating_values = array(
                'auth_name' => $_POST['auth_n'],
                'auth_email' => $_POST['auth_E']
            );

            if($auth_db->validEmail($_POST['auth_E'])){
                if($auth_db->main_update($updating_values,'auth_id='.$auth_id)){
                    echo "<div class='alert alert-success' role='alert'>Updated</div>";
                    // header("Refresh:1; url=../views/authers/index.php");
                    exit();
                }
                else{
                    echo "<div class='alert alert-warning' role='alert'>Error</div>";
                }
            }
            else
            {
                echo "<div class='alert alert-danger' role='alert'>Invalid Email</div>";
            }
        }



?>