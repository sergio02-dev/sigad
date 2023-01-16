<?php
include('classPlndsrrllo.php');
class PlnDsrrllo extends PlanDesarrollo{

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function vigencia_poai_plan($codigo_plan){

        $sql_vigencia_poai_plan="SELECT DISTINCT poav_vigencia
                                   FROM plandesarrollo.accion,
                                        plandesarrollo.proyecto,
                                        plandesarrollo.subsistema,
                                        planaccion.poai_veinte_veintidos,
                                        planaccion.fuente_financiacion,
                                        principal.sedes
                                  WHERE acc_proyecto = pro_codigo
                                    AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    AND acc_codigo = poav_accion
                                    AND poav_fuentefinanciacion = ffi_codigo
                                    AND poav_sede = sed_codigo
                                    AND plandesarrollo.subsistema.pde_codigo = $codigo_plan;";

        $query_vigencia_poai_plan=$this->cnxion->ejecutar($sql_vigencia_poai_plan);

        while($data_vigencia_poai_plan=$this->cnxion->obtener_filas($query_vigencia_poai_plan)){
            $datavigencia_poai_plan[]=$data_vigencia_poai_plan;
        }
        return $datavigencia_poai_plan;
    }

    public function sqlActoAdministrativo(){

        $sqlActoAdministrativo="SELECT aad_codigo, add_nombre
                                  FROM plandesarrollo.acto_administrativo
                                 WHERE add_tipoactoadmin = 1
                                 ORDER BY add_nombre ASC;";

        $queryActoAdministrativo=$this->cnxion->ejecutar($sqlActoAdministrativo);

        while($data_ActoAdministrativo=$this->cnxion->obtener_filas($queryActoAdministrativo)){
            $dataActoAdministrativo[]=$data_ActoAdministrativo;
        }
        return $dataActoAdministrativo;
    }

    public function PlanDesarrolloLista(){

        $sqlPlanDesarrollo="SELECT PDES.pde_codigo, PDES.pde_nombre, PDES.pde_yearinicio, PDES.pde_yearfin, PDES.pde_personacreo, 
                                PDES.pde_personamodifico, PDES.pde_fechacreo, PDES.pde_fechamodifico, PDES.pde_actoadmin,
                                PDES.pde_niveluno, PDES.pde_niveldos, PDES.pde_niveltres,PDES.pde_referencianiveluno,
                                PDES.pde_referencianiveldos,(SELECT COUNT(*) 
                                                                FROM plandesarrollo.subsistema AS SSTMA
                                                                            WHERE SSTMA.pde_codigo=PDES.pde_codigo) AS cantidadsusbistemas, add_nombre
                                FROM plandesarrollo.plan_desarrollo AS PDES,  plandesarrollo.acto_administrativo
                                WHERE PDES.pde_actoadmin=aad_codigo";

        $queryPlanDesarrollo=$this->cnxion->ejecutar($sqlPlanDesarrollo);

        while($data_PlanDesarrollo=$this->cnxion->obtener_filas($queryPlanDesarrollo)){
            $dataPlanDesarrollo[]=$data_PlanDesarrollo;
        }
        return $dataPlanDesarrollo;
    }

    public function codigo_ppi($codigo_plan){

        $sql_codigo_ppi="SELECT epp_codigo, epp_plan, epp_estado
                           FROM ppi.estado_ppi_plan
                          WHERE epp_plan = $codigo_plan;";

        $query_codigo_ppi=$this->cnxion->ejecutar($sql_codigo_ppi);

        $data_codigo_ppi=$this->cnxion->obtener_filas($query_codigo_ppi);

        $epp_codigo = $data_codigo_ppi['epp_codigo'];

        return $epp_codigo;
    }

    public function ultimo_plan(){

        $sql_ultimo_plan="SELECT pde_codigo, pde_nombre 
                            FROM plandesarrollo.plan_desarrollo
                           ORDER BY pde_yearinicio DESC
                           LIMIT 1 OFFSET 0;";

        $query_ultimo_plan=$this->cnxion->ejecutar($sql_ultimo_plan);

        $data_ultimo_plan=$this->cnxion->obtener_filas($query_ultimo_plan);
        
        $pde_codigo = $data_ultimo_plan['pde_codigo'];

        return $pde_codigo;
    }

    public function datPlanDesarrollo(){
        
        $rs_planDesarrollo=$this->PlanDesarrolloLista();
        if($rs_planDesarrollo){
            foreach ($rs_planDesarrollo as $data_nivelUno) {
                $pde_codigo = $data_nivelUno['pde_codigo'];
                $pde_nombre = $data_nivelUno['pde_nombre'];
                $pde_yearinicio = $data_nivelUno['pde_yearinicio'];
                $pde_yearfin = $data_nivelUno['pde_yearfin']; 
                $add_nombre = $data_nivelUno['add_nombre']; 
                $pde_niveluno = $data_nivelUno['pde_niveluno'];
                $pde_niveldos = $data_nivelUno['pde_niveldos'];
                $pde_niveltres = $data_nivelUno['pde_niveltres'];
                $cantidadsusbistemas = $data_nivelUno['cantidadsusbistemas'];
                $pde_actoadmin = $data_nivelUno['pde_actoadmin'];
                $pde_referencianiveluno = $data_nivelUno['pde_referencianiveluno'];
                $pde_referencianiveldos = $data_nivelUno['pde_referencianiveldos'];
    
                $codigo_ppi = $this->codigo_ppi($pde_codigo);
                if($codigo_ppi){
                    $codigo_ppii = $codigo_ppi;
                    $estado_ppi = $this->estado_ppi($codigo_ppii);
                }
                else{
                    $codigo_ppii = 0;
                    $estado_ppi = 1;
                }

                if($this->ultimo_plan() == $pde_codigo){
                    $actualizar_plan = "block";
                }
                else{
                    $actualizar_plan = "none";
                }
    
                $rsPlanDesarrollo[] = array('pde_nombre'=> $pde_nombre, 
                                    'pde_yearinicio'=> $pde_yearinicio, 
                                    'pde_yearfin'=> $pde_yearfin,
                                    'add_nombre'=> $add_nombre,
                                    'pde_codigo'=> $pde_codigo,
                                    'pde_niveluno'=>$pde_niveluno,
                                    'pde_niveldos'=>$pde_niveldos,
                                    'pde_niveltres'=>$pde_niveltres,
                                    'cantidadsusbistemas'=>$cantidadsusbistemas,
                                    'pde_actoadmin'=>$pde_actoadmin,
                                    'pde_referencianiveluno'=>$pde_referencianiveluno,
                                    'pde_referencianiveldos'=>$pde_referencianiveldos,
                                    'codigo_ppii'=> $codigo_ppii,
                                    'estado_ppi'=> $estado_ppi,
                                    'actualizar_plan'=> $actualizar_plan
                                );
            }   
            $datPlanDesarrollo=json_encode(array("data"=>$rsPlanDesarrollo));  
        }
        else{
            $datPlanDesarrollo=json_encode(array("data"=>""));
        }
        return $datPlanDesarrollo;
    }

