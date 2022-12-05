<?php
include('classFormfun.php');
Class RsFuncionamiento extends Funcionamiento{
   

   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
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


 

    

   
    public function form_funcionamiento($codigo_formfun){
        
        $sql_form_formfun = "SELECT sed_codigo, sed_estado
                                    FROM principal.entidad
                                  WHERE sed_codigo = $codigo_formfun;";

        $resultado_form_formfun = $this->cnxion->ejecutar($sql_form_formfun);

        ($data_form_formfun = $this->cnxion->obtener_filas($resultado_form_formfun));
        $dataform_formfun[] = $data_form_formfun;
        return $dataform_formfun;
    }

}
?>