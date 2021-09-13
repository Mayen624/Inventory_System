
<?php
 
    //if(!isset($_POST["oculto"])){
       // header("location: index.php");
    //}

    include('bd.php');

    $name_add = $_POST["name-modal"];
    $user_add = $_POST["user-modal"];
    $password_add = $_POST["password-modal"];
    $email_add = $_POST["email-modal"];
    $type = $_POST["oculto"];

    $password_add = md5($password_add);

    try{
        $sql_add = 'INSERT INTO usuarios (Nombre_usu,Usuario,Password_usu,Correo,type_usu) VALUES (?,?,?,?,?)';
        $stm_add = $con->prepare($sql_add);
        $stm_add->execute(array($name_add,$user_add,$password_add,$email_add,$type));
        
    }catch(Exception $e){
        echo $e->getMessage();
    }

    //  echo "<p><script>swal({
    //  ztitle: 'SUCCESS!',
    //  text: 'The user has been added!',
    //  icon: 'success',
    //  });
    //  setTimeout(function(){ location.href = 'listauser.php' }, 2000);
    //  </script></p>";

    echo json_encode(array("result" => true));
?>