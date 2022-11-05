<?php
    
    include('classAutrdadAmbntal.php');


    class RgstroAutrdadAmbntal extends Autoridad{

        private $codigo_autoridad;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_autoridad = date('YmdHis').rand(99,999);
        }

        public function insert_autoridad_amb(){
            
            $sql_insrt_autrdad="INSERT INTO principal.autoridad_ambiental(
                                            aam_codigo, 
                                            aam_numero, 
                                            aam_descripcion, 
                                            aam_siglas, 
                                            aam_estado, 
                                            aam_fechacreo, 
                                            aam_fechamodifico, 
                                            aam_personacreo, 
                                            aam_personamodifico)
                                    VALUES (".$this->codigo_autoridad.", 
                                            ".$this->getNumeroAutoridad().", 
                                            '".$this->getNombreAutoridad()."', 
                                            '".$this->getReferenciaAutoridad()."', 
                                            ".$this->getEstadoAutoridad().", 
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getPersonaSistema().", 
                                            ".$this->getPersonaSistema().");";
            
            $query_insert_autoridad=$this->cnxion->ejecutar($sql_insrt_autrdad);

            return $sql_insrt_autrdad;
        }

    }



?>

