<?php
class Afiliado{

    private $codigoPersona;
    private $identificacionAfiliado;
    private $tipoIdeAfiliado;
    private $fechaAfliacionAfiliado;
    private $primerNombreAfiliado;
    private $segundoNombreAfiliado;
    private $primerApellidoAfiliado;
    private $segundoApellidoAfiliado;
    private $generoAfiliado;
    private $rhAfiliado;
    private $estadoCivilAfiliado;
    private $profesionAfiliado;
    private $fechaNacimientoAfiliado;
    private $municipioNacimientoAfiliado;
    private $municipioResidenciaAfiliado;
    private $edadAfiliado;
    private $direccionAfiliado;
    private $correoAfiliado;
    private $telefonoAfiliado;
    private $celularAfiliado;
    private $estaturaAfiliado;
    private $pesoAfiliado;
    private $observacionesAfiliado;
    private $personaSistema;

    public function Afiliado(){}

    public function getCodigoPersona(){
        return $this->codigoPersona;
    }
    public function setCodigoPersona($codigoPersona){
        $this->codigoPersona=$codigoPersona;
    }

    public function getIdentificacionAfiliado(){
        return $this->identificacionAfiliado;
    }
    public function setIdentificacionAfiliado($identificacionAfiliado){
        $this->identificacionAfiliado=$identificacionAfiliado;
    }

    public function getTipoIdeAfiliado(){
        return $this->tipoIdeAfiliado;
    }
    public function setTipoIdeAfiliado($tipoIdeAfiliado){
        $this->tipoIdeAfiliado=$tipoIdeAfiliado;
    }

    public function getFechaAfliacionAfiliado(){
        return $this->fechaAfliacionAfiliado;
    }
    public function setFechaAfliacionAfiliado($fechaAfliacionAfiliado){
        $this->fechaAfliacionAfiliado=$fechaAfliacionAfiliado;
    }

    public function getPrimerNombreAfiliado(){
        return $this->primerNombreAfiliado;
    }
    public function setPrimerNombreAfiliado($primerNombreAfiliado){
        $this->primerNombreAfiliado=$primerNombreAfiliado;
    }

    public function getSegundoNombreAfiliado(){
        return $this->segundoNombreAfiliado;
    }
    public function setSegundoNombreAfiliado($segundoNombreAfiliado){
        $this->segundoNombreAfiliado=$segundoNombreAfiliado;
    }

    public function getPrimerApellidoAfiliado(){
        return $this->primerApellidoAfiliado;
    }
    public function setPrimerApellidoAfiliado($primerApellidoAfiliado){
        $this->primerApellidoAfiliado=$primerApellidoAfiliado;
    }

    public function getSegundoApellidoAfiliado(){
        return $this->segundoApellidoAfiliado;
    }
    public function setSegundoApellidoAfiliado($segundoApellidoAfiliado){
        $this->segundoApellidoAfiliado=$segundoApellidoAfiliado;
    }

    public function getGeneroAfiliado(){
        return $this->generoAfiliado;
    }
    public function setGeneroAfiliado($generoAfiliado){
        $this->generoAfiliado=$generoAfiliado;
    }

    public function getRhAfiliado(){
        return $this->rhAfiliado;
    }
    public function setRhAfiliado($rhAfiliado){
        $this->rhAfiliado=$rhAfiliado;
    }

    public function getEstadoCivilAfiliado(){
        return $this->estadoCivilAfiliado;
    }
    public function setEstadoCivilAfiliado($estadoCivilAfiliado){
        $this->estadoCivilAfiliado=$estadoCivilAfiliado;
    }

    public function getProfesionAfiliado(){
        return $this->profesionAfiliado;
    }
    public function setProfesionAfiliado($profesionAfiliado){
        $this->profesionAfiliado=$profesionAfiliado;
    }

    public function getFechaNacimientoAfiliado(){
        return $this->fechaNacimientoAfiliado;
    }
    public function setFechaNacimientoAfiliado($fechaNacimientoAfiliado){
        $this->fechaNacimientoAfiliado=$fechaNacimientoAfiliado;
    }

    public function getMunicipioNacimientoAfiliado(){
        return $this->municipioNacimientoAfiliado;
    }
    public function setMunicipioNacimientoAfiliado($municipioNacimientoAfiliado){
        $this->municipioNacimientoAfiliado=$municipioNacimientoAfiliado;
    }

    public function getMunicipioResidenciaAfiliado(){
        return $this->municipioResidenciaAfiliado;
    }
    public function setMunicipioResidenciaAfiliado($municipioResidenciaAfiliado){
        $this->municipioResidenciaAfiliado=$municipioResidenciaAfiliado;
    }

    public function getEdadAfiliado(){
        return $this->edadAfiliado;
    }
    public function setEdadAfiliado($edadAfiliado){
        $this->edadAfiliado=$edadAfiliado;
    }

    public function getDireccionAfiliado(){
        return $this->direccionAfiliado;
    }
    public function setDireccionAfiliado($direccionAfiliado){
        $this->direccionAfiliado=$direccionAfiliado;
    }

    public function getCorreoAfiliado(){
        return $this->correoAfiliado;
    }
    public function setCorreoAfiliado($correoAfiliado){
        $this->correoAfiliado=$correoAfiliado;
    }

    public function getTelefonoAfiliado(){
        return $this->telefonoAfiliado;
    }
    public function setTelefonoAfiliado($telefonoAfiliado){
        $this->telefonoAfiliado=$telefonoAfiliado;
    }

    public function getCelularAfiliado(){
        return $this->celularAfiliado;
    }
    public function setCelularAfiliado($celularAfiliado){
        $this->celularAfiliado=$celularAfiliado;
    }

    public function getEstaturaAfiliado(){
        return $this->estaturaAfiliado;
    }
    public function setEstaturaAfiliado($estaturaAfiliado){
        $this->estaturaAfiliado=$estaturaAfiliado;
    }

    public function getPesoAfiliado(){
        return $this->pesoAfiliado;
    }
    public function setPesoAfiliado($pesoAfiliado){
        $this->pesoAfiliado=$pesoAfiliado;
    }

    public function getObservacionesAfiliado(){
        return $this->observacionesAfiliado;
    }
    public function setObservacionesAfiliado($observacionesAfiliado){
        $this->observacionesAfiliado=$observacionesAfiliado;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
}
?>