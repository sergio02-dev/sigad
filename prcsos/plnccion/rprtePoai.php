<?php
class RprtePoai{
    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function subsistemas($codigo_plandesarrollo){

        $sql_subsistemas="SELECT sub_codigo, sub_nombre,  
                                 add_codigo, pde_codigo, res_codigo, 
                                 sub_referencia, sub_ref
                            FROM plandesarrollo.subsistema
                           WHERE pde_codigo=$codigo_plandesarrollo";

        $resultado_subsistemas=$this->cnxion->ejecutar($sql_subsistemas);

        while ($data_subsistemas = $this->cnxion->obtener_filas($resultado_subsistemas)){
            $datasubsistemas[] = $data_subsistemas;
        }
        return $datasubsistemas;
    }

    public function proyecto($sub_codigo){

        
        $sql_proyecto="SELECT pro_codigo, pro_descripcion, sub_codigo as subsistema,  
                              add_codigo, res_codigo, pro_referencia, 
                              pro_numero, pro_objetivo
                         FROM plandesarrollo.proyecto
                        WHERE sub_codigo=$sub_codigo;";

        $resultado_proyecto=$this->cnxion->ejecutar($sql_proyecto);

        while ($data_proyecto = $this->cnxion->obtener_filas($resultado_proyecto)){
            $dataproyecto[] = $data_proyecto;

        }
        return $dataproyecto;
    }

    public function cantidadAcciones($pro_codigo){
 
        $sql_cantidadAcciones="SELECT COUNT(*) as cantaccion
                                FROM plandesarrollo.accion
                               WHERE acc_proyecto=$pro_codigo;";

        $resultado_cantidadAcciones=$this->cnxion->ejecutar($sql_cantidadAcciones);

        $data_cantidadAcciones = $this->cnxion->obtener_filas($resultado_cantidadAcciones);

        $cantaccion=$data_cantidadAcciones['cantaccion'];

        return $cantaccion;
    }

    public function acciones($pro_codigo){

        $sql_acciones="SELECT acc_codigo, acc_referencia, acc_descripcion,  
                              acc_proyecto, acc_indicador, acc_numero
                         FROM plandesarrollo.accion
                        WHERE acc_proyecto=$pro_codigo;";

        $resultado_acciones=$this->cnxion->ejecutar($sql_acciones);

        while ($data_acciones = $this->cnxion->obtener_filas($resultado_acciones)){
            $dataacciones[] = $data_acciones;
        }
        return $dataacciones;
    }

    public function fuenteFinanciacion(){

        $sql_fuenteFinanciacion="SELECT ffi_codigo, ffi_nombre, ffi_descripcion, ffi_tipofuente
                                   FROM planaccion.fuente_financiacion
                                   ORDER BY ffi_codigo ASC ;";

        $resultado_fuenteFinanciacion=$this->cnxion->ejecutar($sql_fuenteFinanciacion);

        while ($data_fuenteFinanciacion = $this->cnxion->obtener_filas($resultado_fuenteFinanciacion)){
            $datafuenteFinanciacion[] = $data_fuenteFinanciacion;
        }
        return $datafuenteFinanciacion;
    }

    public function valor_accion_fuente($fuente, $vigencia, $accion){
 
        $sql_valor_accion_fuente="SELECT SUM(pte_valor) AS valor 
                                  FROM planaccion.poai_techo
                                 WHERE pte_fuentefinanciacion=$fuente
                                   AND pte_vigencia=$vigencia
                                   AND pte_accion=$accion;";

        $resultado_valor_accion_fuente=$this->cnxion->ejecutar($sql_valor_accion_fuente);

        $data_valor_accion_fuente = $this->cnxion->obtener_filas($resultado_valor_accion_fuente);

        $valor=$data_valor_accion_fuente['valor'];

        return $valor;
    }

