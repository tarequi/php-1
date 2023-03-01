<?php
include "../../header.php";

?>




<body>
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="../../controllers/auther_control.php">
                    <div class="form-group">
                        <label>Auther Name</label><br>
                        <input type="text" class="form-control" name="auth_name"><br>
                    </div>
                    <div class="form-group">
                        <label> Auther Email </label>
                        <input type="text" class="form-control" name="auth_Email">
                    </div>
                    <input type="submit" class="btn btn-primary mt-3 float-end" name="add_auth" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>
</html>