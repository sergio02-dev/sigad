<?php
include('classResponsable.php');
class RgstroRspnsble extends Responsable{

    private $inser_responsable;
    private $codigo_responsable;
    private $codigo_registro_ordenador;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_responsable = date('YmdHis').rand(99,99999);
        $this->codigo_registro_ordenador = date('YmdHis').rand(99,99999);
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
                                        res_tiporesponsable,
                                        res_clasificacion)
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
                                        ".$this->getTipoResponsable().",
                                        ".$this->getClasificacion().");";

        $this->cnxion->ejecutar($inser_responsable);

        if($this->getTipoResponsable() == 1){
            $inser_registro_ordenador="INSERT INTO usco.registro_ordenador(
                                                    ror_codigo, 
                                                    ror_registro, 
                                                    ror_ordenador,
                                                    ror_fechacreo, 
                                                    ror_fechamodifico, 
                                                    ror_personacreo, 
                                                    ror_personamodifico)
                                            VALUES (".$this->codigo_registro_ordenador.", 
                                                ".$this->codigo_responsable.", 
                                                    ".$this->getOrdenador().",
                                                    NOW(), 
                                                    NOW(), 
                                                    ".$this->getPersonaSistema().", 
                                                    ".$this->getPersonaSistema().");";

            $this->cnxion->ejecutar($inser_registro_ordenador);

        }

        
        
        return $inser_responsable;
    }
}
?>