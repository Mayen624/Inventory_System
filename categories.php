<?php 

	include("bd.php");
	session_start();

	if(!isset($_SESSION["Usuario"])){

        header('location: index.php');
    }elseif(isset($_SESSION["Usuario"])){

        $sql_categories = "SELECT * FROM  categories";
        $stm_categories = $con->prepare($sql_categories);
        $stm_categories->execute();
        $result_categories = $stm_categories->fetchAll(PDO::FETCH_ASSOC);
    }else{
        echo 'Error en el sistema';
        die();
    }


?>
<?php
	//$lang = 'en_US';
	$lang = 'es_SV';
	$page_name = "products";
	include('translate.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

	<link rel="stylesheet" href="css/categories.css">

	<!-- Sweet alert 2 -->
	<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

	<!-- Alertfy -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>

</head>
<body>
<body class="no-skin">
<div id="navbar" class="navbar" style="background-color: #212529 !important;">
		<div class="navbar-container" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			<?php
				if(isset($_SESSION["lang"])){
					$lang = $_SESSION["lang"];
				} else {
					$lang = "en_US";
				}
				$lang = 'es_SV';
				$page_name = "navbar";
				include('translate.php');	
			?>


			<!-- NAV-BAR -->
			<div class="navbar-header pull-left">
	<a href="admin.php" class="navbar-brand">
		<small id="lang-small-nav-bar">
			<i class="fas fa-box-open"></i>
			Inventory System
		</small>
	</a>
</div>

<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">

					<!--CONTENIDO DEL NAVBAR-->
					<li class="bg-dark dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-user-photo"  src="assets/images/avatars/translate.jpg" />
							<span class="user-info">
								<small id="lang-select"><?php echo $page_strings["lang-select"][$lang]; ?></small>
								<!-- Mostrar Nombre del Usuario Logueado-->
								
							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">


							<style type="text/css">
								.user-menu li #lang-spanish{
									
								}

								.user-menu li #lang-english{
									
								}
							</style>

							<li>
								<a id="lang-spanish" href="change_lang_categories.php?language=es_SV">
									<img src="assets/images/avatars/spanish.png" style="width:50px;height:40px;"><!-- ICONO -->
									<?php echo $page_strings["lang-spanish"][$lang]; ?>
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a id="lang-english" href="change_lang_categories.php?language=en_US">
									<img src="assets/images/avatars/english.png" style="width:50px;height:40px;"><!-- ICONO -->
									<?php echo $page_strings["lang-english"][$lang]; ?>
								</a>
							</li>
						</ul>
					</li>

					<li class="bg-dark dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" />
							<span class="user-info">
								<small id="lang-welcome"><?php echo $page_strings["lang-welcome"][$lang]; ?></small>
								<!-- Mostrar Nombre del Usuario Logueado-->
								<?php echo $_SESSION["Usuario"];?>
							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">


							<li>
								<a id="lang-profile" href="#">
									<i class="ace-icon fa fa-user"></i>
									<?php echo $page_strings["lang-profile"][$lang]; ?>
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a id="lang-logout" href="logout.php">
									<i class="ace-icon fa fa-power-off"></i>
									<?php echo $page_strings["lang-logout"][$lang]; ?>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>

    <!--barra de navegacion lateral - comienzo-->
	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
			</script>

			<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					<button class="btn btn-success">
						<i class="ace-icon fa fa-signal"></i>
					</button>

					<button class="btn btn-info">
						<i class="fas fa-pencil-alt"></i>
					</button>

					<button class="btn btn-warning">
						<i class="ace-icon fa fa-users"></i>
					</button>

					<button class="btn btn-danger">
						<i class="ace-icon fa fa-cogs"></i>
					</button>
				</div>

				<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
					<span class="btn btn-success"></span>

					<span class="btn btn-info"></span>

					<span class="btn btn-warning"></span>

					<span class="btn btn-danger"></span>
				</div>
			</div><!-- /.sidebar-shortcuts -->

			<ul class="nav nav-list">
				<!-- Menu Lateral -->
				<?php include('includes/menulateral.php'); ?>

				<?php
				if(isset($_SESSION["lang"])){
					$lang = $_SESSION["lang"];
				} else {
					$lang = "en_US";
				}
				//$lang = 'es_SV';
				$page_name = "cateogories";
				include('translate.php');	
				?>


				<!-- MOSTRAR EL MENU  -->

			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a id="lang-category-categories" href="categories.php"><?php echo $page_strings["lang-category-categories"][$lang]; ?></a>
						</li>
						
					</ul><!-- /.breadcrumb -->

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form>
					</div><!-- /.nav-search -->
				</div>

				<div class="page-content">
					<div class="ace-settings-container" id="ace-settings-container">
						<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
							<i class="ace-icon fa fa-cog bigger-130"></i>
						</div>

						<div class="ace-settings-box clearfix" id="ace-settings-box">
							<div class="pull-left width-50">
								<div class="ace-settings-item">
									<div class="pull-left">
										<select id="skin-colorpicker" class="hide">
											<option data-skin="no-skin" value="#438EB9">#438EB9</option>
											<option data-skin="skin-1" value="#222A2D">#222A2D</option>
											<option data-skin="skin-2" value="#C6487E">#C6487E</option>
											<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
										</select>
									</div>
									<span>&nbsp; Cambiar Color</span>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
									<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
									<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
									<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
									<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
									<label class="lbl" for="ace-settings-add-container">
										Inside
										<b>.container</b>
									</label>
								</div>
							</div><!-- /.pull-left -->

							<div class="pull-left width-50">
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
									<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
									<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
									<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
								</div>
							</div><!-- /.pull-left -->
						</div><!-- /.ace-settings-box -->
					</div><!-- /.ace-settings-container -->

					<div class="page-header">
						<h1 id="lang-sub-category-categories">
							<?php echo $page_strings["lang-sub-category-categories"][$lang]; ?>
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>

							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">

							<!-- PAGE CONTENT BEGINS -->
                            <!--background-color: #cfe2ff;-->

                               <h1 style="text-align:center;margin-bottom: 50px;">ALL CATEOGORIES IN THE INVENTORY</h1>

							   <div class="container">
							   		<div class="card">
										<div class="card-header">
											<h1 style="font-size: 15px;padding:0px 5px"><i class="fas fa-search"></i> Buscar categorias</h1>
											<a id="lang-btn-newusers" class="btn btn-success" data-toggle="modal" data-target="#modal-users"><i style="padding:0px 5px" class="fas fa-plus"></i> New category <?php //echo $page_strings["lang-btn-newusers"][$lang]; ?></a>
										</div>
										<div class="card-body">
											<table class="table table-striped table-bordered" style="margin-top:15px">
												<tr>
													<thead>
														<th id="lang-name" scope="col"><b>Nombre<?php //echo $page_strings["lang-code"][$lang]; ?></b></th>
														<th id="lang-description" scope="col"><b>Descripcion<?php //echo $page_strings["lang-item"][$lang]; ?></b></th>
														<th id="lang-added" scope="col"><b>Agregado<?php //echo $page_strings["lang-description"][$lang]; ?></b></th>
														<th id="lang-actions" scope="col"><b>Acciones<?php //echo $page_strings["lang-price"][$lang]; ?></b></th>
													</thead>
												</tr>
									
												<?php foreach($result_categories as $dato){ ?>

													<style type="text/css">
														tr td img{
															height: 65px;
															width: 65px
														}
													</style>

												<tr>
													<td><?php echo $dato["name_category"];?></td>
													<td><?php echo $dato["description_category"];?></td>
													<td><?php echo $dato["date_added"];?></td>
													<td>
														<a class="btn btn-warning" href="editProcesCategory.php?id=<?php echo $dato["id_category"];?>"><i class="fas fa-pencil-alt"></i></a>
														<a class="btn btn-danger" id_data_categories="<?php echo $dato["id_category"];?>" id="delete-category-<?php echo $dato["id_category"];?>"><i class="fas fa-trash-alt"></i></a>
													</td>
												</tr>
												<?php
												} 
												?> 
											</table>
										</div>
									</div>
							   </div>

                                <br>

                                <div class="container">
                                    
                                </div>

                                <!-- Inicio model - boostrap vs 0.3 -->

                                    <!-- Modal -->
                                <div class="modal fade" id="modal-users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Add new category</h4>
                                        </div>
                                        <div class="modal-body">
										<!-- action="add_categorie.php" -->
                                        <form  id="modal-form-category" method="POST">
                                            <div id="alert-modal-category" style="background-color: #f8d7da; padding: 1rem 1rem;">
                                                Empty spaces are not allowed
                                            </div>

                                            <div class="form-group">
                                                <br>
                                                <label class="form-label">Nombre:</label>
                                                <input type="text" id="category-name-modal" class="form-control" name="category-name-modal" maxlength="15" onkeypress="return soloLetras(event)">

												<label class="form-label">Description:</label>
                                                <textarea  id="category-description-modal" class="form-control" name="category-description-modal" maxlength="120" onkeypress="return soloLetras(event)" cols="20" rows="10"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                

							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
		<!-- /.Pie de pagina -->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

    <?php include('includes/scripts.php'); ?>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script type="text/javascript">
		function SoloNumeros(evt){
			// code is the decimal ASCII representation of the pressed key.
			var code = (evt.which) ? evt.which : evt.keyCode;

			if(code==8) { // backspace.
			return true;
			} else if(code>=48 && code<=57) { // is a number.
			return true;
			} else{ // other keys.
			return false;
			}
		}
	</script> 
	<script>
		function soloLetras(e) {
			var key = e.keyCode || e.which,
			tecla = String.fromCharCode(key).toLowerCase(),
			letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
			especiales = [8, 37, 39, 46],
			tecla_especial = false;

			for (var i in especiales) {
				if (key == especiales[i]) {
					tecla_especial = true;
					break;
				}
			}

			if (letras.indexOf(tecla) == -1 && !tecla_especial) {
				return false;
			}
		}
	</script>
	
	<script>
		function modal_category_empty() {

		var category_name = document.getElementById("category-name-modal").value;
		var description_category = document.getElementById("category-description-modal").value;

		if (category_name == "" || description_category == "") {

			return false;

		}
		return true;
		}
	</script>

	<script>

			function SuccessAlert(){
				alertify.success('The category has been added!');
			}

			function ErrorAlert(){
				alertify.error("The category could't be added");
			}

			function ErrorSystem(){
				alertify.error("Error in the system");
			}

			function SuccessElimination(){
				alertify.success("The category has been removed");
			}

			function ErrorElimination(){
				alertify.error("The category could't be removed");
			}
			
        $(document).ready(function() {

            $("#alert-modal-category").hide();

            $("#modal-form-cateogory").on("submit",function(){
                if(modal_category_empty()){
                    return true;
                }else{
                    $("#alert-modal-category").show();
                    return false;
                }
            })

			$("#modal-form-category").on("submit",function(){
                if(modal_category_empty()){
                	var datos=$('#modal-form-category').serialize();
					$.ajax({
						method: "POST",
						url: "add_categorie.php",
						dataType: "json",
						data: datos,
						success: function(response){
							
							if(response.result == true){
								SuccessAlert();
								setTimeout(function(){location.reload()}, 3000);
							}else{
								ErrorAlert();
							}
				
						},
						error: function(xhr){
							ErrorSystem();
						}
					})
                }else{
                    $("#alert-modal-category").show();
                    return false;
                }
				return false;
            })
        });


		$("[id^=delete-category-]").on("click", function(){
				var id = $(this).attr("id_data_categories");
				Swal.fire({
                title: 'Are you sure to delete this category?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "POST",
                        url: "delete_categories.php",
                        dataType: "json",
                        data: {id: id},
                        success: function(response){
                            
                            if(response.result == true){
                            	SuccessElimination();
								setTimeout(function(){location.reload()}, 2000);
                            }else{
                                ErrorElimination();
                            }
                
                        },
                        error: function(response){
                            ErrorSystem();
                        }
                    })
                }
              })
			});
    </script>
</body>
</html>