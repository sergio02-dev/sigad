<?php
include('classNvlTres.php');
class RgstroNvlTres extends NivelTres{

    private $insert_nivelTres;
    private $codigoNivelTres;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoNivelTres=date('YmdHis').rand(99,99999);
    }

    public function numeroNivelTres(){

        $sqlnumeroNivelTres="SELECT MAX(acc_numero)AS numero
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=".$this->getCodigoNivelDos().";";

        $querynumeroNivelTres=$this->cnxion->ejecutar($sqlnumeroNivelTres);

        $data_numeroNivelTres=$this->cnxion->obtener_filas($querynumeroNivelTres);

        $numero=$data_numeroNivelTres['numero'];

        return $numero;
    }

    public function insertNivelTres(){

        $numero=$this->numeroNivelTres();
        if($numero){
            $numeroNivel=$numero+1;
        }
        else{
            $numeroNivel=1;
        }

        $insert_nivelTres="INSERT INTO plandesarrollo.accion(
                                        acc_codigo, acc_referencia, acc_descripcion, acc_responsable,
                                        acc_lineabase, acc_metaresultado, acc_proyecto, acc_personacreo,
                                        acc_personamodifico, acc_fechacreo, acc_fechamodifico, acc_actoadmin,
                                        acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva,
                                        acc_indicador, acc_numero)
                                VALUES (".$this->codigoNivelTres.", '".$this->getReferencia()."', '".$this->getDescripcion()."', 0,
                                        ".$this->getLineaBase().", ".$this->getMetaResultado().", ".$this->getCodigoNivelDos().", ".$this->getPersonaSistema().",
                                        ".$this->getPersonaSistema().", NOW(), NOW(), ".$this->getActoAdmin().",
                                        0, ".$this->getComportamiento()." ,".$this->getTendenciaPositiva().",
                                        '".$this->getIndicador()."', ".$numeroNivel.");";

        $this->cnxion->ejecutar($insert_nivelTres);


        return $insert_nivelTres;
    }
}
?>
