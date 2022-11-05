<?php
include('classPrsna.php');
class UpdtePrsna extends Persona{

    private $updatePersona;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updatePersona(){

        $updatePersona = "UPDATE principal.persona
                             SET per_nombre = '".$this->getNombrePersona()."', 
                                 per_primerapellido = '".$this->getPrimerApellidoPersona()."', 
                                 per_segundoapellido = '".$this->getSegundoApellidoPersona()."', 
                                 per_tipoidentificacion = ".$this->getTipoIdentificacionPersona().", 
                                 per_identificacion = '".$this->getNumeroIdentificacionPersona()."', 
                                 per_segundonombre = '".$this->getSegundoNombrePersona()."', 
                                 per_lugarexpedicion = '".$this->getLugarExpedicionPersona()."', 
                                 per_fechanacimiento = '".$this->getFechaNacimientoPersona()."', 
                                 per_genero = ".$this->getGeneroPersona().", 
                                 per_estado = ".$this->getEstadoPersona().", 
                                 per_fechamodico = NOW(),
                                 per_personamodifico = ".$this->getPersonaSistema()."
                           WHERE per_codigo = ".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($updatePersona);

        $updateDatosBasicos="UPDATE principal.datos_basicos
                                SET dba_municipioresidencia = ".$this->getMunicipioResidenciaPersona().", 
                                    dba_direccionresidencia = '".$this->getDireccionPersona()."', 
                                    dba_celular = ".$this->getCelularPersona().", 
                                    dba_telefono = '".$this->getTelefonoPersona()."', 
                                    dba_correo = '".$this->getCorreoPersona()."', 
                                    dba_personamodifico = ".$this->getPersonaSistema().",
                                    dba_fechamodifico = NOW()
                              WHERE dba_persona = ".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($updateDatosBasicos);

        


        return $updatePersona." <br><br> ".$updateDatosBasicos." <br><br> ";
    }
}
?>
