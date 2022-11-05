<?php
    include('grlla/data/tpoctvdad.php');

    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_certificado = $_REQUEST['codigo_certificado'];
    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_activida_realizada = $_REQUEST['codigo_activida_realizada']; 

   
    include('crud/rs/rsMtaPrdcto.php');
    $acto_administrativo= Array('Seleccione...','Acuerdo','Resolución','Factura','Acta','Oficio');
   
    list($inicio,$fin)=$objRsMtaPrdcto->anio_inicio_fin($codigo_plan); 

    list($unidad_medida, $linea_base, $meta_resultado)=$objRsMtaPrdcto->unidad_linea_meta($codigo_accion);

    $actividad_descripcion = $objRsMtaPrdcto->actividad_descripcion($codigo_actividad);

    $etapa_descripcion = $objRsMtaPrdcto->etapa_descripcion($codigo_etapa);

    $porcentaje_cumplido_etapa = $objRsMtaPrdcto->porcentaje_cumplido_etapa($codigo_etapa);

    $logro_acumulado = $objRsMtaPrdcto->logro_acumulado($codigo_certificado, $codigo_actividad, $codigo_etapa);

    $acc_descripcion = $objRsMtaPrdcto->descripcion_accion($codigo_accion);


    if($codigo_activida_realizada){

        $capa_direccion = ".capita".$codigo_etapa;
        $url_direccion = "inforgstroactvdad?codigo_certificado=".$codigo_certificado."&codigo_accion=".$codigo_accion."&codigo_etapa=".$codigo_etapa."&codigo_actividad=".$codigo_actividad."&codigo_plan=".$codigo_plan;

        include('crud/rs/rgstroctvidadupdte.php');

        $activdad_etpa_edtar = $objRsRgstroCtvdad->activdad_etpa_edtar($codigo_activida_realizada);

        foreach($activdad_etpa_edtar as $data_actvdad_rlzda){
            $rea_codigo = $data_actvdad_rlzda['rea_codigo'];
            $rea_codigocertificado = $data_actvdad_rlzda['rea_codigocertificado'];
            $rea_codigoactividadpoai = $data_actvdad_rlzda['rea_codigoactividadpoai'];
            $rea_codigoetapa = $data_actvdad_rlzda['rea_codigoetapa'];
            $rea_codigoactividad = $data_actvdad_rlzda['rea_codigoactividad'];
            $rea_numeroveces = $data_actvdad_rlzda['rea_numeroveces']; 
            $rea_logrado = $data_actvdad_rlzda['rea_logrado'];
            $rea_vigencia = $data_actvdad_rlzda['rea_vigencia'];            
          
        }

        if($rea_logrado>0){
            $vision_logro ="block";
        }
        else{
            $vision_logro ="none";
        }

        $url_guardar="modificaractividadetapa";

        $lgro_validacion = $porcentaje_cumplido_etapa + $logro_acumulado - $rea_logrado;

        $maximo_admitido = 100 - $lgro_validacion;

        $task = "MODIFICACI&Oacute;N";
        
    }
    else{
        $capa_direccion = ".acccionactividad".$codigo_accion;
        $url_direccion = "inforegistroactividadplannew?codigo_accion=".$codigo_accion."&codigo_plan=".$codigo_plan;
        $url_guardar="registroactividadetapa";
        $lgro_validacion = $porcentaje_cumplido_etapa + $logro_acumulado;
        $task = "REGISTRO";

        $maximo_admitido = 100 - $lgro_validacion;

        if($lgro_validacion == 100){
            $vision_logro ="none";
        }
        else{
            $vision_logro = "block";
        }
    }

