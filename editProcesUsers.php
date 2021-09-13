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

        $id_btn = $_GET["id"];

        $sql_edit_proces = "SELECT * FROM usuarios WHERE id_user=? ";
        $edit_proces = $con->prepare($sql_edit_proces);
        $edit_proces->execute(array($id_btn));
        $result_edit_proces = $edit_proces->fetchAll();
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


	<!-- bootstrap & fontawesome -->
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
                <h2 class="card-header text-center">Edit user</h2>
                <div class="card-body">
                    <form id="modal-form-users" action="edit.php" method="POST">
                        <div class="form-group">
                            <div id="alert-modal-edit" style="background-color: #f8d7da; padding: 1rem 1rem;">
                                Empty spaces are not allowed
                            </div>
                            <br>
                            <label class="form-label">Name:</label>
                            <input type="text" id="name-modal-edit" class="form-control" name="name-edit" value="<?php echo $result_edit_proces[0]["Nombre_usu"]; ?>" >
                            <label class="form-label">User:</label>
                            <input type="text" id="user-modal-edit" class="form-control" name="user-edit" value="<?php echo $result_edit_proces[0]["Usuario"]; ?>" >
                            <label class="form-label">Password:</label>
                            <input type="password" id="password-modal-edit" class="form-control" name="password-edit" value="<?php echo $result_edit_proces[0]["Password_usu"]; ?>">
                            <label class="form-label">Email:</label>
                            <input type="text" id="email-modal-edit" class="form-control" name="email-edit" value="<?php echo $result_edit_proces[0]["Correo"];?>">
                            <input type="hidden" name="oculto" value="1">
                            <input type="hidden" name="id-user" value="<?php echo $result_edit_proces[0]["id_user"]; ?>">
                            <a class="btn btn-danger mt-3" href="listauser.php">Cancel</a>
                            <input type="submit" class="btn btn-success mt-3" value="Save changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include('includes/scripts.php'); ?>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="js/modal-validation.js"></script>
    <script>
        $(document).ready(function() {

            $("#alert-modal-edit").hide();

            $("#modal-form-users").on("submit",function(){
                if(modal_edit_empty()){
                    return true;
                }else{
                    $("#alert-modal-edit").show();
                    return false;
                }
            })
        });
    </script>
</body>
</html>