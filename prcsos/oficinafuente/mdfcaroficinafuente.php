<?php
include_once('classOficinafuente.php');

class MdfcarOficinaFuente extends OficinaFuente{

    private $sql_updte_oficinafuente;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateOficinafuente(){
        
        $sql_updte_oficinafuente="UPDATE usco.oficinafuente
                                    SET off_oficina=".$this->getCodigo_oficina().", 
                                        off_cargo=".$this->getCodigo_cargo().", 
                                        off_fuente=".$this->getCodigo_fuente().", 
                                        off_estado=".$this->getEstado().",                                   
                                        off_fechamodifico=NOW(),  
                                        off_personamodifico=NOW(), 
                                 WHERE off_codigo=".$this->getCodigo().";";
        
        

        $this->cnxion->ejecutar($sql_updte_oficinafuente);


        return $sql_updte_oficinafuente;

    }
}
?>