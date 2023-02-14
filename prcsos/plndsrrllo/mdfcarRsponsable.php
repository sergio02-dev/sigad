<?php
include('classResponsable.php');
class MdfcarRspnsble extends Responsable{

    private $updte_responsable;
    private $codigo_responsable;
    private $codigo_registro_ordenador;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_responsable = date('YmdHis').rand(99,99999);
        $this->codigo_registro_ordenador = date('YmdHis').rand(99,99999);
    }

    public function updteResponsable(){

        $updte_responsable="UPDATE usco.responsable
                               SET res_nivel = ".$this->getNivel().", 
                                   res_codigonivel = ".$this->getCodigoNivel().", 
                                   res_codigocargo = ".$this->getCargo().", 
                                   res_codigooficina = ".$this->getOficina().", 
                                   res_estado = ".$this->getEstado().", 
                                   res_fechamodifico = NOW(), 
                                   res_personamodifico = ".$this->getPersonaSistema().",
                                   res_clasificacion = ".$this->getClasificacion()."
                             WHERE res_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($updte_responsable);

        if($this->getTipoResponsable() == 1){
            $inser_registro_ordenador="UPDATE usco.registro_ordenador
                                               SET  
                                                    ror_registro= ".$this->getCodigo().", 
                                                    ror_ordenador=".$this->getOrdenador().",
                                                    ror_fechamodifico= NOW(), 
                                                    ror_personamodifico=".$this->getPersonaSistema()."
                                                WHERE ror_registro=".$this->getCodigo().";";

            $this->cnxion->ejecutar($inser_registro_ordenador);

        }

        return $updte_responsable;
    }
}
?>