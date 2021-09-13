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
								<a id="lang-spanish" href="change_lang.php?language=es_SV">
									<img src="assets/images/avatars/spanish.png" style="width:50px;height:40px;"><!-- ICONO -->
									<?php echo $page_strings["lang-spanish"][$lang]; ?>
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a id="lang-english" href="change_lang.php?language=en_US">
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

