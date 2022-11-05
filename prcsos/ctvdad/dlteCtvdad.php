<?php

    include_once('classRgstroCtvdad.php');

    class DlteCtvdad extends RegistroActividades{

        private $SqlDeleteRac;
        private $codigoActividadRealizada;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
           
        }


        public function deleteRegistroActividad(){

            $SqlDeleteRac= "DELETE FROM planaccion.actividad_realizada
                                    WHERE are_codigo=".$this->getCodigoActividadRealizada().";";

            $this->cnxion->ejecutar($SqlDeleteRac);

            return $SqlDeleteRac;

        }


    }
?>