<?php

    Class RprteSlctudCdp{
    
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        } 

        /*public function nombrePersona($codigo_cdp){
            $sql_nombrePersona="SELECT  scdp_resolucion, scdp_fecharesolucion, scdp_resolucion,scdp_objeto, scdp_numero,scdp_consecutivo
                                  FROM cdp.solicitud_cdp
                            INNER JOIN usco.resolucion_persona ON scdp_resolucion = rep_resolucion
                            INNER JOIN usco.vinculacion ON rep_persona = vin_persona 
                            INNER JOIN principal.persona ON vin_persona = per_codigo
                                          WHERE scdp_codigo = $codigo_cdp;";

            $query_nombrePersona=$this->cnxion->ejecutar($sql_nombrePersona);

            $data_nombrePersona=$this->cnxion->obtener_filas($query_nombrePersona);

            $sql_suma_valor_solicitud="SELECT SUM(aso_valor) AS valor_cdp
            FROM cdp.asignacion_solicitud
           WHERE aso_solicitud = $codigo_cdp;";

            $query_suma_valor_solicitud=$this->cnxion->ejecutar($sql_suma_valor_solicitud);

            $data_suma_valor_solicitud=$this->cnxion->obtener_filas($query_suma_valor_solicitud);

            $valor_cdp = $data_suma_valor_solicitud['valor_cdp'];
            
            $per_nombre=$data_nombrePersona['per_nombre'];
            $per_primerapellido=$data_nombrePersona['per_primerapellido'];
            $per_segundoapellido=$data_nombrePersona['per_segundoapellido'];
            $scdp_resolucion = $data_nombrePersona['scdp_resolucion'];
            $scdp_fecharesolucion = date('d/m/Y',strtotime($data_nombrePersona['scdp_fecharesolucion']));
            $scdp_objeto = $data_nombrePersona['scdp_objeto'];
            $scdp_numero = $data_nombrePersona['scdp_numero'];
            $scdp_consecutivo = $data_nombrePersona['scdp_consecutivo'];
            

            $people=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

            return array($people,$scdp_resolucion,$scdp_fecharesolucion,$scdp_objeto,$scdp_consecutivo,$scdp_numero, $valor_cdp);

        }*/

        
        public function cargo_nombre($codigo_cdp){

            $sql_cargoPersona="SELECT car_nombre
                                 FROM cdp.solicitud_cdp
                           INNER JOIN usco.responsable ON scdp_oficina = res_codigooficina
                           INNER JOIN usco.vinculacion ON res_codigooficina = vin_oficina
                           INNER JOIN usco.cargo ON vin_cargo = car_codigo 
                           INNER JOIN usco.resolucion_persona ON vin_persona = rep_persona
                                WHERE scdp_codigo = $codigo_cdp
                                  AND scdp_accion = res_codigonivel
                                  AND res_tiporesponsable = 2
                                  AND res_nivel = 3
                                  AND res_estado = 1
                                  AND vin_estado =1
                                  AND car_estado = 1;";
            
            $query_cargoPersona=$this->cnxion->ejecutar($sql_cargoPersona);

            $data_cargoPersona=$this->cnxion->obtener_filas($query_cargoPersona);

            $car_nombre=$data_cargoPersona['car_nombre'];
    
            return $car_nombre;
        }

       

        public function poai($codigo_cdp){

            $sql_poai="SELECT poa_referencia, poa_numero , esc_valor, esc_clasificador, esc_dane, esc_deq
                                  FROM cdp.etapa_solicitud_clasificador
                                  INNER JOIN planaccion.poai ON esc_etapa = poa_codigo
                                  WHERE esc_solicitud = $codigo_cdp
                                  ORDER BY poa_referencia,poa_numero;";
            
            
    
            $resultado_poai=$this->cnxion->ejecutar($sql_poai);
    
            while ($data_poai = $this->cnxion->obtener_filas($resultado_poai)){
                $datapoai[] = $data_poai;
            }
            return $datapoai;
        }
        
        public function fuentes_financiacionCDP($ultimos_caracteres){

            $sql_fuentes_financiacionCDP="SELECT fup_nombre
                                    FROM usco.fuentes_presupuesto 
                                   WHERE fup_linix = $ultimos_caracteres;  ";

            $resultado_fuentes_financiacionCDP = $this->cnxion->ejecutar($sql_fuentes_financiacionCDP);
    
            $data_fuentes_financiacionCDP = $this->cnxion->obtener_filas($resultado_fuentes_financiacionCDP);

            $pde_fuentes_financiacionCDP = $data_fuentes_financiacionCDP['fup_nombre'];

            return $pde_fuentes_financiacionCDP;
        }


        public function resolucionPersona($codigo_cdp){        

            $sql_resolucionPersona = "SELECT res_codigo, res_codigooficina, res_codigocargo 
                                        FROM usco.responsable
                                       WHERE res_codigo IN(SELECT ror_ordenador 
                                                             FROM usco.responsable, usco.vinculacion, usco.registro_ordenador, cdp.solicitud_cdp

                                                            WHERE res_codigo = ror_registro
                                                             AND  vin_cargo = res_codigocargo
                                                              AND vin_oficina = res_codigooficina
                                                              AND res_nivel = 3
                                                              AND res_tiporesponsable = 1
                                                              AND res_codigonivel = scdp_accion
                                                              AND vin_persona = ".$_SESSION['idusuario']."
                                                              AND vin_estado = 1);";
        
    
            $resultado_resolucionPersona = $this->cnxion->ejecutar($sql_resolucionPersona);
    
            $data_resolucionPersona= $this->cnxion->obtener_filas($resultado_resolucionPersona);
    
            $numero_filas= $this->cnxion->numero_filas($resultado_resolucionPersona);
    
            if($numero_filas == 0){
                $res_codigooficina= 0;
                $res_codigocargo = 0;
            }
            else{
                $res_codigooficina= $data_resolucionPersona['res_codigooficina'];
                $res_codigocargo = $data_resolucionPersona['res_codigocargo'];
            }
            
           
    
            $sql_resolucionOrdenador = "SELECT rep_fecharesolucion, rep_resolucion, 
                                               per_nombre, per_primerapellido, per_segundoapellido ,
                                               scdp_resolucion, scdp_fecharesolucion, scdp_resolucion,scdp_objeto, scdp_numero,scdp_consecutivo,per_codigo, vin_cargo,car_nombre
                                          FROM usco.vinculacion
                                    INNER JOIN principal.persona ON vin_persona = per_codigo
                                    INNER JOIN usco.resolucion_persona ON per_codigo = rep_persona
                                    INNER JOIN cdp.solicitud_cdp ON  scdp_resolucion = rep_resolucion
                                    INNER JOIN usco.cargo ON vin_cargo = car_codigo 
                                         WHERE vin_cargo = $res_codigocargo
                                           AND scdp_codigo = $codigo_cdp
                                           AND vin_oficina = $res_codigooficina
                                           AND rep_estado = 1;";
    
            $resultado_resolucionOrdenador = $this->cnxion->ejecutar($sql_resolucionOrdenador);
    
            $data_resolucionOrdenador= $this->cnxion->obtener_filas($resultado_resolucionOrdenador);

            $sql_suma_valor_solicitud="SELECT SUM(aso_valor) AS valor_cdp
            FROM cdp.asignacion_solicitud
           WHERE aso_solicitud = $codigo_cdp;";


            $query_suma_valor_solicitud=$this->cnxion->ejecutar($sql_suma_valor_solicitud);

            $data_suma_valor_solicitud=$this->cnxion->obtener_filas($query_suma_valor_solicitud);

            $valor_cdp = $data_suma_valor_solicitud['valor_cdp'];
            
            $scdp_resolucion = $data_resolucionOrdenador['scdp_resolucion'];
            $scdp_fecharesolucion = date('d/m/Y',strtotime($data_resolucionOrdenador['scdp_fecharesolucion']));
            $scdp_objeto = $data_resolucionOrdenador['scdp_objeto'];
            $scdp_numero = $data_resolucionOrdenador['scdp_numero'];
            $scdp_consecutivo = $data_resolucionOrdenador['scdp_consecutivo'];
            

            $per_nombre = $data_resolucionOrdenador['per_nombre'];
            $per_primerapellido = $data_resolucionOrdenador['per_primerapellido'];
            $per_segundoapellido = $data_resolucionOrdenador['per_segundoapellido'];
            $car_nombre = $data_resolucionOrdenador['car_nombre'];


         
            $people=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;
           
    
            return array($people,$car_nombre,$scdp_resolucion,$scdp_fecharesolucion,$scdp_numero,$scdp_consecutivo,$scdp_objeto,$valor_cdp);
     
        }

        






        public function subsstema($codigo_planDesarrollo, $sub_sistema){

        
            $sql_subsstema="SELECT sub_codigo, sub_nombre, 
                                   pde_codigo, sub_referencia, sub_ref
                              FROM plandesarrollo.subsistema
                             WHERE pde_codigo = $codigo_planDesarrollo
                               AND sub_codigo = $sub_sistema;";
    
            $resultado_subsstema=$this->cnxion->ejecutar($sql_subsstema);
    
            while ($data_subsstema = $this->cnxion->obtener_filas($resultado_subsstema)){
                $datasubsstema[] = $data_subsstema;
            }
            return $datasubsstema;
        }

        public function list_proyecto($sub_codigo, $proyecto_code){

            $sql_list_proyecto="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                       add_codigo, res_codigo, pro_referencia, 
                                       pro_numero, pro_objetivo
                                  FROM plandesarrollo.proyecto
                                 WHERE sub_codigo = $sub_codigo
                                   AND pro_codigo = $proyecto_code
                                 ORDER BY pro_numero ASC;";

            $resultado_list_proyecto = $this->cnxion->ejecutar($sql_list_proyecto);
    
            while ($data_list_proyecto = $this->cnxion->obtener_filas($resultado_list_proyecto)){
                $datalist_proyecto[] = $data_list_proyecto;
            }
            return $datalist_proyecto;
        }

        public function nmbre_nvel_tres($codigo_proyecto){

            $sql_nmbre_nvel_tres="SELECT pro_codigo, pde_niveltres
                                    FROM plandesarrollo.proyecto
                                   INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                   INNER JOIN plandesarrollo.plan_desarrollo ON plandesarrollo.subsistema.pde_codigo = plandesarrollo.plan_desarrollo.pde_codigo
                                   WHERE pro_codigo = $codigo_proyecto";

            $resultado_nmbre_nvel_tres = $this->cnxion->ejecutar($sql_nmbre_nvel_tres);
    
            $data_nmbre_nvel_tres = $this->cnxion->obtener_filas($resultado_nmbre_nvel_tres);

            $pde_niveltres = $data_nmbre_nvel_tres['pde_niveltres'];

            return $pde_niveltres;
        }

        public function list_acciones($proyecto_codigo){

            $sql_list_acciones="SELECT acc_codigo, acc_referencia, 
                                       acc_numero, acc_descripcion, 
                                       acc_proyecto
                                  FROM plandesarrollo.accion
                                 WHERE acc_proyecto = $proyecto_codigo
                                 ORDER BY acc_numero ASC;";

            $resultado_list_acciones = $this->cnxion->ejecutar($sql_list_acciones);
    
            while ($data_list_acciones = $this->cnxion->obtener_filas($resultado_list_acciones)){
                $datalist_acciones[] = $data_list_acciones;
            }
            return $datalist_acciones;
        }

        public function list_actividades($codigo_accion){

            $sql_list_actividades="SELECT acp_codigo, acp_referencia, acp_numero, 
                                          acp_descripcion, acp_accion
                                     FROM planaccion.actividad_poai
                                    WHERE acp_estado = '1'
                                      AND acp_accion = $codigo_accion
                                    ORDER BY acp_numero ASC;";

            $resultado_list_actividades = $this->cnxion->ejecutar($sql_list_actividades);
    
            while ($data_list_actividades = $this->cnxion->obtener_filas($resultado_list_actividades)){
                $datalist_actividades[] = $data_list_actividades;

            }
            return $datalist_actividades;
        }

        public function accion_prycto($pro_codigo, $codigo_accion){

            $sql_accion_prycto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                       acc_proyecto, acc_numero
                                  FROM plandesarrollo.accion
                                 WHERE acc_proyecto = $pro_codigo
                                   AND acc_codigo = $codigo_accion;";
    
            $resultado_accion_prycto=$this->cnxion->ejecutar($sql_accion_prycto);
    
            while ($data_accion_prycto = $this->cnxion->obtener_filas($resultado_accion_prycto)){
                $dataaccion_prycto[] = $data_accion_prycto;
            }
            return $dataaccion_prycto;
        }

        public function actvdadPoai($codigo_Accion, $vigencia, $codigo_actividad){

            $sql_actividadPoai="SELECT acp_codigo, acp_descripcion, acp_accion, 
                                       acp_proyecto, acp_referencia, acp_estado,
                                       acp_fechacreo, acp_fechamodifico, acp_personacreo, 
                                       acp_personamodifico, acp_vigencia, acp_numero,
                                       acp_oficina, acp_cargo, acp_sedeindicador, 
                                       acp_unidad, acp_objetivo
                                  FROM planaccion.actividad_poai
                                 WHERE acp_accion = $codigo_Accion
                                   AND acp_vigencia = $vigencia
                                   AND acp_codigo = $codigo_actividad;";
    
            $resultado_actividadPoai=$this->cnxion->ejecutar($sql_actividadPoai);
    
            while ($data_actividadPoai = $this->cnxion->obtener_filas($resultado_actividadPoai)){
                $dataactividadPoai[] = $data_actividadPoai;
            }
            return $dataactividadPoai;
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

        public function sigla_nivel_tres($codigo_accion){
    
            $sql_sigla_nivel_tres="SELECT acc_codigo, acc_referencia, acc_numero
                                     FROM plandesarrollo.accion
                                    WHERE acc_codigo = $codigo_accion;";
    
            $query_sigla_nivel_tres=$this->cnxion->ejecutar($sql_sigla_nivel_tres);
    
            $data_sigla_nivel_tres=$this->cnxion->obtener_filas($query_sigla_nivel_tres);
            
            $acc_referencia = $data_sigla_nivel_tres['acc_referencia'];
            $acc_numero = $data_sigla_nivel_tres['acc_numero'];
    
            $ref_nivel_tres = $acc_referencia.".".$acc_numero;
    
            return $ref_nivel_tres;
        }

        public function sigla_nivel_cuatro($codigo_actividad){
    
            $sql_sigla_nivel_cuatro="SELECT acp_codigo, acp_referencia, acp_numero
                                       FROM planaccion.actividad_poai
                                      WHERE acp_codigo = $codigo_actividad;";
    
            $query_sigla_nivel_cuatro=$this->cnxion->ejecutar($sql_sigla_nivel_cuatro);
    
            $data_sigla_nivel_cuatro=$this->cnxion->obtener_filas($query_sigla_nivel_cuatro);
            
            $acp_referencia = $data_sigla_nivel_cuatro['acp_referencia'];
            $acp_numero = $data_sigla_nivel_cuatro['acp_numero'];
    
            $ref_nivel_cuatro = $acp_referencia.".".$acp_numero;
    
            return $ref_nivel_cuatro;
        }

    }

?>