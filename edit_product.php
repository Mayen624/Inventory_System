<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 

    session_start();

    if(!isset($_POST["oculto"])){
        header('location: index.php');
    }

    include('bd.php');

    function AlertEditProduct(){

        echo "<p><script>swal({
            title: 'SUCCESS!',
            text: 'Product edited!',
            icon: 'success',
            });
            setTimeout(function(){ location.href = 'admin.php' }, 2000);
            </script></p>";

    }

    $edit_product = $_POST["prduct-modal-edit"];
    $edit_description = $_POST["description-modal-edit"];
    $edit_price = $_POST["price-modal-edit"];
    $edit_category = $_POST["category-modal-edit"];
    $edit_image = $_POST["image-modal-edit"];
    $id_form_edit = $_POST["id-prduct"];

    $sql_product_edit = 'UPDATE products SET name_product=?, descrip_prodcut=?, price_product=?, img_product=?, category=? WHERE id_prduct=?';
    $stm_product_edit = $con->prepare($sql_product_edit);
    $result_product_edit = $stm_product_edit->execute(array($edit_product,$edit_description,$edit_price,$edit_image,$edit_category,$id_form_edit));

    if($result_product_edit){

       AlertEditProduct();

    }else{
        echo 'Error editing user';
    }




?>