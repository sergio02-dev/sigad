<?php
include('classDlgdo.php');
class rsDlgdo extends Delegado{

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function TipoIdentificacion(){

        $sqlTipoIdentificacion="SELECT tid_codigo, tid_nombre, tid_referencia
                                    FROM principal.tipo_identificacion
                                    WHERE tid_codigo NOT IN(4);";

        $queryTipoIdentificacion=$this->cnxion->ejecutar($sqlTipoIdentificacion);

        while($data_TipoIdentificacion=$this->cnxion->obtener_filas($queryTipoIdentificacion)){
            $dataTipoIdentificacion[]=$data_TipoIdentificacion;
        }
        return $dataTipoIdentificacion;
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
}
?>