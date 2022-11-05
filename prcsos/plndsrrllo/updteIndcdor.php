<?php
include('classIndcdor.php');
class UpdteIndcdor extends Indicador{

    private $update_indicador;
    private $codigoIndicador;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateIndicador(){

        $update_indicador="UPDATE plandesarrollo.indicador
                                SET ind_unidadmedida='".$this->getIndicador()."', 
                                    ind_lineabase=".$this->getLineaBase().", 
                                    ind_metaresultado=".$this->getMetaResultado().", 
                                    ind_fechamodifico=NOW(),
                                    ind_personamodifico=".$this->getPersonaSistema().", 
                                    ind_tipocomportamiento=".$this->getComportamiento().", 
                                    ind_tendencia=".$this->getTendenciaPositiva().",
                                    ind_sede = ".$this->getSede()."
                                WHERE ind_codigo=".$this->getCodigoIndicador().";";

        $this->cnxion->ejecutar($update_indicador);
        

        $update_vigenciaindicador="UPDATE plandesarrollo.indicador_vigencia
                                      SET ivi_estado='0', ivi_fechamodifico=NOW(), 
                                          ivi_personamodifico=".$this->getPersonaSistema()."
                                    WHERE ivi_indicador=".$this->getCodigoIndicador().";";

        $this->cnxion->ejecutar($update_vigenciaindicador);


        $vigencia=$this->getVigencia();
        $vigenciaCantidad=$this->getTotalInsert();
        $unidad=$this->getUnidad();
        $presupuesto=$this->getPresupuesto();

        for($inicioUpdateVigencias=0; $inicioUpdateVigencias<$vigenciaCantidad; $inicioUpdateVigencias++){
            $codigoIndicadorVigencia[$inicioUpdateVigencias]=date('YmsHis').rand(99,99999);
            $prsupuesto = str_replace(".","",$presupuesto[$inicioUpdateVigencias]);

            $update_indicadorVIgencia[$inicioUpdateVigencias]="INSERT INTO plandesarrollo.indicador_vigencia(
                                                ivi_codigo, ivi_indicador, 
                                                ivi_valorlogrado, ivi_presupuesto, ivi_vigencia, ivi_estado, 
                                                ivi_fechacreo, ivi_fechamodifico, ivi_personacreo, ivi_personamodifico)

                                        VALUES (".$codigoIndicadorVigencia[$inicioUpdateVigencias].", ".$this->getCodigoIndicador().", 
                                                ".$unidad[$inicioUpdateVigencias].", ".$prsupuesto.",".$vigencia[$inicioUpdateVigencias].", '1', 
                                                NOW(),  NOW(),  ".$this->getPersonaSistema().",  ".$this->getPersonaSistema().");";

                                $this->cnxion->ejecutar($update_indicadorVIgencia[$inicioUpdateVigencias]);
        }

        return $update_indicador;
    }
}
?>
