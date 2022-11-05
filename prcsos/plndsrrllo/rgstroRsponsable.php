<?php
include('classResponsable.php');
class RgstroRspnsble extends Responsable{

    private $inser_responsable;
    private $codigo_responsable;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_responsable = date('YmdHis').rand(99,99999);
    }

    public function insertResponsable(){

        $inser_responsable="INSERT INTO usco.responsable(
                                        res_codigo, 
                                        res_nivel, 
                                        res_codigonivel, 
                                        res_codigocargo, 
                                        res_codigooficina, 
                                        res_estado, 
                                        res_fechacreo, 
                                        res_fechamodifico, 
                                        res_personacreo, 
                                        res_personamodifico, 
                                        res_tiporesponsable)
                                VALUES (".$this->codigo_responsable.", 
                                        ".$this->getNivel().", 
                                        ".$this->getCodigoNivel().",
                                        ".$this->getCargo().", 
                                        ".$this->getOficina().", 
                                        ".$this->getEstado().", 
                                        NOW(), 
                                        NOW(), 
                                        ".$this->getPersonaSistema().", 
                                        ".$this->getPersonaSistema().",
                                        ".$this->getTipoResponsable().");";

        $this->cnxion->ejecutar($inser_responsable);

        
        return $inser_responsable;
    }
}
?>