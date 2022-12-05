<?php

    class Funcionamiento {

        private $cnxion;
        private $codigoForm;
        private $estado;
        private $sede;
        private $vicerrectoria;
        private $facultad;
        private $dependencia;
        private $area;
        private $linea;
        private $subLinea;
        private $equipo;
        private $descripcionEquipo;
        private $cantidad;
        private $valorUnitario;
        private $valorTotal;    
        private $personaSistema;
   
        


        function Funcionamiento(){}

        
        public function getSede(){
            return $this->sede;
        }
        public function setSede($sede){
            $this->sede=$sede;
        }
       
        public function getVicerrectoria()
        {
                return $this->vicerrectoria;
        }

        public function setVicerrectoria($vicerrectoria)
        {
                $this->vicerrectoria = $vicerrectoria;

                return $this;
        }

     
        public function getFacultad()
        {
                return $this->facultad;
        }

      
        public function setFacultad($facultad)
        {
                $this->facultad = $facultad;

                return $this;
        }

  
        public function getDependencia()
        {
                return $this->dependencia;
        }

        public function setDependencia($dependencia)
        {
                $this->dependencia = $dependencia;

                return $this;
        }

        public function getArea()
        {
                return $this->area;
        }

       
        public function setArea($area)
        {
                $this->area = $area;

                return $this;
        }


        
        public function getLinea()
        {
                return $this->linea;
        }

        
        public function setLinea($linea)
        {
                $this->linea = $linea;

                return $this;
        }

        
        public function getSubLinea()
        {
                return $this->subLinea;
        }

        
        public function setSubLinea($subLinea)
        {
                $this->subLinea = $subLinea;

                return $this;
        }

       
        public function getEquipo()
        {
                return $this->equipo;
        }

       
        public function setEquipo($equipo)
        {
                $this->equipo = $equipo;

                return $this;
        }

        public function getDescripcionEquipo()
        {
                return $this->descripcionEquipo;
        }

       
        public function setDescripcionEquipo($descripcionEquipo)
        {
                $this->descripcionEquipo = $descripcionEquipo;

                return $this;
        }

    
	
	public function getCantidad() {
		return $this->cantidad;
	}
	
	
	public function setCantidad($cantidad): self {
		$this->cantidad = $cantidad;
		return $this;
	}

	public function getValorUnitario() {
		return $this->valorUnitario;
	}
	
	
	public function setValorUnitario($valorUnitario): self {
		$this->valorUnitario = $valorUnitario;
		return $this;
	}

	public function getValorTotal() {
		return $this->valorTotal;
	}
	
	
	public function setValorTotal($valorTotal): self {
		$this->valorTotal = $valorTotal;
		return $this;
	}

	
	public function getPersonaSistema() {
		return $this->personaSistema;
	}
	
	
	public function setPersonaSistema($personaSistema): self {
		$this->personaSistema = $personaSistema;
		return $this;
	}

        
        public function getCodigoForm()
        {
                return $this->codigoForm;
        }

        public function setCodigoForm($codigoForm)
        {
                $this->codigoForm = $codigoForm;

                return $this;
        }

     
        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }

      
        public function getEstado()
        {
                return $this->estado;
        }

  
}



?>