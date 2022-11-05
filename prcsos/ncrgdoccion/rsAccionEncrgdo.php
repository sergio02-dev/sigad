<?php
include('classEncrgdo.php');
class RsAccionEncargado extends Encargado{
    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function plan_desarrollo(){

        $sql_plan_desarrollo="SELECT pde_codigo, pde_nombre
                            FROM plandesarrollo.plan_desarrollo;";

        $resultado_plan_desarrollo=$this->cnxion->ejecutar($sql_plan_desarrollo);

        while ($data_plan_desarrollo = $this->cnxion->obtener_filas($resultado_plan_desarrollo)){
            $dataplan_desarrollo[] = $data_plan_desarrollo;
        }
        return $dataplan_desarrollo;
    }

    public function accion_plan($codigo_plan){

        $sql_accion_plan="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_numero, sub_referencia, SUB.pde_codigo
                            FROM plandesarrollo.accion AS ACC
                        INNER JOIN plandesarrollo.proyecto AS PRO ON PRO.pro_codigo=ACC.acc_proyecto
                        INNER JOIN plandesarrollo.subsistema AS SUB ON SUB.sub_codigo=PRO.sub_codigo
                        WHERE SUB.pde_codigo=$codigo_plan;";

        $resultado_accion_plan=$this->cnxion->ejecutar($sql_accion_plan);

        while ($data_accion_plan = $this->cnxion->obtener_filas($resultado_accion_plan)){
            $dataaccion_plan[] = $data_accion_plan;
        }
        return $dataaccion_plan;
    }
    

    public function check_accion($accion, $encargado){

        $sqlcheck_accion="SELECT count(*) cantidad
                                FROM planaccion.accion_encargado
                               WHERE aen_encargado=$encargado
                               AND aen_accion=$accion
                               AND aen_estado='1';";

        $querycheck_accion=$this->cnxion->ejecutar($sqlcheck_accion);

        $data_check_accion=$this->cnxion->obtener_filas($querycheck_accion);

        $cantidad=$data_check_accion['cantidad'];

        return $cantidad;
    }
}

?>