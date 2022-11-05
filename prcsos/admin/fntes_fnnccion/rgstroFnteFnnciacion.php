<?php
include('classFuentesFinanciacion.php');
class RgstroFntesFnnccion extends FuentesFinanciacion{

    private $codigoFuente;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoFuente=date('YmdHis').rand(99,99999);
    }

    public function insertFuente(){

        $insert_fuente="INSERT INTO planaccion.fuente_financiacion(
                                    ffi_codigo, 
                                    ffi_nombre, 
                                    ffi_descripcion, 
                                    ffi_tipofuente, 
                                    ffi_fechacreo, 
                                    ffi_fechamodifico, 
                                    ffi_personacreo, 
                                    ffi_personamodifico, 
                                    ffi_estado,
                                    ffi_clasificacion,
                                    ffi_codigolinix,
                                    ffi_referencialinix,
                                    ffi_clasificacionplaneacion)
                            VALUES (".$this->codigoFuente.", 
                                    '".$this->getNombre()."', 
                                    '".$this->getDescripcion()."', 
                                    ".$this->getTipo().", 
                                    NOW(), 
                                    NOW(), 
                                    ".$this->getPersonaSistema().", 
                                    ".$this->getPersonaSistema().", 
                                    ".$this->getEstado().",
                                    ".$this->getClasificacion().",
                                    ".$this->getCodigoLinix().",
                                    '".$this->getReferenciaLinix()."',
                                    ".$this->getClasificacionPlaneacion()."
                                );";

        $this->cnxion->ejecutar($insert_fuente);
        
        return $insert_fuente;
    }
}
?>