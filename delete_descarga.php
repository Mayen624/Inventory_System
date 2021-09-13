<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 

include('bd.php');
session_start();

if (!isset($_SESSION['Usuario'])) {
    header('location: index.php');
}

$id_get = $_GET["id"];

$sql_delete = ("DELETE FROM discharges WHERE id_discharge = ?");
$stm_delete = $con->prepare($sql_delete);
$stm_delete->execute(array($id_get));

echo "<p><script>swal({
    title: 'SUCCESS!',
    text: 'The discharge has been deleted!',
    icon: 'success',
    });
    setTimeout(function(){ location.href = 'descarga.php' }, 2000);
    </script></p>";

?>
