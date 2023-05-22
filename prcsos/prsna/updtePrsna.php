<?php
/**
 * Karen Yuliana Palacio Minú
 * 11 de Enero 2020 13:26 pm
 * Update Persona
 */
include('classPrsna.php');
class UpdtePrsna extends Persona{
    
    private $codigoEntidad;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoEntidad=date('YmdHis').rand(99,99999);
    }
    public function updatePersona(){

        $update_persona="UPDATE principal.persona
                            SET per_nombre='".$this->getNombrePersona()."', 
                                per_primerapellido='".$this->getPrimerApellidoPersona()."', 
                                per_segundoapellido='".$this->getSegundoApellidoPersona()."', 
                                per_personamodifico='".$this->getPersonaSistema()."', per_fechamodifico=NOW(), 
                                per_genero='".$this->getGeneroPersona()."', 
                                per_tipoidentificacion=".$this->getTipoIdentificacionPersona().", 
                                per_identificacion='".$this->getIdentificacionPersona()."', 
                                per_estado='".$this->getEstadoPersona()."',
                                per_correo='".$this->getCorreo()."'
                        WHERE per_codigo=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($update_persona);

        $update_entidad_persona="UPDATE principal.entidad_persona
                                    SET epe_estado='0', epe_personamodifico=".$this->getPersonaSistema().", 
                                        epe_fechamodifico=NOW()
                                WHERE epe_persona=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($update_entidad_persona);

        $insert_entidad_persona="INSERT INTO principal.entidad_persona(
                                             epe_codigo, epe_persona, epe_estado, 
                                             epe_personacreo, epe_personamodifico, 
                                             epe_fechacreo, epe_fechamodifico, 
                                             epe_entidad, epe_facultad)
                                     VALUES (".$this->codigoEntidad.", ".$this->getCodigoPersona().", '1', 
                                             ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", 
                                             NOW(), NOW(), 
                                             ".$this->getEntidadPersona().", ".$this->getFacultadPersona().");";

        $this->cnxion->ejecutar($insert_entidad_persona);

        
        return $update_persona;
    }
}
?>