    public function updatePlanDesarrollo(){

        $sqlupdatePlanDesarrollo="SELECT aad_codigo, add_nombre
                                  FROM plandesarrollo.acto_administrativo;";

        $queryupdatePlanDesarrollo=$this->cnxion->ejecutar($sqlupdatePlanDesarrollo);

        while($data_updatePlanDesarrollo=$this->cnxion->obtener_filas($queryupdatePlanDesarrollo)){
            $dataupdatePlanDesarrollo[]=$data_updatePlanDesarrollo;
        }
        return $dataupdatePlanDesarrollo;
    }


    public function PlanDesarrolloForm(){

        $sqlPlanDesarrolloForm="SELECT pde_codigo, pde_nombre, pde_yearinicio, 
                                       pde_yearfin, pde_personacreo, pde_personamodifico, 
                                       pde_fechacreo, pde_fechamodifico, pde_actoadmin,
                                       pde_niveluno, pde_niveldos, pde_niveltres, 
                                       pde_referencianiveluno, pde_referencianiveldos, 
                                       pde_responsable, pde_oficina
                                  FROM plandesarrollo.plan_desarrollo
                                 WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $queryPlanDesarrolloForm=$this->cnxion->ejecutar($sqlPlanDesarrolloForm);

        while($data_PlanDesarrolloForm=$this->cnxion->obtener_filas($queryPlanDesarrolloForm)){
            $dataPlanDesarrolloForm[]=$data_PlanDesarrolloForm;
        }
        return $dataPlanDesarrolloForm;
    }

    public function nivelUno(){

        $sqlnivelUno="SELECT sub_codigo, sub_referencia, sub_nombre, add_codigo, sub_ref
                            FROM plandesarrollo.subsistema
                            WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querynivelUno=$this->cnxion->ejecutar($sqlnivelUno);

        while($data_nivelUno=$this->cnxion->obtener_filas($querynivelUno)){
            $datanivelUno[]=$data_nivelUno;
        }
        return $datanivelUno;
    }
    public function nivelDos($codigo_niveldos){

        $sqlnivelDos="SELECT pro_codigo, pro_descripcion, sub_codigo,
                             res_codigo, pro_referencia, pro_numero, 
                             pro_objetivo
                        FROM plandesarrollo.proyecto
                        WHERE sub_codigo = $codigo_niveldos
                        ORDER BY pro_numero ASC;";

        $querynivelDos=$this->cnxion->ejecutar($sqlnivelDos);

        while($data_nivelDos=$this->cnxion->obtener_filas($querynivelDos)){
            $datanivelDos[]=$data_nivelDos;
        }
        return $datanivelDos;
    }
    public function tendencia(){

        $sqltendencia="SELECT ten_codigo, ten_nombre, ten_referencia, ten_estado
                        FROM plandesarrollo.tendencia
                        ORDER BY ten_codigo ASC;";

        $querytendencia=$this->cnxion->ejecutar($sqltendencia);

        while($data_tendencia=$this->cnxion->obtener_filas($querytendencia)){
            $datatendencia[]=$data_tendencia;
        }
        return $datatendencia;
    }

    public function tipo_comportamiento(){

        $sqltipo_comportamiento="SELECT tco_codigo, tco_nombre, tco_descripcion, tco_estado
                            FROM plandesarrollo.tipo_comportamiento
                            ORDER BY tco_codigo ASC;";

        $querytipo_comportamiento=$this->cnxion->ejecutar($sqltipo_comportamiento);

        while($data_tipo_comportamiento=$this->cnxion->obtener_filas($querytipo_comportamiento)){
            $datatipo_comportamiento[]=$data_tipo_comportamiento;
        }
        return $datatipo_comportamiento;
    }

