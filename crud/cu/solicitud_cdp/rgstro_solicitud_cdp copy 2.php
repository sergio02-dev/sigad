<?php
    header("Content-type: application/json");
    include('prcsos/solicitud_cdp/rgstroSolicitudCdp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaSolicitud = $_REQUEST['txtFechaSolicitud'];
    $selAccion = $_REQUEST['selAccion'];
    $etpass = $_REQUEST['etpass'];
    $chkestado = $_REQUEST['chkestado'];
    $SumTotal = str_replace('.','',$_REQUEST['SumTotal']);
    $fuente_financiacion = $_REQUEST['fuenntes'];
   
    $registrosolicitudcdp = new RgstroSolicitudCdp();

    $array_datos = array();
    if($etpass){
        $cantidad = count($etpass);
        $codigos_etapas_actividad = "";
        $num_etapas = 1;
        for ($array_etapa=0; $array_etapa < $cantidad; $array_etapa++) { 
            $codigo_etapa = $etpass[$array_etapa];
            $otro_valor = $_REQUEST['checkOtrval'.$codigo_etapa];
            $valor_caja_texto = $_REQUEST['valor'.$codigo_etapa];

            if($cantidad == $num_etapas){
                $coma = "";
            }
            else{
                $coma = ",";
            }

            $codigos_etapas_actividad = $codigos_etapas_actividad.$codigo_etapa.$coma;

            $dtEtpa = $registrosolicitudcdp->data_etapa($codigo_etapa);

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

                $array_datos[] = array('codigo_etapa'=> $poa_codigo,
                                       'codigo_actividad'=> $acp_codigo,
                                       'recurso'=>  $valor_solicitud,
                                       'other_value'=> $other_value,
                                       'codigo_clasificador'=> $codigo_clasificador
                                    );
            }
            $num_etapas++;
        }
    }
    else{
        $codigos_etapas_actividad = 0;
    }

    $array_fuentes_financiacion = array();
    if($fuente_financiacion){
        $numero_validacion = 0;
        $cantidad_fuentes = count($fuente_financiacion);
        for ($lista_fuentes=0; $lista_fuentes < $cantidad_fuentes ; $lista_fuentes++) { 
            $codigo_fuente = $fuente_financiacion[$lista_fuentes];
            $valor_solicitado = $_REQUEST['valorpoai'.$codigo_fuente];

            $array_fuentes_financiacion[] = array('codigo_poai'=> $codigo_fuente, 
                                                  'valor_solicitado'=> $valor_solicitado,
                                                );

            $validacion_saldo_poai = $registrosolicitudcdp->validacion_saldo_poai($codigo_fuente);

            $saldo = $validacion_saldo_poai - $valor_solicitado;

            if($saldo < 0){
                $numero_validacion++; 
            }
        }
    }  

    $registrosolicitudcdp->setFecha($txtFechaSolicitud);
    $registrosolicitudcdp->setAccion($selAccion);
    $registrosolicitudcdp->setEstado($chkestado);
    $registrosolicitudcdp->setPersonaSistema($personaSistema);
    $registrosolicitudcdp->setArrayDatos($array_datos);
    $registrosolicitudcdp->setFuentesFinanciacion($array_fuentes_financiacion);

    if($numero_validacion == 0){
        $registrosolicitudcdp->insertSolicitud();
    }
    else{

    }

    echo $numero_validacion;
    
?>