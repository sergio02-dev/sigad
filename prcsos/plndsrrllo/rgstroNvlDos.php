<?php
include('classNvlDos.php');
class RgsrtoNvlDos extends NivelDos{

    private $insert_nivelDos;
    private $codigoNivelDos;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoNivelDos=date('YmdHis').rand(99,99999);
    }

    public function numeroNivelDos(){

        $sqlnumeroNivelDos="SELECT MAX(pro_numero) AS numero
                                FROM plandesarrollo.proyecto
                                WHERE sub_codigo=".$this->getCodigoNivelUno().";";

        $querynumeroNivelDos=$this->cnxion->ejecutar($sqlnumeroNivelDos);

        $data_numeroNivelDos=$this->cnxion->obtener_filas($querynumeroNivelDos);

        $numero=$data_numeroNivelDos['numero'];

        return $numero;
    }

    public function insertNivelDos(){

        $numero=$this->numeroNivelDos();
        if($numero){
            $numeroNivel=$numero+1;
        }
        else{
            $numeroNivel=1;
        }

        $insert_nivelDos="INSERT INTO plandesarrollo.proyecto(
                                    pro_codigo, pro_descripcion, sub_codigo, pro_personacreo, pro_personamodifico, 
                                    pro_fechacreo, pro_fechamodifico, add_codigo, res_codigo, pro_referencia, pro_numero,
                                    pro_objetivo)
                            VALUES (".$this->codigoNivelDos.", '".$this->getNombreNivelDos()."', ".$this->getCodigoNivelUno().", ".$this->getPersonaSistemaNivelDos().", ".$this->getPersonaSistemaNivelDos().", 
                                    NOW(), NOW(), ".$this->getActoAdminNivelDos().", ".$this->getResponsable().", '".$this->getRefeneciaNivelDos()."', ".$numeroNivel.",
                                    '".$this->getObjetivo()."');";

        $this->cnxion->ejecutar($insert_nivelDos);

        
        return $insert_nivelDos;
    }
}
?>