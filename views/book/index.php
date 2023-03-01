<?php
include "../../models/book.php";
include "../../models/catigory.php";
require "../../models/authers.php";

include "../../head_index.php";

//left join table (book) on table (auther)
// $sql = "SELECT book.id_book,book.book_name,book.auther_id,book.description ,GROUP_CONCAT(category.category_name),authers.auth_name FROM book LEFT JOIN book_catigory ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id LEFT JOIN authers ON authers.auth_id = book.auther_id GROUP BY book_catigory.book_id";
// $result = mysqli_query($conn,$sql);
$obj_book = new Book();

$db_auth = new Authers();//for get data in model
$db_catigory = new Catigory();//for get data in model

 
// $sql2 = "SELECT book_catigory.book_id ,GROUP_CONCAT(category.category_name) 
// FROM book_catigory INNER JOIN book ON book.id_book = book_catigory.book_id 
// INNER JOIN category ON category.category_id = book_catigory.cati_id 
// GROUP BY book_catigory.book_id";

// $result2 = mysqli_query($conn,$sql2);
// $rr = mysqli_fetch_assoc($result2);


// "SELECT book_catigory.book_id ,GROUP_CONCAT(category.category_name) FROM book_catigory LEFT JOIN book ON book.id_book = book_catigory.book_id LEFT JOIN category ON category.category_id = book_catigory.cati_id GROUP BY book_catigory.book_id; "

//"SELECT * FROM `book` LEFT JOIN `authers` ON book.auther_id = authers.auth_id LEFT JOIN `book_catigory` ON book_catigory.book_id = book.id_book LEFT JOIN category ON category.category_id = book_catigory.cati_id; "
?>




