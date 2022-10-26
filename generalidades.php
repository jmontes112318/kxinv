<?php
include 'database.php';
if (isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $funcion = $_GET['funcion'];

    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch ($funcion) {
        case 'valorInvSelectivo':

            $query = 'SELECT SUM(stock * costo_und) as valor_inventario
              FROM productos';
            $result = mysqli_query($connection, $query);



            if (!$result) {
                die('erro en la consulta');
            }

            $json = array();
            while ($row = mysqli_fetch_array($result)) {

                $json[] = array(
                    'valorInventario' => $row['valor_inventario'],

                );
            }

            $jsonString = json_encode($json);
            echo $jsonString;

            break;

        case 'valorInvTomado':
            $query = 'SELECT SUM(cant_ingresada * costo_und) as valorTomado
            FROM productos';
            $result = mysqli_query($connection, $query);



            if (!$result) {
                die('erro en la consulta');
            }

            $json = array();
            while ($row = mysqli_fetch_array($result)) {

                $json[] = array(
                    'valorTomado' => $row['valorTomado'],

                );
            }

            $jsonString = json_encode($json);
            echo $jsonString;

            break;

        case 'valorDiferencia':
            $query = 'SELECT (SUM(cant_ingresada * costo_und) - SUM(stock * costo_und)) as valorDiferencia
            FROM productos';
            $result = mysqli_query($connection, $query);



            if (!$result) {
                die('erro en la consulta');
            }

            $json = array();
            while ($row = mysqli_fetch_array($result)) {

                $json[] = array(
                    'valorDiferencia' => $row['valorDiferencia'],

                );
            }

            $jsonString = json_encode($json);
            echo $jsonString;

            break;
            
        case 'referenciasInv':
            $query = 'SELECT COUNT(*) as referencias
            FROM productos
            WHERE stock > 0';
            $result = mysqli_query($connection, $query);



            if (!$result) {
                die('erro en la consulta');
            }

            $json = array();
            while ($row = mysqli_fetch_array($result)) {

                $json[] = array(
                    'referencias' => $row['referencias'],

                );
            }

            $jsonString = json_encode($json);
            echo $jsonString;

            break;

            case 'itemsSobrantes':
                $query = 'SELECT codigo,descripcion,costo_und, (cant_ingresada-stock) as dif 
                FROM productos
                HAVING dif >0';
                $result = mysqli_query($connection, $query);
    
    
    
                if (!$result) {
                    die('erro en la consulta');
                }
    
                $json = array();
                while ($row = mysqli_fetch_array($result)) {
    
                    $json[] = array(
                        'codigo' => $row['codigo'],
                        'descripcion' => $row['descripcion'],
                        'costo_und' => $row['costo_und'],
                         'dif' => $row['dif'],
    
                    );
                }
    
                $jsonString = json_encode($json);
                echo $jsonString;
    
                break;

                case 'itemsFaltantes':
                    $query = 'SELECT codigo,descripcion,costo_und,  (cant_ingresada-stock) as dif 
                    FROM productos
                    HAVING dif < 0';
                    $result = mysqli_query($connection, $query);
        
        
        
                    if (!$result) {
                        die('erro en la consulta');
                    }
        
                    $json = array();
                    while ($row = mysqli_fetch_array($result)) {
        
                        $json[] = array(
                            'codigo' => $row['codigo'],
                            'descripcion' => $row['descripcion'],
                            'costo_und' => $row['costo_und'],                            
                            'dif' => $row['dif'],
        
                        );
                    }
        
                    $jsonString = json_encode($json);
                    echo $jsonString;
        
                    break;
    }
}
