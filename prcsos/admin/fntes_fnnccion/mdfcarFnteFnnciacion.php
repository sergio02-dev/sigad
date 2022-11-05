<?php
include('classFuentesFinanciacion.php');
class MdfcarFntesFnnccion extends FuentesFinanciacion{
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updteFuente(){

        $update_fuente="UPDATE planaccion.fuente_financiacion
                           SET ffi_nombre = '".$this->getNombre()."', 
                               ffi_descripcion = '".$this->getDescripcion()."', 
                               ffi_tipofuente = ".$this->getTipo().", 
                               ffi_fechamodifico = NOW(), 
                               ffi_personamodifico = ".$this->getPersonaSistema().", 
                               ffi_estado = ".$this->getEstado().",
                               ffi_clasificacion = ".$this->getClasificacion().",
                               ffi_codigolinix = ".$this->getCodigoLinix().",
                               ffi_referencialinix = '".$this->getReferenciaLinix()."',
                               ffi_clasificacionplaneacion = ".$this->getClasificacionPlaneacion()."
                         WHERE ffi_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_fuente);
        
        return $update_fuente;
    }
}
?>