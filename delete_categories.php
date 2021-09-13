
<?php 

if (!isset($_POST['id'])) {
    exit('No tiene permiso para ver esta pagina');
}

include("bd.php");


$id = $_POST["id"];

$sql_delete_category = 'DELETE FROM categories WHERE id_category = ?';
$stm_delete = $con->prepare($sql_delete_category);
$stm_delete->execute(array($id));

echo json_encode(array("result" => true));

?>