<?php
include 'database.php';




if (isset($_POST['barra'])) {

    $barra = $_POST['barra'];


    $consulta = $consqlServer->prepare("SELECT DISTINCT c.codigo as codigo, ca.codigo as alterno,
     case when c.codigo like '%-%' THEN 'INSTITUCIONAL' ELSE 'COMERCIAL' END  AS 'bodega'    
    from cot_item c    
    inner join cot_item_alt ca on ca.id_cot_item=c.id    
    where ca.codigo='$barra' and c.codigo not like '%-%'    
    order by c.codigo asc ");
    $consulta->execute();
    $data = $consulta->fetchAll(PDO::FETCH_ASSOC);
    // print_r($data);


    $codigo = $data[0]['codigo'];

    // var_dump($codigo);

    $query = "SELECT * FROM productos WHERE codigo ='$codigo'";
    $result = mysqli_query($connection, $query);

    // // echo $result;

    if (!$result) {
        die('erro en la consulta');
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {

        $json[] = array(
            'codigo' => $row['codigo'],
            'descripcion' => $row['descripcion'],
            'lote' => $row['lote'],
            'vencimiento' => $row['fechavto'],
            'stock' => $row['stock'],
            'ubicacion' => $row['ubicacion'],
            'costo' => $row['costo_und'],
            'pasillo' => $row['pasillo'],
            'estante' => $row['estante'],
            'id' => $row['id'],
        );
    }

    $jsonString = json_encode($json);
    echo $jsonString;
}
