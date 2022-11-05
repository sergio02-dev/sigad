<?php

    class Proyecto{

        private $codigoProyecto;
        private $referenciaProyecto;
        private $subsistemaProyecto;
        private $responsableProyecto;
        private $descripcionProyecto;
        private $personaSistemaProyecto;
        private $resolucionProyecto;
        private $actoAdministrativoProyecto;
        private $trimestres;

        public function Proyecto(){}

        public function getCodigoProyecto(){
            return $this->codigoProyecto;
        }
        public function setCodigoProyecto($codigoProyecto){
            $this->codigoProyecto = $codigoProyecto;
        }


        public function getReferenciaProyecto(){
            return $this->referenciaProyecto;
        }
        public function setReferenciaProyecto($referenciaProyecto){
            $this->referenciaProyecto = $referenciaProyecto;
        }

        public function getSubsistemaProyecto(){
            return $this->subsistemaProyecto;
        }
        public function setSubsistemaProyecto($subsistemaProyecto){
            $this->subsistemaProyecto = $subsistemaProyecto;
        }

        public function getResponsableProyecto(){
            return $this->responsableProyecto;
        }
        public function setResponsableProyecto($responsableProyecto){
            $this->responsableProyecto = $responsableProyecto;
        }

        public function getDescripcionProyecto(){
            return $this->descripcionProyecto;
        }
        public function setDescripcionProyecto($descripcionProyecto){
            $this->descripcionProyecto = $descripcionProyecto;
        }

        public function getPersonaSistemaProyecto(){
            return $this->personaSistemaProyecto;
        }
        public function setPersonaSistemaProyecto($personaSistemaProyecto){
            $this->personaSistemaProyecto = $personaSistemaProyecto;
        }

        public function getResolucionProyecto(){
            return $this->resolucionProyecto;
        }
        public function setResolucionProyecto($resolucionProyecto){
            $this->resolucionProyecto = $resolucionProyecto;
        }

        public function getActoAdministrativoProyecto(){
            return $this->actoAdministrativoProyecto;
        }

        public function setActoAdministrativoProyecto($actoAdministrativoProyecto){
            $this->actoAdministrativoProyecto = $actoAdministrativoProyecto;
        }

        public function getTrimestres(){
            return $this->trimestres;
        }

        public function setTrimestres($trimestres){
            $this->trimestres = $trimestres;
        }



    }

?>




