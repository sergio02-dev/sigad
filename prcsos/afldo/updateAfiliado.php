<?php
include('classAfldo.php');
class UpdteAfldo  extends Afiliado{

    private $updatePersona;
    private $updateDatosBasicos;
    private $updateAfiliado;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function update_afiliado(){

        $updatePersona="UPDATE principal.persona
                           SET per_nombre='".$this->getPrimerNombreAfiliado()."', per_primerapellido='".$this->getPrimerApellidoAfiliado()."', 
                               per_segundoapellido='".$this->getSegundoApellidoAfiliado()."', per_personamodifico='".$this->getPersonaSistema()."',
                               per_fechamodifico=NOW(), per_genero='".$this->getGeneroAfiliado()."', 
                               per_tipoidentificacion=".$this->getTipoIdeAfiliado().", per_identificacion='".$this->getIdentificacionAfiliado()."',
                               per_segundonombre='".$this->getSegundoNombreAfiliado()."', per_fechanacimiento='".$this->getFechaNacimientoAfiliado()."', 
                               per_municipionacimiento=".$this->getMunicipioNacimientoAfiliado()."
                        WHERE  per_codigo=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($updatePersona);

        $updateDatosBasicos="UPDATE principal.datos_basicos
                                SET dba_estadocivil=".$this->getEstadoCivilAfiliado().", dba_profesion=".$this->getProfesionAfiliado().", dba_rh=".$this->getRhAfiliado().",
                                    dba_direccion='".$this->getDireccionAfiliado()."', dba_municipioresidencia=".$this->getMunicipioResidenciaAfiliado().", dba_correo='".$this->getCorreoAfiliado()."', 
                                    dba_telefono='".$this->getTelefonoAfiliado()."', dba_celular=".$this->getCelularAfiliado().", dba_fechamodifico=NOW(),
                                    dba_personamodifico=".$this->getPersonaSistema()."
                              WHERE dba_persona=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($updateDatosBasicos);

        $updateAfiliado="UPDATE afiliado.afiliado
                            SET afi_fechaafiliacion='".$this->getFechaAfliacionAfiliado()."', afi_peso=".$this->getPesoAfiliado().", 
                                afi_estatura=".$this->getEstaturaAfiliado().", afi_observacion='".$this->getObservacionesAfiliado()."',
                                afi_fechamodifico=NOW(), afi_personamodifico=".$this->getPersonaSistema()."
                          WHERE afi_persona=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($updateAfiliado);

        //return $this->codigoPersona;
        return $updatePersona." <br><br> ".$updateDatosBasicos." <br><br> ".$updateAfiliado;
    }
}

?>