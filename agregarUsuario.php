<?php
include 'database.php';

if (isset($_POST['usuario'])) {



    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $perfil = $_POST['perfil'];
    



    $query = "INSERT INTO usuarios(nombre,usuario,password,perfil)
              VALUES('$nombre','$usuario','$password','$perfil')";


    $result = mysqli_query($connection, $query);



    if (!$result) {
        die("Error inserting");
    }

    echo 'ok';
}
