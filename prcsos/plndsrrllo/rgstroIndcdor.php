<?php
include('classIndcdor.php');
class RgstroIndcdor extends Indicador{

    private $insert_indicador;
    private $codigoIndicador;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoIndicador=date('YmdHis').rand(99,99999);
    }

    public function insertIndicador(){

        $insert_indicador="INSERT INTO plandesarrollo.indicador(
                                        ind_codigo, ind_unidadmedida, 
                                        ind_lineabase, ind_metaresultado, 
                                        ind_accion, ind_estado, 
                                        ind_fechacreo, ind_fechamodifico, 
                                        ind_personacreo, ind_personamodifico, 
                                        ind_tipocomportamiento, ind_tendencia,
                                        ind_sede)
                                VALUES (".$this->codigoIndicador.", '".$this->getIndicador()."', 
                                        ".$this->getLineaBase().", ".$this->getMetaResultado().", 
                                        ".$this->getCodigoAccion().", 1, 
                                        NOW(), NOW(), 
                                        ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", 
                                        ".$this->getComportamiento().", ".$this->getTendenciaPositiva().",
                                        ".$this->getSede().");";

        $this->cnxion->ejecutar($insert_indicador);
        
        $vigencia=$this->getVigencia();
        $vigenciaCantidad=$this->getTotalInsert();

        $unidad=$this->getUnidad();
        $presupuesto=$this->getPresupuesto();

        for($inicioInsertVigencias=0; $inicioInsertVigencias<$vigenciaCantidad; $inicioInsertVigencias++){
            $codigoIndicadorVigencia[$inicioInsertVigencias]=date('YmsHis').rand(99,99999);
            $prsupuesto = str_replace(".","",$presupuesto[$inicioInsertVigencias]); 

            $insert_indicadorVIgencia[$inicioInsertVigencias]="INSERT INTO plandesarrollo.indicador_vigencia(
                                                ivi_codigo, ivi_indicador, 
                                                ivi_valorlogrado, ivi_presupuesto, ivi_vigencia, ivi_estado, 
                                                ivi_fechacreo, ivi_fechamodifico, ivi_personacreo, ivi_personamodifico)
                                        VALUES (".$codigoIndicadorVigencia[$inicioInsertVigencias].", ".$this->codigoIndicador.", 
                                                ".$unidad[$inicioInsertVigencias].", ".$prsupuesto.",".$vigencia[$inicioInsertVigencias].", '1', 
                                                NOW(),  NOW(),  ".$this->getPersonaSistema().",  ".$this->getPersonaSistema().");";

                                               
            $this->cnxion->ejecutar($insert_indicadorVIgencia[$inicioInsertVigencias]);
        }

        
       


        return $insert_indicador;
    }
}
?>
