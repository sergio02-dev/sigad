<?php
    
    include('classAutrdadAmbntal.php');

    class MdfcarAutrdadAmbntal extends Autoridad{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function mdfcar_autoridad_amb(){
            
            $sql_updte_autrdad="UPDATE principal.autoridad_ambiental
                                   SET aam_numero = ".$this->getNumeroAutoridad().", 
                                       aam_descripcion = '".$this->getNombreAutoridad()."', 
                                       aam_siglas = '".$this->getReferenciaAutoridad()."', 
                                       aam_estado = ".$this->getEstadoAutoridad().",
                                       aam_fechamodifico = NOW(), 
                                       aam_personamodifico = ".$this->getPersonaSistema()."
                                 WHERE aam_codigo = ".$this->getCodigoAutoridad().";";
            
            $query_updte_autoridad=$this->cnxion->ejecutar($sql_updte_autrdad);

            return $sql_updte_autrdad;
        }

    }



?>