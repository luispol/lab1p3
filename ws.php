<?php

    require "vendor/autoload.php";
    $server = new nusoap_server;
    //Nombre del espacio del espacio de trabajo a nivel de memoria
    $server->configureWSDL('server','urn:server');
    $server->wsdl->schemaTargetNamespace='urn:server';

    $server->wsdl->addComplexType(
        'Promedio',
        'complexType',
        'struct',
        'all',
        '',
        //Los datos compuestos
        array(
            'nombre' => array('name'=>'nombre','type'=>'xsd:string'),
            'laboratorio1' => array('name'=>'laboratorio1','type'=>'xsd:float'),
            'laboratorio2' => array('name'=>'laboratorio2','type'=>'xsd:float'),
            'parcial' => array('name'=>'parcial','type'=>'xsd:float'),
            'promedio'=>array('name'=>'promedio','type'=>'xsd:float'),
            'mensaje'=>array('name'=>'mensaje','type'=>'xsd:string')
        )
    );

    $server->register(
        'calcularPromedio',
        //Datos de entrada
        array(
            'nombre'=>'xsd:string',
            'laboratorio1'=>'xsd:float',
            'laboratorio2'=>'xsd:float',
            'parcial'=>'xsd:float'
        ),
        //Datos de salida
        array('return'=>'tns:Promedio'),
        'urn:server',
        'urn:server#calcularPromedioServer',
        'rpc',
        'encoded',
        'Funcion para calcular el promedio de las notas'
    );

    //Funcion para calular el promedio
    function calcularPromedio($nombre,$laboratorio1,$laboratorio2,$parcial) {
        $promedio = ($laboratorio1 * 0.25) + ($laboratorio2 * 0.25) + ($parcial * 0.5);
        $mensaje = "Promedio calculado exitosamente.";

        return array('nombre'=>$nombre, 'laboratorio1'=>$laboratorio1, 'laboratorio2'=>$laboratorio2,
         'parcial'=>$parcial,'promedio'=>$promedio, 'mensaje'=>$mensaje);
    }


    // Esta recibe las peticiones, permite construir el contenido a la petición y mandárselo, es la que está en modo espera
    $server->service(file_get_contents("php://input"));


?>