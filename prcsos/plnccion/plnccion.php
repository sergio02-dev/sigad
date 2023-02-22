<?php
    class PlnCcion{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function personaResponsable(){

            $personaSistema = $_SESSION['idusuario'];

            $sql_personaResponsable="SELECT per_codigo, per_nombre
                                FROM principal.persona
                                WHERE per_codigo=$personaSistema;";
            $resultado_personaResponsable=$this->cnxion->ejecutar($sql_personaResponsable);

            $data_personaResponsable = $this->cnxion->obtener_filas($resultado_personaResponsable);

            $per_nombre=$data_personaResponsable['per_nombre'];

            return $per_nombre;
        }

        public function acciones_ver(){

            $sql_acciones_ver="SELECT acc_codigo
                                FROM plandesarrollo.accion, planaccion.accion_encargado
                                WHERE plandesarrollo.accion.acc_codigo=planaccion.accion_encargado.aen_accion
                                AND aen_estado='1'
                                AND aen_encargado=".$_SESSION['idusuario'];

            $resulatdo_accion_ver=$this->cnxion->ejecutar($sql_acciones_ver);

            while($data_accion_ver =$this->cnxion->obtener_filas($resulatdo_accion_ver)){
                $dataaccion_ver[]=$data_accion_ver;
            }
            return $dataaccion_ver;
        }

        /*public function plan_accion_consulta($codigo_planaccion){
            
            if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
                $condicion_encargado="";
            }
            else{
                $acciones=$this->acciones_ver();
                if($acciones){
                    $num=1;
                    $cantidad=count($acciones);
                    $acciones_show="";
                    foreach ($acciones as $data_acciones_ver) {
                        $acc_codigo=$data_acciones_ver['acc_codigo'];
    
                        if($num==$cantidad){
                            $coma="";
                        }
                        else{
                            $coma=",";
                        }
                        $accon=$acc_codigo.$coma;
                        $acciones_show=$acciones_show.$accon;
                        $num++;
                    }
                }
                else{
                   $acciones_show=0; 
                }
                $condicion_encargado="AND plandesarrollo.accion.acc_codigo IN($acciones_show)";
            }
            $sql_plan_accion="SELECT  DISTINCT  plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  sub_nombre,pro_descripcion,acc_descripcion,acc_referencia,acc_numero,
                              plandesarrollo.subsistema.sub_codigo,plandesarrollo.proyecto.pro_codigo,plandesarrollo.accion.acc_codigo
                              FROM plandesarrollo.plan_desarrollo,plandesarrollo.subsistema,plandesarrollo.proyecto,plandesarrollo.accion
                              WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                              $condicion_encargado";
            $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

            while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
                $dataplan_accion[] = $data_plan_accion;

            }

            return $dataplan_accion;
        }*/

        public function plan_accion_consulta($codigo_planaccion){

            $codigo_session = $_SESSION['idusuario'];
            
            if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
                $sql_plan_accion="SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                                  sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                                  acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                                  plandesarrollo.proyecto.pro_codigo, 
                                                  plandesarrollo.accion.acc_codigo
                                             FROM plandesarrollo.plan_desarrollo,
                                                  plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto,
                                                  plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion";
            }
            else{
                $sql_plan_accion="SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                                  sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                                  acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                                  plandesarrollo.proyecto.pro_codigo, 
                                                  plandesarrollo.accion.acc_codigo
                                             FROM plandesarrollo.plan_desarrollo,
                                                  plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto,
                                                  plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                                              AND plandesarrollo.subsistema.sub_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                            FROM usco.vinculacion, usco.responsable
                                                                                            WHERE vin_persona = $codigo_session
                                                                                            AND res_codigocargo = vin_cargo
                                                                                            AND vin_oficina = res_codigooficina
                                                                                            AND res_estado = 1
                                                                                            AND vin_estado = 1
                                                                                            AND res_nivel = 1)
                                  UNION 
                                  SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                                  sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                                  acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                                  plandesarrollo.proyecto.pro_codigo, 
                                                  plandesarrollo.accion.acc_codigo
                                             FROM plandesarrollo.plan_desarrollo,
                                                  plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto,
                                                  plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                                              AND plandesarrollo.proyecto.pro_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                            FROM usco.vinculacion, usco.responsable
                                                                                            WHERE vin_persona = $codigo_session
                                                                                            AND res_codigocargo = vin_cargo
                                                                                            AND vin_oficina = res_codigooficina
                                                                                            AND res_estado = 1
                                                                                            AND vin_estado = 1
                                                                                            AND res_nivel = 2)
                                 UNION 
                                 SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                                  sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                                  acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                                  plandesarrollo.proyecto.pro_codigo, 
                                                  plandesarrollo.accion.acc_codigo
                                             FROM plandesarrollo.plan_desarrollo,
                                                  plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto,
                                                  plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                                              AND  plandesarrollo.accion.acc_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                            FROM usco.vinculacion, usco.responsable
                                                                                            WHERE vin_persona = $codigo_session
                                                                                            AND res_codigocargo = vin_cargo
                                                                                            AND vin_oficina = res_codigooficina
                                                                                            AND res_estado = 1
                                                                                            AND vin_estado = 1
                                                                                            AND res_nivel = 3)";
                
            }
            
                             
            $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

            while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
                $dataplan_accion[] = $data_plan_accion;

            }

            return $dataplan_accion;
        }

        public function contratacion($codigo_planaccion){

           
            $sql_plan_accion="SELECT  DISTINCT  plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  sub_nombre,pro_descripcion,acc_descripcion,acc_referencia,acc_numero,
                               plandesarrollo.subsistema.sub_codigo, plandesarrollo.proyecto.pro_codigo, plandesarrollo.accion.acc_codigo
                              FROM plandesarrollo.plan_desarrollo,plandesarrollo.subsistema,plandesarrollo.proyecto,plandesarrollo.accion
                              WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                              AND plandesarrollo.accion.acc_codigo IN (2019121705405037046, 2019121705432245165, 2019121705452248968, 2019121705471534195, 2019121705492416316, 2019121705512587002, 2019121705255056230, 2019121705320384828, 2019121705361726109)";
            $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

            while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
                $dataplan_accion[] = $data_plan_accion;

            }
            return $dataplan_accion;
        }



        public function contratacion2($codigo_planaccion){

           
            $sql_plan_accion="SELECT  DISTINCT  plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  sub_nombre,pro_descripcion,acc_descripcion,acc_referencia,acc_numero,
                              plandesarrollo.subsistema.sub_codigo,plandesarrollo.proyecto.pro_codigo,plandesarrollo.accion.acc_codigo
                              FROM plandesarrollo.plan_desarrollo,plandesarrollo.subsistema,plandesarrollo.proyecto,plandesarrollo.accion
                              WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                              AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                              AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_planaccion
                              AND plandesarrollo.accion.acc_codigo IN (201912172343519759, 2019120216224859898)";
            $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

            while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
                $dataplan_accion[] = $data_plan_accion;

            }
            return $dataplan_accion;
        }


        public function plan_desarrollo(){

            $sql_plan_desarrollo="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin, pde_personacreo,
                               pde_personamodifico, pde_fechacreo, pde_fechamodifico, pde_actoadmin,
                               pde_niveluno, pde_niveldos, pde_niveltres
                              FROM plandesarrollo.plan_desarrollo";

            $query_plan_desarrollo=$this->cnxion->ejecutar($sql_plan_desarrollo);

            while($data_plan_desarrollo=$this->cnxion->obtener_filas($query_plan_desarrollo)){
                $dataPlanDesarrollo[]=$data_plan_desarrollo;
            }
            return $dataPlanDesarrollo;
        }

        public function etapasPoai($accion_actividad){
            $sql_etapasPoai="SELECT poa_codigo, poa_referencia, poa_objeto, poa_recurso, 
                                    poa_logro,poa_estado, poa_numero, poa_vigencia,
                                    poa_logroejecutado,planaccion.poai.acp_codigo,
                                    poa_codigoclasificadorpresupuestal, 
                                    poa_descripcionclasificador, poa_dane, poa_plancompras
                               FROM planaccion.poai,planaccion.actividad_poai
                              WHERE planaccion.poai.acp_codigo=planaccion.actividad_poai.acp_codigo
                                AND planaccion.poai.acp_codigo=$accion_actividad 
                                ORDER BY poa_fechacreo ASC";

            $resultado_etapasPoai=$this->cnxion->ejecutar($sql_etapasPoai);

            while ($data_etapasPoai = $this->cnxion->obtener_filas($resultado_etapasPoai)){
                $dataEtapasPoai[] = $data_etapasPoai;
            }

            return $dataEtapasPoai;
        }
        public function avanceEsperado($accion_actividad){
            $sql_avanceEsperado="SELECT poa_logroejecutado,poa_logro
                        FROM planaccion.poai,planaccion.actividad_poai
                        WHERE planaccion.poai.acp_codigo=planaccion.actividad_poai.acp_codigo
                        AND planaccion.poai.acp_codigo=$accion_actividad ";

            $resultado_avanceEsperado=$this->cnxion->ejecutar($sql_avanceEsperado);

            while ($data_avanceEsperado = $this->cnxion->obtener_filas($resultado_avanceEsperado)){
                $dataAvanceEsperado[] = $data_avanceEsperado;
            }
            return $dataAvanceEsperado;
        }
        public function actividadPoai($accion_code){

            if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1 ){
                $condicionVer="";
            }
            else{
                $condicionVer="AND planaccion.actividad_poai.acp_codigo IN(SELECT DISTINCT acp_codigo
                                                                                FROM planaccion.actividad_poai, usco.vinculacion
                                                                            WHERE  acp_oficina = vin_oficina
                                                                            AND acp_cargo = vin_cargo 
                                                                            AND vin_persona = ".$_SESSION['idusuario']." )";
            }
            $sql_actividadPoai="SELECT DISTINCT acp_codigo, acp_descripcion, acc_descripcion, pro_descripcion, acp_referencia,
                                                acp_estado, acp_vigencia, acp_numero, sub_nombre,acp_fechacreo,acc_descripcion, 
                                                plandesarrollo.accion.acc_codigo, acp_objetivo, ain_indicador,
                                                ain_unidad
                                FROM planaccion.actividad_poai,plandesarrollo.proyecto,plandesarrollo.subsistema,plandesarrollo.plan_desarrollo,plandesarrollo.accion,planaccion.actividad_indicador
                                WHERE planaccion.actividad_poai.acp_proyecto=plandesarrollo.proyecto.pro_codigo
                                AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                AND planaccion.actividad_indicador.ain_actividad=planaccion.actividad_poai.acp_codigo
                                AND plandesarrollo.subsistema.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                AND plandesarrollo.accion.acc_codigo=planaccion.actividad_poai.acp_accion
                                AND acp_accion=$accion_code 
                                $condicionVer
                                ORDER BY acp_fechacreo ASC";
                                //2019121620230056952

            $resultado_actividadPoai=$this->cnxion->ejecutar($sql_actividadPoai);

            $data_actividadPoai = $this->cnxion->obtener_filas($resultado_actividadPoai);
            $acp_codigo = $data_actividadPoai['acp_codigo'];
            

            return $acp_codigo;
        }

        public function formUpdatePoai($codigo_poai){
            $sql_formPoai="SELECT poa_codigo, poa_referencia, poa_objeto, 
                                  poa_recurso, poa_logro,poa_estado, 
                                  poa_numero, poa_vigencia,poa_logroejecutado,
                                  poa_codigoclasificadorpresupuestal,
                                  poa_descripcionclasificador, poa_dane, 
                                  poa_plancompras
                        FROM planaccion.poai,planaccion.actividad_poai
                        WHERE planaccion.poai.acp_codigo=planaccion.actividad_poai.acp_codigo
                        AND planaccion.poai.poa_codigo=$codigo_poai";

            $resultado_formPoai=$this->cnxion->ejecutar($sql_formPoai);

            while ($data_formPoai = $this->cnxion->obtener_filas($resultado_formPoai)){
                $dataFormPoai[] = $data_formPoai;
            }

            return $dataFormPoai;
        }

        public function suma($accion_actividad){
          $sqlnumero="SELECT SUM(poa_logro) AS numerosuma
                             FROM planaccion.poai
                             WHERE acp_codigo=$accion_actividad;";
           $querynumero=$this->cnxion->ejecutar($sqlnumero);

          $data_numero=$this->cnxion->obtener_filas($querynumero);

          $numeroSuma=$data_numero['numerosuma'];

          return $numeroSuma;
        }
        public function sumaRecursoEtapas($accion_actividad){

            $sqlnumero="SELECT SUM(poa_recurso) AS recursosuma
                          FROM planaccion.poai
                         WHERE acp_codigo=$accion_actividad;";

            $querynumero=$this->cnxion->ejecutar($sqlnumero);

            $data_numero=$this->cnxion->obtener_filas($querynumero);

            $recursoSuma=$data_numero['recursosuma'];

            return $recursoSuma;
        }

        public function acciones($codigo_planaccion){

            $codigo_planaccion=$codigo_planaccion;
            $personaSession=$_SESSION['idusuario'];

        
            $rs_plan_accion=$this->plan_accion_consulta($codigo_planaccion);

            if($rs_plan_accion){
                foreach ($rs_plan_accion as $dataplan_accion) {

                    $pde_codigo = $dataplan_accion['pde_codigo'];
                    $pde_nombre = $dataplan_accion['pde_nombre'];
                    $sub_nombre = $dataplan_accion['sub_nombre'];
                    $pro_descripcion = $dataplan_accion['pro_descripcion'];
                    $acc_descripcion = $dataplan_accion['acc_descripcion'];
                    $acc_referencia = $dataplan_accion['acc_referencia'];
                    $acc_numero = $dataplan_accion['acc_numero'];
                    $pro_codigo = $dataplan_accion['pro_codigo'];
                    $acc_codigo = $dataplan_accion['acc_codigo'];
                    $sub_codigo = $dataplan_accion['sub_codigo'];
    
                    if($pde_codigo==1){
                      $referenciaAccion=$acc_referencia;
                    }
                    else{
                        $referenciaAccion=$acc_referencia.'.'.$acc_numero;
                    }
    
    
                    $rsplan_accion[] = array('pde_nombre'=> $pde_nombre,
                                        'sub_nombre'=> $sub_nombre,
                                        'pro_descripcion'=> $pro_descripcion,
                                        'acc_descripcion'=> $acc_descripcion,
                                        'pde_codigo'=> $pde_codigo,
                                        'sub_codigo'=> $sub_codigo,
                                        'pro_codigo'=> $pro_codigo,
                                        'acc_codigo'=> $acc_codigo,
                                        'referenciaAccion'=> $referenciaAccion
                                    );
    
    
                }
                $datAccion=json_encode(array("data"=>$rsplan_accion));
            }
            else{
                $datAccion=json_encode(array("data"=>""));
            }

            

           

            return $datAccion;
        }



        public function accionPlan($codigo_plandesarrollo){

            $sql_accionPlan="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                    acc_lineabase, acc_metaresultado, acc_proyecto,  acc_numero, pde_codigo
                                FROM plandesarrollo.accion, plandesarrollo.proyecto, plandesarrollo.subsistema
                                WHERE plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                AND plandesarrollo.subsistema.pde_codigo=$codigo_plandesarrollo;";

            $resultado_accionPlan=$this->cnxion->ejecutar($sql_accionPlan);

            while ($data_accionPlan = $this->cnxion->obtener_filas($resultado_accionPlan)){
                $dataaccionPlan[] = $data_accionPlan;
            }
            return $dataaccionPlan;
        }
        public function accionesPlanJson($codigo_plandesarrollo){

            $codigo_plandesarrollo=$codigo_plandesarrollo;

        
            $rs_accionPlan=$this->accionPlan($codigo_plandesarrollo);

            foreach ($rs_accionPlan as $data_accionplan) {

                $acc_codigo = $data_accionplan['acc_codigo'];
                $acc_descripcion = $data_accionplan['acc_descripcion'];
                $acc_referencia = $data_accionplan['acc_referencia'];
                $acc_numero = $data_accionplan['acc_numero'];
                $pde_codigo = $data_accionplan['pde_codigo'];

                if($pde_codigo==1){
                  $referenciaAccion=$acc_referencia;
                }
                else{
                    $referenciaAccion=$acc_referencia.'.'.$acc_numero;
                }


                $rsaccion_plan[] = array('acc_codigo'=> $acc_codigo,
                                    'acc_descripcion'=> $acc_descripcion,
                                    'acc_codigo'=> $acc_codigo,
                                    'referenciaAccion'=> $referenciaAccion
                                );
            }

            $dtaAccion=json_encode(array("data"=>$rsaccion_plan));

            return $dtaAccion;
        }

        public function personas_encargados(){

            $sql_personas_encargados="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido  
                                             per_genero, per_tipoidentificacion, per_identificacion
                                        FROM principal.persona
                                        WHERE per_codigo NOT IN (1, 201604281729001);";

            $resultado_personas_encargados=$this->cnxion->ejecutar($sql_personas_encargados);

            while ($data_personas_encargados = $this->cnxion->obtener_filas($resultado_personas_encargados)){
                $datapersonas_encargados[] = $data_personas_encargados;
            }
            return $datapersonas_encargados;
        }

        public function checked_encargado($codigo_accion, $codigo_encargado){

            $sqlchecked_encargado="SELECT COUNT(*) AS checked 
                         FROM planaccion.accion_encargado
                        WHERE aen_estado='1'
                          AND aen_accion=$codigo_accion
                          AND aen_encargado=$codigo_encargado;";

            $querychecked_encargado=$this->cnxion->ejecutar($sqlchecked_encargado);
  
            $data_checked_encargado=$this->cnxion->obtener_filas($querychecked_encargado);
  
            $checked=$data_checked_encargado['checked'];
  
            return $checked;
        }

        public function lista_encargado_accion($codigo_accion){

            $sql_lista_encargado_accion="SELECT aen_codigo, aen_accion, aen_encargado, aen_estado,
                                                per_nombre , per_primerapellido , per_segundoapellido 
                                        FROM planaccion.accion_encargado, principal.persona
                                        WHERE planaccion.accion_encargado.aen_encargado=principal.persona.per_codigo
                                        AND aen_estado='1'
                                        AND aen_accion=$codigo_accion;";

            $resultado_lista_encargado_accion=$this->cnxion->ejecutar($sql_lista_encargado_accion);

            while ($data_lista_encargado_accion = $this->cnxion->obtener_filas($resultado_lista_encargado_accion)){
                $datalista_encargado_accion[] = $data_lista_encargado_accion;
            }
            return $datalista_encargado_accion;
        }

        public function descripcion_poai($codigo_poai){

            $sqldescripcion_poai="SELECT acp_descripcion
                                    FROM planaccion.actividad_poai
                                   WHERE acp_codigo=$codigo_poai;";

            $querydescripcion_poai=$this->cnxion->ejecutar($sqldescripcion_poai);
  
            $data_descripcion_poai=$this->cnxion->obtener_filas($querydescripcion_poai);
  
            $acp_descripcion=$data_descripcion_poai['acp_descripcion'];
  
            return $acp_descripcion;
        }

        public function actividades_accion($codigo_accion){

            $sql_actividades_accion="SELECT acp_codigo, acp_descripcion, 
                                                acp_accion, acp_proyecto, 
                                                acp_referencia, acp_vigencia, 
                                                acp_numero, acp_subsistema
                                           FROM planaccion.actividad_poai
                                          WHERE acp_accion = $codigo_accion;";

            $resultado_actividades_accion=$this->cnxion->ejecutar($sql_actividades_accion);

            while ($data_actividades_accion = $this->cnxion->obtener_filas($resultado_actividades_accion)){
                $dataactividades_accion[] = $data_actividades_accion;
            }
            return $dataactividades_accion;
        }

        public function etapas_actividad($cdigo_actividad){

            $sql_etapas_actividad = "SELECT poa_codigo, poa_referencia, 
                                            poa_objeto, poa_recurso, 
                                            poa_estado, poa_numero, 
                                            poa_vigencia, acp_codigo, 
                                            poa_logroejecutado
                                    FROM planaccion.poai
                                    WHERE acp_codigo IN($cdigo_actividad)
                                    ORDER BY acp_codigo, poa_numero;";

            $resultado_etapas_actividad = $this->cnxion->ejecutar($sql_etapas_actividad);

            while ($data_etapas_actividad = $this->cnxion->obtener_filas($resultado_etapas_actividad)){
                $dataetapas_actividad[] = $data_etapas_actividad;
            }
            return $dataetapas_actividad;
        }

        public function checked_etapa($codigo_certificado, $codigo_etapa){
            
            $sql_checked_etapa="SELECT COUNT(*) AS checked_etpa
                                 FROM planaccion.certificado_etapa
                                WHERE cee_certificado = $codigo_certificado
                                  AND cee_etapa = $codigo_etapa;";

            $resultado_checked_etapa=$this->cnxion->ejecutar($sql_checked_etapa);

            $data_checked_etapa = $this->cnxion->obtener_filas($resultado_checked_etapa);

            $checked_etpa = $data_checked_etapa['checked_etpa'];

            return $checked_etpa;
        }

        public function list_anios_plan($codigo_accion){

            $sql_list_anios_plan="SELECT DISTINCT plandesarrollo.accion.acc_codigo,acc_descripcion,
                                                  acc_referencia,acc_numero, plandesarrollo.subsistema.sub_codigo,
                                                  plandesarrollo.proyecto.pro_codigo,plandesarrollo.accion.acc_codigo,
                                                  pde_yearinicio, pde_yearfin
                                             FROM plandesarrollo.plan_desarrollo, plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto, plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                              AND plandesarrollo.accion.acc_codigo=$codigo_accion";

            $resultado_list_anios_plan=$this->cnxion->ejecutar($sql_list_anios_plan);

            $data_list_anios_plan = $this->cnxion->obtener_filas($resultado_list_anios_plan);

            $pde_yearinicio = $data_list_anios_plan['pde_yearinicio'];
            $pde_yearfin = $data_list_anios_plan['pde_yearfin'];

            return array($pde_yearinicio, $pde_yearfin);
        }

        /*public function activity_list($codigo_accion){
        
            $rs_actvty=$this->actividades_accion($codigo_accion);

            if($rs_actvty){
                foreach ($rs_actvty as $data_rs_actvty) {

                    $acp_codigo = $data_rs_actvty['acp_codigo'];
                    $acp_descripcion = $data_rs_actvty['acp_descripcion'];
                    $acp_referencia = $data_rs_actvty['acp_referencia'];
                    $acp_numero = $data_rs_actvty['acp_numero'];
                    $acp_vigencia = $data_rs_actvty['acp_vigencia'];
    
                    $referenciaActividad = $acp_referencia.".".$acp_numero;

                    $actividad_completa = $referenciaActividad." ".$referenciaActividad;
    
    
                    $rsaccion_plan[] =array('acp_codigo'=> $acp_codigo,
                                            'acp_descripcion'=> $acp_descripcion,
                                            'referenciaActividad'=> $referenciaActividad,
                                            'actividad_completa'=> $actividad_completa
                                    );
                }
    
                $dtaAccion=json_encode($rsaccion_plan);
            }
            else{
                $dtaAccion = "nohayinfo";
            }
            return $dtaAccion;
        }*/

        public function nombre_sede($codigo_sede){
            
            $sql_nombre_sede="SELECT sed_codigo, sed_nombre
                                FROM principal.sedes
                               WHERE sed_codigo = $codigo_sede;";

            $resultado_nombre_sede=$this->cnxion->ejecutar($sql_nombre_sede);

            while ($data_nombre_sede = $this->cnxion->obtener_filas($resultado_nombre_sede)){
                $data_nombre_sede[] = $data_nombre_sede;
            };

            $sed_nombre = $data_nombre_sede['sed_nombre'];

            return $sed_nombre;
        }

        public function sede_indicador($codigo_indicador){

            $codigo_actividad = $this->actividadPoai($accion_code);
            
            $sql_sede_indicador="SELECT ind_codigo, ind_unidadmedida, ind_sede,
                                        sed_nombre
                                FROM plandesarrollo.indicador
                                INNER JOIN principal.sedes ON ind_sede = sed_codigo
                                INNER JOIN planaccion.actividad_indicador ON ind_codigo = ain_indicador
                                WHERE ind_codigo = $codigo_indicador";

            $resultado_sede_indicador=$this->cnxion->ejecutar($sql_sede_indicador);

            $data_sede_indicador = $this->cnxion->obtener_filas($resultado_sede_indicador);

            $sed_nombre = $data_sede_indicador['sed_nombre'];

            return $sed_nombre;
        }

        public function datOficinafuente(){
        
            $list_sedes = $this->sede_indicador($codigo_indicador);
    
            if($list_sedes){
                foreach ($list_sedes as $dat_sede) {
                    $codigo_indicador = $dat_sede['ind_codigo'];
                    $off_cargo = $dat_sede['off_cargo'];
                    $off_codigo = $dat_oficinafuente['off_codigo'];
                    $off_estado = $dat_oficinafuente['off_estado'];
    
                    
    
    
                    $nombre_fuente = '';
                    foreach($oficina_fuente as $dat_oficina_fuente){
                        $ffi_nombre = $dat_oficina_fuente['ffi_nombre'];
    
                        $nombre_fuente = $nombre_fuente.$ffi_nombre.'<br/>';
                    }
                   
                    if($off_estado == 1){
                        $estado = "Activo";
                    }
                    else{
                        $estado = "Inactivo";
                    }
                    
    
    
        
                    $rsOficinafuente[] = array('ofi_nombre'=> $nombre_oficina, 
                                               'car_nombre'=> $nombre_cargo,
                                               'off_fuente'=> $nombre_fuente,
                                               'off_oficina' => $off_oficina,
                                               'off_cargo'=> $off_cargo,
                                               'off_codigo'=> $off_codigo,
                                               'estado'=> $estado
                                            );
        
                }
                $dattOficinafuente=json_encode(array("data"=>$rsOficinafuente));
            }
            else{
                $dattOficinafuente=json_encode(array("data"=>""));
            } 
            return $dattOficinafuente;
        }


        public function indicadores_accion($codigo_accion){

            $sql_indicadores_accion = "SELECT ind_codigo, ind_unidadmedida, ind_lineabase, 
                                              ind_metaresultado, ind_accion, ind_estado, 
                                              ind_tipocomportamiento, ind_tendencia, ind_sede
                                         FROM plandesarrollo.indicador
                                        WHERE ind_estado = '1'
                                          AND ind_accion = $codigo_accion;";

            $resultado_indicadores_accion = $this->cnxion->ejecutar($sql_indicadores_accion);

            while ($data_indicadores_accion = $this->cnxion->obtener_filas($resultado_indicadores_accion)){
                $dataindicadores_accion[] = $data_indicadores_accion;
            }
            return $dataindicadores_accion;
        }

        public function comportamientoNivelTres($codigo_comportamiento){

            $sqlcomportamientoNivelTres="SELECT tco_codigo, tco_nombre, tco_descripcion, tco_estado
                                            FROM plandesarrollo.tipo_comportamiento
                                            WHERE tco_codigo=".$codigo_comportamiento.";";
    
            $querycomportamientoNivelTres=$this->cnxion->ejecutar($sqlcomportamientoNivelTres);
    
            $data_comportamientoNivelTres=$this->cnxion->obtener_filas($querycomportamientoNivelTres);
            
            $tco_nombre=$data_comportamientoNivelTres['tco_nombre'];
            
            return $tco_nombre;
        }

        public function tendenciaNivelTres($codigo_tendencia){

            $sqltendenciaNivelTres="SELECT ten_codigo, ten_nombre, ten_referencia
                                    FROM plandesarrollo.tendencia
                                    WHERE ten_codigo=".$codigo_tendencia.";";
    
            $querytendenciaNivelTres=$this->cnxion->ejecutar($sqltendenciaNivelTres);
    
            $data_tendenciaNivelTres=$this->cnxion->obtener_filas($querytendenciaNivelTres);
            
            $ten_nombre=$data_tendenciaNivelTres['ten_nombre'];
            
            return $ten_nombre;
        }

        public function indicador_vigencia($codigoIndicador){

            $sql_indicador_vigencia="SELECT ivi_codigo, ivi_indicador,
                                            ivi_valorlogrado, ivi_presupuesto, 
                                            ivi_vigencia
                                      FROM plandesarrollo.indicador_vigencia
                                     WHERE ivi_estado='1'
                                       AND ivi_indicador=$codigoIndicador;";
    
            $query_indicador_vigencia=$this->cnxion->ejecutar($sql_indicador_vigencia);
    
            while($data_indicador_vigencia=$this->cnxion->obtener_filas($query_indicador_vigencia)){
                $dataindicador_vigencia[]=$data_indicador_vigencia;
            }
            return $dataindicador_vigencia;
        }
        

        public function fuentes_inversion(){

            $sql_fuentes_inversion="SELECT ffi_codigo, ffi_nombre, ffi_clasificacion, 
                                           ffi_referencialinix, ffi_codigolinix
                                      FROM planaccion.fuente_financiacion
                                     WHERE ffi_estado = 1
                                       AND ffi_clasificacion = 3;";
    
            $query_fuentes_inversion=$this->cnxion->ejecutar($sql_fuentes_inversion);
    
            while($data_fuentes_inversion=$this->cnxion->obtener_filas($query_fuentes_inversion)){
                $datafuentes_inversion[]=$data_fuentes_inversion;
            }
            return $datafuentes_inversion;
        }

        public function codigos_presupuestales($fuente){

            $sql_codigos_presupuestales="SELECT ccp_codigo, ccp_code, ccp_niv, 
                                                ccp_descripcion, ccp_fuente, ccp_estado
                                           FROM planaccion.codigo_clasificador_presupuestal
                                          WHERE ccp_estado = 1
                                            AND ccp_fuente = '$fuente'
                                          ORDER BY ccp_descripcion ASC;";
    
            $query_codigos_presupuestales=$this->cnxion->ejecutar($sql_codigos_presupuestales);
    
            while($data_codigos_presupuestales=$this->cnxion->obtener_filas($query_codigos_presupuestales)){
                $datacodigos_presupuestales[]=$data_codigos_presupuestales;
            }
            return $datacodigos_presupuestales;
        }

        public function ref_fuente($codigo_fuente){

            $sql_ref_fuente="SELECT ffi_codigo, ffi_nombre, ffi_clasificacion, 
                                    ffi_referencialinix, ffi_codigolinix
                               FROM planaccion.fuente_financiacion
                              WHERE ffi_estado = 1
                                AND ffi_clasificacion = 3
                                AND ffi_codigo = $codigo_fuente;";
    
            $query_ref_fuente = $this->cnxion->ejecutar($sql_ref_fuente);
    
            $data_ref_fuente = $this->cnxion->obtener_filas($query_ref_fuente);
            
            $ffi_referencialinix = $data_ref_fuente['ffi_referencialinix'];
            
            return $ffi_referencialinix;
        }

        public function list_codigo_presupuestal($codigo_presupuestal){

            $sql_list_codigo_presupuestal="SELECT ccp_codigo, ccp_code, ccp_niv, 
                                                  ccp_descripcion, ccp_fuente, ccp_estado
                                             FROM planaccion.codigo_clasificador_presupuestal
                                            WHERE ccp_codigo = $codigo_presupuestal";
    
            $query_list_codigo_presupuestal = $this->cnxion->ejecutar($sql_list_codigo_presupuestal);
    
            $data_list_codigo_presupuestal = $this->cnxion->obtener_filas($query_list_codigo_presupuestal);
            
            $ccp_code = $data_list_codigo_presupuestal['ccp_code'];

            $ccp_descripcion = $data_list_codigo_presupuestal['ccp_descripcion'];
            
            return array($ccp_code, $ccp_descripcion);
        }

        public function plan_accion_compras($codigo_accion){

            $sql_plan_accion_compras="SELECT COUNT(*)AS plan_compras
                                        FROM plandesarrollo.plan_compras_accion
                                       WHERE pca_estado = 1
                                         AND pca_accion = $codigo_accion;";
    
            $query_plan_accion_compras = $this->cnxion->ejecutar($sql_plan_accion_compras);
    
            $data_plan_accion_compras = $this->cnxion->obtener_filas($query_plan_accion_compras);
            
            $plan_compras = $data_plan_accion_compras['plan_compras'];
            
            return $plan_compras;
        }
        
      



        
    }
?>
