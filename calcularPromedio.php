<?php
    require 'vendor/autoload.php';
    $url="http://localhost/lab1p3/ws.php?wsdl";
    $cliente = new nusoap_client($url,'wsdl');
    $error=$cliente->getError();
    if ($error) {
        echo "Error de conexion en el webservice: $error";
    } 

    $parametros = array(
        'nombre'=>$_POST["nombre"],
        'laboratorio1' => (float)$_POST["laboratorio1"],
        'laboratorio2' => (float)$_POST["laboratorio2"],
        'parcial' => (float)$_POST["parcial"]
    );

    $resultado = $cliente->call('calcularPromedio', $parametros);

    echo "<h1>Nombre del alumno: {$resultado["nombre"]}</h1>";
    echo "<h1>Nota del laboratorio 1: {$resultado["laboratorio1"]}</h1>";
    echo "<h1>Nota del laboratorio 2: {$resultado["laboratorio2"]}</h1>";
    echo "<h1>Nota del parcial: {$resultado["parcial"]}</h1>";
    echo "<h1>Promedio calculado: {$resultado["promedio"]}</h1>";
    echo "<h1>{$resultado["mensaje"]}</h1>";
    



?>