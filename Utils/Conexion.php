<?php

Class Conexion{

    //Atributos de la clase
    private $server = "localhost";
    private $user = "choros";
    private $pass = "asd123";
    private $bd = "islachoros";
    private $port = 3308; //cambiar a 3306 en sus compus

    protected $conexion; // cadena de conexión;
    protected $secured; // retorna textos de forma segura


    //Constructor

    function __construct(){
        $this->conexion = new mysqli($this->server,$this->user,$this->pass,$this->bd,$this->port);
        if($this->conexion->connect_errno){
            die("Error al conectar a Mysql : (".$this->conexion->connect_errno.") - ".$this->conexion->connect_errno);
        }
    }

    //Metodos
    public function proteger_text($text){
        $this->secured = strip_tags($text);
        $this->secured = htmlspecialchars(trim(stripslashes($text)),ENT_QUOTES,"UTF8");

        return $this->secured;
    }

    protected function prepare($consulta){
        if(!($consulta = $this->conexion->prepare($consulta))){
            die("Fallo la preparación de la consulta, (".$this->conexion->connect_errno.") ".$this->conexion->connect_error);
        }

        return $consulta;
    }

    protected function execute($sentencia){
        if(!$sentencia->execute()){
            die("Fallo la preparación de la consulta, (".$this->conexion->connect_errno.") ".$this->conexion->connect_error);
        }

        return $sentencia;
        
    }
}

$conexion = new Conexion;
