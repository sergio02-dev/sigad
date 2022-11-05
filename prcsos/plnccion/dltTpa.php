<?php

    include_once('classActvdadPoai.php');

    class DltTpa extends ActividadPoai{

        private $sqlDeleteEtapas;
 
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
           
        }

        public function EtapasEliminar(){

            $sql_EtapasEliminar="SELECT poa_codigo, poa_referencia, poa_objeto, poa_recurso, poa_logro, 
                                        poa_fechacreo, poa_fechamodifico, poa_personacreo, poa_personamodifico, 
                                        poa_estado, poa_numero, poa_vigencia, acp_codigo, poa_logroejecutado
                                   FROM planaccion.poai
                                  WHERE poa_codigo=".$this->getCodigoActividad().";";

            $resulatdo_EtapasEliminar=$this->cnxion->ejecutar($sql_EtapasEliminar);

            while($data_EtapasEliminar =$this->cnxion->obtener_filas($resulatdo_EtapasEliminar)){
                $dataEtapasEliminar[]=$data_EtapasEliminar;
            }
            return $dataEtapasEliminar;
        }

        public function deleteEtapa(){

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
                                            VALUES  (".$this->getCodigoActividad().", '$poa_referencia', '$poa_objeto', $poa_recurso, $poa_logro, 
                                                    '$poa_fechacreo', '$poa_fechamodifico', $poa_personacreo, $poa_personamodifico, 
                                                    '$poa_estado', $poa_numero, $poa_vigencia, $acp_codigo, $poa_logroejecutado, 
                                                    NOW(), ".$this->getPersonaSistema().");";

                    //echo "<br> ".$insterEtapaEliminar."<br>";
                    $this->cnxion->ejecutar($insterEtapaEliminar);
            }
                


            $sqlDeleteEtapas= "DELETE FROM planaccion.poai
                                WHERE poa_codigo=".$this->getCodigoActividad()." ;";

            $this->cnxion->ejecutar($sqlDeleteEtapas);

            return $sqlDeleteEtapas;

        }


    }
?>