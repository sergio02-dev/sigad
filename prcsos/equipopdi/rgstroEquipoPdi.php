<?php
include_once('classEquipoPdi.php');

class RgstroEquipoPdi extends EquipoPdi {

    private $sql_insertEquipo;
    private $sql_insertCaracteristicas;
    private $codigo_equipoPdi;
    private $codigo_caracteristica;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_equipoPdi =date('YmdHis').rand(99,99999);
        $this->codigo_caracteristica =date('YmdHis').rand(99,99999);
    }

    public function insertEquipoPdi(){
        
        $sql_insertEquipo="INSERT INTO inventario.equipo(equi_codigo, 
                                                         equi_sublinea, 
                                                         equi_nombre, 
                                                         equi_estado, 
                                                         equi_fechacreo, 
                                                         equi_fechamodifico, 
                                                         equi_personacreo, 
                                                         equi_personamodifico, 
                                                         equi_codigoctic)
                                                 VALUES (".$this->codigo_equipoPdi.", 
                                                         ".$this->getCodigoSublinea().", 
                                                         '".$this->getEquipoNombre()."', 
                                                         1,
                                                         NOW(), 
                                                         NOW(), 
                                                         ".$this->getPersonaSistema().", 
                                                         ".$this->getPersonaSistema().", 
                                                         0);";
        $this->cnxion->ejecutar($sql_insertEquipo);

        $sql_insertCaracteristicas ="INSERT INTO inventario.descripcion_equipo(deq_codigo, 
                                                                               deq_equipo, 
                                                                               deq_descripcion, 
                                                                               deq_valor, 
                                                                               deq_estado, 
                                                                               deq_fechacreo, 
                                                                               deq_fechamodifico, 
                                                                               deq_personacreo, 
                                                                               deq_personamodifico, 
                                                                               deq_codigoctic)
                                                                       VALUES (".$this->codigo_caracteristica.", 
                                                                               ".$this->codigo_equipoPdi.", 
                                                                               '".$this->getCaracteristicaNombre()."', 
                                                                               ".$this->getValorunitario().", 
                                                                               1, 
                                                                               NOW(), 
                                                                               NOW(), 
                                                                               ".$this->getPersonaSistema().", 
                                                                               ".$this->getPersonaSistema().", 
                                                                                0);";
        $this->cnxion->ejecutar($sql_insertCaracteristicas);

        return $sql_insertEquipo;

    }
}
?>