    public function nombre_nivel_uno($codigo_plandesarrollo){
 
        $sql_nombre_nivel_uno="SELECT pde_niveluno
                                 FROM plandesarrollo.plan_desarrollo
                                WHERE pde_codigo=$codigo_plandesarrollo;";

        $resultado_nombre_nivel_uno=$this->cnxion->ejecutar($sql_nombre_nivel_uno);

        $data_nombre_nivel_uno = $this->cnxion->obtener_filas($resultado_nombre_nivel_uno);

        $pde_niveluno=$data_nombre_nivel_uno['pde_niveluno'];

        return $pde_niveluno;
    }

    public function totalAsignadoSubsistema($sub_codigo, $vigencia){
 
        $sql_totalAsignadoSubsistema="SELECT SUM(pte_valor) as totalasignado
                                        FROM planaccion.poai_techo, plandesarrollo.accion, plandesarrollo.proyecto
                                       WHERE planaccion.poai_techo.pte_accion=plandesarrollo.accion.acc_codigo
                                         AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                         AND plandesarrollo.proyecto.sub_codigo=$sub_codigo
                                         AND pte_vigencia=$vigencia;";

        $resultado_totalAsignadoSubsistema=$this->cnxion->ejecutar($sql_totalAsignadoSubsistema);

        $data_totalAsignadoSubsistema = $this->cnxion->obtener_filas($resultado_totalAsignadoSubsistema);

        $pde_niveluno=$data_totalAsignadoSubsistema['pde_niveluno'];

        return $pde_niveluno;
    }

    public function totalAsignadoAccion($vigencia, $accion){
 
        $sql_totalAsignadoAccion="SELECT SUM(pte_valor) AS ttalasignadoaccion
                                        FROM planaccion.poai_techo
                                       WHERE pte_vigencia=$vigencia
                                         AND pte_accion=$accion";

        $resultado_totalAsignadoAccion=$this->cnxion->ejecutar($sql_totalAsignadoAccion);

        $data_totalAsignadoAccion= $this->cnxion->obtener_filas($resultado_totalAsignadoAccion);

        $ttalasignadoaccion=$data_totalAsignadoAccion['ttalasignadoaccion'];

        return $ttalasignadoaccion;
    }

    public function pdi_accion($accion, $vigencia){
 
        $sql_pdi_accion="SELECT SUM(ivi_presupuesto) AS pdi_accion 
                            FROM plandesarrollo.indicador_vigencia, plandesarrollo.indicador
                           WHERE plandesarrollo.indicador_vigencia.ivi_indicador=plandesarrollo.indicador.ind_codigo
                             AND plandesarrollo.indicador.ind_accion=$accion
                             AND plandesarrollo.indicador_vigencia.ivi_vigencia=$vigencia;";

        $resultado_pdi_accion=$this->cnxion->ejecutar($sql_pdi_accion);

        $data_pdi_accion= $this->cnxion->obtener_filas($resultado_pdi_accion);

        $pdi_accion=$data_pdi_accion['pdi_accion'];

        return $pdi_accion;
    }

    public function pdi_subsistema($sub_codigo, $vigencia){
 
        $sql_pdi_subsistema="SELECT SUM(ivi_presupuesto) AS pdi_subsistema 
                            FROM plandesarrollo.indicador_vigencia, plandesarrollo.indicador, plandesarrollo.accion,plandesarrollo.proyecto
                            WHERE plandesarrollo.indicador_vigencia.ivi_indicador=plandesarrollo.indicador.ind_codigo
                            AND plandesarrollo.indicador.ind_accion=plandesarrollo.accion.acc_codigo
                            AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                            AND plandesarrollo.proyecto.sub_codigo=$sub_codigo
                            AND plandesarrollo.indicador_vigencia.ivi_vigencia=$vigencia;";

        $resultado_pdi_subsistema=$this->cnxion->ejecutar($sql_pdi_subsistema);

        $data_pdi_subsistema= $this->cnxion->obtener_filas($resultado_pdi_subsistema);

        $pdi_subsistema=$data_pdi_subsistema['pdi_subsistema'];

        return $pdi_subsistema;
    
    }
    
