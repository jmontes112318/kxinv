<?php
session_start();
include 'database.php';
if (isset($_POST["usuario"])) {

    $usu = $_POST['usuario'];
    $pass = $_POST['contrasenia'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usu' AND password ='$pass'";
    $result = mysqli_query($connection, $query);
    $filas = mysqli_num_rows($result);

    if ($filas) {

        $json = array();
        while ($row = mysqli_fetch_array($result)) {

            $json[] = array(

                'nombre' => $row['nombre'],
                'usuario' => $row['usuario'],
                'password' => $row['password'],
                'perfil' => $row['perfil'],
                'estado' => $row['estado'],
                'id' => $row['id'],
            );
        }

        $jsonString = json_encode($json);
        echo $jsonString;
    } else {
        echo "0";
    }
}
