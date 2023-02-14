<?php
    include('prcsos/solicitud_cdp/mdfcarSolicitudCdp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaSolicitud = $_REQUEST['txtFechaSolicitud'];
    //$txtNumeroSolicitud = $_REQUEST['txtNumeroSolicitud'];
    $scdp_accion = $_REQUEST['scdp_accion'];
    $actvddes = $_REQUEST['codigo_actividad'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];
    $txtObjetoCDP = $_REQUEST['txtObjetoCDP'];
    $txtNumeroSolicitud = $_REQUEST['txtNumeroSolicitud'];
   
    $modificarsolicitudcdp = new MdfcarSolicitudCdp();

    $array_datos = array();

    if($actvddes){
        $num_activs = count($actvddes);
        for ($array_etpas=0; $array_etpas < $num_activs; $array_etpas++) { 
            $codigo_actividad = $actvddes[$array_etpas];
            $codigo_etapa = $_REQUEST['etpass'.$codigo_actividad];
            $otro_valor = $_REQUEST['checkOtrval'.$codigo_actividad];
            $valor_caja_texto = str_replace('.','',$_REQUEST['valor'.$codigo_actividad]);
            $poa_recurso = $_REQUEST['valor_etapa'.$codigo_actividad];
            $clasificadores = $_REQUEST['selClasificador'.$codigo_actividad];
            $valor_clasfcdor = $_REQUEST['valor_clasificador'.$codigo_actividad];
            $cdgo_dane = $_REQUEST['codigo_dane'.$codigo_actividad];
            $dscrpcion_dane = $_REQUEST['descripcion_dane'.$codigo_actividad];


            $array_clasificador = array();

            for ($list_clasificadores=0; $list_clasificadores < count($clasificadores); $list_clasificadores++) { 
                $codigo_clasificador = $clasificadores[$list_clasificadores];
                $valor_clasificador = str_replace('.','',$valor_clasfcdor[$list_clasificadores]);
                $codigo_dane = $cdgo_dane[$list_clasificadores];
                $descripcion_dane = $dscrpcion_dane[$list_clasificadores];

                $array_clasificador[] = array('codigo_clasificador'=> $codigo_clasificador, 
                                              'valor_clasificador'=> $valor_clasificador,
                                              'codigo_dane'=>$codigo_dane,
                                              'descripcion_dane'=>$descripcion_dane);
            }

            if($otro_valor == 1){
                $other_value = 1;
                $valor_solicitud = $valor_caja_texto;
            }
            else{
                $other_value = 0;
                $valor_solicitud = $poa_recurso;
            }

            $codigo_recurso = $_REQUEST['codigo_recurso'.$codigo_etapa];

            $array_fuente_valor = array();

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

                $array_fuente_valor[] = array('codigo_etapa'=> $codigo_etapa,
                                              'codigo_asignacion'=> $codigo_asignacion,
                                              'verificar_cambio'=> $verificar_cambio,
                                              'valor_cambio'=> $valor_cambio,
                                            );

            }
            $array_datos[] = array('codigo_etapa'=> $codigo_etapa,
                                   'codigo_actividad'=> $codigo_actividad,
                                   'recurso'=>  $valor_solicitud,
                                   'other_value'=> $other_value,
                                   'codigo_clasificador'=> $array_clasificador,
                                   'asignaciones_solicitud'=> $array_fuente_valor
                                );
        }

    }

    //print_r($array_datos);

    $modificarsolicitudcdp->setFecha($txtFechaSolicitud);
   // $modificarsolicitudcdp->setCodigoSolicitud($txtNumeroSolicitud);
    $modificarsolicitudcdp->setAccion($scdp_accion);
    $modificarsolicitudcdp->setEstado($chkestado);
    $modificarsolicitudcdp->setPersonaSistema($personaSistema);
    $modificarsolicitudcdp->setArrayDatos($array_datos);
    $modificarsolicitudcdp->setCodigo($codigo_solicitud);
    $modificarsolicitudcdp->setObjeto($txtObjetoCDP);
    $modificarsolicitudcdp->setConsecutivo($txtNumeroSolicitud);

    echo  $modificarsolicitudcdp->mdfcarSolicitud();
    
?>