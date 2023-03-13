<?php
include('classFormpdi.php');
Class RsFormpdi extends PlandeComprasPDI{
   
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

        $sql_list_caracteristicas = "SELECT equi_codigo, equi_sublinea, equi_nombre,
                                            deq_descripcion, deq_valor, deq_codigo,
                                            deq_valor
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

  
   


}
?>
 
