<?php
include('classSaldoFuenteFinanciacion.php');
class MdfcarSldosFnteFnnccion extends SaldoFuenteFinanciacion{

    private $update_saldo_fuente;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function modfcarSaldoFuente(){

        $update_saldo_fuente="UPDATE planaccion.saldos_fuente_financiacion
                                 SET sff_vigencia = ".$this->getVigencia().", 
                                     sff_fuente = ".$this->getFuenteFinanciacion().", 
                                     sff_saldo = ".$this->getSaldo().", 
                                     sff_estado = ".$this->getEstado().", 
                                     sff_fechamodifico = NOW(),
                                     sff_personamodifico = ".$this->getPersonaSistema().",
                                     sff_acto = ".$this->getAcuerdo()."
                               WHERE sff_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_saldo_fuente);
        
        return $update_saldo_fuente;
    }
}
?>