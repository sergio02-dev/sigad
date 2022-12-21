<?php
include_once('classFormfun.php');

class RgstroFormfun extends Funcionamiento{

    private $sql_insert_formfun;
    private $codigo_formfun;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_formfun =date('YmdHis').rand(99,99999);
    }

    public function insertFormfun(){
        
        $sql_insert_formfun="INSERT INTO usco.funcionamiento(
                                        fun_codigo, 
                                        fun_sede, 
                                        fun_vicerrectoria, 
                                        fun_facultad, 
                                        fun_dependencia, 
                                        fun_area, 
                                        fun_linea, 
                                        fun_sublinea, 
                                        fun_equipo, 
                                        fun_equipodescripcion, 
                                        fun_valorunitario, 
                                        fun_cantidad, 
                                        fun_fechacreo, 
                                        fun_fechamodifico, 
                                        fun_personacreo, 
                                        fun_personamodifico, 
                                        fun_estado)
                                VALUES (".$this->codigo_formfun.",
                                        ".$this->getSede().",
                                        ".$this->getVicerrectoria().",
                                        ".$this->getFacultad().", 
                                        ".$this->getDependencia().", 
                                        ".$this->getArea().",
                                        ".$this->getLineaequipo().",
                                        ".$this->getSublineaequipo().",
                                        ".$this->getEquipo().",
                                        ".$this->getCaracteristicas().",
                                        ".$this->getValorunitario().",
                                        ".$this->getCantidad().",
                                        NOW(), 
                                        NOW(), 
                                        ".$this->getPersonaSistema().",
                                        ".$this->getPersonaSistema().",
                                        1)";
                           
        
        $this->cnxion->ejecutar($sql_insert_formfun);


        return $sql_insert_formfun;

    }
}
?>
