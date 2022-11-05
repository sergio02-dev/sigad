<?php

    include_once('classRgstroCtvdad.php');

    class RgstroCtvdad extends RegistroActividades{

        private $sqlInsertRac;
        private $codigoActividadRealizada;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigoActividadRealizada = date('YmdHis');
        }


        public function insertRegistroActividad(){

            $sqlInsertRac=" INSERT INTO planaccion.actividad_realizada(are_codigo, are_actividad, are_numeroveces, are_tipoavance, are_avancelogrado,
                                                                       are_personacreo, are_personamodifico, are_fechacreo, are_fechamodifico,are_tipoactividad,
                                                                       are_acuerdo, are_numeroacuerdoresolucion, are_titulonombre, are_trimestre)
                                VALUES ( ".$this->codigoActividadRealizada.",  ".$this->getCodigoActividad().", ".$this->getNumeroVeces().", ". $this->getTipoValorAvance().", 
                                ".$this->getAvanceLogrado().", ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", NOW(), NOW(),".$this->getTipoActividad().",
                                ".$this->getActoAdministrativo().", '".$this->getNombreAcuerdo()."','".$this->getNombreTitulo()."', ".$this->getTrimestre().");";
            
            $this->cnxion->ejecutar($sqlInsertRac);

            return $sqlInsertRac;

        }


    }
?>