<?php
include('classSaldoFuenteFinanciacion.php');
class RgstroSldosFnteFnnccion extends SaldoFuenteFinanciacion{

    private $insert_saldo_fuente;
    private $codigoSaldo;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoSaldo=date('YmdHis').rand(99,99999);
    }

    public function insertSaldoFuente(){

        $insert_saldo_fuente="INSERT INTO planaccion.saldos_fuente_financiacion(
                                          sff_codigo, 
                                          sff_vigencia, 
                                          sff_fuente, 
                                          sff_saldo, 
                                          sff_estado, 
                                          sff_fechacreo, 
                                          sff_fechamodifico, 
                                          sff_personacreo, 
                                          sff_personamodifico,
                                          sff_acto)
                                  VALUES (".$this->codigoSaldo.", 
                                          ".$this->getVigencia().", 
                                          ".$this->getFuenteFinanciacion().", 
                                          ".$this->getSaldo().", 
                                          ".$this->getEstado().", 
                                          NOW(), 
                                          NOW(), 
                                          ".$this->getPersonaSistema().", 
                                          ".$this->getPersonaSistema().",
                                          ".$this->getAcuerdo().");";

        $this->cnxion->ejecutar($insert_saldo_fuente);
        
        return $insert_saldo_fuente;
    }
}
?>