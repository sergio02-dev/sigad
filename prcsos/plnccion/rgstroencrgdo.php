<?php 
include('classEncrgdo.php');
class RgstroEncrgdo extends Encargado{

    private $sqlInsertEncargado;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function insertEncargado(){
        
        $codigoPersona=$this->getCodigoPersona();
        $cantidadInsert=$this->getCantidadInsert();

        $sql_accion="UPDATE planaccion.accion_encargado
                        SET aen_estado='0'
                      WHERE aen_accion=".$this->getCodigoAccion().";";

        $this->cnxion->ejecutar($sql_accion);

        for($inicioInsertEncargado=0; $inicioInsertEncargado<$cantidadInsert; $inicioInsertEncargado++){

            $codigoEncargado=date('YmdHis').rand(99,99999);

            $insertEncargado[$inicioInsertEncargado]="INSERT INTO planaccion.accion_encargado(
                                                                  aen_codigo, aen_accion, aen_encargado, aen_estado, aen_fechacreo, 
                                                                  aen_fechamodifico, aen_personacreo, aen_personamodifico)
                                                          VALUES (".$codigoEncargado.", ".$this->getCodigoAccion().", ".$codigoPersona[$inicioInsertEncargado].", '1', NOW(), 
                                                                  NOW(), ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

                                  //  echo "<br> -----> ".$insertEncargado[$inicioInsertEncargado];

            $this->cnxion->ejecutar($insertEncargado[$inicioInsertEncargado]);
        }
    }
}
?>