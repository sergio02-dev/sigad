<?php

    include_once('classActvdadPoai.php');

    class DltCtvdadCcion extends ActividadPoai{

        private $sqlDeleteActividadAccion;
        private $sqlDeleteEtapas;
 
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
           
        }

        public function ActividadEliminar(){

            $sql_ActividadEliminar="SELECT acp_codigo, acp_descripcion, acp_accion, acp_proyecto, acp_referencia, 
                                           acp_estado, acp_vigencia, acp_numero, acp_subsistema, acp_personacreo,
                                           acp_personamodifico, acp_fechamodifico, acp_fechacreo
                                      FROM planaccion.actividad_poai
                                     WHERE acp_codigo=".$this->getCodigoActividad().";";

            $resulatdo_ActividadEliminar=$this->cnxion->ejecutar($sql_ActividadEliminar);

            while($data_ActividadEliminar =$this->cnxion->obtener_filas($resulatdo_ActividadEliminar)){
                $dataActividadEliminar[]=$data_ActividadEliminar;
            }
            return $dataActividadEliminar;
        }

        public function EtapasEliminar(){

            $sql_EtapasEliminar="SELECT poa_codigo, poa_referencia, poa_objeto, poa_recurso, poa_logro, 
                                        poa_fechacreo, poa_fechamodifico, poa_personacreo, poa_personamodifico, 
                                        poa_estado, poa_numero, poa_vigencia, acp_codigo, poa_logroejecutado
                                   FROM planaccion.poai
                                  WHERE acp_codigo=".$this->getCodigoActividad().";";

            $resulatdo_EtapasEliminar=$this->cnxion->ejecutar($sql_EtapasEliminar);

            while($data_EtapasEliminar =$this->cnxion->obtener_filas($resulatdo_EtapasEliminar)){
                $dataEtapasEliminar[]=$data_EtapasEliminar;
            }
            return $dataEtapasEliminar;
        }

        public function deleteActividadAccion(){

            $accionActividad=$this->ActividadEliminar();
            //echo ""

            foreach ($accionActividad as $data_ActividadEliminar) {
               $acp_codigo=$data_ActividadEliminar['acp_codigo'];
               $acp_descripcion=$data_ActividadEliminar['acp_descripcion'];
               $acp_accion=$data_ActividadEliminar['acp_accion'];
               $acp_proyecto=$data_ActividadEliminar['acp_proyecto'];
               $acp_referencia=$data_ActividadEliminar['acp_referencia'];
               $acp_estado=$data_ActividadEliminar['acp_estado'];
               $acp_vigencia=$data_ActividadEliminar['acp_vigencia'];
               $acp_numero=$data_ActividadEliminar['acp_numero'];
               $acp_subsistema=$data_ActividadEliminar['acp_subsistema'];
               $acp_personacreo=$data_ActividadEliminar['acp_personacreo'];
               $acp_personamodifico=$data_ActividadEliminar['acp_personamodifico'];
               $acp_fechamodifico=$data_ActividadEliminar['acp_fechamodifico'];
               $acp_fechacreo=$data_ActividadEliminar['acp_fechacreo'];

               $insterActividadEliminar="INSERT INTO planaccion.actividad_poaieliminada(
                                                    acpe_codigo, acpe_descripcion, acpe_accion, acpe_proyecto, acpe_referencia, 
                                                    acpe_estado, acpe_fechaelimino, acpe_personaelimino, acpe_vigencia, 
                                                    acpe_numero, acpe_subsistema, acpe_fechacreo, acpe_fechamodifico,
                                                    acpe_personacreo, acpe_personamodifico )
                                            VALUES (".$this->getCodigoActividad().", '$acp_descripcion', $acp_accion, $acp_proyecto, '$acp_referencia', 
                                                    '$acp_estado', NOW(), ".$this->getPersonaSistema().", $acp_vigencia, 
                                                    $acp_numero, $acp_subsistema, '$acp_fechacreo', '$acp_fechamodifico',
                                                    $acp_personacreo, $acp_personamodifico);";

                                                    echo "<br> ".$insterActividadEliminar."<br>";
                 $this->cnxion->ejecutar($insterActividadEliminar);
            }

            $etapaEliminar=$this->EtapasEliminar();

            foreach ($etapaEliminar as $data_EtapasEliminar) {
                $poa_codigo=$data_EtapasEliminar['poa_codigo'];
                $poa_referencia=$data_EtapasEliminar['poa_referencia'];
                $poa_objeto=$data_EtapasEliminar['poa_objeto'];
                $poa_recurso=$data_EtapasEliminar['poa_recurso'];
                $poa_logro=$data_EtapasEliminar['poa_logro'];
                $poa_fechacreo=$data_EtapasEliminar['poa_fechacreo'];
                $poa_fechamodifico=$data_EtapasEliminar['poa_fechamodifico'];
                $poa_personacreo=$data_EtapasEliminar['poa_personacreo'];
                $poa_personamodifico=$data_EtapasEliminar['poa_personamodifico'];
                $poa_estado=$data_EtapasEliminar['poa_estado'];
                $poa_numero=$data_EtapasEliminar['poa_numero'];
                $poa_vigencia=$data_EtapasEliminar['poa_vigencia'];
                $acp_codigo=$data_EtapasEliminar['acp_codigo'];
                $poa_logroejecutado=$data_EtapasEliminar['poa_logroejecutado'];

                $insterEtapaEliminar="INSERT INTO planaccion.poai_eliminar(
                                                     poae_codigo, poae_referencia, poae_objeto, poae_recurso, poae_logro, 
                                                     poae_fechacreo, poae_fechamodifico, poae_personacreo, poae_personamodifico, 
                                                     poae_estado, poae_numero, poae_vigencia, acpe_codigo, poae_logroejecutado, 
                                                     poae_fechaelimino, poae_personaelimino)
                                            VALUES  ($poa_codigo, '$poa_referencia', '$poa_objeto', $poa_recurso, $poa_logro, 
                                                    '$poa_fechacreo', '$poa_fechamodifico', $poa_personacreo, $poa_personamodifico, 
                                                    '$poa_estado', $poa_numero, $poa_vigencia, ".$this->getCodigoActividad().", $poa_logroejecutado, 
                                                    NOW(), ".$this->getPersonaSistema().");";

                    //echo "<br> ".$insterEtapaEliminar."<br>";
                    $this->cnxion->ejecutar($insterEtapaEliminar);
            }

            $sqlDeleteActividadAccion="DELETE FROM planaccion.actividad_poai
                                         WHERE acp_codigo=".$this->getCodigoActividad().";";

            $this->cnxion->ejecutar($sqlDeleteActividadAccion);

            $sqlDeleteEtapas= "DELETE FROM planaccion.poai
                                 WHERE acp_codigo=".$this->getCodigoActividad()." ;";

            $this->cnxion->ejecutar($sqlDeleteEtapas);

            return $sqlDeleteActividadAccion." ".$sqlDeleteEtapas;

        }


    }
?>