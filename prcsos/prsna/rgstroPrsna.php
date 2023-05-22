<?php
/**
 * Karen Yuliana Palacio Minú
 * 11 de Enero 2020 12:02 pm
 * Registro Persona
 */
include('classPrsna.php');
class RgstroPrsna extends Persona{

    private $codigoPersona;
    private $codigoEntidad;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPersona=date('YmdHis').rand(99,99999);
        $this->codigoEntidad=date('YmdHis').rand(99,99999);
    }
    public function insertPersona(){

        $insert_persona="INSERT INTO principal.persona(
                                        per_codigo, per_nombre, per_primerapellido, 
                                        per_segundoapellido, per_personacreo, 
                                        per_personamodifico, per_fechacreo, 
                                        per_fechamodifico, per_genero, per_tipoidentificacion, 
                                        per_identificacion, per_estado,
                                        per_correo)
                                VALUES (".$this->codigoPersona.", '".$this->getNombrePersona()."', '".$this->getPrimerApellidoPersona()."', 
                                        '".$this->getSegundoApellidoPersona()."', '".$this->getPersonaSistema()."', 
                                        '".$this->getPersonaSistema()."', NOW(), 
                                        NOW(), '".$this->getGeneroPersona()."', ".$this->getTipoIdentificacionPersona().", 
                                        '".$this->getIdentificacionPersona()."', '".$this->getEstadoPersona()."',
                                        '".$this->getCorreo()."');";

        $this->cnxion->ejecutar($insert_persona);


        $insert_entidad_persona="INSERT INTO principal.entidad_persona(
                                             epe_codigo, epe_persona, epe_estado, epe_personacreo, epe_personamodifico, 
                                             epe_fechacreo, epe_fechamodifico, epe_entidad, epe_facultad)
                                     VALUES (".$this->codigoEntidad.", ".$this->codigoPersona.", '1', ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", 
                                            NOW(), NOW(), ".$this->getEntidadPersona().", ".$this->getFacultadPersona().");";

        $this->cnxion->ejecutar($insert_entidad_persona);

        
        return $insert_persona.'-'.$insert_entidad_persona;
    }
}
?>