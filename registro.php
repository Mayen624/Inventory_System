<?php
    require 'bd.php';

    
    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        $message = '';

        if(!empty($_POST["nombre"]) && !empty($_POST["usuario"]) && !empty($_POST["contra1"]) && !empty($_POST["correo"])){

            $type = $_POST["type"];
            $name = $_POST["nombre"];
            $new_user = $_POST["usuario"];
            $password = $_POST["contra1"];
            $email = $_POST["correo"];

            $password = md5($password);

            $sql_insert = "INSERT INTO usuarios (Nombre_usu,Usuario,Password_usu,Correo,type_usu) VALUES (?,?,?,?,?)";
            $insert_stm = $con->prepare($sql_insert);
            $insert_stm->execute(array($name,$new_user,$password,$email,$type));
            $insert_result = $insert_stm->fetchAll();
            
            if($insert_result > 0) {
                $message = '<p style="color: #239B56; margin:2px 5px;font-size:16px;">*User add successfully*</p>';
            }else{
                $message = '<p style="color: red; margin:2px 5px;font-size:16px;">*Error to create the user*</p>';
            }

            
        }
        else{
            $message = '<p style="color: red; margin:2px 5px;font-size:16px;">*Empty spaces are not allowed*</p>';
        }


    }
        

        
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <title>Registro - Usuarios </title>
</head>

    <form class="registro__form" action="registro.php" method="POST">
        <?php if(!empty($message)): ?>
			<?=$message ?>
    	<?php endif; ?>
        <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Full name"><br>
        <input type="text" id="user"  class="form-control" name="usuario" placeholder="User"><br>
        <input type="password" id="password1" class="form-control" name="contra1" placeholder="Password"><br>
        <input type="email" id="correo" class="form-control" name="correo" placeholder="Email"><br>
        <input type="hidden" name="type" value="1">
        <button class="btn__registro">Sign up</button><br>
        <a class="txt-center" href="index.php">¿Already have a account?</a>
    </form>

                    
    
    <script>
        // $(document).ready(function() {
        //     setTimeout(function(){$(".alert").hide()}, 3000);
        // });
    </script>

</body>
</html>