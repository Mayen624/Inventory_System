
<?php

    include("bd.php");



    $name_category = $_POST["category-name-modal"];
    $date_category = date('Y-m-d H:i:s');//$_POST["category-date-modal"];
    $description_category = $_POST["category-description-modal"];

    $sql_category = 'INSERT INTO categories (name_category,date_added,description_category) VALUES (?,?,?)';
    $stm_category = $con->prepare($sql_category);
    $stm_category->execute(array($name_category,$date_category,$description_category));
    $result_category = $stm_category->fetchAll();

    // echo "<p><script>swal({
    //     title: 'SUCCESS!',
    //     text: 'The category has been added!',
    //     icon: 'success',
    //     });
    //     setTimeout(function(){ location.href = 'categories.php' }, 2000);
    //     </script></p>";

    echo json_encode(array("result" => true));





?>