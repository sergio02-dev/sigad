<?php

    include_once('classRgstroCtvdad.php');

    class RgstroCtvdadHjo extends RegistroActividades{

        private $sqlInsertRac;
        private $codigoActividadRealizadaHijo;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigoActividadRealizadaHijo = date('YmdHis');
        }


        public function insertRegistroActividadHijo(){

            $sqlInsertRacHijo=" INSERT INTO planaccion.actividad_realizada(are_codigo, are_actividad, are_numeroveces, are_tipoavance, are_avancelogrado,
                                                                       are_personacreo, are_personamodifico, are_fechacreo, are_fechamodifico,are_tipoactividad,
                                                                       are_acuerdo, are_numeroacuerdoresolucion, are_titulonombre, are_trimestre, are_padre)
                                VALUES ( ".$this->codigoActividadRealizadaHijo.",  ".$this->getCodigoActividad().", ".$this->getNumeroVeces().", 1, 
                                ".$this->getAvanceLogrado().", ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", NOW(), NOW(),".$this->getTipoActividad().",
                                99, '".$this->getNombreAcuerdo()."','".$this->getNombreTitulo()."',".$this->getTrimestre().",".$this->getCodigoActividadRealizada().");";
            
            $this->cnxion->ejecutar($sqlInsertRacHijo);

            return $sqlInsertRacHijo;

        }


    }
?>