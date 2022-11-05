<?php
    function caracteres($palabra){
        $no_admitidas = array(".",",");
        $admitidas = array("");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/cdp/rgstroCdp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaExpedicion = $_REQUEST['txtFechaExpedicion'];
    $txtNumeroExpedicion = caracteres($_REQUEST['txtNumeroExpedicion']);
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];
    $etapass = $_REQUEST['etapass'];

    $registroCdp = new RgstroCdp();

    $array_datos = array();

    if($etapass){
        $cantidad = count($etapass);
        $num_etapas = 1;
        for ($array_etapa=0; $array_etapa < $cantidad; $array_etapa++) { 
            $codigo_etapa = $etapass[$array_etapa];
            $otro_valor = $_REQUEST['checkOtrval'.$codigo_etapa];
            $valor_caja_texto = str_replace('.','',$_REQUEST['valor'.$codigo_etapa]);

            $dtEtpa = $registroCdp->data_etapa($codigo_etapa);

            foreach ($dtEtpa as $dat_etapa) {
                $poa_codigo = $dat_etapa['poa_codigo'];
                $acp_codigo = $dat_etapa['acp_codigo'];
                $poa_recurso = $dat_etapa['poa_recurso'];

                $codigo_clasificador = $_REQUEST['codigo_clasificador'.$poa_codigo];

                if($otro_valor == 1){
                    $other_value = 1;
                    $valor_solicitud = $valor_caja_texto;
                }
                else{
                    $other_value = 0;
                    $valor_solicitud = $poa_recurso;
                }

                $codigo_recurso = $_REQUEST['codigo_recurso'.$poa_codigo];

                for ($array_recurso=0; $array_recurso < count($codigo_recurso); $array_recurso++) {
                    $codigo_asignacion = $codigo_recurso[$array_recurso];
                    $cambio_valor = $_REQUEST['checkCmbioval'.$codigo_asignacion];
                    $recurso_asignado = $_REQUEST['recurso_asignado'.$codigo_asignacion];
                    $fuentes_asgnacion = str_replace('.','',$_REQUEST['fuentes_asgnacion'.$codigo_asignacion]);

                    if($cambio_valor == 1){
                        $verificar_cambio = $cambio_valor;
                        $valor_cambio = $fuentes_asgnacion;

                    }
                    else{
                        $verificar_cambio = 0;
                        $valor_cambio = $recurso_asignado;
                    }

                    $array_fuente_valor[] = array('codigo_etapa'=> $poa_codigo,
                                                  'codigo_asignacion'=> $codigo_asignacion,
                                                  'verificar_cambio'=> $verificar_cambio,
                                                  'valor_cambio'=> $valor_cambio,
                                                );

                }

                $array_datos[] = array('codigo_etapa'=> $poa_codigo,
                                       'codigo_actividad'=> $acp_codigo,
                                       'recurso'=>  $valor_solicitud,
                                       'other_value'=> $other_value,
                                       'codigo_clasificador'=> $codigo_clasificador,
                                       'asignaciones_solicitud'=> $array_fuente_valor
                                    );
            }
            $num_etapas++;
        }
    }

    //print_r($array_datos);

    $registroCdp->setFecha($txtFechaExpedicion);
    $registroCdp->setNumero($txtNumeroExpedicion);
    $registroCdp->setCodigoSolicitud($codigo_solicitud);
    $registroCdp->setPersonaSistema($personaSistema);
    $registroCdp->setArrayDatos($array_datos);

    $registroCdp->insert_cdp();
?>