<script>
    $(document).ready(function () {
        $('#table').DataTable({
            serverSide:true,
            processing: true,
            "paging":true,
            searching:false,
            order:[],
            ajax:{
               url: '../../models/book_2.php',
               type:"POST"
            },
            columnDefs:[{
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
            <h4>Books</h4>
            <a id="add_book" class="btn btn-primary float-end">Add Book</a>
        </div>

        <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Auther</th>
                <th scope="col">category</th>
                <th scope="col">Description</th>
                <th scope="col">Image Book</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody> 
        </table>
    </div>

<!-----------------------------Modal add cati && Modal  Update cati && Modal  Delete cati--------------------------->
<div class="modal fade" id="Modal_cati" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="myForm" method="POST" action="../../controllers/book_control.php">
                    <div class="modal-body">
                            <div class="form-group">
                                <label> Book Name </label><br>
                                <input type="text" class="form-control" minlength="4" required name="book_name" id="book_name"><br>
                            </div>
                            <div class="form-group">
                                <label> Auther Name </label>
                                <select class="form-select" name="select_auth"  id="select_auth" required aria-label="Floating label select example">
                                <option value="" selected>Select Auther</option>

                                    <?php
                                    foreach($db_auth->select() as $row){
                                    ?>

                                <option value="<?= $row['auth_id'] ?>"><?= $row['auth_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> Description</label>
                                <input type="text" class="form-control" minlength="3" required name="description" id="description">
                            </div>

                            <div class="form-group">
                                <label> Catigory </label>
                                <select class="form-select mt-3" multiple   name="select_cati[]" id="select_cati" aria-label="Floating label select example">
                                <option value="" selected>Select Catigory</option>
                                    <?php
                                        foreach($db_catigory->select() as $row){
                                    ?>
                                    <option value="<?= $row['category_id']?>"><?= $row['category_name']?></option>
                                
                                <?php 
                                }
                                ?>
                                </select>
                            </div>  
                            <div id="img-sec" class="d-flex align-items-center justify-content-between">
                                <input type="file"  name="img" id="img" class="btn btn-success mt-3" multiple>
                                <input type="hidden" name="old_img" id="old_img">
                            </div>
                                
                        

                        <!--Id for Delete-->
                        <input type="hidden" id="book_Id_Delete" name="delete_id_book" class="form-control">
                        <!--Id for Update-->
                        <input type="hidden" id="book_Id_update" name="update_id_book" class="form-control">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" id="close" class="btn btn-danger float-left" data-bs-dismiss="modal">Close</button>
                        
                        <!--Button for Update-->
                        <button type="submit" id="update_book_model" name="update" class="btn btn-success">Update</button>
                        <!--Button for Insert-->
                        <button type="submit" id="add_book_model" name="add_book" class="btn btn-success">Add Book</button>
                        <!--Button for Delete-->
                        <button type="submit" id="Delete_book_model" name="del" class="btn btn-danger">Delete Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------Modal add Auther && Modal  Update Auther && Modal  Delete Auther--------------------------->



<script>

$(document).ready(function (){
    $("#myForm").validate({
        rules : {
            "select_cati[]" :{
                required :true,
                minlength: 2
            }, 
        },
        messages: {
            "select_cati[]" : {
                minlength : "Please select at least 2 catigory"
            },
        },

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
                    $("#table").DataTable().ajax.reload();
                    $('#myForm')[0].reset();
                    // $("#table").load(location.href + " #table");//to load data in table without refresh table
                }
            };
            form.ajaxSubmit(option);
        },

    });
});



        $(document).ready(function(){
            $("#add_book").on('click',function(){
                $("#message").empty();
                $("#Modal_cati").modal("toggle");
                $("#update_book_model").hide();
                $("#Delete_book_model").hide();
                $("#add_book_model").show();
                $(".modal-body").show();

                

                //empty felids
                $("#book_name").val('');
                $("#select_auth").val('');
                $("#description").val('');

            });
            
            // $("#add_book_model").on('click' , function(){
            //     var dataform = new FormData();
            //     var img_book = $('#img')[0].files[0];
            //     var action = "add_book";

            //     var book_n = $("#book_name").val();
            //     var auth_n = $("#select_auth").val();
            //     var description = $("#description").val();
            //     var select_cati = $("#select_cati").val();//(array)
                

            //     dataform.append('book_name', book_n);
            //     dataform.append('select_auth', auth_n);
            //     dataform.append('description', description);

            //     for(let i = 0 ; i < select_cati.length;i++){
            //         dataform.append('select_cati[]', select_cati[i]);
            //     }
            //     console.log(select_cati);

            //     dataform.append('add_book', action);
            //     dataform.append('img', img_book);

            //     // //call number 1 (for image)
            //     $.ajax({
            //         url:"../../controllers/book_control.php",
            //         type: 'post',
            //         data:dataform,
            //         contentType:false,
            //         processData:false,
            //         success : function(data){
            //             $("#Modal_cati").modal("toggle");
            //             $("#message").append(data);
            //             $("#table").load(location.href + " #table");
            //         }
            //     });
            // });
/***********************************Update*********************************/
            $(document).on('click' , 'a[data-role=update_book]',function(){

                //removes all <img> elements with class="image" 
                $("img").remove(".image")

                $("#message").empty();
                $("#Modal_cati").modal("toggle");
                $("#update_book_model").show();
                $("#Delete_book_model").hide();
                $("#add_book_model").hide();
                $(".modal-body").show();

                

                var id = $(this).data('id');//id Book
                var action = "getData";


                //To Get Data
                $.ajax({
                    url:'../../models/book.php',
                    method:'POST',
                    data:{
                        getData:action,
                        book_id:id
                    },
                    success : function(data){
                        let info = JSON.parse(data);  

                        $("#book_name").val(info[0].book_name);
                        $("#select_auth").val(info[0].auther_id);
                        $("#description").val(info[0].description);
                        $("#book_Id_update").val(info[0].id_book);

                        //put the img [name] in input hidden to send it to controller
                        $("#old_img").attr("value",info[0].book_img);
                        $("#old_img").val(info[0].book_img);//put the current file in text input 
                        //get the curent updated img
                        $("#img-sec").append(`<img class ='image' style="width: 50px; height:50px" src=../../img/${info[0].book_img}>`);
                        $("#img").attr("value",info[0].book_img);
                        $("#Modal_cati").modal("toggle");
                    }
                });
            });

                // $("#update_book_model").on('click' , function(){

                //     let book_id = $("#book_Id_update").val();
                //     let book_n = $("#book_name").val();
                //     let auth_id =  $("#select_auth").val();
                //     let desc = $("#description").val();
                //     var img_book = $('#img')[0].files[0];
                //     var select_cati = $("#select_cati").val();//(array)
                //     var action = "update";

                //     var dataform = new FormData();

                //     dataform.append('book_id',book_id);
                //     dataform.append('book_name',book_n);
                //     dataform.append('auth_id',auth_id);//(auth_id) => $_POST['auth_id'] 
                //     dataform.append('description',desc);
                //     dataform.append('img',img_book);
                //     dataform.append('update',action);
                    

                    
                //     for(let i = 0 ; i < select_cati.length;i++){
                //         dataform.append('select_cati[]', select_cati[i]);
                //     }


                //     $.ajax({
                //         url:'../../controllers/book_control.php',
                //         method:'POST',
                //         data:dataform,
                //         contentType:false,
                //         processData:false,
                //         success : function(data){
                //         $("#Modal_cati").modal("toggle");
                //         $("#message").append(data);
                //         $("#table").load(location.href + " #table");
                //     }
                //     });
                // });
           
/***********************************Update*********************************/


/***********************************Delete*********************************/
                $(document).on('click','a[data-role=delete]',function(){
                $("#message").empty();
                $("#Modal_cati").modal("toggle");
                $("#update_book_model").hide();
                $("#Delete_book_model").show();
                $("#add_book_model").hide();
                $(".modal-body").hide();
                

                var id = $(this).data('id');//id Book
                // console.log(id);
                $("#book_Id_Delete").val(id);

                });

                // $("#Delete_book_model").on('click',function(){
                //     var del_id = $("#Delete_book_model").val();
                //     var action = "del";

                //     $.ajax({
                //         url:'../../controllers/book_control.php',
                //         method:'POST',
                //         data:{
                //             book_id:del_id,
                //             del:action
                //         },
                //         success : function(data){
                //             $("#Modal_cati").modal("toggle");
                //             $("#message").append(data);
                //             $("#table").load(location.href + " #table");
                //         },
                //     });
                // });
/***********************************Delete*********************************/

        });
</script>
<?php
include "../../footer.php";
?>