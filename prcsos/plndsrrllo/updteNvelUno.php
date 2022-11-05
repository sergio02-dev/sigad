<?php
include('classNvlUno.php');
class UpdateNvlUno extends NivelUno{

    private $update_nivelUno;
    private $codigoResponsable;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoResponsable = date('YmdHis').rand(99,99999); 
    }

    public function updateNivelUno(){

        $update_nivelUno="UPDATE plandesarrollo.subsistema
                            SET sub_nombre='".$this->getNombreNivelUno()."',sub_personamodifico=".$this->getPersonaSistemaNivelUno().", 
                                sub_fechamodifico=NOW(), sub_referencia='".$this->getRefereciaNivelUno()."', sub_ref='".$this->getRef()."',
                                res_codigo=".$this->getResponsable()."
                            WHERE sub_codigo=".$this->getCodigoNivelUno().";";

        $this->cnxion->ejecutar($update_nivelUno);

        if($this->getCodigoLevel()){
            $update_rspnsble="UPDATE usco.responsable
                                 SET res_codigocargo=".$this->getCargo().", 
                                     res_codigooficina=".$this->getOficina().", 
                                     res_fechamodifico=NOW(),
                                     res_personamodifico=".$this->getPersonaSistemaNivelUno()."
                               WHERE res_codigo=".$this->getCodigoLevel()." ;";

            $this->cnxion->ejecutar($update_rspnsble);
            echo "update ".$update_rspnsble;
        }
        else{
            $insert_rspnsble="INSERT INTO usco.responsable(
                                        res_codigo, 
                                        res_nivel, 
                                        res_codigonivel, 
                                        res_codigocargo, 
                                        res_codigooficina, 
                                        res_estado, 
                                        res_fechacreo, 
                                        res_fechamodifico, 
                                        res_personacreo, 
                                        res_personamodifico)
                                VALUES (".$this->codigoResponsable.", 
                                        1, 
                                        ".$this->getCodigoNivelUno().", 
                                        ".$this->getCargo().", 
                                        ".$this->getOficina().", 
                                        1, 
                                        NOW(), 
                                        NOW(), 
                                        ".$this->getPersonaSistemaNivelUno().", 
                                        ".$this->getPersonaSistemaNivelUno().");";

            $this->cnxion->ejecutar($insert_rspnsble);

            echo "insret ".$insert_rspnsble;
        }

        
        return $update_nivelUno;
    }
}
?>