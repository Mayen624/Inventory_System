					<?php
						if(isset($_SESSION["lang"])){
							$lang = $_SESSION["lang"];
						} else {
							$lang = "en_US";
						}
						//$lang = 'es_SV';
						$page_name = "menulateral";
						include('translate.php'); 
					?>

					<style type="text/css">
						
						.modi a i{
							display:inline-block; 
							min-width:30px;
							margin-right:2px;
							vertical-align:sub;
							text-align:center;
							font-size:18px;
							font-weight:400px
						}

					</style>

					<li class="modi active">
						<a href="admin.php" style="padding-left: 5px;">
						<i class="fas fa-box-open" aria-hidden="true" style="text-aling:center;"></i>
							<span id="lang-products" class="menu-text"> <?php echo $page_strings["lang-products"][$lang]; ?></span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="listauser.php">
							<i class="menu-icon far fa-id-card"></i>
							<span id="lang-users" class="menu-text"> <?php echo $page_strings["lang-users"][$lang]; ?> </span>
						</a>

						<b class="arrow"></b>
					</li>


					<li class="modi">
						<a href="categories.php" style="padding-left: 5px;">
						<i class="fas fa-tags" aria-hidden="true" style="text-aling:center;"></i>
							<span id="lang-categories " class="menu-text">Categorias</span>
						</a>

						<b class="arrow"></b>
					</li>

					

					