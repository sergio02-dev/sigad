<?php
include('classActualizarPDI.php');
class RgstroActlzcionPDI extends ActualizacionPDI{

    private $insertPlanDesarrollo;
    private $codigoPlanDesarrollo;
    private $codigo_ppi;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPlanDesarrollo = date('YmdHis').rand(99,99999);
        $this->codigo_ppi = date('YmdHis').rand(99,99999);
    }

    public function datos_plan_desarrollo(){

        $sql_datos_plan_desarrollo="SELECT pde_codigo, pde_niveluno, pde_niveldos, 
                                           pde_niveltres, pde_referencianiveluno, 
                                           pde_referencianiveldos
                                      FROM plandesarrollo.plan_desarrollo
                                     WHERE pde_codigo = ".$this->getCodigoPlan().";";

        $query_datos_plan_desarrollo=$this->cnxion->ejecutar($sql_datos_plan_desarrollo);

        while($data_datos_plan_desarrollo=$this->cnxion->obtener_filas($query_datos_plan_desarrollo)){
            $datadatos_plan_desarrollo[]=$data_datos_plan_desarrollo;
        }
        return $datadatos_plan_desarrollo;
    }

    public function subsistema_plan(){

        $sql_subsistema_plan="SELECT sub_codigo, sub_nombre,  
                                     pde_codigo, res_codigo, 
                                     sub_referencia, sub_ref
                                FROM plandesarrollo.subsistema
                               WHERE pde_codigo = ".$this->getCodigoPlan().";";

        $query_subsistema_plan=$this->cnxion->ejecutar($sql_subsistema_plan);

        while($data_subsistema_plan=$this->cnxion->obtener_filas($query_subsistema_plan)){
            $datasubsistema_plan[]=$data_subsistema_plan;
        }
        return $datasubsistema_plan;
    }

    public function codigo_subsistema(){

        $sql_codigo_subsistema="SELECT MAX(sub_codigo) AS codigo_sub  
                                  FROM plandesarrollo.subsistema;";

        $query_codigo_subsistema=$this->cnxion->ejecutar($sql_codigo_subsistema);

        $data_codigo_subsistema=$this->cnxion->obtener_filas($query_codigo_subsistema);

        $codigo_sub = $data_codigo_subsistema['codigo_sub'];

        $cod_registro = $codigo_sub + 1;

        return $cod_registro;
    }

    public function list_proyecto($codigo_subsistema){

        $sql_list_proyecto="SELECT pro_codigo, pro_descripcion, 
                                   res_codigo, pro_referencia, 
                                   pro_numero, pro_objetivo
                              FROM plandesarrollo.proyecto
                             WHERE sub_codigo = $codigo_subsistema;";

        $query_list_proyecto=$this->cnxion->ejecutar($sql_list_proyecto);

        while($data_list_proyecto=$this->cnxion->obtener_filas($query_list_proyecto)){
            $datalist_proyecto[]=$data_list_proyecto;
        }
        return $datalist_proyecto;
    }

    public function codigo_proyecto(){

        $sql_codigo_proyecto="SELECT MAX(pro_codigo) AS codigo_pro  
                                FROM plandesarrollo.proyecto;";

        $query_codigo_proyecto=$this->cnxion->ejecutar($sql_codigo_proyecto);

        $data_codigo_proyecto=$this->cnxion->obtener_filas($query_codigo_proyecto);

        $codigo_pro = $data_codigo_proyecto['codigo_pro'];

        $cod_registro = $codigo_pro + 1;

        return $cod_registro;
    }

    public function list_acciones($codigo_proyecto){

        $sql_list_acciones="SELECT acc_codigo, acc_referencia, acc_descripcion, 
                                   acc_responsable, acc_lineabase, acc_metaresultado, 
                                   acc_proyecto, acc_actoadmin, acc_numerovigencia, 
                                   acc_comportamiento, acc_tendenciapositiva, 
                                   acc_indicador, acc_numero
                              FROM plandesarrollo.accion
                             WHERE acc_proyecto = $codigo_proyecto;";

        $query_list_acciones=$this->cnxion->ejecutar($sql_list_acciones);

        while($data_list_acciones=$this->cnxion->obtener_filas($query_list_acciones)){
            $datalist_acciones[]=$data_list_acciones;
        }
        return $datalist_acciones;
    }

    public function codigo_accion(){

        $sql_codigo_accion="SELECT MAX(acc_codigo) AS codigo_acc  
                                FROM plandesarrollo.accion;";

        $query_codigo_accion=$this->cnxion->ejecutar($sql_codigo_accion);

        $data_codigo_accion=$this->cnxion->obtener_filas($query_codigo_accion);

        $codigo_acc = $data_codigo_accion['codigo_acc'];

        $cod_registro = $codigo_acc + 1;

        return $cod_registro;
    }

    public function actualizar_plan(){

        // echo "---- ".$this->getCodigoPlan();

        $lista_datos_plan = $this->datos_plan_desarrollo();
        foreach ($lista_datos_plan as $dat_lsta_plan) {
            $pde_codigo = $dat_lsta_plan['pde_codigo'];
            $pde_niveluno = $dat_lsta_plan['pde_niveluno'];
            $pde_niveldos = $dat_lsta_plan['pde_niveldos']; 
            $pde_niveltres = $dat_lsta_plan['pde_niveltres'];
            $pde_referencianiveluno = $dat_lsta_plan['pde_referencianiveluno']; 
            $pde_referencianiveldos = $dat_lsta_plan['pde_referencianiveldos'];
        }

        $insert_plandesarrollo="INSERT INTO plandesarrollo.plan_desarrollo(
                                            pde_codigo, 
                                            pde_nombre, 
                                            pde_yearinicio, 
                                            pde_yearfin, 
                                            pde_personacreo, 
                                            pde_personamodifico, 
                                            pde_fechacreo, 
                                            pde_fechamodifico, 
                                            pde_actoadmin,
                                            pde_niveluno, 
                                            pde_niveldos, 
                                            pde_niveltres, 
                                            pde_referencianiveluno, 
                                            pde_referencianiveldos, 
                                            pde_responsable, 
                                            pde_oficina)
                                    VALUES (".$this->codigoPlanDesarrollo.", 
                                            '".$this->getNombre()."', 
                                            ".$this->getYearInicio().", 
                                            ".$this->getYearFin().", 
                                            ".$this->getPersonaSistema().", 
                                            ".$this->getPersonaSistema().",
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getActoAdmin().",
                                            '".$pde_niveluno."', 
                                            '".$pde_niveldos."', 
                                            '".$pde_niveltres."', 
                                            '".$pde_referencianiveluno."', 
                                            '".$pde_referencianiveldos."',
                                            ".$this->getResponsable().", 
                                            ".$this->getOficina().");";

        $this->cnxion->ejecutar($insert_plandesarrollo);

        $insert_ppi="INSERT INTO ppi.estado_ppi_plan(
                                 epp_codigo, 
                                 epp_plan, 
                                 epp_estado, 
                                 epp_fechacreo, 
                                 epp_fechamodifico, 
                                 epp_personacreo, 
                                 epp_personamodifico)
                         VALUES (".$this->codigo_ppi.", 
                                 ".$this->codigoPlanDesarrollo.", 
                                 0, 
                                 NOW(), 
                                 NOW(), 
                                 ".$this->getPersonaSistema().", 
                                 ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insert_ppi);

        /********************* datos subsistemas ********************/
        $list_subsistema_plan = $this->subsistema_plan();
        if($list_subsistema_plan){
            foreach ($list_subsistema_plan as $dat_sbstema) {
                $sub_codigo = $dat_sbstema['sub_codigo'];
                $sub_nombre = $dat_sbstema['sub_nombre'];  
                $res_codigo = $dat_lsta_plan['res_codigo'];
                $sub_referencia = $dat_lsta_plan['sub_referencia'];
                $sub_ref = $dat_lsta_plan['sub_ref'];

                $codigo_subsistema = $this->codigo_subsistema();

                $sql_substma = "INSERT INTO plandesarrollo.subsistema(
                                            sub_codigo, sub_nombre, 
                                            sub_personacreo, sub_personamodifico, 
                                            sub_fechacreo, sub_fechamodifico, 
                                            add_codigo, pde_codigo, res_codigo, 
                                            sub_referencia, sub_ref)
                                    VALUES ($codigo_subsistema, '$sub_nombre', 
                                            ".$this->getPersonaSistema().", ".$this->getPersonaSistema().", 
                                            NOW(), NOW(), 
                                            ".$this->getActoAdmin().", ".$this->codigoPlanDesarrollo.", 0,
                                            '$sub_referencia', '$sub_ref');";

                                            //echo "-- > ".$sql_substma;
                $this->cnxion->ejecutar($sql_substma);

                $lstdo_proyecto = $this->list_proyecto($sub_codigo);
                if($lstdo_proyecto){
                    foreach ($lstdo_proyecto as $dat_prycto) {
                        $pro_codigo = $dat_prycto['pro_codigo'];
                        $pro_descripcion = $dat_prycto['pro_descripcion']; 
                        $res_codigo = $dat_prycto['res_codigo'];
                        $pro_referencia = $dat_prycto['pro_referencia'];
                        $pro_numero = $dat_prycto['pro_numero'];
                        $pro_objetivo = $dat_prycto['pro_objetivo'];

                        $codigo_proyecto = $this->codigo_proyecto();

                        $sql_pryecto = "INSERT INTO plandesarrollo.proyecto(
                                                    pro_codigo, 
                                                    pro_descripcion, 
                                                    sub_codigo, 
                                                    pro_personacreo, 
                                                    pro_personamodifico, 
                                                    pro_fechacreo, 
                                                    pro_fechamodifico, 
                                                    add_codigo, 
                                                    res_codigo, 
                                                    pro_referencia, 
                                                    pro_numero, 
                                                    pro_objetivo)
                                            VALUES ($codigo_proyecto, 
                                                    '$pro_descripcion', 
                                                    $codigo_subsistema, 
                                                    ".$this->getPersonaSistema().", 
                                                    ".$this->getPersonaSistema().", 
                                                    NOW(), 
                                                    NOW(), 
                                                    ".$this->getActoAdmin().", 
                                                    0, 
                                                    '$pro_referencia', 
                                                    $pro_numero, 
                                                    '$pro_objetivo');";

                                                   // echo "-- > ".$sql_pryecto;

                        $this->cnxion->ejecutar($sql_pryecto);

                        $list_accnes = $this->list_acciones($pro_codigo);
                        if($list_accnes){
                            foreach ($list_accnes as $dat_accion) {
                                $acc_codigo = $dat_accion['acc_codigo'];
                                $acc_referencia = $dat_accion['acc_referencia'];
                                $acc_descripcion = $dat_accion['acc_descripcion'];
                                $acc_proyecto = $dat_accion['acc_proyecto'];
                                $acc_actoadmin = $dat_accion['acc_actoadmin'];
                                $acc_numerovigencia = $dat_accion['acc_numerovigencia'];
                                $acc_comportamiento = $dat_accion['acc_comportamiento'];
                                $acc_tendenciapositiva = $dat_accion['acc_tendenciapositiva'];
                                $acc_indicador = $dat_accion['acc_indicador'];
                                $acc_numero = $dat_accion['acc_numero'];

                                $codigo_accion = $this->codigo_accion();

                                $sql_accion = "INSERT INTO plandesarrollo.accion(
                                                           acc_codigo, 
                                                           acc_referencia,
                                                           acc_descripcion, 
                                                           acc_responsable, 
                                                           acc_lineabase, 
                                                           acc_metaresultado, 
                                                           acc_proyecto, 
                                                           acc_personacreo, 
                                                           acc_personamodifico, 
                                                           acc_fechacreo, 
                                                           acc_fechamodifico, 
                                                           acc_actoadmin, 
                                                           acc_numerovigencia, 
                                                           acc_comportamiento, 
                                                           acc_tendenciapositiva, 
                                                           acc_indicador, 
                                                           acc_numero)
                                                   VALUES ($codigo_accion, 
                                                           '$acc_referencia', 
                                                           '$acc_descripcion', 
                                                           0, 
                                                           0, 
                                                           0, 
                                                           $codigo_proyecto, 
                                                           ".$this->getPersonaSistema().", 
                                                           ".$this->getPersonaSistema().", 
                                                           NOW(), 
                                                           NOW(), 
                                                           ".$this->getActoAdmin().", 
                                                           0, 
                                                           0, 
                                                           0, 
                                                           '$acc_indicador', 
                                                           $acc_numero);";

                                //echo "-- > ".$sql_accion;
                                $this->cnxion->ejecutar($sql_accion);
                            }
                        }


                    }
                }
            }
        }

        

        
        return $insertPlanDesarrollo;
    }
}
?>