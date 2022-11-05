<?php
include('classCtoDmnstrtvo.php');
class RgstroActoAdmnstrtvo extends ActoAdministrativo{

    private $inster_actoAdministrativo;
    private $codigoNivelUno;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoActoAdministrativo=date('YmdHis').rand(99,99999);
    }

    public function insertActoAdministrativo(){

        $inster_actoAdministrativo="INSERT INTO plandesarrollo.acto_administrativo(
                                                aad_codigo, add_nombre, 
                                                add_personacreo, add_personamodifico, 
                                                add_fechacreo, add_fechamodifico, 
                                                add_tipoactoadmin, add_vigencia,
                                                add_urlactoadmin, add_descripcion,
                                                add_padre)
                                        VALUES (".$this->codigoActoAdministrativo.", '".$this->getNombreActoAdministrativo()."', 
                                                ".$this->getPersonaActoAdministrativo().",".$this->getPersonaActoAdministrativo().", 
                                                NOW(), NOW(), 
                                                ".$this->getTipoActoAdministrativo().", ".$this->getVigenciaActoAdministrativo().",
                                                '".$this->getUrlActoAdministrativo()."',
                                                '".$this->getDescripcionActoAdministrativo()."',
                                                ".$this->getAcuerdoPapa()."
                                            );";

        $this->cnxion->ejecutar($inster_actoAdministrativo);

        
        return $inster_actoAdministrativo;
    }
}
?>