<?php
include('classResoluciones.php');
Class RsRslcnes extends Resoluciones{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_resoluciones(){

        $sql_list_resoluciones="SELECT aad_codigo, add_nombre, 
                                       add_tipoactoadmin, add_urlactoadmin,
                                       add_vigencia, add_padre, 
                                       add_descripcion
                                  FROM plandesarrollo.acto_administrativo
                                 WHERE add_tipoactoadmin = 2;";

        $query_list_resoluciones=$this->cnxion->ejecutar($sql_list_resoluciones);

        while($data_list_resoluciones=$this->cnxion->obtener_filas($query_list_resoluciones)){
            $datalist_resoluciones[]=$data_list_resoluciones;
        }
        return $datalist_resoluciones;
    }

    public function vigencia_resoluciones(){

        $sql_vigencia_resoluciones="SELECT DISTINCT add_vigencia
                                      FROM plandesarrollo.acto_administrativo
                                     WHERE add_tipoactoadmin = 2
                                     GROUP BY add_vigencia
                                     ORDER BY add_vigencia ASC;";

        $query_vigencia_resoluciones=$this->cnxion->ejecutar($sql_vigencia_resoluciones);

        while($data_vigencia_resoluciones=$this->cnxion->obtener_filas($query_vigencia_resoluciones)){
            $datavigencia_resoluciones[]=$data_vigencia_resoluciones;
        }
        return $datavigencia_resoluciones;
    }

    public function nombre_acuerdo($codigo_acuerdo){

        $sql_nombre_acuerdo="SELECT aad_codigo, add_nombre, 
                                    add_tipoactoadmin, add_urlactoadmin,
                                    add_vigencia, add_padre, 
                                    add_descripcion
                               FROM plandesarrollo.acto_administrativo
                              WHERE aad_codigo = $codigo_acuerdo;";

        $query_nombre_acuerdo=$this->cnxion->ejecutar($sql_nombre_acuerdo);

        $data_nombre_acuerdo=$this->cnxion->obtener_filas($query_nombre_acuerdo);

        $add_nombre = $data_nombre_acuerdo['add_nombre'];

        return $add_nombre;
    }

    public function dataListResoluciones(){
        
        $rs_resoluciones=$this->list_resoluciones();
       
        foreach ($rs_resoluciones as $dta_resoluciones) {
            
            $aad_codigo = $dta_resoluciones['aad_codigo'];
            $add_nombre = $dta_resoluciones['add_nombre'];
            $add_vigencia = $dta_resoluciones['add_vigencia'];
            $add_urlactoadmin = $dta_resoluciones['add_urlactoadmin'];
            $add_padre = $dta_resoluciones['add_padre'];
            $add_descripcion = $dta_resoluciones['add_descripcion'];

            if($add_padre){
                $nombre_acuerdo = $this->nombre_acuerdo($add_padre);
            }
            else{
                $nombre_acuerdo = "";
            }

            $rsRslciones[] = array('aad_codigo'=> $aad_codigo, 
                                   'add_nombre'=> $add_nombre, 
                                   'add_vigencia'=> $add_vigencia,
                                   'add_urlactoadmin'=> $add_urlactoadmin,
                                   'add_padre'=> $add_padre,
                                   'nombre_acuerdo'=> $nombre_acuerdo,
                                   'add_descripcion'=> $add_descripcion

                                );

        }

        $datResolucion=json_encode(array("data"=>$rsRslciones));
            
        return $datResolucion;
    }

    public function form_resolucion($codigo_resolucion){

        $sql_form_resolucion="SELECT aad_codigo, add_nombre, 
                                     add_tipoactoadmin, add_urlactoadmin,
                                     add_vigencia, add_padre, 
                                     add_descripcion
                                FROM plandesarrollo.acto_administrativo
                               WHERE aad_codigo = $codigo_resolucion;";

        $query_form_resolucion=$this->cnxion->ejecutar($sql_form_resolucion);

        while($data_form_resolucion=$this->cnxion->obtener_filas($query_form_resolucion)){
            $dataform_resolucion[]=$data_form_resolucion;
        }
        return $dataform_resolucion;
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