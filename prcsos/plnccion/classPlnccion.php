<?php
Class PlanAccion{

    private $personaSistema;
    private $codigoActividad;
    private $referenciaActividad;
    private $objetoAccion;
    private $recursoAccion;
    private $logroAccion;
    private $logroEjecutado;
    private $vigenciaActividad;
    private $estado;
    private $codigo_poai;
    private $codigoClasificador;
    private $descripcionClasificador;
    private $dane;
    private $planCompras;

    public function PlanAccion(){}

    public function getCodigoPoai(){
        return $this->codigo_poai;
    }
    public function setCodigoPoai($codigo_poai){
        $this->codigo_poai=$codigo_poai;
    }

    public function getCodigoClasificador(){
        return $this->codigoClasificador;
    }
    public function setCodigoClasificador($codigoClasificador){
        $this->codigoClasificador=$codigoClasificador;
    }
    public function getDescripcionClasificador(){
        return $this->descripcionClasificador;
    }

    public function setDescripcionClasificador($descripcionClasificador){
        $this->descripcionClasificador=$descripcionClasificador;
    }

    public function getCodigoActividad(){
        return $this->codigoActividad;
    }

    public function setCodigoActividad($codigoActividad){
        $this->codigoActividad=$codigoActividad;
    }

    public function getReferencia(){
        return $this->referenciaActividad;
    }

    public function setReferencia($referenciaActividad){
        $this->referenciaActividad=$referenciaActividad;
    }

    public function getObjeto(){
        return $this->objetoAccion;
    }

    public function setObjeto($objetoAccion){
        $this->objetoAccion=$objetoAccion;
    }

    public function getRecurso(){
        return $this->recursoAccion;
    }

    public function setRecurso($recursoAccion){
        $this->recursoAccion=$recursoAccion;
    }

    public function getLogro(){
        return $this->logroAccion;
    }

    public function setLogro($logroAccion){
        $this->logroAccion=$logroAccion;
    }

    public function getLogroEjecutado(){
        return $this->logroEjecutado;
    }

    public function setLogroEjecutado($logroEjecutado){
        $this->logroEjecutado=$logroEjecutado;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getVigenciaActividad(){
        return $this->vigenciaActividad;
    }

    public function setVigenciaActividad($vigenciaActividad){
        $this->vigenciaActividad=$vigenciaActividad;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
    
    public function getDane(){
        return $this->dane;
    }
    public function setDane($dane){
        $this->dane=$dane;
    }
    
    public function getPlanCompras(){
        return $this->planCompras;
    }
    public function setPlanCompras($planCompras){
        $this->planCompras=$planCompras;
    }

}
?>
