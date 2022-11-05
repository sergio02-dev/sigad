<?php
include('classCtoDmnstrtvo.php');
class UpdateActoAdmnstrtvo extends ActoAdministrativo{

    private $update_actoAdministrativo;
    private $codigoNivelUno;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoActoAdministrativo=date('YmdHis').rand(99,99999);
    }

    public function updateActoAdministrativo(){

        $update_actoAdministrativo="UPDATE plandesarrollo.acto_administrativo
                                      SET  add_nombre='".$this->getNombreActoAdministrativo()."', 
                                           add_personamodifico=".$this->getPersonaActoAdministrativo().", 
                                           add_fechamodifico=NOW(), 
                                           add_tipoactoadmin=".$this->getTipoActoAdministrativo().",
                                           add_vigencia = ".$this->getVigenciaActoAdministrativo().",
                                           add_urlactoadmin = '".$this->getUrlActoAdministrativo()."',
                                           add_descripcion = '".$this->getDescripcionActoAdministrativo()."',
                                           add_padre = ".$this->getAcuerdoPapa()."
                                        WHERE aad_codigo=".$this->getCodigoActoAdministrativo().";";

        $this->cnxion->ejecutar($update_actoAdministrativo);

        
        return $update_actoAdministrativo;
    }
}
?>