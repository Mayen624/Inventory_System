<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 

    session_start();

    $message = '';

    if(!isset($_POST["oculto"])){
        header('location: index.php');
    }

    include('bd.php');

    $edit_name = $_POST["name-edit"];
    $edit_user = $_POST["user-edit"];
    $edit_password = $_POST["password-edit"];
    $edit_email = $_POST["email-edit"];
    $id_form = $_POST["id-user"];

    //Encrypt Password

    $edit_password = md5($edit_password);


    $sql_edit = 'UPDATE usuarios SET Nombre_usu=?, Usuario=?, Password_usu=?, Correo=? WHERE id_user=?';
    $stm_edit = $con->prepare($sql_edit);
    $result_edit = $stm_edit->execute(array($edit_name,$edit_user,$edit_password,$edit_email,$id_form));

    if($result_edit){

        echo "<p><script>swal({
        title: 'SUCCESS!',
        text: 'Edited user!',
        icon: 'success',
        });
        setTimeout(function(){ location.href = 'listauser.php' }, 2000);
        </script></p>";

    }else{
        echo 'Error editing user';
    }




?>