    public function nombrePlanDesarrollo(){

        $sqlnombrePlanDesarrollo="SELECT pde_nombre
                        FROM plandesarrollo.plan_desarrollo
                        WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querynombrePlanDesarrollo=$this->cnxion->ejecutar($sqlnombrePlanDesarrollo);

        $data_nombrePlanDesarrollo=$this->cnxion->obtener_filas($querynombrePlanDesarrollo);
        
        $pde_nombre=$data_nombrePlanDesarrollo['pde_nombre'];
        
        return $pde_nombre;
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

    public function responsable_nombre($responsable){

        $sql_responsable_nombre="SELECT per_codigo, per_nombre || ' '|| per_primerapellido || ' '|| per_segundoapellido AS responsable
                            FROM principal.persona
                            WHERE per_codigo=$responsable;";

        $query_responsable_nombre=$this->cnxion->ejecutar($sql_responsable_nombre);
        
        $data_responsable_nombre=$this->cnxion->obtener_filas($query_responsable_nombre);

        $nombreResponsable=$data_responsable_nombre['responsable'];

        return $nombreResponsable;
    }


    public function listadoNivelUno(){

        $sqllistadoNivelUno="SELECT sub_codigo, sub_nombre,add_codigo, plandesarrollo.subsistema.pde_codigo,  
                                    sub_referencia, sub_ref, pde_referencianiveldos, pde_niveluno, pde_actoadmin,
                                    pde_niveldos, res_codigo
                                FROM plandesarrollo.subsistema, plandesarrollo.plan_desarrollo
                                WHERE plandesarrollo.subsistema.pde_codigo=plandesarrollo.plan_desarrollo.pde_codigo
                                AND plandesarrollo.subsistema.pde_codigo=".$this->getCodigoPlanDesarrollo()."
                                ORDER BY sub_fechacreo ASC;";

        $querylistadoNivelUno=$this->cnxion->ejecutar($sqllistadoNivelUno);

        while($data_listadoNivelUno=$this->cnxion->obtener_filas($querylistadoNivelUno)){
            $datalistadoNivelUno[]=$data_listadoNivelUno;
        }
        return $datalistadoNivelUno;
    }

    public function rspnsble_nivel_uno($codigo_nivel){

        $sql_rspnsble_nivel_uno="SELECT res_codigo, res_nivel, res_codigonivel, 
                                        res_codigocargo, res_codigooficina, 
                                        res_estado, car_nombre, ofi_nombre
                                   FROM usco.responsable, usco.cargo,
                                        usco.oficina
                                WHERE res_codigocargo = car_codigo
                                  AND res_codigooficina = ofi_codigo
                                  AND res_codigonivel = $codigo_nivel";

        $query_rspnsble_nivel_uno=$this->cnxion->ejecutar($sql_rspnsble_nivel_uno);
        
        while($data_rspnsble_nivel_uno=$this->cnxion->obtener_filas($query_rspnsble_nivel_uno)){
            $datarspnsble_nivel_uno[]=$data_rspnsble_nivel_uno;
        }
        return $datarspnsble_nivel_uno;
    }

    public function dataNivelUno(){
        
        $rs_nivelUno = $this->listadoNivelUno();
        foreach ($rs_nivelUno as $data_nivelUno) {
            
            $sub_codigo = $data_nivelUno['sub_codigo'];
            $sub_nombre = $data_nivelUno['sub_nombre'];
            $add_codigo = $data_nivelUno['add_codigo'];
            $pde_codigo = $data_nivelUno['pde_codigo']; 
            $sub_referencia = $data_nivelUno['sub_referencia']; 
            $sub_ref = $data_nivelUno['sub_ref'];
            $pde_actoadmin = $data_nivelUno['pde_actoadmin'];
            $pde_niveluno = $data_nivelUno['pde_niveluno'];
            $pde_referencianiveldos = $data_nivelUno['pde_referencianiveldos'];
            $pde_niveldos = $data_nivelUno['pde_niveldos'];
            $res_codigo = $data_nivelUno['res_codigo'];

            $responsable=$this->responsable_nombre($res_codigo);

            $rspnsble_nivel_uno = $this->rspnsble_nivel_uno($sub_codigo);
            if($rspnsble_nivel_uno){
                foreach ($rspnsble_nivel_uno as $dta_rspns) {
                    $ofi_nombre = $dta_rspns['ofi_nombre'];
                    $car_nombre = $dta_rspns['car_nombre'];

                }
            }


            $refrencia=$sub_referencia.$sub_ref;

            $rsNivelUno[] = array('sub_codigo'=> $sub_codigo, 
                                  'sub_nombre'=> $sub_nombre, 
                                  'add_codigo'=> $add_codigo,
                                  'pde_codigo'=> $pde_codigo,
                                  'sub_referencia'=> $refrencia,
                                  'pde_actoadmin'=> $pde_actoadmin,
                                  'pde_referencianiveldos'  => $pde_referencianiveldos,
                                  'pde_niveldos' => $pde_niveldos,
                                  'responsable' => $responsable,
                                  'oficina'=> $ofi_nombre,
                                  'cargo'=> $car_nombre

                                );

        }

        $datNivelUno=json_encode(array("data"=>$rsNivelUno));
            
        return $datNivelUno;
    }

    public function listadoNivelDos(){

        $sqllistadoNivelUno="SELECT PRO.pro_codigo,  PRO.pro_descripcion, PRO.sub_codigo, PRO.pro_personacreo, 
                                    PRO.pro_personamodifico,  PRO.pro_referencia, PRO.pro_numero, SUB.sub_nombre,
                                    SUB.pde_codigo, PRO.pro_objetivo,  SUB.add_codigo, PRO.res_codigo
                            FROM plandesarrollo.proyecto AS PRO, plandesarrollo.subsistema AS SUB
                            WHERE PRO.sub_codigo=SUB.sub_codigo
                            AND pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querylistadoNivelUno=$this->cnxion->ejecutar($sqllistadoNivelUno);

        while($data_listadoNivelUno=$this->cnxion->obtener_filas($querylistadoNivelUno)){
            $datalistadoNivelUno[]=$data_listadoNivelUno;
        }
        return $datalistadoNivelUno;
    }

    public function dataNivelDos(){
        
        $rs_nivelDos=$this->listadoNivelDos();
        //return $rs_planDesarrollo;
       
        foreach ($rs_nivelDos as $data_nivelDos) {
            
            $pro_codigo = $data_nivelDos['pro_codigo'];
            $pro_descripcion = $data_nivelDos['pro_descripcion'];
            $pro_referencia = $data_nivelDos['pro_referencia'];
            $pro_numero = $data_nivelDos['pro_numero']; 
            $sub_nombre =$data_nivelDos['sub_nombre'];
            $pde_codigo =$data_nivelDos['pde_codigo'];
            $pro_objetivo = $data_nivelDos['pro_objetivo'];
            $add_codigo = $data_nivelDos['add_codigo'];
            $sub_codigo = $data_nivelDos['sub_codigo'];
            $res_codigo = $data_nivelDos['res_codigo'];

            $referencia=$pro_referencia.".".$pro_numero;

            $responsable=$this->responsable_nombre($res_codigo);

            $rsNivelDos[] = array('pro_codigo'=> $pro_codigo, 
                                  'pro_descripcion'=> $pro_descripcion, 
                                  'referencia'=> $referencia,
                                  'sub_nombre'=> $sub_nombre,
                                  'pde_codigo'=> $pde_codigo,
                                  'pro_objetivo'=> $pro_objetivo,
                                  'add_codigo' => $add_codigo,
                                  'sub_codigo' => $sub_codigo,
                                  'ref' => $pro_referencia,
                                  'responsable' => $responsable
                            );

        }

        $datNivelDos=json_encode(array("data"=>$rsNivelDos));
            
        return $datNivelDos;
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
    public function comportamientoNivelTres($codigo_comportamiento){

        $sqlcomportamientoNivelTres="SELECT tco_codigo, tco_nombre, tco_descripcion, tco_estado
                                        FROM plandesarrollo.tipo_comportamiento
                                        WHERE tco_codigo=".$codigo_comportamiento.";";

        $querycomportamientoNivelTres=$this->cnxion->ejecutar($sqlcomportamientoNivelTres);

        $data_comportamientoNivelTres=$this->cnxion->obtener_filas($querycomportamientoNivelTres);
        
        $tco_nombre=$data_comportamientoNivelTres['tco_nombre'];
        
        return $tco_nombre;
    }
    public function listadoNivelTres(){

        $sqllistadoNivelUno="SELECT acc_codigo, acc_referencia, acc_descripcion,  
                                    acc_lineabase, acc_metaresultado, acc_proyecto, 
                                    acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva, 
                                    acc_indicador, acc_numero, SUB.sub_nombre, PRO.pro_descripcion, 
                                    acc_numero, SUB.pde_codigo, PRO.add_codigo, SUB.sub_codigo, PRO.pro_codigo, 
                                    SUB.sub_referencia, SUB.sub_ref, PRO.pro_referencia, PRO.pro_numero, 
                                    acc_responsable
                            FROM plandesarrollo.accion, plandesarrollo.proyecto AS PRO , plandesarrollo.subsistema AS SUB
                            WHERE acc_proyecto=PRO.pro_codigo
                            AND PRO.sub_codigo=SUB.sub_codigo
                            AND SUB.pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querylistadoNivelUno=$this->cnxion->ejecutar($sqllistadoNivelUno);

        while($data_listadoNivelUno=$this->cnxion->obtener_filas($querylistadoNivelUno)){
            $datalistadoNivelUno[]=$data_listadoNivelUno;
        }
        return $datalistadoNivelUno;
    }

    public function dataNivelTres(){
        
        $rs_nivelTres=$this->listadoNivelTres();
        //return $rs_planDesarrollo;
       
        foreach ($rs_nivelTres as $data_nivelTres) {
            
            $acc_codigo = $data_nivelTres['acc_codigo'];
            $sub_nombre = $data_nivelTres['sub_nombre'];
            $pro_descripcion = $data_nivelTres['pro_descripcion'];
            $acc_descripcion = $data_nivelTres['acc_descripcion']; 
            $acc_lineabase =$data_nivelTres['acc_lineabase'];
            $acc_metaresultado =$data_nivelTres['acc_metaresultado'];
            $acccomportamiento =$data_nivelTres['acc_comportamiento'];
            $acctendenciapositiva =$data_nivelTres['acc_tendenciapositiva'];
            $acc_indicador =$data_nivelTres['acc_indicador'];
            $acc_referencia =$data_nivelTres['acc_referencia'];
            $acc_numero =$data_nivelTres['acc_numero'];
            $pde_codigo = $data_nivelTres['pde_codigo'];
            $add_codigo = $data_nivelTres['add_codigo'];
            $pro_codigo = $data_nivelTres['pro_codigo'];
            $sub_codigo = $data_nivelTres['sub_codigo'];
            $pro_referencia = $data_nivelTres['pro_referencia'];
            $pro_numero = $data_nivelTres['pro_numero'];
            $acc_responsable = $data_nivelTres['acc_responsable'];

            $referencia=$acc_referencia.".".$acc_numero;


            $responsable=$this->responsable_nombre($acc_responsable);

            if($acctendenciapositiva==0){
                $acc_tendenciapositiva="";
            }
            else{
                $acc_tendenciapositiva=$this->tendenciaNivelTres($acctendenciapositiva);
            }

            if($acccomportamiento==0){
                $acc_comportamiento="";
            }
            else{
                $acc_comportamiento=$this->comportamientoNivelTres($acccomportamiento);
            }

            $rsNivelDos[] = array('acc_codigo'=> $acc_codigo, 
                                'sub_nombre'=> $sub_nombre, 
                                'pro_descripcion'=> $pro_descripcion,
                                'acc_descripcion'=> $acc_descripcion,
                                'acc_lineabase'=> $acc_lineabase, 
                                'acc_metaresultado'=> $acc_metaresultado,
                                'acc_tendenciapositiva'=> $acc_tendenciapositiva,
                                'acc_comportamiento'=> $acc_metaresultado,
                                'acc_indicador'=> $acc_indicador,
                                'referencia'=> $referencia, 
                                'pde_codigo'=> $pde_codigo,
                                'add_codigo'=> $add_codigo,
                                'responsable'=> $responsable
                            );

        }

        $datNivelDos=json_encode(array("data"=>$rsNivelDos));
            
        return $datNivelDos;
    }

    public function updateNivelUno($codigo_nivel){

        $sqlupdateNivelUno="SELECT sub_codigo, sub_nombre,add_codigo, pde_codigo,  
                                   sub_referencia, sub_ref, res_codigo
                              FROM plandesarrollo.subsistema
                              WHERE sub_codigo=$codigo_nivel;";

        $queryupdateNivelUno=$this->cnxion->ejecutar($sqlupdateNivelUno);

        while($data_updateNivelUno=$this->cnxion->obtener_filas($queryupdateNivelUno)){
            $dataupdateNivelUno[]=$data_updateNivelUno;
        }
        return $dataupdateNivelUno;
    }

    public function updateNivelDos($codigo_niveldos){

        $sqlupdateNivelDos="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                    add_codigo,  pro_referencia, 
                                    pro_numero, pro_objetivo, res_codigo
                            FROM plandesarrollo.proyecto
                            WHERE pro_codigo=$codigo_niveldos;";

        $queryupdateNivelDos=$this->cnxion->ejecutar($sqlupdateNivelDos);

        while($data_updateNivelDos=$this->cnxion->obtener_filas($queryupdateNivelDos)){
            $dataupdateNivelDos[]=$data_updateNivelDos;
        }
        return $dataupdateNivelDos;
    }

    public function updateNivelTres($codigo_nivelTres){

        $sqlupdateNivelTres="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                    acc_lineabase, acc_metaresultado, acc_proyecto,
                                    acc_comportamiento, acc_tendenciapositiva, 
                                    acc_indicador, acc_numero, sub_codigo, acc_responsable
                            FROM plandesarrollo.accion, plandesarrollo.proyecto
                            WHERE acc_proyecto=pro_codigo
                            AND acc_codigo=$codigo_nivelTres;";

        $queryupdateNivelTres=$this->cnxion->ejecutar($sqlupdateNivelTres);

        while($data_updateNivelTres=$this->cnxion->obtener_filas($queryupdateNivelTres)){
            $dataupdateNivelTres[]=$data_updateNivelTres;
        }
        return $dataupdateNivelTres;
    }

    public function datosPlan(){

        $sqldatosPlan="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin,
                                    pde_actoadmin, pde_niveluno, pde_niveldos, pde_niveltres,
                                    pde_referencianiveluno, pde_referencianiveldos
                            FROM plandesarrollo.plan_desarrollo
                            WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $querydatosPlan=$this->cnxion->ejecutar($sqldatosPlan);

        while($data_datosPlan=$this->cnxion->obtener_filas($querydatosPlan)){
            $datadatosPlan[]=$data_datosPlan;
        }
        return $datadatosPlan;
    }

    public function indicadorLista($codigoAccion){

        $sqlindicadorLista="SELECT ind_codigo, ind_unidadmedida, 
                                   ind_lineabase, ind_metaresultado, 
                                   ind_accion, ind_estado, ind_fechacreo, 
                                   ind_fechamodifico, ind_personacreo, 
                                   ind_personamodifico, ind_tipocomportamiento, 
                                   ind_tendencia, ind_sede
                              FROM plandesarrollo.indicador
                             WHERE ind_accion=$codigoAccion
                              ORDER BY ind_fechacreo ASC;";

        $queryindicadorLista=$this->cnxion->ejecutar($sqlindicadorLista);

        while($data_indicadorLista=$this->cnxion->obtener_filas($queryindicadorLista)){
            $dataindicadorLista[]=$data_indicadorLista;
        }
        return $dataindicadorLista;
    }
    public function indicador_vigencia($codigoIndicador){

        $sqlindicador_vigencia="SELECT ivi_codigo, ivi_indicador,
                                       ivi_valorlogrado, ivi_presupuesto, ivi_vigencia
                                FROM plandesarrollo.indicador_vigencia
                                WHERE ivi_estado='1'
                                AND ivi_indicador=$codigoIndicador;";

        $queryindicador_vigencia=$this->cnxion->ejecutar($sqlindicador_vigencia);

        while($data_indicador_vigencia=$this->cnxion->obtener_filas($queryindicador_vigencia)){
            $dataindicador_vigencia[]=$data_indicador_vigencia;
        }
        return $dataindicador_vigencia;
    }

    
    public function actoAdminNombre(){

        $sqlactoAdminNombre="SELECT pde_actoadmin
                        FROM plandesarrollo.plan_desarrollo
                        WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $queryactoAdminNombre=$this->cnxion->ejecutar($sqlactoAdminNombre);

        $data_actoAdminNombre=$this->cnxion->obtener_filas($queryactoAdminNombre);
        
        $pde_actoadmin=$data_actoAdminNombre['pde_actoadmin'];
        
        return $pde_actoadmin;
    }

    public function indicadorForm($codigoInidicador){

        $sqlindicadorForm="SELECT ind_codigo, ind_unidadmedida, ind_lineabase, ind_metaresultado, 
                                    ind_accion, ind_estado, ind_fechacreo, ind_fechamodifico, ind_personacreo, 
                                    ind_personamodifico, ind_tipocomportamiento, ind_tendencia
                            FROM plandesarrollo.indicador
                            WHERE ind_codigo=$codigoInidicador;";

        $queryindicadorForm=$this->cnxion->ejecutar($sqlindicadorForm);

        while($data_indicadorForm=$this->cnxion->obtener_filas($queryindicadorForm)){
            $dataindicadorForm[]=$data_indicadorForm;
        }
        return $dataindicadorForm;
    }

    public function indicadorVigenciaForm($codigoIndicador, $vigencia){

        $sqlindicadorVigenciaForm="SELECT ivi_codigo, ivi_indicador,
                                          ivi_valorlogrado, ivi_presupuesto, ivi_vigencia
                                     FROM plandesarrollo.indicador_vigencia
                                     WHERE ivi_estado='1'
                                     AND ivi_indicador=$codigoIndicador
                                     AND ivi_vigencia=$vigencia;";

        $queryindicadorVigenciaForm=$this->cnxion->ejecutar($sqlindicadorVigenciaForm);

        while($data_indicadorVigenciaForm=$this->cnxion->obtener_filas($queryindicadorVigenciaForm)){
            $dataindicadorVigenciaForm[]=$data_indicadorVigenciaForm;
        }
        return $dataindicadorVigenciaForm;
    }

    public function responsable(){

        $sql_responsable="SELECT per_codigo, per_nombre || ' '|| per_primerapellido || ' '|| per_segundoapellido AS responsable
                            FROM principal.persona
                            WHERE per_nombre LIKE 'Facultad%'
                            OR per_nombre LIKE 'Vicerrectoria%';";

        $query_responsable=$this->cnxion->ejecutar($sql_responsable);
        while($data_responsable=$this->cnxion->obtener_filas($query_responsable)){
            $dataResponsable[]=$data_responsable;
        }
        return $dataResponsable;
    }

    public function accionPlanDesarrollo($proyecto){

        $sqlaccionPlanDesarrollo="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                        acc_proyecto,  acc_actoadmin, acc_numerovigencia, acc_comportamiento, 
                                        acc_tendenciapositiva, acc_indicador, acc_numero
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=$proyecto
                                ORDER BY acc_codigo ASC;";

        $queryaccionPlanDesarrollo=$this->cnxion->ejecutar($sqlaccionPlanDesarrollo);

        while($data_accionPlanDesarrollo=$this->cnxion->obtener_filas($queryaccionPlanDesarrollo)){
            $dataaccionPlanDesarrollo[]=$data_accionPlanDesarrollo;
        }
        return $dataaccionPlanDesarrollo;
    }

    public function accion_Plan($plan){

        $sqlAccion_Plan="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                        acc_proyecto,  acc_actoadmin, acc_numerovigencia, acc_comportamiento, 
                                        acc_tendenciapositiva, acc_indicador, acc_numero
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=$proyecto
                                ORDER BY acc_codigo ASC;";

        $queryAccion_Plan=$this->cnxion->ejecutar($sqlAccion_Plan);

        while($data_Accion_Plan=$this->cnxion->obtener_filas($queryAccion_Plan)){
            $dataAccion_Plan[]=$data_Accion_Plan;
        }
        return $dataAccion_Plan;
    }

    public function infoPlan($plan){

        $sqlinfoPlan="SELECT pde_codigo, pde_yearinicio, pde_yearfin
                        FROM plandesarrollo.plan_desarrollo
                       WHERE pde_codigo=$plan;";

        $queryinfoPlan=$this->cnxion->ejecutar($sqlinfoPlan);

        $data_infoPlan=$this->cnxion->obtener_filas($queryinfoPlan);
        
        $pde_yearinicio=$data_infoPlan['pde_yearinicio'];
        $pde_yearfin=$data_infoPlan['pde_yearfin'];

        $yearsinfo=$pde_yearinicio."-".$pde_yearfin;

        return $yearsinfo;
    }
    
    public function vigencias_certificado(){

        $sql_vigencias_certificado="SELECT DISTINCT act_vigencia
                                      FROM planaccion.actividad
                                     GROUP BY act_vigencia
                                     ORDER BY act_vigencia ASC;";

        $query_vigencias_certificado=$this->cnxion->ejecutar($sql_vigencias_certificado);

        while($data_vigencias_certificado=$this->cnxion->obtener_filas($query_vigencias_certificado)){
            $datavigencias_certificado[]=$data_vigencias_certificado;
        }
        return $datavigencias_certificado;
    }

    

    public function list_sedes(){

        $sql_list_sedes="SELECT sed_codigo, sed_nombre, sed_estado
                           FROM principal.sedes
                          WHERE sed_estado = 1
                          ORDER BY sed_codigo ASC;";

        $query_list_sedes=$this->cnxion->ejecutar($sql_list_sedes);

        while($data_list_sedes=$this->cnxion->obtener_filas($query_list_sedes)){
            $datalist_sedes[]=$data_list_sedes;
        }
        return $datalist_sedes;
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

    public function estado_ppi($codigo_ppi){

        $sql_estado_ppi="SELECT epp_codigo, epp_estado
                           FROM ppi.estado_ppi_plan
                          WHERE epp_codigo = $codigo_ppi;";

        $query_estado_ppi=$this->cnxion->ejecutar($sql_estado_ppi);

        $data_estado_ppi=$this->cnxion->obtener_filas($query_estado_ppi);
        
        $epp_estado = $data_estado_ppi['epp_estado'];

        return $epp_estado;
    }

    public function list_oficina(){

        $sql_list_oficina="SELECT ofi_codigo, ofi_nombre, ofi_estado
                             FROM usco.oficina
                            WHERE ofi_estado = 1
                            ORDER BY ofi_nombre ASC;";

        $query_list_oficina=$this->cnxion->ejecutar($sql_list_oficina);

        while($data_list_oficina=$this->cnxion->obtener_filas($query_list_oficina)){
            $datalist_oficina[]=$data_list_oficina;
        }
        return $datalist_oficina;
    }

    public function list_cargo(){

        $sql_list_cargo="SELECT car_codigo, car_nombre, car_estado
                           FROM usco.cargo
                          WHERE car_estado = 1
                          ORDER BY car_nombre ASC;";

        $query_list_cargo=$this->cnxion->ejecutar($sql_list_cargo);

        while($data_list_cargo=$this->cnxion->obtener_filas($query_list_cargo)){
            $datalist_cargo[]=$data_list_cargo;
        }
        return $datalist_cargo;
    }

    public function nombre_uno($codigo_nivel_uno){

        $sql_nombre_uno="SELECT sub_codigo, sub_nombre, 
                                sub_referencia, sub_ref
                           FROM plandesarrollo.subsistema
                          WHERE sub_codigo = $codigo_nivel_uno;";

        $query_nombre_uno=$this->cnxion->ejecutar($sql_nombre_uno);

        $data_nombre_uno=$this->cnxion->obtener_filas($query_nombre_uno);
        
        $sub_nombre = $data_nombre_uno['sub_nombre'];

        return $sub_nombre;
    }

    public function nombre_dos($codigo_nivel_dos){

        $sql_nombre_dos="SELECT pro_codigo, pro_descripcion 
                           FROM plandesarrollo.proyecto
                          WHERE pro_codigo = $codigo_nivel_dos;";

        $query_nombre_dos=$this->cnxion->ejecutar($sql_nombre_dos);

        $data_nombre_dos=$this->cnxion->obtener_filas($query_nombre_dos);
        
        $pro_descripcion = $data_nombre_dos['pro_descripcion'];

        return $pro_descripcion;
    }

    public function nombre_tres($codigo_nivel_tres){

        $sql_nombre_tres="SELECT acc_codigo, acc_descripcion
                            FROM plandesarrollo.accion
                           WHERE acc_codigo = $codigo_nivel_tres;";

        $query_nombre_tres=$this->cnxion->ejecutar($sql_nombre_tres);

        $data_nombre_tres=$this->cnxion->obtener_filas($query_nombre_tres);
        
        $acc_descripcion = $data_nombre_tres['acc_descripcion'];

        return $acc_descripcion;
    }

    public function form_responsable($codigo_responsable){

        $sql_form_responsable="SELECT res_codigo, res_nivel, res_codigonivel, 
                                      res_codigocargo, res_codigooficina, 
                                      res_estado
                                 FROM usco.responsable
                                WHERE res_codigo = $codigo_responsable;";

        $query_form_responsable=$this->cnxion->ejecutar($sql_form_responsable);

        while($data_form_responsable=$this->cnxion->obtener_filas($query_form_responsable)){
            $dataform_responsable[]=$data_form_responsable;
        }
        return $dataform_responsable;
    }

    public function list_responsables($codigo_nivel, $nivel){

        $sql_list_responsables="SELECT res_codigo, res_nivel, res_codigonivel, 
                                       res_codigocargo, res_codigooficina, 
                                       res_estado, res_personacreo
                                  FROM usco.responsable
                                 WHERE res_codigonivel = $codigo_nivel
                                   AND res_nivel = $nivel
                                   AND res_tiporesponsable = 1;";

        $query_list_responsables=$this->cnxion->ejecutar($sql_list_responsables);

        while($data_list_responsables=$this->cnxion->obtener_filas($query_list_responsables)){
            $datalist_responsables[] = $data_list_responsables;
        }
        return $datalist_responsables;
    }

    public function list_responsbles_gastos($codigo_nivel, $nivel){

        $sql_list_responsbles_gastos="SELECT res_codigo, res_nivel, res_codigonivel, 
                                       res_codigocargo, res_codigooficina, 
                                       res_estado, res_personacreo
                                  FROM usco.responsable
                                 WHERE res_codigonivel = $codigo_nivel
                                   AND res_nivel = $nivel
                                   AND res_tiporesponsable = 2;";

        $query_list_responsbles_gastos=$this->cnxion->ejecutar($sql_list_responsbles_gastos);

        while($data_list_responsbles_gastos=$this->cnxion->obtener_filas($query_list_responsbles_gastos)){
            $datalist_responsbles_gastos[] = $data_list_responsbles_gastos;
        }
        return $datalist_responsbles_gastos;
    }

    
    public function list_autorizador($codigo_nivel, $nivel){

        $sql_list_autorizador="SELECT res_codigo, res_nivel, res_codigonivel, 
                                       res_codigocargo, res_codigooficina, 
                                       res_estado, res_personacreo
                                  FROM usco.responsable
                                 WHERE res_codigonivel = $codigo_nivel
                                   AND res_nivel = $nivel
                                   AND res_tiporesponsable = 3;";

        $query_list_autorizador=$this->cnxion->ejecutar($sql_list_autorizador);

        while($data_list_autorizador=$this->cnxion->obtener_filas($query_list_autorizador)){
            $datalist_autorizador[] = $data_list_autorizador;
        }
        return $datalist_autorizador;
    }

    public function list_asignacionrecursos($codigo_nivel, $nivel){

        $sql_list_autorizador="SELECT res_codigo, res_nivel, res_codigonivel, 
                                       res_codigocargo, res_codigooficina, 
                                       res_estado, res_personacreo
                                  FROM usco.responsable
                                 WHERE res_codigonivel = $codigo_nivel
                                   AND res_nivel = $nivel
                                   AND res_tiporesponsable = 4;";

        $query_list_autorizador=$this->cnxion->ejecutar($sql_list_autorizador);

        while($data_list_autorizador=$this->cnxion->obtener_filas($query_list_autorizador)){
            $datalist_autorizador[] = $data_list_autorizador;
        }
        return $datalist_autorizador;
    }

    public function nombre_oficina($codigo_oficina){

        $sql_nombre_oficina="SELECT ofi_codigo, ofi_nombre, ofi_estado
                               FROM usco.oficina
                              WHERE ofi_codigo = $codigo_oficina;";

        $query_nombre_oficina=$this->cnxion->ejecutar($sql_nombre_oficina);

        $data_nombre_oficina=$this->cnxion->obtener_filas($query_nombre_oficina);
        
        $ofi_nombre = $data_nombre_oficina['ofi_nombre'];

        return $ofi_nombre;
    }

    public function nombre_cargo($codigo_cargo){

        $sql_nombre_cargo="SELECT car_codigo, car_nombre, car_estado
                             FROM usco.cargo
                            WHERE car_codigo = $codigo_cargo;";

        $query_nombre_cargo=$this->cnxion->ejecutar($sql_nombre_cargo);

        $data_nombre_cargo=$this->cnxion->obtener_filas($query_nombre_cargo);
        
        $car_nombre = $data_nombre_cargo['car_nombre'];

        return $car_nombre;
    }

    public function nombre_indicador($codigo_indicador){

        $sql_nombre_indicador="SELECT ind_codigo, ind_unidadmedida
                                 FROM plandesarrollo.indicador
                                WHERE ind_codigo = $codigo_indicador;";

        $query_nombre_indicador = $this->cnxion->ejecutar($sql_nombre_indicador);

        $data_nombre_indicador = $this->cnxion->obtener_filas($query_nombre_indicador);
        
        $ind_unidadmedida = $data_nombre_indicador['ind_unidadmedida'];

        return $ind_unidadmedida;
    }

    public function list_responsable_indicador($codigo_indicador){

        $sql_list_responsable_indicador="SELECT res_codigo, res_nivel, res_codigonivel, 
                                                res_codigocargo, res_codigooficina, 
                                                res_estado, res_personacreo
                                           FROM usco.responsable
                                          WHERE res_codigonivel = $codigo_indicador
                                            AND res_nivel = 4;";

        $query_list_responsable_indicador = $this->cnxion->ejecutar($sql_list_responsable_indicador);

        while($data_list_responsable_indicador=$this->cnxion->obtener_filas($query_list_responsable_indicador)){
            $datalist_responsable_indicador[] = $data_list_responsable_indicador;
        }
        return $datalist_responsable_indicador;
    }

    public function responsable_level_one($codigo_level_uno){

        $sql_responsable_level_one="SELECT res_codigo, res_nivel, res_codigonivel, 
                                           res_codigocargo, res_codigooficina, res_estado
                                      FROM usco.responsable
                                     WHERE res_codigonivel = $codigo_level_uno;";

        $query_responsable_level_one = $this->cnxion->ejecutar($sql_responsable_level_one);

        while($data_responsable_level_one=$this->cnxion->obtener_filas($query_responsable_level_one)){
            $dataresponsable_level_one[] = $data_responsable_level_one;
        }
        return $dataresponsable_level_one;
    }

   /* public function ultimo_plan($codigo_indicador){

        $sql_nombre_indicador="SELECT ind_codigo, ind_unidadmedida
                                 FROM plandesarrollo.indicador
                                WHERE ind_codigo = $codigo_indicador;";

        $query_nombre_indicador = $this->cnxion->ejecutar($sql_nombre_indicador);

        $data_nombre_indicador = $this->cnxion->obtener_filas($query_nombre_indicador);
        
        $ind_unidadmedida = $data_nombre_indicador['ind_unidadmedida'];

        return $ind_unidadmedida;
    }*/


    public function acuerdo_list_poai($codigo_plan, $codigo_calendario){

        $sql_acuerdo_list_poai="SELECT DISTINCT poav_acuerdo as acuerdo, add_fechacreo
                                        FROM plandesarrollo.accion
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                    INNER JOIN principal.sedes ON poav_sede = sed_codigo
                                    INNER JOIN plandesarrollo.acto_administrativo ON poav_acuerdo = aad_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND poav_vigencia = $codigo_calendario
                                    UNION 
                                    SELECT DISTINCT sff_acto as acuerdo, add_fechacreo
                                        FROM plandesarrollo.accion
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                                    INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                    INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                    INNER JOIN principal.sedes ON poav_sede = sed_codigo
                                    INNER JOIN plandesarrollo.acto_administrativo ON sff_acto = aad_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND poav_vigencia = $codigo_calendario
                                    UNION 
                                    SELECT tpo_acuerdo as acuerdo, add_fechacreo
                                        FROM planaccion.traslados_poai
                                    INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                    INNER JOIN plandesarrollo.accion ON tpo_accion = acc_codigo 
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    INNER JOIN plandesarrollo.acto_administrativo ON tpo_acuerdo = aad_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND poav_vigencia = $codigo_calendario
                                    ORDER BY add_fechacreo ASC;";

        $query_acuerdo_list_poai=$this->cnxion->ejecutar($sql_acuerdo_list_poai);

        while($data_acuerdo_list_poai=$this->cnxion->obtener_filas($query_acuerdo_list_poai)){
            $dataacuerdo_list_poai[]=$data_acuerdo_list_poai;
        }
        return $dataacuerdo_list_poai;
    }

    public function acuerdo_poai($codigo_acuerdo){

        $sql_acuerdo_poai="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                  add_urlactoadmin
                             FROM plandesarrollo.acto_administrativo
                            WHERE aad_codigo = $codigo_acuerdo;";

        $query_acuerdo_poai=$this->cnxion->ejecutar($sql_acuerdo_poai);

        $data_acuerdo_poai=$this->cnxion->obtener_filas($query_acuerdo_poai);

        $add_nombre = $data_acuerdo_poai['add_nombre'];

        return $add_nombre;
    }

    public function vigencia_pssai_plan($codigo_plan){

        $sql_vigencia_pssai_plan="SELECT DISTINCT poav_vigencia
                                   FROM plandesarrollo.accion,
                                        plandesarrollo.proyecto,
                                        plandesarrollo.subsistema,
                                        planaccion.poai_veinte_veintidos,
                                        planaccion.fuente_financiacion,
                                        principal.sedes
                                  WHERE acc_proyecto = pro_codigo
                                    AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    AND acc_codigo = poav_accion
                                    AND poav_fuentefinanciacion = ffi_codigo
                                    AND poav_sede = sed_codigo
                                    AND plandesarrollo.subsistema.pde_codigo = $codigo_plan;";

        $query_vigencia_pssai_plan=$this->cnxion->ejecutar($sql_vigencia_pssai_plan);

        while($data_vigencia_pssai_plan=$this->cnxion->obtener_filas($query_vigencia_pssai_plan)){
            $datavigencia_pssai_plan[]=$data_vigencia_pssai_plan;
        }
        return $datavigencia_pssai_plan;
    }

    public function list_poais($codigo_plan){

        $vigencia_pssai_plan = $this->vigencia_pssai_plan($codigo_plan);

        if($vigencia_pssai_plan){
            foreach ($vigencia_pssai_plan as $dta_vgncia) {
                $poav_vigencia = $dta_vgncia['poav_vigencia'];

                $array_poais[] = array('vigencia'=> $poav_vigencia,
                                       'acuerdo'=> 0,
                                       'descripcion'=> $poav_vigencia.' TODO');

                $acuerdo_list_poai = $this->acuerdo_list_poai($codigo_plan, $poav_vigencia);
                if($acuerdo_list_poai){
                    foreach ($acuerdo_list_poai as $dta_acuerdos) {
                        $acuerdo = $dta_acuerdos['acuerdo'];

                        if($acuerdo){
                            $acuerdo_poai = $this->acuerdo_poai($acuerdo);

                            $descrpc = $poav_vigencia." ".$acuerdo_poai;
    
                            $array_poais[] = array('vigencia'=> $poav_vigencia,
                                                   'acuerdo'=> $acuerdo,
                                                   'descripcion'=> $descrpc);
                        }
                        
                    }
                }
            }
        }
        return $array_poais;
    }

    public function vgncias_plan($codigo_plan){

        $sql_vigencia_pssai_plan="SELECT DISTINCT acp_vigencia
                                    FROM planaccion.actividad_poai
                                   INNER JOIN plandesarrollo.accion ON acp_accion = acc_codigo
                                   INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                   INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                   WHERE pde_codigo = $codigo_plan";

        $query_vigencia_pssai_plan=$this->cnxion->ejecutar($sql_vigencia_pssai_plan);

        while($data_vigencia_pssai_plan=$this->cnxion->obtener_filas($query_vigencia_pssai_plan)){
            $datavigencia_pssai_plan[]=$data_vigencia_pssai_plan;
        }
        return $datavigencia_pssai_plan;
    }

    
    public function plan_compras_accion($codigo_accion){

        $sql_plan_compras_accion="SELECT pca_codigo, pca_accion, pca_plantafisica, pca_estado
                                    FROM plandesarrollo.plan_compras_accion
                                   WHERE pca_estado = 1
                                     AND pca_accion = $codigo_accion;";

        $query_plan_compras_accion = $this->cnxion->ejecutar($sql_plan_compras_accion);

        while($data_plan_compras_accion=$this->cnxion->obtener_filas($query_plan_compras_accion)){
            $dataplan_compras_accion[] = $data_plan_compras_accion;
        }
        return $dataplan_compras_accion;
    }
}
?>