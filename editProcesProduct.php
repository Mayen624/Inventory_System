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

        $sql_edit_proces = "SELECT * FROM products WHERE id_prduct =? ";
        $edit_proces = $con->prepare($sql_edit_proces);
        $edit_proces->execute(array($get_id));
        $result_edit_proces_product = $edit_proces->fetchAll();
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
    <title>Edit - user</title>

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
                <h2 class="card-header text-center">Edit products</h2>
                <div class="card-body">
                    <form id="modal-form-products-edit" action="edit_product.php" method="POST">
                        <div class="form-group">
                            <div id="alert-modal-prducts-edit" style="background-color: #f8d7da; padding: 1rem 1rem;">
                                Empty spaces are not allowed
                            </div>
                            <br>
                            <label class="form-label">product:</label>
                            <input type="text" id="prduct-modal-edit" class="form-control" name="prduct-modal-edit" value="<?php echo $result_edit_proces_product[0]["name_product"]; ?>">
                            <label class="form-label">description:</label>
                            <input type="text" id="description-modal-edit" class="form-control" name="description-modal-edit" value="<?php echo $result_edit_proces_product[0]["descrip_prodcut"]; ?>">
                            <label class="form-label">Price:</label>
                            <input type="text" id="price-modal-edit" class="form-control" name="price-modal-edit" value="<?php echo $result_edit_proces_product[0]["price_product"]; ?>">
                            <label class="form-label">Category:</label>
                            <input type="text" id="category-modal-edit" class="form-control" name="category-modal-edit" value="<?php echo $result_edit_proces_product[0]["category"]; ?>">
							<label class="form-label">image:</label>
                            <input type="file" id="image-modal-edit" class="form-control" name="image-modal-edit">
                            <input type="hidden" name="oculto" value="1">
                            <input type="hidden" name="id-prduct" value="<?php echo $result_edit_proces_product[0]["id_prduct"]; ?>">
                            <a class="btn btn-danger mt-3" href="admin.php">Cancel</a>
                            <input type="submit" class="btn btn-success mt-3" value="Save changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        function modal_edit_prducts() {

        var product_edit = document.getElementById("prduct-modal-edit").value
        var price_edit = document.getElementById("description-modal-edit").value
        var description_edit = document.getElementById("price-modal-edit").value
        var category_edit = document.getElementById("category-modal-edit").value
        var image_edit = document.getElementById("image-modal-edit").value

        if (product_edit == "" || price_edit == "" || description_edit == "" || category_edit == "" || image_edit == "") {

            return false;

        }
        return true;
        }
    </script>
    <script>
        $(document).ready(function() {

            $("#alert-modal-prducts-edit").hide();

            $("#modal-form-products-edit").on("submit",function(){
                if(modal_edit_prducts()){
                    return true;
                }else{
                    $("#alert-modal-prducts-edit").show();
                    return false;
                }
            })
        });
    </script>
</body>
</html>