    public function poai_techo_subsistema_fuente($fuente, $vigencia, $sub_codigo){
 
        $sql_poai_techo_subsistema_fuente="SELECT SUM(pte_valor) AS poaitechosubsistema 
                                            FROM planaccion.poai_techo, plandesarrollo.accion, plandesarrollo.proyecto
                                           WHERE planaccion.poai_techo.pte_accion=plandesarrollo.accion.acc_codigo
                                             AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                             AND pte_fuentefinanciacion=$fuente
                                             AND pte_vigencia=$vigencia
                                             AND sub_codigo=$sub_codigo";

        $resultado_poai_techo_subsistema_fuente=$this->cnxion->ejecutar($sql_poai_techo_subsistema_fuente);

        $data_poai_techo_subsistema_fuente= $this->cnxion->obtener_filas($resultado_poai_techo_subsistema_fuente);

        $poaitechosubsistema=$data_poai_techo_subsistema_fuente['poaitechosubsistema'];

        return $poaitechosubsistema;
    }

    public function responsables_accion($acc_codigo){
 
        $sql_responsables_accion="SELECT aen_codigo, aen_accion, aen_encargado, per_nombre,
                                         per_primerapellido, per_segundoapellido
                                    FROM planaccion.accion_encargado, principal.persona
                                   WHERE aen_encargado=per_codigo
                                     AND aen_estado='1'
                                     AND aen_accion=$acc_codigo;";

        $resultado_responsables_accion=$this->cnxion->ejecutar($sql_responsables_accion);

        while ($data_responsables_accion = $this->cnxion->obtener_filas($resultado_responsables_accion)){
            $dataresponsables_accion[] = $data_responsables_accion;
        }
        return $dataresponsables_accion;
    }

    public function rubro_accion($acc_codigo, $vigencia){
 
        $sql_rubro_accion="SELECT rac_rubro
                             FROM planaccion.rubro_accion
                            WHERE rac_accion=$acc_codigo
                              AND rac_vigencia=$vigencia;";

        $resultado_rubro_accion=$this->cnxion->ejecutar($sql_rubro_accion);

        $data_rubro_accion= $this->cnxion->obtener_filas($resultado_rubro_accion);

        $rac_rubro=$data_rubro_accion['rac_rubro'];

        return $rac_rubro;
    }

    public function valor_accion_fuente_facultad($vigencia, $accion){
 
        $sql_valor_accion_fuente_facultad="SELECT SUM(pte_valor) AS valor 
                                            FROM planaccion.poai_techo
                                           WHERE pte_fuentefinanciacion IN(23, 24, 25, 26, 27, 28, 29)
                                             AND pte_vigencia=$vigencia
                                             AND pte_accion=$accion;";

        $resultado_valor_accion_fuente_facultad=$this->cnxion->ejecutar($sql_valor_accion_fuente_facultad);

        $data_valor_accion_fuente_facultad = $this->cnxion->obtener_filas($resultado_valor_accion_fuente_facultad);

        $valor=$data_valor_accion_fuente_facultad['valor'];

        return $valor;
    }

    public function poai_techo_subsistema_fuente_facultad($vigencia, $sub_codigo){
 
        $sql_poai_techo_subsistema_fuente_facultad="SELECT SUM(pte_valor) AS poaitechosubsistema 
                                            FROM planaccion.poai_techo, plandesarrollo.accion, plandesarrollo.proyecto
                                           WHERE planaccion.poai_techo.pte_accion=plandesarrollo.accion.acc_codigo
                                             AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                             AND pte_fuentefinanciacion IN(23, 24, 25, 26, 27, 28, 29)
                                             AND pte_vigencia=$vigencia
                                             AND sub_codigo=$sub_codigo";

        $resultado_poai_techo_subsistema_fuente_facultad=$this->cnxion->ejecutar($sql_poai_techo_subsistema_fuente_facultad);

        $data_poai_techo_subsistema_fuente_facultad= $this->cnxion->obtener_filas($resultado_poai_techo_subsistema_fuente_facultad);

        $poaitechosubsistema=$data_poai_techo_subsistema_fuente_facultad['poaitechosubsistema'];

        return $poaitechosubsistema;
    }



}
?>