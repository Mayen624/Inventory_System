<?php 

    session_start();

    if (!isset($_GET['id'])) {
        session_destroy();
        header('Location: index.php');
        
    }

    //if (!isset($_SESSION['nombre'])) { 
    //  session_destroy();
    //   header('Location: index.php');
    if(isset($_SESSION)){

        include('bd.php');

        $get_id = $_GET["id"];

        $sql_edit_proces = "SELECT * FROM categories WHERE id_category =? ";
        $edit_proces = $con->prepare($sql_edit_proces);
        $edit_proces->execute(array($get_id));
        $result_edit_proces_category = $edit_proces->fetchAll();
    }else{
        echo('Error');
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - category</title>

    <meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--link rel="stylesheet" href="assets/css/bootstrap.min.css" />-->

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />


	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>
</head>
<body>

<div class="container" style="max-width: 650px; min-width: 400px; margin-top: 125px;">
            <div class="card">
                <h2 class="card-header text-center">Edit Category</h2>
                <div class="card-body">
                    <form id="modal-form-category-edit" action="edit_categories.php" method="POST">
                        <div class="form-group">
                            <div id="alert-modal-category-edit" style="background-color: #f8d7da; padding: 1rem 1rem;">
                                Empty spaces are not allowed
                            </div>
                            <br>
                            <label class="form-label">Name:</label>
                            <input type="text" id="name-modal-edit-category" class="form-control" name="name-modal-edit-category" value="<?php echo $result_edit_proces_category[0]["name_category"]; ?>">
                            <label class="form-label">description:</label>
                            <input type="text" id="description-modal-edit-category" class="form-control" name="description-modal-edit-category" value="<?php echo $result_edit_proces_category[0]["description_category"]; ?>">
                            <!-- <label class="form-label">Date added:</label>
                            <input type="text" id="price-modal-edit-category" class="form-control" name="price-modal-edit-category" value="<?php //echo $result_edit_proces_category[0]["date_added"]; ?>"> -->
                            <input type="hidden" name="oculto" value="1">
                            <input type="hidden" name="id-category" value="<?php echo $result_edit_proces_category[0]["id_category"]; ?>">
                            <a class="btn btn-danger mt-3" href="categories.php">Cancel</a>
                            <input type="submit" class="btn btn-success mt-3" value="Save changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        
    </script>
    <script>

        function modal_edit_category_empty() {

        var category_name = document.getElementById("name-modal-edit-category").value;
        var description_category = document.getElementById("description-modal-edit-category").value;

        if (category_name == "" || description_category == "") {

            return false;

        }
        return true;
        }

        $(document).ready(function() {

            $("#alert-modal-category-edit").hide();

            $("#modal-form-category-edit").on("submit",function(){
                if(modal_edit_category_empty()){
                    return true;
                }else{
                    $("#alert-modal-category-edit").show();
                    return false;
                }
            })
        });
    </script>
</body>
</html>