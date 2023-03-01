<?php
// include "../../models/authers.php";
include "../../head_index.php";

// $db = new Authers();

?>
 <script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide:true,
            "paging":true,
            order:[],
            ajax:{
               url: '../../models/auth_2.php',
               type:"POST"
            },
            columnDefs:[{
                
                orderable:false,target : [0,3]
                
            }],
        //     columns: [
        //     { data: "auth_id" },
        //     { data: "auth_name" },
        //     { data: "auth_email" },
        //     { data: "body" }
        // ]
                
            
        });
    });
 </script>


 <div class="msg" id="message"></div>
 
    <div class="container">
        <div class="head pt-3 pb-3">
            <h4>Authers</h4>
            <button id="add_auther" class="btn btn-primary float-end">Add Auther</button>
        </div>

        <table class="table"  id="table" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php

                // foreach($db->select() as $row):

            ?>
           <tr>
           <!-- <th scope="row">
                    <a class="btn btn-success" id="update_cati" data-role="update" data-id="<?= $row['category_id'] ?>">Edit</a>
                    <a class="btn btn-danger" id="delete_cati"  data-role="delete" data-id="<?= $row['category_id'] ?>">Delete</a>
            </th> -->
           </tr>
            <?php
            // endforeach;
            ?>
        </tbody>
        </table>
    </div>



    <!-----------------------------Modal add Auther && Modal  Update Auther && Modal  Delete Auther--------------------------->
    <div class="modal fade" id="Modal_auth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Auther</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm" method="POST" action="../../controllers/auther_control.php">
                    <div class="modal-body">
                    
                            <div class="form-group">
                                <label for="auth_name">Auther Name</label>
                                <input type="text" name="auth_n" id="auth_name" required  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="auth_email">Auther Email</label>
                                <input type="email" name="auth_E" id="auth_email" required class="form-control">
                            </div>
                            <!-- <input type="submit" value="submit"> -->
                        
                        <!--Id for Delete-->
                        <input type="hidden" id="auth_Id_Delete" name="delete_auth_id" class="form-control">
                        <!--Id for Update-->
                        <input type="hidden" id="auth_Id_update" name="update_auth_id" class="form-control">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" id="close" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                        <!--Button for Update-->
                        <button type="submit" id="update_auth" name="update" class="btn btn-success">Update</button>
                        <!--Button for Insert-->
                        <button type="submit" id="add_auth" name="add_auth" class="btn btn-success">Add Auther</button>
                        <!--Button for Delete-->
                        <button type="submit" id="Delete_auth_model" name="del" class="btn btn-danger">Delete auther</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------Modal add Auther && Modal  Update Auther && Modal  Delete Auther--------------------------->


    



