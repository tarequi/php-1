<?php
// include "../../models/catigory.php";

include "../../head_index.php";

// $db_catigory = new Catigory();

 
?>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            serverSide:true,
            processing: true,
            "paging":true,
            order:[],
            ajax:{
               url: '../../models/catigory2.php',
               type:"POST"
            },
            columnDefs:[{
                // soso:true,
                //  targets: [0, 1], visible: false,//hide column 0 & 1 in table
                orderable:false,//To control the ordering
                orderable: false, targets: [0,2] 
                // searchable: false
                // width    : "400px", targets: [1, 2],
            }],
        });
    });
 </script>
<div id="message"></div>
    <div class="container">
        <div class="head pt-3 pb-3">
            <h4>Catigory</h4>
            <button id="add_cati" class="btn btn-primary float-end">Add Catigory</button>
        </div>

        <table style="width: 100%;" class="table" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <!--DataTable Server Side-->
        </tbody>
        </table>




    <!-----------------------------Modal add cati && Modal  Update cati && Modal  Delete cati--------------------------->
    <div class="modal fade" id="Modal_cati" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Catigory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm" method="POST" action="../../controllers/catigory_control.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cati_name">Catigory Name</label>
                            <input type="text" name="cati_name" id="cati_name" required minlength="5" class="form-control">
                        </div>
                        
                        <!--Id for Delete-->
                        <input type="hidden" name="cati_id_delete" id="cati_Id_Delete" class="form-control">
                        <!--Id for Update-->
                        <input type="hidden" name="cati_id_update" id="cati_Id_update" class="form-control">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" id="close" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                        
                        <!--Button for Update-->
                        <button type="submit" id="update_cati_model" name="update" class="btn btn-success">Update</button>
                        <!--Button for Insert-->
                        <button type="submit" id="add_cati_model" name="add_cati" class="btn btn-success">Add catigory</button>
                        <!--Button for Delete-->
                        <button type="submit" id="Delete_cati_model" name="del" class="btn btn-danger">Delete catigory</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    <!-----------------------------Modal add Auther && Modal  Update Auther && Modal  Delete Auther--------------------------->
    </div>

    <script>
 $(document).ready(function (){
    $("#myForm").validate({
        submitHandler :function(form){
            form = $("#myForm");
            var option = 
            {
                target : "#message",
                success: function(data) 
                {
                    $("#Modal_cati").modal("toggle");
                    // $("#auth_name").val(""); //to empty the text after added
                    // $("#auth_email").val(""); //to empty the text after added
                    // $("#message").append(data);//append response message from (auther_controler) to this page
                    // $("#myForm")[0].reset();
                    $('#table').DataTable().ajax.reload();//refresh table (Datatable serverSide)
                    // $("#table").load(location.href + " #table");//to load data in table without refresh table
                }
            };
            form.ajaxSubmit(option);
        },
    });
 });




        $(document).ready(function (){
        /**************************add catigory******************/
            $("#add_cati").on('click',function(){
                $("#Modal_cati").modal("toggle");
                $("#update_cati_model").hide();
                $("#Delete_cati_model").hide();
                $("#add_cati_model").show();
                $("#cati_name").val('');
                $("#message").empty();
                $(".modal-body").show();
            });

            // $("#add_cati_model").on('click',function(){
            //     let cati_n = $("#cati_name").val();
            //     let action    = "add_cati"; 

            //     $.ajax({
            //         url:"../../controllers/catigory_control.php",
            //         method:"POST",
            //         data:{
            //             add_cati :action,
            //             cati_name :cati_n
                        
            //         },
            //         success : function(data){
            //             // console.log(data);
            //             $("#Modal_cati").modal("toggle");
            //             $("#message").append(data);
            //             // $("#table").load(location.href + " #table");
            //         }
            //     });
            // });
        /**************************add catigory******************/

        /**************************Update catigory******************/
            $(document).on('click' , 'a[data-role=update]',function(){
                let id = $(this).data('id');
                let action = "getData";

                $("#message").empty();
                $("#Modal_cati").modal("toggle");
                $("#Delete_cati_model").hide();
                $("#add_cati_model").hide();
                $("#update_cati_model").show();
                $(".modal-body").show();

                //now we have to get the data for this id from database
                $.ajax({
                    url:'../../models/catigory.php',
                    method: 'POST',
                    data:{
                        cati_id : id,
                        get_cati_data:action
                    },
                    success : function(data){
                        let info = JSON.parse(data);//array of object
                        $("#cati_name").val(info[0].category_name);
                        $("#cati_Id_update").val(info[0].category_id);
                    }
                });
            });

                // $("#update_cati_model").on('click',function(){
                //     let action = "update";
                //     let cati_n = $("#cati_name").val();
                //     let id     = $("#cati_Id_update").val();
                    
                //     $.ajax({
                //         url:'../../controllers/catigory_control.php',
                //         method:'POST',
                //         data:{
                //             update   :action,
                //             cati_id  : id,
                //             cati_name:cati_n
                //         },
                //         success : function(data){
                //             console.log(data);
                //             $("#message").append(data);
                //             $("#Modal_cati").modal("toggle");
                //             $("#table").load(location.href + " #table");
                //         }
                //     });
                // });
            
        /**************************Update catigory******************/

        
        /**************************Delete catigory******************/
            $(document).on("click" , 'a[data-role=delete]',function(){
               
                $("#Modal_cati").modal("toggle");
                $("#Delete_cati_model").show();
                $("#add_cati_model").hide();
                $("#update_cati_model").hide();
                $(".modal-body").hide();
                $("#message").empty();

                var id = $(this).data('id');
                $("#cati_Id_Delete").val(id);
                // console.log(id);

                });

                // $("#Delete_cati_model").on('click',function(){
                //     var action = "del";
                //     var id = $("#cati_Id_Delete").val();
                    
                //     $.ajax({
                //         url:'../../controllers/catigory_control.php',
                //         method: 'POST',
                //         data:{
                //             del : action,
                //             cati_id : id
                //         },
                //         success : function(data,res){
                //             // console.log(`The Data ==> ${data}`);
                //             // console.log(`The res ==> ${res}`);
                //             $("#table").load(location.href + " #table");

                //             $("#message").append(data);
                //             $("#Modal_cati").modal("toggle");
                //         }
                //     });
                // });
            
            /**************************Delete catigory******************/
        });
    </script>
<?php
include "../../footer.php";
?>