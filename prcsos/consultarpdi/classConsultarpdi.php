<?php
/**
 * Juan sebastian Romero
 * 21 de Diciembre 2022 11:59 am
 * Clase Consultar Formulario PDI
 */
Class ConsultarPDI{
    private $sede;
    private $dependencia;
    private $accion;
    private $equipo;
    private $caracteristicas;
    private $cantidad;
    private $valorunitario;
	
    


	public function getDependencia() {
		return $this->dependencia;
	}
	
	public function setDependencia($dependencia){
		$this->dependencia = $dependencia;

	}
	

	public function getAccion() {
		return $this->accion;
	}
	
	public function setAccion($accion){
		$this->accion = $accion;
	
	}

	public function getSede() {
		return $this->sede;
	}

	public function setSede($sede){
		$this->sede = $sede;
	}


	public function getEquipo() {
		return $this->equipo;
	}
	
	public function setEquipo($equipo){
		$this->equipo = $equipo;

	}

	public function getCantidad() {
		return $this->cantidad;
	}
	

	public function setCantidad($cantidad) {
		$this->cantidad = $cantidad;

	}
	public function getValorunitario() {
		return $this->valorunitario;
	}
	
	public function setValorunitario($valorunitario) {
		$this->valorunitario = $valorunitario;

	}

	
	public function getCaracteristicas() {
		return $this->caracteristicas;
	}
	

	public function setCaracteristicas($caracteristicas){
		$this->caracteristicas = $caracteristicas;
	
	}

}
?>