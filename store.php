<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
    
  session_start();
  include("bd.php");

	if(!isset($_SESSION["Usuario"]) ){
		header('location: index.php');
	}elseif(!isset($_SESSION["type"])){
		header('location: store.php');
	}

  if(isset($_SESSION["Usuario"])){

    $sql_store = 'SELECT * FROM  products ';
    $stm_store = $con->prepare($sql_store);
    $stm_store->execute();
    $result_store = $stm_store->fetchAll();
  }else{
    die('No tiene permitido ver el contenido de esta pagina, GET OUT!');
  }

  //DESCARGA DEL STOCK
  if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(!empty($_POST["img"]) || !empty($_POST["description"]) || !empty($_POST["price"])){
      //$sql = 'SELECT stock FROM products WHERE id_product=$id_post';
      $img = $_POST["img"];
      $description = $_POST["description"];
      $price = $_POST["price"];
      $id = $_POST["id"];
      $id_user = $_SESSION["id"];
  
      $sql = 'INSERT INTO discharges (id_stock,id_user) VALUES (?,?)';
      $stm = $con->prepare($sql);
      $stm->execute(array($id,$id_user));
      $result = $stm->fetchAll();
  
      if($result > 0){
        echo "<p><script>swal({
          ztitle: 'SUCCESS!',
          text: 'PRODUCTO AÑADIDO A TUS DESCARGAS!',
          icon: 'success',
          });
          </script></p>";
      }else{
        echo "<p><script>swal({
          ztitle: 'ERROR!',
          text: 'NO SE PUDO AÑADIR EL PRODUCTO!',
          icon: 'error',
          });
          </script></p>";
      }
    }
  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
    <?php
        if(isset($_SESSION["lang"])){
            $lang = $_SESSION["lang"];
        } else {
        $lang = "en_US";
        }
        //$lang = "es_SV";
        $page_name = "store";
        include('translate.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" >
</head>
<body>

    <style type="text/css">

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');

        body{
            /* font-family: 'Poppins', sans-serif; */
        }

        .Log-out{
            font-size: 25px !important;
        }

        .Log-out i{
            color: black;
        }

        nav .container-fluid i{
            padding: 5px 10px;
            color: black;
        }

        .row{
            padding: 15px;
        }

        .row .card:hover{
           transform: translateY(-15px);
           box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
        }

    </style>

<nav class="navbar navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a style="font-size: 25px" class="navbar-brand" href="store.php"><i class="fas fa-box-open"></i>  Store Inventory </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
      <h5 style="font-size: 25px"><i class="fas fa-box-open"></i> Store Inventory</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a style="font-size: 20px" class="nav-link active" href="descarga.php"><i class="fas fa-truck-loading"></i> Discharges</a>
          </li>
          <li class="nav-item">
            <a style="font-size: 20px" class="nav-link active" aria-current="page" href="#"><i class="fas fa-user-alt"></i> Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a style="font-size: 20px" class="nav-link active dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i style="font-size: 20px" class="fas fa-globe"></i>Language
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
              <li><a style="font-size: 15px" class="dropdown-item" href="change_lang_store.php?language=es_SV">Spanish</a></li>
              <li><a style="font-size: 15px" class="dropdown-item" href="change_lang_store.php?language=en_US">English</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a style="font-size: 20px" class="nav-link active" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign out</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<br><br><br><br>


    <!--content page-->

    <div class="container text-center">
        <div class="alert alert-secondary" role="alert">
            <h3 id="lang-h1-store"><?php echo $page_strings["lang-h1-store"][$lang]; ?></h3>
        </div>

    </div>
    
    <div class="container">
    <div class="row">
   <?php foreach ($result_store as $data){?>
       
    <div class="col-sm-4 py-3">
            <form action="store.php" method="POST">
                <div class="card">
                    <img style="height:400px;" title="product"alt="Titulo" class="card-img-top" src="archivo/<?php echo $data["img_product"] ?>" />
                    <div class="card-body">
                        <h5 class="card-title"><b>$<?php echo $data["price_product"] ?></b></h5>
                        <hr>
                        <p class="card-text" style="padding: 5px;"><?php echo $data["descrip_prodcut"] ?></p>
                        <input type="hidden" name="img" value="archivo/<?php echo $data["img_product"] ?>">
                        <input type="hidden" name="description" value="<?php echo $data["descrip_prodcut"]?>">
                        <input type="hidden" name="price" value="<?php echo $data["price_product"] ?>">
                        <input type="hidden" name="id" value="<?php echo $data["id_prduct"] ?>">
                        <button type="submit" id="btn-product" class="btn btn-dark w-100"><i class="fas fa-truck-loading"></i></button>
                    </div>
                </div>
            </form>
    </div>
       
   <?php } ?>
   </div>
    </div>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/611bebf7d6e7610a49b0a2b7/1fdah3g8j';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
<!--End of Tawk.to Script-->



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>