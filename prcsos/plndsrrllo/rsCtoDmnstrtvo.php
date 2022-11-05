<?php
include('classCtoDmnstrtvo.php');
class ActoDmnstrtvo extends ActoAdministrativo{

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function sqlTipoActo(){

        $sqlTipoActo="SELECT tac_codigo, tac_nombre
                        FROM plandesarrollo.tipo_actoadmin;";

        $queryTipoActo=$this->cnxion->ejecutar($sqlTipoActo);

        while($data_TipoActo=$this->cnxion->obtener_filas($queryTipoActo)){
            $dataTipoActo[]=$data_TipoActo;
        }
        return $dataTipoActo;
    }

    public function vigencia_actos(){

        $sql_vigencia_actos="SELECT DISTINCT add_vigencia
                               FROM plandesarrollo.acto_administrativo
                              WHERE add_tipoactoadmin = 1
                              GROUP BY add_vigencia
                              ORDER BY add_vigencia ASC;";

        $query_vigencia_actos=$this->cnxion->ejecutar($sql_vigencia_actos);

        while($data_vigencia_actos=$this->cnxion->obtener_filas($query_vigencia_actos)){
            $datavigencia_actos[]=$data_vigencia_actos;
        }
        return $datavigencia_actos;
    }

    public function selectActo(){

        $sqlselectActo="SELECT aad_codigo, add_nombre, 
                               add_tipoactoadmin, tac_nombre, 
                               add_urlactoadmin, add_vigencia,
                               add_padre, add_descripcion
                          FROM plandesarrollo.acto_administrativo,plandesarrollo.tipo_actoadmin 
                         WHERE add_tipoactoadmin=tac_codigo
                              AND add_tipoactoadmin = 1;";

        $queryselectActo=$this->cnxion->ejecutar($sqlselectActo);

        while($data_selectActo=$this->cnxion->obtener_filas($queryselectActo)){
            $dataselectActo[]=$data_selectActo;
        }
        return $dataselectActo;
    }

    public function dataActo(){
        
        $rsActo=$this->selectActo();
       
        foreach ($rsActo as $dataActoAdmin) {
            
            $aad_codigo = $dataActoAdmin['aad_codigo'];
            $add_nombre = $dataActoAdmin['add_nombre'];
            $tac_nombre = $dataActoAdmin['tac_nombre'];
            $add_tipoactoadmin = $dataActoAdmin['add_tipoactoadmin']; 
			$add_urlactoadmin = $dataActoAdmin['add_urlactoadmin'];
            $add_vigencia = $dataActoAdmin['add_vigencia'];
            $add_descripcion = $dataActoAdmin['add_descripcion'];

            $rsActpAdmin[] = array('aad_codigo'=> $aad_codigo, 
                                   'add_nombre'=> $add_nombre, 
                                   'tac_nombre'=> $tac_nombre,
                                   'add_tipoactoadmin'=> $add_tipoactoadmin,
                                   'add_urlactoadmin'=> $add_urlactoadmin,
                                   'add_vigencia'=> $add_vigencia,
                                   'add_descripcion'=> $add_descripcion
                                );

        }

        $dtaActo=json_encode(array("data"=>$rsActpAdmin));
            
        return $dtaActo;
    }

    public function actoAdminForm(){

        $sqlactoAdminForm="SELECT aad_codigo, add_nombre, 
                                  add_tipoactoadmin, add_vigencia, 
                                  add_urlactoadmin, add_padre, 
                                  add_descripcion
                             FROM plandesarrollo.acto_administrativo
                            WHERE aad_codigo=".$this->getCodigoActoAdministrativo().";";

        $queryactoAdminForm=$this->cnxion->ejecutar($sqlactoAdminForm);

        while($data_actoAdminForm=$this->cnxion->obtener_filas($queryactoAdminForm)){
            $dataactoAdminForm[]=$data_actoAdminForm;
        }
        return $dataactoAdminForm;
    }


    public function PlanDesarrolloForm(){

        $sqlPlanDesarrolloForm="SELECT pde_codigo, pde_nombre, 
                                       pde_yearinicio, pde_yearfin, 
                                       pde_personacreo, pde_personamodifico, 
                                       pde_fechacreo, pde_fechamodifico, 
                                       pde_actoadmin, pde_niveluno, 
                                       pde_niveldos, pde_niveltres
                                  FROM plandesarrollo.plan_desarrollo
                                 WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $queryPlanDesarrolloForm=$this->cnxion->ejecutar($sqlPlanDesarrolloForm);

        while($data_PlanDesarrolloForm=$this->cnxion->obtener_filas($queryPlanDesarrolloForm)){
            $dataPlanDesarrolloForm[]=$data_PlanDesarrolloForm;
        }
        return $dataPlanDesarrolloForm;
    }

    public function list_acuerdos(){

        $sql_list_acuerdos="SELECT aad_codigo, add_nombre, 
                                   add_tipoactoadmin
                              FROM plandesarrollo.acto_administrativo
                             WHERE add_tipoactoadmin = 1
                             ORDER BY add_nombre ASC;";

        $query_list_acuerdos=$this->cnxion->ejecutar($sql_list_acuerdos);

        while($data_list_acuerdos=$this->cnxion->obtener_filas($query_list_acuerdos)){
            $datalist_acuerdos[]=$data_list_acuerdos;
        }
        return $datalist_acuerdos;
    }
}
?>