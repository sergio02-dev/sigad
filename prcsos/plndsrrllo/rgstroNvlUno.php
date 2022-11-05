<?php
include('classNvlUno.php');
class RgsrtoNvlUno extends NivelUno{

    private $insert_NivelUno;
    private $codigoNivelUno;
    private $codigoResponsable;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoNivelUno = date('YmdHis').rand(99,99999);
        $this->codigoResponsable = date('YmdHis').rand(99,99999); 
    }

    public function insertNivelUno(){

        $insert_NivelUno="INSERT INTO plandesarrollo.subsistema(
                                        sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico, 
                                        sub_fechacreo, sub_fechamodifico, add_codigo, pde_codigo, res_codigo, 
                                        sub_referencia, sub_ref)
                                VALUES (".$this->codigoNivelUno.", '".$this->getNombreNivelUno()."', ".$this->getPersonaSistemaNivelUno().", ".$this->getPersonaSistemaNivelUno().", 
                                        NOW(), NOW(), ".$this->getActoAdminNivelUno().", ".$this->getPlanDesarrolloNivelUno().", ".$this->getResponsable().", 
                                        '".$this->getRefereciaNivelUno()."', '".$this->getRef()."');";

        $this->cnxion->ejecutar($insert_NivelUno);

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
                                      res_personamodifico,
                                      res_tiporesponsable)
                              VALUES (".$this->codigoResponsable.", 
                                      1, 
                                      ".$this->codigoNivelUno.", 
                                      ".$this->getCargo().", 
                                      ".$this->getOficina().", 
                                      1, 
                                      NOW(), 
                                      NOW(), 
                                      ".$this->getPersonaSistemaNivelUno().", 
                                      ".$this->getPersonaSistemaNivelUno().",
                                      ".$this->getTipoResponsable().");";

        $this->cnxion->ejecutar($insert_rspnsble);



        
        return $insert_NivelUno." <br>".$insert_rspnsble;
    }
}
?>