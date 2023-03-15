<?php
include('prcsos/formpdi/classFormpdi.php');
Class RsMdfcarPlanComprasPdi extends PlandeComprasPDI{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
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

    public function list_proyecto(){

        $codigo_plan = $this->ultimo_plan();

        $sql_list_proyecto= "SELECT pro_codigo, pro_descripcion,pro_referencia, pro_numero
                               FROM plandesarrollo.proyecto
                              INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                              WHERE pde_codigo = $codigo_plan
                                AND pro_codigo IN(SELECT DISTINCT acc_proyecto
                                                    FROM plandesarrollo.plan_compras_accion
                                                    INNER JOIN  plandesarrollo.accion ON pca_accion = acc_codigo
                                                    WHERE pca_estado = 1)
                                ORDER BY pro_referencia, pro_numero ASC";
    
        $resultado_list_proyecto = $this->cnxion->ejecutar($sql_list_proyecto);

        while ($data_list_proyecto = $this->cnxion->obtener_filas($resultado_list_proyecto)){
        $datalist_proyecto[] = $data_list_proyecto;
        }
        return $datalist_proyecto;
    }

    public function mdfcar_list_proyecto($codigo_accion){

        $codigo_plan = $this->ultimo_plan();

        $sql_mdfcar_list_proyecto= "SELECT pro_codigo
                               FROM plandesarrollo.proyecto
                              INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                              WHERE pde_codigo = $codigo_plan
                                AND pro_codigo IN(SELECT DISTINCT acc_proyecto
                                                    FROM plandesarrollo.plan_compras_accion
                                                    INNER JOIN  plandesarrollo.accion ON pca_accion = acc_codigo
                                                    WHERE pca_estado = 1
                                                    AND pca_accion = $codigo_accion)";
    
        $resultado_mdfcar_list_proyecto = $this->cnxion->ejecutar($sql_mdfcar_list_proyecto);

        $data_mdfcar_list_proyecto = $this->cnxion->obtener_filas($resultado_mdfcar_list_proyecto);
        $pro_codigo = $data_mdfcar_list_proyecto['pro_codigo'];
        return $pro_codigo;

    }

    public function list_accion($codigo_proyecto){

        $sql_list_accion= "SELECT acc_codigo, acc_referencia, acc_descripcion,acc_numero,acc_proyecto
                            FROM plandesarrollo.accion
                            WHERE acc_proyecto = $codigo_proyecto
                            AND acc_codigo IN (SELECT DISTINCT pca_accion
                                                 FROM plandesarrollo.plan_compras_accion
                                                WHERE pca_estado = 1)
                            ORDER BY acc_referencia, acc_numero ASC";
    
        $resultado_list_accion = $this->cnxion->ejecutar($sql_list_accion);

        while ($data_list_accion = $this->cnxion->obtener_filas($resultado_list_accion)){
        $datalist_accion[] = $data_list_accion;
        }
        return $datalist_accion;
    }




    public function list_sedes(){

        $sql_list_sedes = "SELECT sed_codigo, sed_nombre, sed_estado
                            FROM principal.sedes
                            ORDER BY sed_nombre ASC;";

        $resultado_list_sedes = $this->cnxion->ejecutar($sql_list_sedes);

        while ($data_list_sedes = $this->cnxion->obtener_filas($resultado_list_sedes)){
            $datalist_sedes[] = $data_list_sedes;
        }
        return $datalist_sedes;
    }

    public function list_vicerrectoria($codigo_sede){

        $sql_list_vicerrectoria = "SELECT DISTINCT ent_codigo, ent_nombre
                                FROM principal.sedes
                                INNER JOIN usco.organigrama_usco ON org_sede = sed_codigo
                                INNER JOIN principal.entidad ON ent_codigo = org_vicerrectoria
                                WHERE sed_codigo = $codigo_sede
                                ORDER BY ent_nombre ASC;";

        $resultado_list_vicerrectoria = $this->cnxion->ejecutar($sql_list_vicerrectoria);

        while ($data_list_vicerrectoria = $this->cnxion->obtener_filas($resultado_list_vicerrectoria)){
            $datalist_vicerrectoria[] = $data_list_vicerrectoria;
        }
        return $datalist_vicerrectoria;
    }
    public function list_facultad($codigo_sede, $codigo_vicerrectoria){

        $sql_list_facultad = "SELECT DISTINCT org_sede, org_vicerrectoria, 
                                            org_facultades as codigo_facultad, ent_nombre as nombre_facultad
                                            FROM usco.organigrama_usco
                                             INNER JOIN principal.entidad ON ent_codigo = org_facultades
                                             WHERE org_sede = $codigo_sede
                                             AND org_vicerrectoria = $codigo_vicerrectoria
                                            ORDER BY org_facultades, ent_nombre ASC;";

        $resultado_list_facultad = $this->cnxion->ejecutar($sql_list_facultad);

        while ($data_list_facultad = $this->cnxion->obtener_filas($resultado_list_facultad)){
            $datalist_facultad[] = $data_list_facultad;
        }
        return $datalist_facultad;
    }

    public function list_dependencia($codigo_sede, $codigo_vice, $codigo_facultad){

        $sql_list_dependencia = "SELECT DISTINCT org_sede, org_vicerrectoria, 
                                                ofi_codigo AS codigo_dependencia, 
                                                ofi_nombre AS nombre_dependencia
                                            FROM usco.organigrama_usco
                                            INNER JOIN usco.oficina ON ofi_codigo = org_dependencias
                                            WHERE org_sede = $codigo_sede
                                            AND org_vicerrectoria = $codigo_vice
                                            AND org_facultades = $codigo_facultad
                                            ORDER BY nombre_dependencia ASC;";   

        $resultado_list_dependencia = $this->cnxion->ejecutar($sql_list_dependencia);

        while ($data_list_dependencia = $this->cnxion->obtener_filas($resultado_list_dependencia)){
            $datalist_dependencia[] = $data_list_dependencia;
        }
        return $datalist_dependencia;
    }

    public function list_area($codigo_sede, $codigo_vicerrectoria, $codigo_facultad, $codigo_dependencia){

        $sql_list_area = "SELECT DISTINCT org_sede, org_vicerrectoria, 
                                        are_codigo AS codigo_area, 
                                        are_nombre AS nombre_area
                                        FROM usco.organigrama_usco
                                        INNER JOIN usco.areas ON are_codigo = org_areas
                                        WHERE org_sede = $codigo_sede
                                        AND org_vicerrectoria = $codigo_vicerrectoria
                                        AND org_facultades = $codigo_facultad
                                        AND org_dependencias = $codigo_dependencia
                                        ORDER BY are_nombre ASC;";   

        $resultado_list_area = $this->cnxion->ejecutar($sql_list_area);

        while ($data_list_area = $this->cnxion->obtener_filas($resultado_list_area)){
            $datalist_area[] = $data_list_area;
        }
        return $datalist_area;
    }

    public function list_linea(){

        $sql_list_linea = "SELECT lin_codigo, lin_nombre, lin_estado
                                FROM inventario.linea
                                ORDER BY lin_nombre ASC;";

        $resultado_list_linea = $this->cnxion->ejecutar($sql_list_linea);

        while ($data_list_linea = $this->cnxion->obtener_filas($resultado_list_linea)){
            $datalist_linea[] = $data_list_linea;
        }
        return $datalist_linea;
    }

    public function list_sublinea($codigo_linea){

        $sql_list_sublinea = "SELECT slin_codigo, slin_linea, slin_nombre, slin_estado
                                FROM inventario.sub_linea
                               WHERE slin_linea = $codigo_linea
                                ORDER BY slin_nombre ASC;";

        $resultado_list_sublinea = $this->cnxion->ejecutar($sql_list_sublinea);

        while ($data_list_sublinea = $this->cnxion->obtener_filas($resultado_list_sublinea)){
            $datalist_sublinea[] = $data_list_sublinea;
        }
        return $datalist_sublinea;
    }

    public function list_equipo($codigo_sublinea){

        $sql_list_equipo = "SELECT slin_codigo, equi_codigo, equi_nombre
                                FROM inventario.sub_linea
                                INNER JOIN inventario.equipo ON slin_codigo = equi_sublinea
                                WHERE slin_codigo = $codigo_sublinea
                                ORDER BY equi_nombre ASC;";

        $resultado_list_equipo = $this->cnxion->ejecutar($sql_list_equipo);

        while ($data_list_equipo = $this->cnxion->obtener_filas($resultado_list_equipo)){
            $datalist_equipo[] = $data_list_equipo;
        }
        return $datalist_equipo;
    }

    public function list_caracteristicas($codigo_equipo){


        $sql_list_caracteristicas = "SELECT deq_descripcion, deq_valor, deq_codigo
                                        FROM inventario.equipo
                                        INNER JOIN inventario.descripcion_equipo ON deq_equipo = equi_codigo
                                        WHERE deq_estado = 1
                                        AND deq_equipo = $codigo_equipo
                                        ORDER BY deq_descripcion ASC;";

        $resultado_list_caracteristicas = $this->cnxion->ejecutar($sql_list_caracteristicas);

        while ($data_list_caracteristicas = $this->cnxion->obtener_filas($resultado_list_caracteristicas)){
            $datalist_caracteristicas[] = $data_list_caracteristicas;
        }
        return $datalist_caracteristicas;
    }


    public function planta_fisica($codigo_accion){

        $sql_planta_fisica="SELECT pca_codigo, pca_plantafisica
                                FROM plandesarrollo.plan_compras_accion
                                WHERE pca_estado = 1
                                AND pca_accion =$codigo_accion;";

        $query_planta_fisica=$this->cnxion->ejecutar($sql_planta_fisica);

        $data_planta_fisica=$this->cnxion->obtener_filas($query_planta_fisica);
        
        $pca_plantafisica = $data_planta_fisica['pca_plantafisica'];

        return $pca_plantafisica;
    }

    public function form_plancompraspdi($codigo_pdi){
        
            $sql_form_plancompraspdi = "SELECT pdi_codigo, pdi_sede, 
                                            pdi_vicerrectoria, pdi_facultad, pdi_dependencia, 
                                            pdi_area, pdi_accion, pdi_plantafisica, pdi_linea, 
                                            pdi_sublinea, pdi_equipo, pdi_equipodescripcion, 
                                            pdi_valorunitario, pdi_cantidad, pdi_estado,
                                            pdi_valorunitario * pdi_cantidad AS total
                                            FROM usco.formulariopdi
                                            WHERE pdi_codigo = $codigo_pdi;";

        $resultado_form_plancompraspdi = $this->cnxion->ejecutar($sql_form_plancompraspdi);

        ($data_form_plancompraspdi = $this->cnxion->obtener_filas($resultado_form_plancompraspdi));
        $dataform_plancompraspdi[] = $data_form_plancompraspdi;
        return $dataform_plancompraspdi;
    }
   


}
?>
 
