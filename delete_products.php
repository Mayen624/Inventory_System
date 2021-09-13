<?php 

    if (!isset($_POST['id'])) {
        exit();
    }

    include('bd.php');

    $id_get = $_POST["id"]; 

    $sql_delete = ("DELETE FROM products WHERE id_prduct = ?");
    $stm_delete = $con->prepare($sql_delete);
    $stm_delete->execute(array($id_get));

    echo json_encode(array("result" => true));




?>