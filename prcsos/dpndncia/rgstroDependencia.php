<?php
include_once('classDependencia.php');

class RgstroDependencia extends Dependencia{

    private $sql_insert_dependencia;
    private $codigo_dependecia;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_dependecia =date('YmdHis').rand(99,99999);
    }

    public function insertDependencia(){
        
        $sql_insert_dependencia="INSERT INTO usco.oficina(
                                             ofi_codigo, 
                                             ofi_nombre, 
                                             ofi_estado, 
                                             ofi_fechacreo, 
                                             ofi_fechamodifico, 
                                             ofi_personacreo, 
                                             ofi_personamodifico)
                                     VALUES (".$this->codigo_dependecia.", 
                                             '".$this->getNombre()."',
                                             ".$this->getEstado().", 
                                             NOW(), 
                                             NOW(), 
                                             ".$this->getPersonaSistema().",
                                             ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($sql_insert_dependencia);


        return $sql_insert_dependencia;

    }
}
?>
