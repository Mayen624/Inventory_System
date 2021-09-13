<?php
session_start();
include("bd.php");

//$messaje = '';

if(!isset($_SESSION["Usuario"]) ){
  header('location: index.php');
}elseif(!isset($_SESSION["type"])){
  header('location: store.php');
}else{

  $id_user = $_SESSION["id"];

  $sql = 'SELECT * FROM discharges d INNER JOIN products p ON d.id_stock = p.id_prduct WHERE d.id_user = ?';
  $stm_show = $con->prepare($sql);
  $stm_show->execute(array($id_user));
  $result_show = $stm_show->fetchAll();
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
<!-------------------------------------------------LENGUAJE----------------------------------------------------->
<?php
	if(isset($_SESSION["lang"])){
	$lang = $_SESSION["lang"];
	} else {
		$lang = "en_US";
	}
	//$lang = 'es_SV';
	$page_name = "descarga";
	include('translate.php');	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discharge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" >
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="css/descarga.css">
    <script src="js/jquery-3.6.0.min.js" ></script>
    
</head>
<body>
<!--NAVBAR-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="store.php"><i class="fas fa-box-open"></i>  Store Inventory </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" id="lang-myprofile"><?php echo $page_strings["lang-myprofile"][$lang]; ?></a>
        </li>
        <li class="nav-item dropdown">
          <a id="lang-change" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $page_strings["lang-change"][$lang]; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" id="lang-english" href="change_lang_descarga.php?language=en_US"><?php echo $page_strings["lang-english"][$lang]; ?></a></li>
            <li><a class="dropdown-item" id="lang-spanish" href="change_lang_descarga.php?language=es_SV"><?php echo $page_strings["lang-spanish"][$lang]; ?></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h1 id="lang-main-title" style="text-align:center;margin-top:30px;"><?php echo $page_strings["lang-main-title"][$lang]; ?></h1>

<div class="container">
  <div class="row">

      <?php foreach ($result_show as $data){?>
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="archivo/<?php echo $data["img_product"]?>" class="img-fluid rounded-start">
            </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title mt-3"><b>$<?php echo $data["price_product"]?></b></h5>
                    <p class="card-text"><b><?php echo $data["name_product"]?></b></p>
                </div>
                <form  method="POST">
                    <a href="delete_descarga.php?id=<?php echo $data["id_discharge"]?>"  class="btn btn-danger" style="margin-left:20px;"><i class="fas fa-trash-alt"></i></a>
                      <input type="hidden" name="id_to_delete" value="<?php echo $data["id_discharge"]?>">
                      <select id="select_cantidad_<?php echo $data["id_stock"]; ?>" data_value="<?php echo $data["id_stock"]; ?>" name="stock_select">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    <br>
                </form>
              </div>
          </div>
        </div>
      <?php } ?>
      <button id="lang-descharge" class="btn btn-dark"  ><?php echo $page_strings["lang-descharge"][$lang]; ?></button>
  </div>
</div>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>

  $( document ).ready(function() {

    $("#lang-descharge").on("click",function(){
            
    var datos= getProducts();
					$.ajax({
						method: "POST",
						url: "descarga_process.php",
						dataType: "json",
						data: {datos: datos},
						success: function(response){
							
							if(response.result == true){
								SuccesAlert();
								setTimeout(function(){location.reload()}, 3000);
							}else{
								ErrorDischarge();
							}
				
						},
						error: function(xhr){
							ErrorSystem();
						}
					})
				return false;
        });
    
});
    function getProducts(){
      var products = [];
      $("[id^=select_cantidad_]").each(function(){
        products.push({product:$(this).attr("data_value"), qtt: $(this).val()});
      
      });
      return products;
    }

    function SuccesAlert(){
			alertify.success('Successfully descharge !');
		}

		function DeleteAlert(){
			alertify.success('The user has been removed');
		}

		function ErrorDischarge(){
			alertify.error("The user could't be added");
		}

		function ErrorSystem(){
			alertify.error("Error deleting discharge");
		}


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>