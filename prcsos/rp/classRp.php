<?php
/**
 * Karen Yuliana Palacio Minú
 * 13 de Junio 2022 03.18 p.m.
 * Clase Rp
 */
Class Rp {
    private $codigo;
    private $codigoCdp;
    private $fecha;
    private $numero;
    private $otroValor;
    private $valorRP;
    private $estado;
    private $proveedor;
    private $actoAdministrativo;
    private $servicio;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setCodigoCdp($codigoCdp){
        $this->codigoCdp=$codigoCdp;
    }
    public function getCodigoCdp(){
        return $this->codigoCdp;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }
    public function getFecha(){
        return $this->fecha;
    } 

    public function setNumero($numero){
        $this->numero=$numero;
    }
    public function getNumero(){
        return $this->numero;
    } 
    
    public function setOtroValor($otroValor){
        $this->otroValor=$otroValor;
    }
    public function getOtroValor(){
        return $this->otroValor;
    } 
    
    public function setValorRP($valorRP){
        $this->valorRP=$valorRP;
    }
    public function getValorRP(){
        return $this->valorRP;
    } 

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }
   
    public function setProveedor($proveedor){
        $this->proveedor=$proveedor;
    }
    public function getProveedor(){
        return $this->proveedor;
    }
 
    public function setActoAdministrativo($actoAdministrativo){
        $this->actoAdministrativo=$actoAdministrativo;
    }
    public function getActoAdministrativo(){
        return $this->actoAdministrativo;
    }
 
    public function setServicio($servicio){
        $this->servicio=$servicio;
    }
    public function getServicio(){
        return $this->servicio;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
}
?>