<?php

include("bd.php");
session_start();

$id_user = $_SESSION["id"];

$result_show = $_POST["datos"];

//$id_to_delete = $_POST["id_to_delete"]

foreach ($result_show as $data){
  $sql_stock = 'SELECT * FROM products WHERE id_prduct = ?';
  $stm_stock = $con->prepare($sql_stock);
  $stm_stock->execute(array($data["product"]));
  $result_stock = $stm_stock->fetchAll();

  foreach ( $result_stock as $stock){

    $cantidad = $stock["stock"] - $data["qtt"];

    $sql_update = "UPDATE products SET stock= $cantidad WHERE id_prduct = " . $data["product"];
    $stm_update = $con->prepare($sql_update);
    $stm_update->execute();
    $result_update = $stm_update->fetchAll();
    
    
  }
}

//HACER QUERY PA ELIMINAR LA DESCARGA DESPUES DEL PROCESO

  // $sql_delete = 'DELETE FROM discharges WHERE id_discharges = ? ';
  // $stm_delete = $con->prepare($sql_delete);
  // $stm_delete->execute(array($$id_to_delete));
  

  

echo json_encode(array("result" => true));

?>