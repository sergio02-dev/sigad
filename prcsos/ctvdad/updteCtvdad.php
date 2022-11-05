<?php

    include_once('classRgstroCtvdad.php');

    class UdteCtvdad extends RegistroActividades{

        private $SqlUpdateRac;
        private $codigoActividadRealizada;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            //$this->codigoActividadRealizada = $this->getCodigoActividadRealizada();
        }


        public function updateRegistroActividad(){

            $SqlUpdateRac= "UPDATE planaccion.actividad_realizada
                                SET are_personamodifico=".$this->getPersonaSistema().",
                                    are_fechamodifico= NOW(), are_numeroveces=".$this->getNumeroVeces().", 
                                    are_tipoavance=". $this->getTipoValorAvance().", are_avancelogrado=".$this->getAvanceLogrado().", 
                                    are_tipoactividad=".$this->getTipoActividad().", are_acuerdo=".$this->getActoAdministrativo().", 
                                    are_numeroacuerdoresolucion='".$this->getNombreAcuerdo()."', 
                                    are_titulonombre='".$this->getNombreTitulo()."',
                                    are_trimestre=".$this->getTrimestre()."
                                WHERE are_codigo=".$this->getCodigoActividadRealizada().";";
            

            $this->cnxion->ejecutar($SqlUpdateRac);

            return $SqlUpdateRac;

        }


    }
?>