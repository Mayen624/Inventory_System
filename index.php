<?php
	require "bd.php";

	

	$message = '';

	$Empty = "Empty espace are not allowed";

    $Error = "The user dosn't exist";

	if($_SERVER["REQUEST_METHOD"] == 'POST'){

		if(!empty($_POST["Usuario"]) && !empty($_POST["Password"])){

			$user = $_POST["Usuario"];
			$password = $_POST["Password"];
	
			$password = md5($password);
	
			$sql_login = "SELECT * FROM usuarios WHERE Usuario=? AND Password_usu=?";
			$login_stm = $con->prepare($sql_login);
			$login_stm->execute(array($user,$password));
			$login_result = $login_stm->fetchAll();

			if(count($login_result) > 0){
				foreach ($login_result as $result){
				
					if($result["type_usu"] == 1){
						session_start();
						$_SESSION["Usuario"] = $user;
						$_SESSION["type"] = $result["type_usu"];
						$_SESSION["id"] = $result["id_user"];
						header('location: store.php');
					}elseif($result["type_usu"] == 2) {
						session_start();
						$_SESSION["Usuario"] = $user;
						$_SESSION["id"] = $result["id_user"];
						$_SESSION["type"] = $result["type_usu"];
						header('location: admin.php');
					}
	
				}

			}else{
				$message = '<p style="color:red; margin:2px 5px;font-size:18px;">*The user does not exist*</p>';
			}

			

	
			
		}else{
			$message = '<p style="color: red; margin:2px 5px;font-size:16px;">*Empty espace are not allowed*</p>';
		}

		
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Usuario</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="assets/alertify/css/alertify.min.css">
	<script src="js/jquery-3.6.0.min.js"></script>
	

</head>

<body>
	
	<form class="login__form" id="login-form" method="POST">
		<?php if(!empty($message)): ?>
			<?=$message ?>
    	<?php endif; ?>
		<input type="text" name="Usuario" id="usuario" placeholder="User"><br>
		<input type="password" name="Password" id="pass" placeholder="Password"><br>
		<button class="btn__login" id="btn-login">Sign In</button><br>
		<span>Don't you have an account?</span>
		<a href="registro.php">Create new account</a>
	</form>	

</body>
<script src="assets/alertify/js/alertify.min.js"></script>
<script>

        
</script>
</html>