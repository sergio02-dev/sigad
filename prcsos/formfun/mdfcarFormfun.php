<?php
include_once('classFormfun.php');

class MdfcarFormfun extends Funcionamiento {

    private $sql_updateformfun;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateformfun(){
        
        $sql_updateformfun="UPDATE usco.funcionamiento
                                    SET  fun_sede=".$this->getSede().", 
                                    fun_vicerrectoria=".$this->getVicerrectoria().", 
                                    fun_facultad=".$this->getFacultad().", 
                                    fun_dependencia=".$this->getDependencia().", 
                                    fun_area=".$this->getArea().", 
                                    fun_linea=".$this->getLineaequipo().", 
                                    fun_sublinea=".$this->getSublineaequipo().", 
                                    fun_equipo=".$this->getEquipo().", 
                                    fun_equipodescripcion=".$this->getCaracteristicas().", 
                                    fun_valorunitario=".$this->getValorunitario().", 
                                    fun_cantidad=".$this->getCantidad().", 
                                    fun_fechacreo=NOW(), 
                                    fun_fechamodifico=NOW(), 
                                    fun_personacreo=".$this->getPersonaSistema().", 
                                    fun_personamodifico=".$this->getPersonaSistema().",
                                    fun_estado=".$this->getEstado()."
                                WHERE fun_codigo=".$this->getCodigo().";";
        
        
        $this->cnxion->ejecutar($sql_updateformfun);

        return $sql_updateformfun;

    }
}
?>