<script>
    
    $(document).ready(function(){
        
                jQuery.validator.addMethod(
                    "first_name", 
                    function(ele){
                        ele = $("#auth_name").val();
                        var arr =  ele.split(" ");
                        if(arr[0].length > 2){//if first name equal or less than 2 show the error
                            return true
                        }
                    }, "Your First Name Should Be At Least 3 Character"); 
                    
                    jQuery.validator.addMethod(
                    "last_name", 
                    function(element){
                        element = $("#auth_name").val();
                        var arr2 =  element.split(" ");
                        var last = arr2[arr2.length-1];
                        if(last !="undefined" && last.length > 4){
                            return true
                        }
    
                    }, "Your Last Name Should Be At Least 5 Character");
                    //function for white space
                    jQuery.validator.addMethod(
                    "white_space", 
                    function(e){
                        e = $("#auth_name").val();
                        let arr3 =  e.split("");
                        for(let i = 0;i<arr3.length;i++){
                            if(arr3[i] == " "){
                            return true
                            }
                        }
                    }, "Must Have White Space");
                //jQuery Validation & submitHandler
                $("#myForm").validate({
                    
                    rules:{
                        auth_n: {
                            required:true,
                            // minlength:4,
                            nowhitespace:false,
                            maxWords:2,
                            first_name :true,
                            last_name :true,
                            white_space:true
                        },
                        auth_E:{
                            required:true,
                            email:true
                        }
                    },
                    messages:{
                        auth_E:{
                            required:'please enter valid email',
                            maxWords: "soso"
                        },
                        auth_n:{
                            nowhitespace: 'Please No White Space'
                        }
                         
                    },
                    
                    submitHandler : function (form)
                    {
                        var form = $("#myForm");

                        var option = 
                        {
                            target : "#message",
                            success: function(data) {
                                $("#Modal_auth").modal("toggle");
                                $("#auth_name").val(""); //to empty the text after added
                                $("#auth_email").val(""); //to empty the text after added
                                // $("#message").append(data);//append response message from (auther_controler) to this page
                                // $("#table").load(location.href + " #table");//to load data in table without refresh table
                                $("#table").DataTable().ajax.reload();
                            }
                        };
                        form.ajaxSubmit(option);//Do Same Ajax Request
                        
                    },
                });
    });
    /*********************************add auther ******************************/
        $(document).ready(function() {
            $("#add_auther").on("click", function() {

                //jQuery Validation
                // $("#myForm").validate({
                // });

                $("#update_auth").hide();//hide update btn when you need to add
                $("#Delete_auth_model").hide();
                $("#add_auth").show();
                $(".modal-body").show();

                $("#message").empty();//when you click to update another auther the element (#message) should be empty
                $("#auth_name").val('');
                $("#auth_email").val('');
                $("#Modal_auth").modal("toggle");
            });


            /*************************Old Code**********************/
            // $("#add_auth").on('click', function() {
            //     var action = "add_auth";
            //     var auth_name = $("#auth_name").val();
            //     var auth_email = $("#auth_email").val();

            //     var form = $("#myForm");
               
            //     if(form.valid()){
            //         $.ajax({
            //         url: "../../controllers/auther_control.php",
            //         method: "POST",
            //         data: {
            //             add_auth : action,
            //             auth_n: auth_name,//$_POST['auth_n'] => received in "../../controllers/auther_control.php"
            //             auth_E: auth_email
            //         },
            //         success: function(data,res) {
            //             console.log(data);
            //             console.log(res);
            //             $("#Modal_auth").modal("toggle");
            //             $("#auth_name").val(""); //to empty the text after added
            //             $("#auth_email").val(""); //to empty the text after added
            //             $("#message").append(data);//append response message from (auther_controler) to this page
            //             $("#table").load(location.href + " #table");//to load data in table without refresh table
            //         }
            //     });
            //     }else{
            //         console.log("soso");
            //     }

               
            // });









            /*************New Ajax add call********************/
            // $("#add_auth").on('click', function() {
            // var options = {
            // target:  '#message',//element that show response from controller
            // // url:     '../../controllers/auther_control.php',
            //     success: function(data) {
            //         $("#Modal_auth").modal("toggle");
            //             $("#auth_name").val(""); //to empty the text after added
            //             $("#auth_email").val(""); //to empty the text after added
            //             // $("#message").append(data);//append response message from (auther_controler) to this page
            //             $("#table").load(location.href + " #table");//to load data in table without refresh table
            //     }
            // };

            // $("#myForm").ajaxForm(options);
            // });
        });
        /*********************************add auther ******************************/
    //to switch between button (add & update) you can use (another Method)
    /*
        $(document).ready(function(){
        $("#saveButton").click(function(){
        $("#saveButton").attr("disabled", true);
        $("#editButton").attr("enabled", true);
        });
        $("#editButton").click(function(){
        $("#editButton").attr("disabled", true);
        $("#saveButton").attr("enabled", true);
        });
        });
    */
    
    
     /*********************************update auther ******************************/
     $(document).ready(function() {
            $(document).on("click", 'a[data-role=update]', function() {

                // //jQuery Validation
                // $("#myForm").validate({
                // });


                $("#add_auth").hide();//hide Add btn when you need to update
                $("#Delete_auth_model").hide();
                $("#update_auth").show();
                $(".modal-body").show();
                $("#message").empty();//when you click to update another auther the element (#message) should be empty
                
                var id = $(this).data('id');
                console.log(id);
                var action = "get_auth" ;

                //Get date from (models/authers.php)
                //To Get Data for clicked auther
                $.ajax({
                    url: "../../models/authers.php",
                    method: "POST",
                    data: {
                        get_auth : action,
                        auth_id: id
                    },
                    success: function(data) {
                        var info = JSON.parse(data);//convert (JSON) TO JS Object
                        console.log(info);//array of object
                        // console.log(info[0].auth_id);
                        // console.log(info[0].auth_name);
                        // console.log(info[0].auth_email);

                        //to put the data in popup
                        $('#auth_name').val(info[0].auth_name);
                        $("#auth_email").val(info[0].auth_email);
                        $("#auth_Id_update").val(info[0].auth_id);
                    }
                });
                $("#Modal_auth").modal("toggle");
            });


            /************************Old Code*******************/
            // $("#update_auth").on('click', function() {
            //     var action = "update";
            //     var id = $("#auth_Id_update").val();
            //     var auth_na = $("#auth_name").val();
            //     var auth_em = $("#auth_email").val();
                
            //     // console.log(id);
            //     // console.log(auth_na);
            //     // console.log(auth_em);
            //     $.ajax({
            //         url: "../../controllers/auther_control.php",
            //         method: "POST",
            //         data: {
            //             update : action,
            //             auth_id: id,
            //             auth_n : auth_na,//$_POST['auth_n'] => received in "../../controllers/auther_control.php"
            //             auth_E : auth_em
            //         },
            //         success: function(data,respons) {
            //             // console.log(`data${data}`);//<div class='alert alert-success' role='alert'>Updated</div>
            //             // console.log(`res${respons}`);
            //             $("#table").load(location.href + " #table");//to load data in table without refresh table
            //             $("#message").append(data);//append response message from (auther_controler) to this page
            //             $("#Modal_auth").modal("toggle");
            //         }
            //     });
                
            // }); 
            
            /************************New Code*******************/
            // $("#update_auth").on('click', function() {
            //     var option = {
            //         target : "#message",
            //         success: function(data) {
            //         $("#Modal_auth").modal("toggle");
            //             $("#auth_name").val(""); //to empty the text after added
            //             $("#auth_email").val(""); //to empty the text after added
            //             // $("#message").append(data);//append response message from (auther_controler) to this page
            //             $("#table").load(location.href + " #table");//to load data in table without refresh table
            //     }
            //     };
            //     $("#myForm").ajaxForm(option);
            // });
        });
        /*********************************update auther ******************************/
        









         /*********************************Delete auther ******************************/
    
         $(document).ready(function() {
            $(document).on("click", 'a[data-role=delete]' , function() {
                $("#add_auth").hide();
                $("#update_auth").hide();
                $("#Delete_auth_model").show();
                $(".modal-body").hide();


                $("#message").empty();
                var id = $(this).data('id');//(get the id from delete btn) //$(this) => refare to a[data-role=delete]
             
                $("#auth_Id_Delete").val(id);//(put value in input hiddin)
                // console.log($("#auth_Id_Delete").val());

                $("#Modal_auth").modal("toggle");
            });

            // $("#Delete_auth_model").on('click', function() {
            //     var action = "del";
            //     var id_auth = $("#auth_Id_Delete").val();//declare another variable
            //     // console.log(id_auth);
          
            //     $.ajax({
            //         url: "../../controllers/auther_control.php",
            //         method: "POST",
            //         data: {
            //             del : action,
            //             auth_id: id_auth
            //         },
            //         success: function(data,respons) {
            //             // console.log(`data${data}`);//<div class='alert alert-success' role='alert'>Updated</div>
            //             // console.log(`res${respons}`);
            //             $("#table").load(location.href + " #table");//to load data in table without refresh table
            //             $("#message").append(data);//append response message from (auther_controler) to this page
            //             $("#Modal_auth").modal("toggle");
            //         }
            //     });
            // }); 
        });
    
        /*********************************Delete auther ******************************/
        
        // function getId(id){
            
        //         if(id != null){
        //             // $(document).ready(function() {
        //             //     // $("#update_auther").click(function() {
        //             //     // $("#message").empty();//when you click to update another auther the element (#message) should be empty
        //             //     // });
        //             //     $("#Modal_auth").modal("toggle");
        //             //     var auth_id = id;//get id
        //             //     var action = "get_auth" ;

        //             // //To Get Data for clicked auther
        //             //     $.ajax({
        //             //         url: "../../models/authers.php",
        //             //         method: "POST",
        //             //         data: {
        //             //             get_auth : action,
        //             //             auth_id: auth_id
        //             //         },
        //             //         success: function(data) {
        //             //             var info = JSON.parse(data);//convert (JSON) TO JS Object
        //             //             console.log(info);//array of object
        //             //             // console.log(info[0].auth_id);
        //             //             // console.log(info[0].auth_name);
        //             //             // console.log(info[0].auth_email);

        //             //             //to put the data in popup
        //             //             $('#auth_name').val(info[0].auth_name);
        //             //             $("#auth_email").val(info[0].auth_email);
        //             //             $("#auth_Id_update").val(info[0].auth_id);
        //             //         }
        //             //     });
                        

        //             //         $("#auth_model_operation").on('click', function() {
                               
        //             //         var action = "update";
        //             //         var id = $("#auth_Id_update").val();
        //             //         var auth_na = $("#auth_name").val();
        //             //         var auth_em = $("#auth_email").val();
                            
        //             //         // console.log(id);
        //             //         // console.log(auth_na);
        //             //         // console.log(auth_em);
        //             //         $.ajax({
        //             //             url: "../../controllers/auther_control.php",
        //             //             method: "POST",
        //             //             data: {
        //             //                 update : action,
        //             //                 auth_id: id,
        //             //                 auth_n : auth_na,//$_POST['auth_n'] => received in "../../controllers/auther_control.php"
        //             //                 auth_E : auth_em
        //             //             },
        //             //             success: function(data,respons) {
        //             //                 console.log(data);
        //             //                 // console.log(`data${data}`);//<div class='alert alert-success' role='alert'>Updated</div>
        //             //                 // console.log(`res${respons}`);
        //             //                 $("#Modal_auth").modal("toggle");
        //             //                 $("#message").append(data);//append response message from (auther_controler) to this page
                                   
        //             //                 $("#table").load(location.href + " #table");//to load data in table without refresh table
        //             //             }
        //             //         });
        //             //     });
                        
        //             // });
                    
        //         }
        //         else {
        //                 // $(document).ready(function () {
        //                 // $("#add_auther").on("click", function() {
        //                     $("#message").empty();//when you click to update another auther the element (#message) should be empty
        //                     $("#Modal_auth").modal("toggle");
        //                 // });

        //                 $("#auth_model_operation").click(function() {
        //                     var action = "add_auth";
        //                     var auth_name = $("#auth_name").val();
        //                     var auth_email = $("#auth_email").val();

                    
        //                     $.ajax({
        //                         url: "../../controllers/auther_control.php",
        //                         method: "POST",
        //                         data: {
        //                             add_auth : action,
        //                             auth_n: auth_name,//$_POST['auth_n'] => received in "../../controllers/auther_control.php"
        //                             auth_E: auth_email
        //                         },
        //                         success: function(data) {
        //                             console.log(data);
        //                             $("#Modal_auth").modal("toggle");
        //                             $("#auth_name").val(""); //to empty the text after added
        //                             $("#auth_email").val(""); //to empty the text after added
        //                             $("#message").append(data);//append response message from (auther_controler) to this page
        //                             $("#table").load(location.href + " #table");//to load data in table without refresh table
                                    
        //                         }
        //                     });
        //                 });
                        
        //             // });
                    
        //         }
                
        //     }
            

        //Mohammad Way
        // $.getJSON( "../../controllers/auther_control.php", function( data ) {
        // var items = [];
        // console.log(JSON.stringify(data));

        // $.each( data, function( key, val ) {
        //     console.log(data);
        // });
        
        // $( "<ul/>", {
        //     "class": "my-new-list",
        //     html: items.join( "" )
        // }).appendTo( "body" );
        // });
        
           
        </script>
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-valid0ation@1.19.5/dist/jquery.validate.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->


<?php
include "../../footer.php";
?>
<script src="../../js/additional-methods.js"></script> 