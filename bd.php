<?php 

    $server = 'localhost';
    $user = 'mayen';
    $pass = 'Julio1643520000';
    $database = 'inventory_system';

   try{
       // Create connection
    $con = new PDO("mysql:host=$server;dbname=$database;",$user, $pass);
        //echo 'Conectado';
   } catch (PDOException $e ) {
       die('Connection Failed:' . $e->getMessage());
   }


?>