<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 

    session_start();

    if(!isset($_POST["oculto"])){
        header('location: index.php');
    }

    include('bd.php');

    function AlertEditCategory(){

        echo "<p><script>swal({
            title: 'SUCCESS!',
            text: 'Category edited!',
            icon: 'success',
            });
            setTimeout(function(){ location.href = 'categories.php' }, 2000);
            </script></p>";

    }

    $edit_name = $_POST["name-modal-edit-category"];
    $edit_description = $_POST["description-modal-edit-category"];
    $id = $_POST["id-category"];

    $sql_category_edit = 'UPDATE categories SET name_category=?, description_category=? WHERE id_category=?';
    $stm_category_edit = $con->prepare($sql_category_edit);
    $stm_category_edit->execute(array($edit_name,$edit_description,$id));
    $result_category_edit = $stm_category_edit->fetchAll();


    if($result_category_edit > 0){

       AlertEditCategory();

    }else{
        echo 'Error editing Category';
    }




?>