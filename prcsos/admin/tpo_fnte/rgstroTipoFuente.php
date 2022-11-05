<?php
include('classTipoFuente.php');
class RgstroTpoFnte extends TipoFuente{

    private $codigoTipoFuente;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoTipoFuente=date('YmdHis').rand(99,99999);
    }

    public function insert_tipo_fuente(){

        $insert_tpo_fnte="INSERT INTO planaccion.tipo_fuente_financiacion(
                                      tff_codigo, 
                                      tff_nombre, 
                                      tff_estado, 
                                      tff_fechacreo, 
                                      tff_fechamodifico, 
                                      tff_personacreo, 
                                      tff_personamodifico, 
                                      tff_descripcion)
                              VALUES (".$this->codigoTipoFuente.", 
                                      '".$this->getNombre()."', 
                                      ".$this->getEstado().", 
                                      NOW(), 
                                      NOW(), 
                                      ".$this->getPersonaSistema().", 
                                      ".$this->getPersonaSistema().", 
                                      '".$this->getDescripcion()."');";

        $this->cnxion->ejecutar($insert_tpo_fnte);
        
        return $insert_tpo_fnte;
    }
}
?>