<?php 

    include('bd.php');
    session_start();

    if(!isset($_SESSION["Usuario"])){

        header('location: index.php');
    }elseif(isset($_SESSION["Usuario"])){

        $sql_user_list = "SELECT * FROM usuarios";
        $stm_user_list = $con->prepare($sql_user_list);
        $stm_user_list->execute();
        $result_user_list = $stm_user_list->fetchAll(PDO::FETCH_ASSOC);
    }else{
        echo 'Error en el sistema';
        die();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <title>Lista de Usuarios</title>

    <meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	
	<!-- Sweet alert 2 -->
	<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

	<!-- Alertfy -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />


	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>

</head>
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
				//$lang = 'es_SV';
				$page_name = "navbar";
				include('translate.php');
			?>

			<?php include('includes/navbar.php'); ?>

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
				<?php  include('includes/menulateral.php'); ?>

				<?php
						if(isset($_SESSION["lang"])){
							$lang = $_SESSION["lang"];
						} else {
						$lang = "en_US";
						}
						//$lang = 'es_SV';
						$page_name = "users";
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
							<a id="lang-first-category" href="listauser.php"><?php echo $page_strings["lang-first-category"][$lang]; ?></a>
						</li>
						
					</ul><!-- /.breadcrumb -->

					<div class="nav-search" id="nav-search">
						<!--BUSCADOR-->
						<!-- <form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form> -->
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
						<h1 id="lang-category-users">
							<?php echo $page_strings["lang-category-users"][$lang]; ?>
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>

							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">

							<!-- PAGE CONTENT BEGINS -->
                            <!--background-color: #cfe2ff;-->

                            
                            <h1 id="lang-list-all-user" class="text-center" style=" padding: 1rem 1rem;"><?php echo $page_strings["lang-list-all-user"][$lang]; ?></h1>

							<div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                        <a id="lang-modal-tittle" class="btn btn-success" data-toggle="modal" data-target="#modal-users"><i class="fas fa-plus"></i> <?php echo $page_strings["lang-modal-tittle"][$lang];?></a>
                                    </div>
                                </div>

                                <br>

                                <div class="container">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <thead>
                                                <th id="lang-code" scope="col"><b><?php echo $page_strings["lang-code"][$lang]; ?></b></th>
                                                <th id="lang-name" scope="col"><b><?php echo $page_strings["lang-name"][$lang]; ?></b></th>
                                                <th id="lang-user" scope="col"><b><?php echo $page_strings["lang-user"][$lang]; ?></b></th>
                                                <th id="lang-password" scope="col"><b><?php echo $page_strings["lang-password"][$lang]; ?></b></th>
                                                <th id="lang-email" scope="col"><b><?php echo $page_strings["lang-email"][$lang]; ?></b></th>
												<th id="lang-type" scope="col"><b><?php echo $page_strings["lang-type"][$lang]; ?></b></th>
                                                <th id="lang-actions" scope="col"><b><?php echo $page_strings["lang-actions"][$lang]; ?></b></th>
                                            </thead>
                                        </tr>
                            
                                        <?php foreach($result_user_list as $dato){ ?>

                                        <tr>
                                            <td><?php echo $dato["id_user"];?></td>
                                            <td><?php echo $dato["Nombre_usu"];?></td>
                                            <td><?php echo $dato["Usuario"];?></td>
                                            <td><?php echo $dato["Password_usu"]; ?></td>
                                            <td><?php echo $dato["Correo"];?></td>
											<td><?php echo $dato["type_usu"];?></td>
                                            <td>
                                                <a class="btn btn-warning" href="editProcesUsers.php?id=<?php echo $dato["id_user"]; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger" data_list_user="<?php echo $dato["id_user"];?>" id="delete-user-<?php echo $dato["id_user"];?>"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        } 
                                        ?> 
                                    </table>
                                </div>

                                <!-- Inicio model - boostrap vs 0.3 -->

                                    <!-- Modal -->
                                <div class="modal fade" id="modal-users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" >Add new users</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form id="modal-form-users" action="add_users.php" method="POST">
                                            <div id="alert-modal" style="background-color: #f8d7da; padding: 1rem 1rem;">
                                                Empty spaces are not allowed
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <label class="form-label">Name:</label>
                                                <input type="text" id="name-modal" class="form-control" name="name-modal" maxlength="25" onkeypress="return soloLetras(event)">
                                                <label class="form-label">User:</label>
                                                <input type="text" id="user-modal" class="form-control" name="user-modal" maxlength="10">
                                                <label class="form-label">Password:</label>
                                                <input type="password" id="password-modal" class="form-control" name="password-modal" maxlength="15">
                                                <label class="form-label">Email:</label>
                                                <input type="text" id="email-modal" class="form-control" name="email-modal" maxlength="20">
                                                <input type="hidden" name="oculto" value="1">
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button id="btn-users" class="btn btn-primary">Save changes</button>
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

		<?php //require_once("piedepagina.php"); ?>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <?php include('includes/scripts.php'); ?>

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
		function modal_empty() {

		var name = document.getElementById("name-modal").value;
		var user = document.getElementById("user-modal").value;
		var password = document.getElementById("password-modal").value;
		var email = document.getElementById("email-modal").value;

		if (name == "" || user == "" || password == "" || email == "") {

			return false;

		}
		return true;
		}
	</script>


    <script>

		function SuccesAlert(){
			alertify.success('The user has been added!');
		}

		function DeleteAlert(){
			alertify.success('The user has been removed');
		}

		function ErrorUser(){
			alertify.error("The user could't be added");
		}

		function ErrorDeleting(){
			alertify.error("Error deleting user");
		}

        $(document).ready(function() {
			
			
			
            $("#alert-modal").hide();

			$("#modal-form-users").on("submit",function(){
                if(modal_empty()){
                    return true;
                }else{
                    $("#alert-modal").show();
                    return false;
                }
            })

            $("#modal-form-users").on("submit",function(){
                if(modal_empty()){
                	var datos=$('#modal-form-users').serialize();
					$.ajax({
						method: "POST",
						url: "add_users.php",
						dataType: "json",
						data: datos,
						success: function(response){
							
							if(response.result == true){
								SuccesAlert();
								setTimeout(function(){location.reload()}, 3000);
							}else{
								ErrorUser();
							}
				
						},
						error: function(xhr){
							ErrorSystem();
						}
					})
                }else{
                    $("#alert-modal").show();
                    return false;
                }
				return false;
            })
		
			//Muestra una alerta antes de eliminar un usuario
			// ^ = (Que inicie con)
			$("[id^=delete-user-]").on("click", function(){
				var id = $(this).attr("data_list_user");
				Swal.fire({
                title: 'Are you sure to delete this user?',
                //text: "You won't be able to revert this",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    //var datos=$('#modal-form-users').serialize();
                    $.ajax({
                        method: "POST",
                        url: "delete_user.php",
                        dataType: "json",
                        data: {id: id},
                        success: function(response){
                            
                            if(response.result == true){
                                DeleteAlert();
								setTimeout(function(){location.reload()}, 2000);
                            }else{
                                ErrorAlert();
                            }
                
                        },
                        error: function(response){
                            ErrorSystem();
                        }
                    })
                }
              })
			});

        });

    </script>

    
</body>
 <!--<script src="assets/js/bootstrap.min.js"></script>-->
</html>