<?php
include_once('classDependencia.php');

class MdfcarDependencia extends Dependencia{

    private $sql_updte_dependencia;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateDependencia(){
        
        $sql_updte_dependencia="UPDATE usco.oficina
                                   SET ofi_nombre='".$this->getNombre()."',
                                       ofi_estado=".$this->getEstado().", 
                                       ofi_fechamodifico=NOW(), 
                                       ofi_personamodifico=".$this->getPersonaSistema()."
                                 WHERE ofi_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($sql_updte_dependencia);


        return $sql_updte_dependencia;

    }
}
?>
