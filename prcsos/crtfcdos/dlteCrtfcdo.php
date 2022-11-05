<?php

    include_once('classCrtfcdos.php');

    class DlteCrtfcdo extends Certificados{

        private $SqlDeleteCertificado;
        private $SqlDeleteCostoCertificado;
        private $codigoActividadRealizada;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
           
        }


        public function deleteCertificado(){

            $SqlDeleteCertificado= "DELETE FROM planaccion.actividad
                                     WHERE act_codigo=".$this->getcodigoActividad().";";

            $this->cnxion->ejecutar($SqlDeleteCertificado);

            $SqlDeleteCostoCertificado= "DELETE FROM planaccion.actividad_costo
                                          WHERE aco_actividad=".$this->getcodigoActividad().";";

            $this->cnxion->ejecutar($SqlDeleteCostoCertificado);


            $SqlDeleteEtapaCertificado= "DELETE FROM planaccion.certificado_etapa
                                          WHERE cee_certificado = ".$this->getcodigoActividad().";";

            $this->cnxion->ejecutar($SqlDeleteEtapaCertificado);

            return $SqlDeleteCertificado." <br><br>".$SqlDeleteCostoCertificado." <br><br>".$SqlDeleteEtapaCertificado;

        }


    }
?>