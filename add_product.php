
<?php 


    include('bd.php');

    //var_dump($_FILES);

    if(isset($_FILES["image-modal"])){

        $product_img = $_FILES["image-modal"]["tmp_name"];
        $directorio = "archivo/";
        $nombre = basename($_FILES["image-modal"]["name"]);
        $subido = move_uploaded_file($product_img, $directorio.$nombre);

    }

     $product_name = $_POST["product-name-modal"];
     $description = $_POST["description-modal"];
     $price = $_POST["price-modal"];
     $stock = $_POST["stock-modal"];
     $category = $_POST["category-modal"];

     $sql_add = 'INSERT INTO products (name_product,descrip_prodcut,price_product,img_product,stock,category) VALUES (?,?,?,?,?,?)';
     $stm_add = $con->prepare($sql_add);
     $stm_add->execute(array($product_name,$description,$price,$nombre,$stock,$category));


    echo json_encode(array("result" => true));
     

