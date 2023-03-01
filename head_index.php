<?php 
//(to control the URL)
define("BURL" , "http://localhost/testcomp/");
define("BURL_AUTHER" , "http://localhost/testcomp/views/authers/");
define("BURL_BOOK" , "http://localhost/testcomp/views/book/");
define("BURL_CATI" , "http://localhost/testcomp/views/catigory/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--jQuery Ajax CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--Css Datatable -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" >
    
    <!--Bootstrap js for box Model-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    
     <!-- jQuery data table
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   
   
   
   
    <!-- jQuery data table
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --> 
    <title>Document</title>
    <style>
        .head{
            align-items: center;
            display: flex;
            justify-content: space-between;
        }
        /*for jQuery Validation */
        .error {
        color:red;
        }
        .valid {
            color:green;
        }

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BURL_BOOK?>">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BURL_AUTHER?>">Authers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BURL_CATI?>">category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BURL_BOOK;?>view.php">View Book</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


