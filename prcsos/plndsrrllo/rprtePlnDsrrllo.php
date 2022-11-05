<?php 
include('classPlndsrrllo.php');
Class RprtePlnDsrrllo extends PlanDesarrollo{
    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function nombre_documento($codigo_plan){

        $sql_nombre_documento="SELECT pde_codigo, pde_nombre, 
                                      pde_yearinicio, pde_yearfin
                                 FROM plandesarrollo.plan_desarrollo
                                WHERE pde_codigo = $codigo_plan;";

        $query_nombre_documento=$this->cnxion->ejecutar($sql_nombre_documento);

        $data_nombre_documento=$this->cnxion->obtener_filas($query_nombre_documento);
        
        $pde_yearinicio=$data_nombre_documento['pde_yearinicio'];
        $pde_yearfin=$data_nombre_documento['pde_yearfin'];

        $nmbre = "PDI".$pde_yearinicio."_".$pde_yearfin;
        
        return $nmbre;
    }

    public function subSistemasPlanDesarrollo(){

        
        $sql_subSistemasPlanDesarrollo="SELECT sub_codigo, sub_nombre, 
                                    pde_codigo, sub_referencia, sub_ref
                                FROM plandesarrollo.subsistema
                                WHERE pde_codigo=".$this->getCodigoPlanDesarrollo()."
                                ORDER BY sub_codigo ASC;";

        $resultado_subSistemasPlanDesarrollo=$this->cnxion->ejecutar($sql_subSistemasPlanDesarrollo);

        while ($data_subSistemasPlanDesarrollo = $this->cnxion->obtener_filas($resultado_subSistemasPlanDesarrollo)){
            $datasubSistemasPlanDesarrollo[] = $data_subSistemasPlanDesarrollo;

        }
        return $datasubSistemasPlanDesarrollo;
    }

    public function subSstmasPlanDsrrllo($sub_sistema){

        
        $sql_subSistemasPlanDesarrollo="SELECT sub_codigo, sub_nombre, 
                                               pde_codigo, sub_referencia, sub_ref
                                          FROM plandesarrollo.subsistema
                                         WHERE pde_codigo=".$this->getCodigoPlanDesarrollo()."
                                           AND sub_codigo = $sub_sistema;";

        $resultado_subSistemasPlanDesarrollo=$this->cnxion->ejecutar($sql_subSistemasPlanDesarrollo);

        while ($data_subSistemasPlanDesarrollo = $this->cnxion->obtener_filas($resultado_subSistemasPlanDesarrollo)){
            $datasubSistemasPlanDesarrollo[] = $data_subSistemasPlanDesarrollo;

        }
        return $datasubSistemasPlanDesarrollo;
    }

    public function proyectosSubsistema($sub_codigo){
        
        $sql_proyectosSubsistema="SELECT pro_codigo, pro_descripcion, sub_codigo,  add_codigo, res_codigo, pro_referencia, 
                                                pro_numero, pro_objetivo
                                        FROM plandesarrollo.proyecto
                                        WHERE sub_codigo=$sub_codigo
                                        ORDER BY pro_codigo ASC";

        $resultado_proyectosSubsistema=$this->cnxion->ejecutar($sql_proyectosSubsistema);

        while ($data_proyectosSubsistema = $this->cnxion->obtener_filas($resultado_proyectosSubsistema)){
            $dataproyectosSubsistema[] = $data_proyectosSubsistema;

        }
        return $dataproyectosSubsistema;
    }

    public function pryctosSbsstema($sub_codigo, $proyecto_sub){
        
        $sql_proyectosSubsistema="SELECT pro_codigo, pro_descripcion, sub_codigo,  add_codigo, res_codigo, pro_referencia, 
                                         pro_numero, pro_objetivo
                                    FROM plandesarrollo.proyecto
                                   WHERE sub_codigo=$sub_codigo
                                     AND pro_codigo = $proyecto_sub
                                     ORDER BY pro_codigo ASC";

        $resultado_proyectosSubsistema=$this->cnxion->ejecutar($sql_proyectosSubsistema);

        while ($data_proyectosSubsistema = $this->cnxion->obtener_filas($resultado_proyectosSubsistema)){
            $dataproyectosSubsistema[] = $data_proyectosSubsistema;

        }
        return $dataproyectosSubsistema;
    }

    public function nivelUnoNombre(){

        $sqlnivelUnoNombre="SELECT pde_niveluno
                              FROM plandesarrollo.plan_desarrollo
                             WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querynivelUnoNombre=$this->cnxion->ejecutar($sqlnivelUnoNombre);

        $data_nivelUnoNombre=$this->cnxion->obtener_filas($querynivelUnoNombre);
        
        $pde_niveluno=$data_nivelUnoNombre['pde_niveluno'];
        
        return $pde_niveluno;
    }

    public function nivelDosNombre(){

        $sqlnivelDosNombre="SELECT pde_niveldos
                        FROM plandesarrollo.plan_desarrollo
                        WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querynivelDosNombre=$this->cnxion->ejecutar($sqlnivelDosNombre);

        $data_nivelDosNombre=$this->cnxion->obtener_filas($querynivelDosNombre);
        
        $pde_niveldos=$data_nivelDosNombre['pde_niveldos'];
        
        return $pde_niveldos;
    }

    public function nivelTresNombre(){

        $sqlnivelTresNombre="SELECT pde_niveltres
                        FROM plandesarrollo.plan_desarrollo
                        WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querynivelTresNombre=$this->cnxion->ejecutar($sqlnivelTresNombre);

        $data_nivelTresNombre=$this->cnxion->obtener_filas($querynivelTresNombre);
        
        $pde_niveltres=$data_nivelTresNombre['pde_niveltres'];
        
        return $pde_niveltres;
    }

    public function PlanDesarrolloDatos(){

        $sqlPlanDesarrolloDatos="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin, pde_personacreo, 
                                   pde_personamodifico, pde_fechacreo, pde_fechamodifico, pde_actoadmin,
                                   pde_niveluno, pde_niveldos, pde_niveltres, pde_referencianiveluno,
                                   pde_referencianiveldos, pde_responsable
                             FROM plandesarrollo.plan_desarrollo
                             WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $queryPlanDesarrolloDatos=$this->cnxion->ejecutar($sqlPlanDesarrolloDatos);

        $data_PlanDesarrolloDatos=$this->cnxion->obtener_filas($queryPlanDesarrolloDatos);
        
        $yearinicio=$data_PlanDesarrolloDatos['pde_yearinicio'];
        $yearfin=$data_PlanDesarrolloDatos['pde_yearfin'];

        return $yearinicio."-".$yearfin;
    }

    public function accionProyecto($proyecto){
        
        $sql_accionProyecto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_proyecto, 
                                    acc_numero, acc_lineabase, acc_metaresultado
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=$proyecto;";

        $resultado_accionProyecto=$this->cnxion->ejecutar($sql_accionProyecto);

        while ($data_accionProyecto = $this->cnxion->obtener_filas($resultado_accionProyecto)){
            $dataaccionProyecto[] = $data_accionProyecto;
        }
        return $dataaccionProyecto;
    }

    public function accion_indicador($proyecto){
        
        $sql_accion_indicador="SELECT acc_codigo, acc_referencia, acc_descripcion, 
                                      acc_lineabase, acc_metaresultado, acc_proyecto, 
                                      acc_numero, ind_codigo, ind_unidadmedida, 
                                      ind_lineabase, ind_metaresultado, ind_accion,
                                      ind_sede
                                 FROM plandesarrollo.accion, plandesarrollo.indicador
                                WHERE acc_codigo = ind_accion
                                  AND acc_proyecto = $proyecto
                                ORDER BY acc_numero, ind_fechacreo ASC";

        $resultado_accion_indicador=$this->cnxion->ejecutar($sql_accion_indicador);

        while ($data_accion_indicador = $this->cnxion->obtener_filas($resultado_accion_indicador)){
            $dataaccion_indicador[] = $data_accion_indicador;
        }
        return $dataaccion_indicador;
    }


    public function indicadorAccion($codigo_accion){

        
        $sql_indicadorAccion="SELECT ind_codigo, ind_unidadmedida, ind_lineabase, ind_metaresultado, 
                                        ind_accion, ind_estado, ind_tipocomportamiento, ind_tendencia
                                FROM plandesarrollo.indicador
                                WHERE ind_estado='1'
                                AND ind_accion=$codigo_accion;";

        $resultado_indicadorAccion=$this->cnxion->ejecutar($sql_indicadorAccion);

        while ($data_indicadorAccion = $this->cnxion->obtener_filas($resultado_indicadorAccion)){
            $dataindicadorAccion[] = $data_indicadorAccion;
        }
        return $dataindicadorAccion;
    }

    public function indicadorVigencia($indicador, $vigencia){

        $sqlindicadorVigencia="SELECT ivi_codigo, ivi_indicador, ivi_valorlogrado, ivi_presupuesto, 
                                        ivi_vigencia, ivi_estado
                                FROM plandesarrollo.indicador_vigencia
                                WHERE ivi_estado='1'
                                AND ivi_indicador=$indicador
                                AND ivi_vigencia=$vigencia;";

        $queryindicadorVigencia=$this->cnxion->ejecutar($sqlindicadorVigencia);

        $data_indicadorVigencia=$this->cnxion->obtener_filas($queryindicadorVigencia);
        
        $ivi_valorlogrado=$data_indicadorVigencia['ivi_valorlogrado'];
        $ivi_presupuesto=$data_indicadorVigencia['ivi_presupuesto'];

        return $ivi_valorlogrado."-".$ivi_presupuesto;

        //return $sqlindicadorVigencia;
    }

    public function valorProyectoVigencia($proyecto, $vigencia){

        $sqlvalorProyectoVigencia="SELECT SUM(ivi_presupuesto) AS presupuesto_proyecto
                            FROM plandesarrollo.indicador_vigencia, plandesarrollo.indicador, plandesarrollo.accion
                            WHERE ivi_indicador=ind_codigo
                            AND ind_accion=acc_codigo
                            AND ivi_estado='1'
                            AND ind_estado='1'
                            AND ivi_vigencia=$vigencia
                            AND acc_proyecto=$proyecto";

        $queryvalorProyectoVigencia=$this->cnxion->ejecutar($sqlvalorProyectoVigencia);

        $data_valorProyectoVigencia=$this->cnxion->obtener_filas($queryvalorProyectoVigencia);
        
        $presupuesto_proyecto=$data_valorProyectoVigencia['presupuesto_proyecto'];

        return $presupuesto_proyecto;
    }

    public function valor_vigencia_accion($codigo_accion, $vigencia){

        $sql_valor_vigencia_accion="SELECT mpr_codigo, mpr_accion, 
                                           mpr_vigencia, mpr_valoresperado
                                      FROM plandesarrollo.meta_producto
                                     WHERE mpr_accion = $codigo_accion
                                       AND mpr_vigencia = $vigencia;";

        $query_valor_vigencia_accion=$this->cnxion->ejecutar($sql_valor_vigencia_accion);

        $data_valor_vigencia_accion=$this->cnxion->obtener_filas($query_valor_vigencia_accion);
        
        $mpr_valoresperado=$data_valor_vigencia_accion['mpr_valoresperado'];

        return $mpr_valoresperado;
    }


    public function valor_proyecto_plan_antiguo($proyecto, $vigencia){

        $sql_valor_proyecto_plan_antiguo="SELECT pco_codigo, pco_proyecto, pco_vigencia, pco_valor
                                            FROM plandesarrollo.proyecto_costo2019
                                           WHERE pco_proyecto = $proyecto
                                             AND pco_vigencia = $vigencia;";

        $query_valor_proyecto_plan_antiguo=$this->cnxion->ejecutar($sql_valor_proyecto_plan_antiguo);

        $data_valor_proyecto_plan_antiguo=$this->cnxion->obtener_filas($query_valor_proyecto_plan_antiguo);
        
        $pco_valor=$data_valor_proyecto_plan_antiguo['pco_valor'];

        return $pco_valor;
    }

    public function nombre_sede($codigo_sede){

        $sql_nombre_sede="SELECT sed_codigo, sed_nombre, sed_estado
                            FROM principal.sedes
                           WHERE sed_codigo = $codigo_sede;";

        $query_nombre_sede=$this->cnxion->ejecutar($sql_nombre_sede);

        $data_nombre_sede=$this->cnxion->obtener_filas($query_nombre_sede);
        
        $sed_nombre = $data_nombre_sede['sed_nombre'];

        return $sed_nombre;
    }

    public function sigla_nivel_uno($codigo_subsistema){

        $sql_sigla_nivel_uno="SELECT sub_codigo, sub_nombre, 
                                     sub_referencia, sub_ref
                                FROM plandesarrollo.subsistema
                               WHERE sub_codigo = $codigo_subsistema;";

        $query_sigla_nivel_uno=$this->cnxion->ejecutar($sql_sigla_nivel_uno);

        $data_sigla_nivel_uno=$this->cnxion->obtener_filas($query_sigla_nivel_uno);
        
        $sub_referencia = $data_sigla_nivel_uno['sub_referencia'];
        $sub_ref = $data_sigla_nivel_uno['sub_ref'];

        $ref_nivel_uno = $sub_referencia.$sub_ref;

        return $ref_nivel_uno;
    }

    public function sigla_nivel_dos($codigo_proyecto){

        $sql_sigla_nivel_dos="SELECT pro_codigo, pro_referencia, pro_numero
                                FROM plandesarrollo.proyecto
                               WHERE pro_codigo = $codigo_proyecto;";

        $query_sigla_nivel_dos=$this->cnxion->ejecutar($sql_sigla_nivel_dos);

        $data_sigla_nivel_dos=$this->cnxion->obtener_filas($query_sigla_nivel_dos);
        
        $pro_referencia = $data_sigla_nivel_dos['pro_referencia'];
        $pro_numero = $data_sigla_nivel_dos['pro_numero'];

        $ref_nivel_dos = $pro_referencia.".".$pro_numero;

        return $ref_nivel_dos;
    }


}
?>