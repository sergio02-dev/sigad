<?php 
include('classEncrgdo.php');
class RgstroAccionEncrgdo extends Encargado{

    private $sqlInsertEncargado;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function insertEncargado(){
        
        $codigoPersona=$this->getCodigoPersona();
        $cantidadInsert=$this->getCantidadInsert();
        $codigoAccion=$this->getCodigoAccion();

        $sql_accion="UPDATE planaccion.accion_encargado
                        SET aen_estado='0'
                      WHERE aen_encargado=".$this->getCodigoPersona().";";

        $this->cnxion->ejecutar($sql_accion);

        for($inicioInsertEncargado=0; $inicioInsertEncargado<$cantidadInsert; $inicioInsertEncargado++){

            $codigoEncargado=date('YmdHis').rand(99,99999);

            $insertEncargado[$inicioInsertEncargado]="INSERT INTO planaccion.accion_encargado(
                                                                  aen_codigo, aen_accion, aen_encargado, aen_estado, aen_fechacreo, 
                                                                  aen_fechamodifico, aen_personacreo, aen_personamodifico)
                                                          VALUES (".$codigoEncargado.", ".$codigoAccion[$inicioInsertEncargado].", ".$codigoPersona.", '1', NOW(), 
                                                                  NOW(), ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

                                    echo "<br> -----> ".$insertEncargado[$inicioInsertEncargado];

            $this->cnxion->ejecutar($insertEncargado[$inicioInsertEncargado]);
        }
    }
}
?>