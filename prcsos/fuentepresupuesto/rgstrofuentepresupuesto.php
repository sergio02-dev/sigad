<?php
include_once('classFuentePresupuesto.php');

class RgstroFuentePresupuesto extends FuentePresupuesto{

    private $sql_insert_fuentepresupuesto;
    private $codigo_fuentepresupuesto;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_fuentepresupuesto =date('YmdHis').rand(99,99999);
    }

    public function insertFuentePresupuesto(){
        
        $sql_insert_fuentepresupuesto="INSERT INTO usco.fuentes_presupuesto(fup_codigo, 
                                                                            fup_linix, 
                                                                            fup_nombre, 
                                                                            fup_estado, 
                                                                            fup_personacreo, 
                                                                            fup_personamodifico, 
                                                                            fup_fechacreo, 
                                                                            fup_fechamodifico)
                                                                    VALUES (".$this->codigo_fuentepresupuesto.", 
                                                                            ".$this->getCodigoLinix().", 
                                                                            '".$this->getNombre()."', 
                                                                            ".$this->getEstado().", 
                                                                            ".$this->getPersonaSistema().",
                                                                            ".$this->getPersonaSistema().",
                                                                            NOW(),
                                                                            NOW());";
        
        $this->cnxion->ejecutar($sql_insert_fuentepresupuesto);


        return $sql_insert_fuentepresupuesto;

    }
}
?>
