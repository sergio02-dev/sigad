<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 * 24 de enero 2023 15:41pm
 * Clase Fuente presupuesto
 */
include_once('classFuentePresupuesto.php');

class MdfcarFuentePresupuesto extends FuentePresupuesto{

    private $sql_updte_fuentepresupuesto;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateFuentePresupuesto(){
        
        $sql_updte_fuentepresupuesto="UPDATE usco.fuentes_presupuesto
                                          SET fup_linix=".$this->getCodigoLinix().", 
                                              fup_nombre='".$this->getNombre()."', 
                                              fup_estado=".$this->getEstado().",  
                                              fup_personamodifico=".$this->getPersonaSistema().", 
                                              fup_fechamodifico=NOW()
                                        WHERE fup_codigo=".$this->getCodigo().";";
        
        $this->cnxion->ejecutar($sql_updte_fuentepresupuesto);


        return $sql_updte_fuentepresupuesto;

    }
}
?>