<?php
include('prcsos/formconsultafun/classFormconsultafun.php');
Class RsConsulta_funcionamiento extends Consulta_funcionamiento{
   

   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 


    public function list_formconsultafun(){

        $sql_list_formconsultafun = "SELECT fun_codigo, 
                                            fun_sede, 
                                            fun_vicerrectoria, 
                                            fun_facultad, 
                                            fun_dependencia, 
                                            fun_area, 
                                            fun_linea, 
                                            fun_sublinea, 
                                            fun_equipo, 
                                            fun_equipodescripcion, 
                                            fun_valorunitario, 
                                            fun_cantidad, 
                                            fun_estado
                                    FROM usco.funcionamiento;";

        $resultado_list_formconsultafun = $this->cnxion->ejecutar($sql_list_formconsultafun);

        while ($data_list_formconsultafun = $this->cnxion->obtener_filas($resultado_list_formconsultafun)){
            $datalist_formconasultafun[] = $data_list_formconsultafun;
        }
        return $datalist_formconasultafun;
    }
    public function nombre_sede($codigo_sede){
        
        $sql_nombre_sede = "SELECT sed_nombre
                              FROM principal.sedes
                             WHERE sed_codigo = $codigo_sede;";

        $resultado_nombre_sede = $this->cnxion->ejecutar($sql_nombre_sede);

        $data_nombre_sede= $this->cnxion->obtener_filas($resultado_nombre_sede);
        
        $sed_nombre = $data_nombre_sede['sed_nombre'];

        return $sed_nombre;
    }
    public function nombre_dependencia($codigo_dependencia){
        
        $sql_nombre_dependencia ="SELECT ofi_nombre
                                FROM  usco.oficina
                                WHERE ofi_codigo = $codigo_dependencia;";

        $resultado_nombre_dependencia = $this->cnxion->ejecutar($sql_nombre_dependencia);

        $data_nombre_dependencia= $this->cnxion->obtener_filas($resultado_nombre_dependencia);
        
        $ofi_nombre = $data_nombre_dependencia['ofi_nombre'];

        return $ofi_nombre;
    }

    public function nombre_equipo($codigo_equipo){
        
        $sql_nombre_equipo ="SELECT  equi_nombre
                             FROM inventario.equipo
                             WHERE equi_codigo=$codigo_equipo;";

        $resultado_nombre_equipo = $this->cnxion->ejecutar($sql_nombre_equipo);

        $data_nombre_equipo= $this->cnxion->obtener_filas($resultado_nombre_equipo);
        
        $equi_nombre = $data_nombre_equipo['equi_nombre'];

        return $equi_nombre;
    }

    public function nombre_descricion($codigo_descripcion){
        
        $sql_nombre_descripcion ="SELECT deq_descripcion
                            FROM inventario.descripcion_equipo
                            WHERE deq_codigo=$codigo_descripcion;";

        $resultado_nombre_descripcion = $this->cnxion->ejecutar($sql_nombre_descripcion);

        $data_nombre_descripcion= $this->cnxion->obtener_filas($resultado_nombre_descripcion);
        
        $deq_descripcion = $data_nombre_descripcion['deq_descripcion'];

        return $deq_descripcion;
    }

    public function nombre_area($codigo_area)
    {

        $sql_nombre_area = "SELECT are_nombre
                            FROM usco.areas
                            WHERE are_codigo=$codigo_area;";

        $resultado_nombre_area = $this->cnxion->ejecutar($sql_nombre_area);

        $data_nombre_area = $this->cnxion->obtener_filas($resultado_nombre_area);

        $are_nombre = $data_nombre_area['are_nombre'];

        return $are_nombre;

    }

    public function nombre_vicerrectoria($codigo_vicerrectoria)
    {

        $sql_nombre_vicerrectoria = "   SELECT ent_nombre
                                        FROM principal.entidad
                                        WHERE ent_codigo = $codigo_vicerrectoria;";

        $resultado_nombre_vicerrectoria = $this->cnxion->ejecutar($sql_nombre_vicerrectoria);

        $data_nombre_vicerrectoria = $this->cnxion->obtener_filas($resultado_nombre_vicerrectoria);

        $ent_nombre = $data_nombre_vicerrectoria['ent_nombre'];

        return $ent_nombre;
    }

    public function nombre_facultad($codigo_facultad)
    {

        $sql_nombre_facultad = "SELECT ent_nombre
                                FROM principal.entidad
                                WHERE ent_codigo = $codigo_facultad;";

        $resultado_nombre_facultad = $this->cnxion->ejecutar($sql_nombre_facultad);

        $data_nombre_facultad = $this->cnxion->obtener_filas($resultado_nombre_facultad);

        $fac_nombre = $data_nombre_facultad['ent_nombre'];

        return $fac_nombre;
    }

    public function nombre_linea($codigo_linea)
    {

        $sql_nombre_linea = "   SELECT lin_nombre
                                    FROM inventario.linea
                                    WHERE lin_codigo = $codigo_linea;";

        $resultado_nombre_linea = $this->cnxion->ejecutar($sql_nombre_linea);

        $data_nombre_linea = $this->cnxion->obtener_filas($resultado_nombre_linea);

        $lin_nombre = $data_nombre_linea['lin_nombre'];

        return $lin_nombre;
    }

    public function nombre_sublinea($codigo_sublinea)
    {

        $sql_nombre_sublinea = "   SELECT slin_nombre
                                FROM inventario.sub_linea
                                WHERE slin_codigo = $codigo_sublinea;";

        $resultado_nombre_sublinea = $this->cnxion->ejecutar($sql_nombre_sublinea);

        $data_nombre_sublinea = $this->cnxion->obtener_filas($resultado_nombre_sublinea);

        $slin_nombre = $data_nombre_sublinea['slin_nombre'];

        return $slin_nombre;
    }

    


    
    public function datFormconsultafun(){
        
        $list_formconsultafun = $this->list_formconsultafun();
        
        if($list_formconsultafun){
            foreach ($list_formconsultafun as $dat_consultafun) {
                $fun_codigo = $dat_consultafun['fun_codigo'];
                $fun_sede = $dat_consultafun['fun_sede'];
                $fun_dependencia = $dat_consultafun['fun_dependencia'];
                $fun_equipo = $dat_consultafun['fun_equipo'];
                $fun_descripcion = $dat_consultafun['fun_equipodescripcion'];
                $fun_cantidad = $dat_consultafun['fun_cantidad'];
                $fun_valorunitario = $dat_consultafun['fun_valorunitario'];
                $fun_estado = $dat_consultafun['fun_estado'];
                $fun_area = $dat_consultafun['fun_area'];
                $fun_vicerrectoria = $dat_consultafun['fun_vicerrectoria'];
                $fun_facultad = $dat_consultafun['fun_facultad'];
                $fun_linea = $dat_consultafun['fun_linea'];
                $fun_sublinea = $dat_consultafun['fun_sublinea'];

                $nombre_sede = $this->nombre_sede($fun_sede);
                $nombre_dependencia = $this->nombre_dependencia($fun_dependencia);
                $nombre_equipo = $this->nombre_equipo($fun_equipo);
                $nombre_descripcion = $this->nombre_descricion($fun_descripcion);
                $nombre_area = $this->nombre_area($fun_area);
                $nombre_vicerrectoria = $this->nombre_vicerrectoria($fun_vicerrectoria);
                $nombre_facultad = $this->nombre_facultad($fun_facultad);
                $nombre_linea = $this->nombre_linea($fun_linea);
                $nombre_sublinea = $this->nombre_sublinea($fun_sublinea);

                

                if($fun_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

    
                $rsFormconsultafun[] = array('sed_nombre'=> $nombre_sede, 
                                           'ofi_nombre'=> $nombre_dependencia, 
                                           'equi_nombre'=> $nombre_equipo, 
                                           'deq_descripcion'=> $nombre_descripcion,
                                           'fun_cantidad'=> $fun_cantidad, 
                                           'fun_valorunitario'=> $fun_valorunitario,
                                           'estado'=> $estado,
                                           'fun_codigo'=> $fun_codigo,
                                           'are_nombre'=> $nombre_area,
                                           'ent_nombre'=> $nombre_vicerrectoria,
                                           'fac_nombre'=> $nombre_facultad,
                                           'lin_nombre'=> $nombre_linea,
                                           'slin_nombre'=> $nombre_sublinea,
                                           
                                           
                                        );
    
            }
            $dattFormconsultafun=json_encode(array("data"=>$rsFormconsultafun));
        }
        else{
            $dattFormconsultafun=json_encode(array("data"=>""));
        } 
        return $dattFormconsultafun;
    }

}
?>