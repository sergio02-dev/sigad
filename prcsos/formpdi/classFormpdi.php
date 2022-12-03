<?php
/**
 * Juan sebastian Romero
 * 02 de Diciembre 2022 15:50 pm
 * Clase Formulario PDI
 */
Class PlandeComprasPDI{
    private $codigo;
    private $sede;
    private $vicerrectoria;
    private $facultad;
    private $dependencia;
    private $area;
    private $tipogasto;
    private $codigopdi;
    private $accion;
    private $plantafisica;
    private $lineaequipo;
    private $sublineaequipo;
    private $equipo;
    private $caracteristicas;
    private $cantidad;
    private $valorunitario;
    private $valortotal;
    private $personaSistema;
    

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }


	public function getPlantafisica() {
		return $this->plantafisica;
	}
	
	public function setPlantafisica($plantafisica){
        $this->plantafisica = $plantafisica;
	}

	
	public function getValortotal() {
		return $this->valortotal;
	}
	

	public function setValortotal($valortotal){
		$this->valortotal = $valortotal;
	}

	public function getVicerrectoria() {
		return $this->vicerrectoria;
	}
	
	public function setVicerrectoria($vicerrectoria){
		$this->vicerrectoria = $vicerrectoria;
	}

	public function getFacultad() {
		return $this->facultad;
	}
	
	public function setFacultad($facultad){
		$this->facultad = $facultad;
	}

	public function getDependencia() {
		return $this->dependencia;
	}
	
	public function setDependencia($dependencia){
		$this->dependencia = $dependencia;

	}
	public function getArea() {
		return $this->area;
	}
	
	public function setArea($area) {
		$this->area = $area;
	}

	public function getTipogasto() {
		return $this->tipogasto;
	}
	

	public function setTipogasto($tipogasto){
		$this->tipogasto = $tipogasto;

	}

	public function getCodigopdi() {
		return $this->codigopdi;
	}

	public function setCodigopdi($codigopdi){
		$this->codigopdi = $codigopdi;

	}

	public function getAccion() {
		return $this->accion;
	}
	
	public function setAccion($accion){
		$this->accion = $accion;
	
	}

	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setCodigo($codigo){
		$this->codigo = $codigo;
		
	}
	public function getSede() {
		return $this->sede;
	}

	public function setSede($sede){
		$this->sede = $sede;
	}

	public function getLineaequipo() {
		return $this->lineaequipo;
	}
	

	public function setLineaequipo($lineaequipo){
		$this->lineaequipo = $lineaequipo;

	}
	public function getSublineaequipo() {
		return $this->sublineaequipo;
	}
	
	public function setSublineaequipo($sublineaequipo){
		$this->sublineaequipo = $sublineaequipo;

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