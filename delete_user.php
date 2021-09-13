<?php 

    if (!isset($_POST['id'])) {
        exit('No tiene permiso para ver esta pagina');
    }

    include('bd.php');

    $id_get = $_POST["id"]; 

    $sql_delete = ("DELETE FROM usuarios WHERE id_user = ?");
    $stm_delete = $con->prepare($sql_delete);
    $stm_delete->execute(array($id_get));

    echo json_encode(array("result" => true));



?>