?>
<form id="rgstroActvdad" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> DE ACTIVIDADES</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div><strong>Accion: </strong><?php echo $acc_descripcion; ?> | <strong>Linea Base <?php echo $inicio; ?>: </strong><?php echo $linea_base ?> | <strong>Meta <?php echo $fin; ?>: </strong> <?php echo $meta_resultado ?></div>
        <hr>
        <div><strong>Unidad de Medida: </strong><?php echo $unidad_medida; ?></div>
        <hr>
        <div><strong>Actividad: </strong><?php echo $actividad_descripcion; ?></div>
        <hr>
        <div><strong>Etapa: </strong><?php echo $etapa_descripcion; ?></div>
        <hr>
        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-sm-12">
                <a href="Javascript:modalInfo();"><i class="fas fa-question-circle"></i></a>
                <div class="form-group">
                    <label for="selTipoActividad" class="font-weight-bold">Actividad Realizada * </label> 
                    <select name="selTipoActividad" id="selTipoActividad"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0">Seleccione...</option>
                        <?php
                            foreach ($dataTipoactividad as $Tipoactividad) {

                                $tac_codigo=$Tipoactividad['tac_codigo'];
                                $tac_nombre=$Tipoactividad['tac_nombre'];
                                $tac_descripcion=$Tipoactividad['tac_descripcion'];

                                if($rea_codigoactividad==$tac_codigo){
                                    $select_tipoActividad="selected";
                                }
                                else{
                                    $select_tipoActividad="";
                                }
                        ?>
                            <option value="<?php echo  $tac_codigo; ?>" <?php echo $select_tipoActividad; ?>><?php echo $tac_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                &nbsp;
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Número de Veces *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="textNumeroVeces" name="textNumeroVeces" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rea_numeroveces; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6" style="display: <?php echo $vision_logro; ?>">
                <a href="Javascript:modalInfoDos();"><i class="fas fa-question-circle"></i></a>
                <div class="form-group">
                    <label for="textCantidad" class="font-weight-bold">Avance Lograda*</label> 
                    <input type="number" class="form-control caja_texto_sizer" id="textCantidad" name="textCantidad" data-rule-required="true" value="<?php echo $rea_logrado; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
                

    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="maximo_admitido" id="maximo_admitido" value="<?php echo $maximo_admitido; ?>">
        <input type="hidden" name="codigo_actividad_realizada" id="codigo_actividad_realizada" value="<?php echo $rea_codigo; ?>">
        <input type="hidden" name="codigo_certificado" id="codigo_certificado" value="<?php echo $codigo_certificado; ?>">
        <input type="hidden" name="codigo_actividad" id="codigo_actividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="codigo_etapa" id="codigo_etapa" value="<?php echo $codigo_etapa; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_actividad();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

    <!-- **********************          Inicio Modal Forma    *********************************** -->
        <!-- Large modal -->
        <div class="modal fade infoModal" tabindex="-1" id="infoModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content row flex-grow" style='overflow-y: auto; max-height: calc(90vh - 150px);'>
                    
                    <div class="cuerpo">
                        <div class="modal-header fondo-titulo">
                            <h4 class="modal-title"><strong>ACTIVIDADES</strong></h4>
                        </div>
                        <div class="contenido">
                            <br><br>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th colspan="1">ACTIVIDADES </th>
                                    <th colspan="2">DESCRIPCIÓN O SIGNIFICADO</th>
                                </tr>
                                <tr>
                                    <th>TALLER</th>
                                    <td>Un taller es también una sesión de entrenamiento o guía de uno o varios días de duración. Se enfatiza
                                        en la solución de problemas, capacitación, y requiere la participación de los asistentes. A menudo, un simposio, lectura
                                        o reunión se convierte en un taller si se acompaña de una demostración práctica.
                                    </td>
                                </tr>
                                <tr>
                                    <th>CONFERENCIA</th>
                                    <td>Disertación o exposición en público sobre un tema o un asunto. "el profesor de física de la universidad pronunciará
                                        en Buenos Aires una serie de conferencias"
                                    </td>
                                </tr>
                                <tr>
                                    <th>ESTUDIO</th>
                                    <td>Obra o trabajo en el que se estudia o se investiga un asunto o una cuestión o se reflexiona sobre él. "un estudio de
                                        la obra cervantina"
                                    </td>
                                </tr>
                                <tr>
                                    <th>CONTRATACIÓN</th>
                                    <td>Vinculación formal de persona natural o jurídica con el objetivo de obtener un resultado</td>
                                </tr>
                                <tr>
                                    <th>COMPRA</th>
                                    <td>Adquisición de un bien o servicio</td>
                                </tr>
                                <tr>
                                    <th>LICENCIA O RENOVACIÓN</th>
                                    <td>Una licencia de software es un contrato entre el licenciante (autor/titular de los derechos de
                                        explotación/distribución) y el licenciatario2​ (usuario consumidor, profesional o empresa) del programa informático,
                                        para utilizarlo cumpliendo una serie de términos y condiciones establecidas dentro de sus cláusulas,3​ es decir, es
                                        un conjunto de permisos que un desarrollador le puede otorgar a un usuario en los que tiene la posibilidad de
                                        distribuir, usar o modificar el producto bajo una licencia determinada. Además se suelen definir los plazos
                                        de duración, el territorio donde se aplica la licencia (ya que la licencia se soporta en las leyes particulares de cada
                                        país o región), entre otros.4​
                                    </td>
                                </tr>
                                <tr>
                                    <th>BASES DE DATOS</th>
                                    <td>Es un acuerdo de licencia copyleft diseñado para permitir a los usuarios compartir, modificar y usar libremente una
                                    base de datos, manteniendo la misma libertad para los demás
                                    </td>
                                </tr>
                                <tr>
                                    <th>GASTOS DE VIAJE</th>
                                    <td>Incluye todos los gastos requeridos para el desplazamiento y permanencia fuera de la sede de trabajo</td>
                                </tr>
                                <tr>
                                    <th>COMISIÓN DE ESTUDIO</th>
                                    <td>Contrato por medio del cual un funcionario (Docente, Administrativo o Trabajador Oficial) se retira temporalmente
                                        del servicio mientras cursa un programa académico
                                    </td>
                                </tr>
                                <tr>
                                    <th>CAPACITACIÓN INDIVIDUAL</th>
                                    <td>Cursos, Dipomados o Talleres sobre temas específicos.</td>
                                </tr>
                                <tr>
                                    <th>CAPACITACIÓN GRUPAL</th>
                                    <td>Cursos, Dipomados o Talleres sobre temas específicos.</td>
                                </tr>
                                <tr>
                                    <th>REGISTRO Y/O EN FUNCIONAMIENTO</th>
                                    <td>Registro:  Registro calificado del programa o centro
                                        En funcionamiento: el bien está instalado y funcionando</td>
                                </tr>
                                <tr>
                                    <th>EVALUACIÓN</th>
                                    <td>Encuesta o cuestionario para medir el resultado</td>
                                </tr>
                                <tr>
                                    <th>FORMACIÓN DOCTOR</th>
                                    <td>Comisión de estudios, financiación de matrícula, desplazamiento, trabajo de grado</td>
                                </tr>
                                <tr>
                                    <th>FORMACIÓN MAGITER</th>
                                    <td>Comisión de estudios, financiación de matrícula, desplazamiento, trabajo de grado</td>
                                </tr>
                                <tr>
                                    <th>FORMACIÓN POSTDOCTOR</th>
                                    <td>Comisión de estudios, financiación de matrícula, desplazamiento, trabajo de grado</td>
                                </tr>
                                <tr>
                                    <th>FORMACIÓN ESPECIALISTA</th>
                                    <td>Comisión de estudios, financiación de matrícula, desplazamiento, trabajo de grado</td>
                                </tr>
                                <tr>
                                    <th>HONORARIOS</th>
                                    <td>Servicios profesionales (Cátedra)</td>
                                </tr>
                                <tr>
                                    <th>CONSTRUCCIÓN PLANTA FÍSICA</th>
                                    <td>Metros cuadrados construídos (incluye equipos y muebles incorporados a la construcción)</td>
                                </tr>
                                <tr>
                                    <th>ADECUACIÓN PLANTA FÍSICA</th>
                                    <td>Metros cuadrados adecuados (incluye equipos y muebles incorporados a la edificación)</td>
                                </tr>
                                <tr>
                                    <th>MANTENIMIENTO PLANTA FÍSICA</th>
                                    <td>Metros cuadrados mantenidos (incluye equipos y muebles incorporados a la edificación)</td>
                                </tr>
                                <tr>
                                    <th>PUBLICACIONES</th>
                                    <td>Costo de la publicación de un artículo en una revista</td>
                                </tr>
                                <tr>
                                    <th>LEGALIZACIÓN CONVENIOS</th>
                                    <td>Lo que se requiera para formalizar convenios con otras Entidades Públicas o Privadas, como pólizas y publicaciones.
                                        También encontré que aún no ha corregido los valores de la Linea base y metas en los reportes, motivo por el cual aún se muestran metas para el 2019 negativas.
                                        Quedo atenta a la realización de esos ajustes.</td>
                                </tr>

                            </table>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- **********************          Fin Modal Forma       *********************************** -->

    <!-- **********************          Inicio Modal Forma    *********************************** -->
        <!-- Large modal -->
        <div class="modal fade infoModal" tabindex="-1" id="infoModalDos" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content row flex-grow" style='overflow-y: auto; max-height: calc(90vh - 150px);'>
                    <div class="cuerpo">
                        <div class="modal-header fondo-titulo">
                            <h4 class="modal-title"><strong>AVANCES</strong></h4>
                        </div>
                        <div class="contenido">
                            <br><br>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td colspan="2">
                                    <p> <strong>AVANCE LOGRADO: </strong> Registre el porcentaje de avance que representa la actividad realizada para cada <br>
                                                unidad de la meta <br>
                                                Por ejemplo: <br>
                                                META: 4 DOCTORADOS <br>

                                                        &nbsp;3 MAGISTER <br>
                                                        &nbsp;2 POST-DOCTORADOS <br>
                                                RESULTADO: <br>
                                                        &nbsp;1 DOCTOR GRADUADO = 1 o 100% <br>
                                                        &nbsp;1 DOCTOR CON MATRÍCULA = 30% <br>
                                                        &nbsp;1 DOCTOR TERMINÓ ASIGNATURAS = 70% <br>
                                                        &nbsp;1 DOCTOR = 0% <br>
                                                EL SISTEMA REALIZA LOS CÁLCULOS PARA DETERMINAR EL PORCENTAJE DE AVANCE DE CADA META,<br>
                                                ES DECIR POR DOCTORES POR MAGISTER Y POR POST-DOCTORES Y LUEGO CALCULA EL PORCENTAJE DE AVANCE DE LA ACCIÓN <br>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- **********************          Fin Modal Forma       *********************************** -->

<script>

    function modalInfo(){
        $('#infoModal').modal({
            keyboard: true
        });
    }
    function modalInfoDos(){
        $('#infoModalDos').modal({
            keyboard: true
        });
    }
</script>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_actividad.js"></script>
