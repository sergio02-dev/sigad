<?php
include('classResolucionpersona.php');
class RsResolucionPersona extends ResolucionPersona
{



    public function __construct()
    {
        $this->cnxion = Dtbs::getInstance();
    }

    public function list_resolucion_persona($codigo_persona)
    {

        $sql_list_resolucion_persona = "SELECT rep_codigo, 
                                            rep_persona, 
                                            rep_resolucion, 
                                            rep_fecharesolucion, 
                                            rep_estado
                                        FROM usco.resolucion_persona
                                        WHERE rep_persona = $codigo_persona
                                        AND rep_estado = 1;";

        $query_list_resolucion_persona = $this->cnxion->ejecutar($sql_list_resolucion_persona);

        while ($data_list_resolucion_persona = $this->cnxion->obtener_filas($query_list_resolucion_persona)) {
            $datalist_resolucion_persona[] = $data_list_resolucion_persona;
        }
        return $datalist_resolucion_persona;
    }

    public function form_resolucion_persona($codigo_resolucion){
        
        $sql_form_resolucion_persona = "SELECT  
                                        rep_persona, 
                                        rep_resolucion, 
                                        rep_fecharesolucion, 
                                        rep_estado
                                    FROM usco.resolucion_persona
                                    WHERE rep_codigo = $codigo_resolucion
                                    AND rep_estado = 1;";

        $resultado_form_resolucion_persona = $this->cnxion->ejecutar($sql_form_resolucion_persona);

        ($data_form_resolucion_persona = $this->cnxion->obtener_filas($resultado_form_resolucion_persona));
        $dataform_resolucion_persona[] = $data_form_resolucion_persona;
        return $dataform_resolucion_persona;
    }




}   
?>