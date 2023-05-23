<?php
    include('prcsos/autrzcion_tcnca/rgstroAutrzcionTcnca.php');

    $codigo_solicitud = $_REQUEST['codigo_solicitud'];
    $actvddes = $_REQUEST['codigo_actividad'];
    $personaSistema = $_SESSION['idusuario'];
    $numero_solicitud = $_REQUEST['numero_solicitud'];
    $codigo_accion = $_REQUEST['scdp_accion'];

    $array_datos = array();

    $numero_actividades = count($actvddes);

    $num_validar = 0;
    for ($dtos_autrzacion=0; $dtos_autrzacion < $numero_actividades; $dtos_autrzacion++) { 
        $codigo_actividad = $actvddes[$dtos_autrzacion];
        $etapas = $_REQUEST['codigo_etapa'.$codigo_actividad];

        $numero_etapas = count($etapas);

        for ($dtos_etpas=0; $dtos_etpas < $numero_etapas; $dtos_etpas++) { 
            $codigo_etapa = $etapas[$dtos_etpas];

            $clasificadoresEtapa = $_REQUEST['clasificadoresEtapa'.$codigo_etapa];
            if($clasificadoresEtapa){
                $numero_clasificadores = count($clasificadoresEtapa);
                for ($list_clasificadores=0; $list_clasificadores < $numero_clasificadores; $list_clasificadores++) { 
                    $codigo_clasificador = $clasificadoresEtapa[$list_clasificadores];

                    $dto_aprovacion = $_REQUEST['etapaClasificador'.$codigo_clasificador];

                    if($dto_aprovacion){
                        $codigo_aprobacion = 1;
                        $num_validar++;
                    }
                    else{
                        $codigo_aprobacion = 0;
                    }

                    $array_datos[] = array('codigo_actividad'=> $codigo_actividad,
                                           'codigo_etapa'=> $codigo_etapa,
                                           'codigo_clasificador'=> $codigo_clasificador,
                                           'codigo_aprobacion'=> $codigo_aprobacion
                                        );
                }
                

            }
            
        }
    }

    $registroautorizaciontecnica = new RgstroAutrzcionTcnca();

    $registroautorizaciontecnica->setSolicitud($codigo_solicitud);
    $registroautorizaciontecnica->setArrayDatos($array_datos);
    $registroautorizaciontecnica->setPersonaSistema($personaSistema);


    if($num_validar>0){
        include('ntfcar_rspnsble_rgstro.php');
    }
    $registroautorizaciontecnica->insert_autorizacion_tecnica();


?>