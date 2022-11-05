<?php 
Class RprteXcelPlnCccion{

    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function subSistemasPlanDesarrollo($codigo_planDesarrollo){

        
        $sql_subSistemasPlanDesarrollo="SELECT sub_codigo, sub_nombre, 
                                    pde_codigo, sub_referencia, sub_ref
                                FROM plandesarrollo.subsistema
                                WHERE pde_codigo=$codigo_planDesarrollo;";

        $resultado_subSistemasPlanDesarrollo=$this->cnxion->ejecutar($sql_subSistemasPlanDesarrollo);

        while ($data_subSistemasPlanDesarrollo = $this->cnxion->obtener_filas($resultado_subSistemasPlanDesarrollo)){
            $datasubSistemasPlanDesarrollo[] = $data_subSistemasPlanDesarrollo;
        }
        return $datasubSistemasPlanDesarrollo;
    }

    public function proyecto_subsistema($sub_codigo){

        $sql_proyecto_subsistema="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                         add_codigo, res_codigo, pro_referencia, 
                                         pro_numero, pro_objetivo
                                    FROM plandesarrollo.proyecto
                                   WHERE sub_codigo = $sub_codigo
                                   ORDER BY pro_numero ASC;";

        $resultado_proyecto_subsistema=$this->cnxion->ejecutar($sql_proyecto_subsistema);

        while ($data_proyecto_subsistema = $this->cnxion->obtener_filas($resultado_proyecto_subsistema)){
            $dataproyecto_subsistema[] = $data_proyecto_subsistema;

        }
        return $dataproyecto_subsistema;
    }


    public function accion_proyecto($pro_codigo){

        $sql_accion_proyecto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                      acc_proyecto, acc_numero
                                 FROM plandesarrollo.accion
                                WHERE acc_proyecto =$pro_codigo
                                ORDER BY acc_numero ASC;";

        $resultado_accion_proyecto=$this->cnxion->ejecutar($sql_accion_proyecto);

        while ($data_accion_proyecto = $this->cnxion->obtener_filas($resultado_accion_proyecto)){
            $dataaccion_proyecto[] = $data_accion_proyecto;
        }
        return $dataaccion_proyecto;
    }

    public function nombreNivelUno($codigo_planDesarrollo){

        $sql_nombreNivelUno="SELECT pde_niveluno
                               FROM plandesarrollo.plan_desarrollo
                              WHERE pde_codigo = $codigo_planDesarrollo;";

        $query_nombreNivelUno=$this->cnxion->ejecutar($sql_nombreNivelUno);

        $data_nombreNivelUno=$this->cnxion->obtener_filas($query_nombreNivelUno);
        
        $pde_niveluno = $data_nombreNivelUno['pde_niveluno'];
        
        return $pde_niveluno;
    }

    public function nombreNivelDos($codigo_planDesarrollo){

        $sql_nombreNivelDos="SELECT pde_niveldos
                                FROM plandesarrollo.plan_desarrollo
                               WHERE pde_codigo=$codigo_planDesarrollo;";

        $resultado_nombreNivelDos=$this->cnxion->ejecutar($sql_nombreNivelDos);

        $data_nombreNivelDos = $this->cnxion->obtener_filas($resultado_nombreNivelDos);

        $pde_niveldos = $data_nombreNivelDos['pde_niveldos'];

        return $pde_niveldos;
    }

    public function nombreNivelTres($codigo_planDesarrollo){

        $sql_nombreNivelTres="SELECT pde_niveltres
                                FROM plandesarrollo.plan_desarrollo
                               WHERE pde_codigo=$codigo_planDesarrollo;";

        $resultado_nombreNivelTres=$this->cnxion->ejecutar($sql_nombreNivelTres);

        $data_nombreNivelTres = $this->cnxion->obtener_filas($resultado_nombreNivelTres);

        $pde_niveltres=$data_nombreNivelTres['pde_niveltres'];

        return $pde_niveltres;
    }

    public function actividadPoai($codigo_Accion, $vigencia){

        $sql_actividadPoai="SELECT acp_codigo, acp_descripcion, acp_accion, 
                                   acp_proyecto, acp_referencia, acp_estado,
                                   acp_fechacreo, acp_fechamodifico, acp_personacreo, 
                                   acp_personamodifico, acp_vigencia, acp_numero,
                                   acp_oficina, acp_cargo, acp_sedeindicador, 
                                   acp_unidad, acp_objetivo
                              FROM planaccion.actividad_poai
                             WHERE acp_accion = $codigo_Accion
                               AND acp_vigencia = $vigencia;";

        $resultado_actividadPoai=$this->cnxion->ejecutar($sql_actividadPoai);

        while ($data_actividadPoai = $this->cnxion->obtener_filas($resultado_actividadPoai)){
            $dataactividadPoai[] = $data_actividadPoai;
        }
        return $dataactividadPoai;
    }

    public function datos_indicador($codigo_indicador){

        $sql_datos_indicador="SELECT ind_codigo, ind_unidadmedida, 
                                     ind_estado, ind_sede, 
                                     sed_nombre
                                FROM plandesarrollo.indicador, 
                                     principal.sedes
                               WHERE ind_sede = sed_codigo
                                 AND ind_codigo = $codigo_indicador;";

        $resultado_datos_indicador=$this->cnxion->ejecutar($sql_datos_indicador);

        while ($data_datos_indicador = $this->cnxion->obtener_filas($resultado_datos_indicador)){
            $datadatos_indicador[] = $data_datos_indicador;
        }
        return $datadatos_indicador;
    }

    public function cantidadCombinar($codigo_actividad){

        $sql_cantidadCombinar="SELECT COUNT(*) AS cantidad_etapas
                                FROM planaccion.poai
                                WHERE acp_codigo=$codigo_actividad;";

        $resultado_cantidadCombinar=$this->cnxion->ejecutar($sql_cantidadCombinar);

        $data_cantidadCombinar = $this->cnxion->obtener_filas($resultado_cantidadCombinar);

        $cantidad_etapas=$data_cantidadCombinar['cantidad_etapas'];

        return $cantidad_etapas;
    }

    public function codigo_presupuestal($clasificador){

        $sql_codigo_presupuestal="SELECT ccp_codigo, ccp_code, ccp_niv, 
                                         ccp_descripcion, ccp_fuente, 
                                         ccp_estado
                                    FROM planaccion.codigo_clasificador_presupuestal
                                   WHERE ccp_codigo = $clasificador;";

        $resultado_codigo_presupuestal=$this->cnxion->ejecutar($sql_codigo_presupuestal);

        $data_codigo_presupuestal = $this->cnxion->obtener_filas($resultado_codigo_presupuestal);

        $ccp_code = $data_codigo_presupuestal['ccp_code'];
        $ccp_descripcion = $data_codigo_presupuestal['ccp_descripcion'];

        return array($ccp_code, $ccp_descripcion);
    }

    public function etapas($codigo_actividad){

        $sql_etapas="SELECT poa_codigo, poa_referencia, poa_objeto, poa_recurso, poa_logro, 
                            poa_numero, poa_vigencia, acp_codigo, poa_logroejecutado,
                            poa_logro*poa_logroejecutado AS avance_esperado, poa_personacreo,
                            poa_codigoclasificadorpresupuestal, poa_dane,
                            poa_descripcionclasificador
                       FROM planaccion.poai
                       WHERE acp_codigo=$codigo_actividad
                       ORDER BY poa_numero ASC;";

        $resultado_etapas=$this->cnxion->ejecutar($sql_etapas);

        while ($data_etapas = $this->cnxion->obtener_filas($resultado_etapas)){
            $dataetapas[] = $data_etapas;
        }
        return $dataetapas;
    }

    public function responsable_etapa($codigo_persona){

        $sql_responsable_etapa="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido
                                  FROM principal.persona
                                 WHERE per_codigo=$codigo_persona;";

        $resultado_responsable_etapa=$this->cnxion->ejecutar($sql_responsable_etapa);

        $data_responsable_etapa = $this->cnxion->obtener_filas($resultado_responsable_etapa);

        $per_nombre=$data_responsable_etapa['per_nombre'];
        $per_primerapellido=$data_responsable_etapa['per_primerapellido'];
        $per_segundoapellido=$data_responsable_etapa['per_segundoapellido'];
        $nombre_completo=$per_nombre.' '.$per_primerapellido.' '.$per_segundoapellido;

        return $nombre_completo;
    }

    public function responsableAccion($codigoAccion){

        $sql_responsableAccion="SELECT aen_codigo, aen_accion, aen_encargado, 
                            per_nombre , per_primerapellido , per_segundoapellido AS encargado
                       FROM planaccion.accion_encargado, principal.persona
                      WHERE aen_encargado=per_codigo
                        AND aen_estado='1'
                        AND aen_accion=$codigoAccion;";

        $resultado_responsableAccion=$this->cnxion->ejecutar($sql_responsableAccion);

        while ($data_responsableAccion = $this->cnxion->obtener_filas($resultado_responsableAccion)){
            $dataresponsableAccion[] = $data_responsableAccion;
        }
        return $dataresponsableAccion;
    }

    public function nombre_cargo($codigo_cargo){

        $sql_nombre_cargo="SELECT car_codigo, car_nombre, car_estado
                             FROM usco.cargo
                            WHERE car_codigo = $codigo_cargo;";

        $resultado_nombre_cargo=$this->cnxion->ejecutar($sql_nombre_cargo);

        $data_nombre_cargo = $this->cnxion->obtener_filas($resultado_nombre_cargo);

        $car_nombre = $data_nombre_cargo['car_nombre'];

        return $car_nombre;
    }

    public function nombre_oficina($codigo_oficina){

        $sql_nombre_oficina="SELECT ofi_codigo, ofi_nombre, ofi_estado
                               FROM usco.oficina
                              WHERE ofi_codigo = $codigo_oficina;";

        $resultado_nombre_oficina=$this->cnxion->ejecutar($sql_nombre_oficina);

        $data_nombre_oficina = $this->cnxion->obtener_filas($resultado_nombre_oficina);
        
        $ofi_nombre = $data_nombre_oficina['ofi_nombre'];

        return $ofi_nombre;
    }

    public function sumaRecursoEtapas($accion_actividad){
            
        $sql_suma="SELECT SUM(poa_recurso) AS recursosuma
                      FROM planaccion.poai
                     WHERE acp_codigo=$accion_actividad;";

        $query_suma=$this->cnxion->ejecutar($sql_suma);

        $data_numero=$this->cnxion->obtener_filas($query_suma);

        $recursoSuma = $data_numero['recursosuma'];
        if($recursoSuma){
            $suma_recurso = $recursoSuma;
        }
        else{
            $suma_recurso = 0; 
        }
        return $recursoSuma;
    }

    public function avanceEsperado($accion_actividad){
        
        $sql_avanceEsperado="SELECT poa_logroejecutado,poa_logro
                               FROM planaccion.poai,planaccion.actividad_poai
                              WHERE planaccion.poai.acp_codigo=planaccion.actividad_poai.acp_codigo
                                AND poa_estado = '1'
                                AND planaccion.poai.acp_codigo=$accion_actividad ";

        $resultado_avanceEsperado=$this->cnxion->ejecutar($sql_avanceEsperado);

        while ($data_avanceEsperado = $this->cnxion->obtener_filas($resultado_avanceEsperado)){
            $dataAvanceEsperado[] = $data_avanceEsperado;
        }
        return $dataAvanceEsperado;
    }
}

?>