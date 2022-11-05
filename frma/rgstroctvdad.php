<?php
    include('grlla/data/tpoctvdad.php');

    $codigo_actividad=$_REQUEST['codigo_actividad'];
    //$accion_actividad=$_REQUEST['accion_actividad'];
    $acc_descripcion=$_REQUEST['acc_descripcion'];
    $codigo_accion=$_REQUEST['codigo_accion'];
    $codigo_activida_realizada=$_REQUEST['codigo_activida_realizada'];
    $display="None";
    $tarea=$_REQUEST['tarea'];

    $accion_actividad=$tipoactividad->accion_actividad($codigo_actividad);
   
    include('crud/rs/mtaPrdcto.php');
    $acto_administrativo= Array('Seleccione...','Acuerdo','Resolución','Factura','Acta','Oficio');
    //echo "Vigencia -------->    ".$Rstrimestre;
    list($valorEsperado,$UnidadMedida)=$objRsMtaPrdcto->selectMetaProducto();
    $valorEjecutado=$objRsMtaPrdcto->selectAccionEjecucion();


    if($codigo_activida_realizada || $tarea){
        include('crud/rs/rgstroctvidadupdte.php');

        foreach($actividadRealiza as $data_RsDatosActividad){
            $are_codigo=$data_RsDatosActividad['are_codigo'];
            $are_actividad=$data_RsDatosActividad['are_actividad'];
            $are_numeroveces=$data_RsDatosActividad['are_numeroveces'];
            $are_tipoavance=$data_RsDatosActividad['are_tipoavance'];
            $are_avancelogrado=$data_RsDatosActividad['are_avancelogrado'];
            $are_tipoactividad=$data_RsDatosActividad['are_tipoactividad'];
            $are_acuerdo=$data_RsDatosActividad['are_acuerdo'];
            $are_numeroacuerdoresolucion=$data_RsDatosActividad['are_numeroacuerdoresolucion'];
            $are_titulonombre=$data_RsDatosActividad['are_titulonombre'];
            $Rstrimestre=$data_RsDatosActividad['are_trimestre'];
            $are_padre=$data_RsDatosActividad['are_padre'];


           

            //echo "--Are codigoi--------------".$are_codigo;

           

            if($are_tipoavance==1){
                $select_porcentual="selected";
            }
            elseif($are_tipoavance==2){
                $select_total="selected";
                $display="block";
            }
          
        }

        if($tarea==1){
            $disabled="disabled";
            $are_avancelogrado="";
            $are_numeroveces="";
            $url_guardar="crudregistroactividadhijo";
            $valorAcumulado=$objRsRgstroCtvdad->avanceAcumulado($are_codigo);

            //echo "#jsdkakd---> ".$valorAcumulado;
            $Rstrimestre=$objRsMtaPrdcto->Rstrimestre();
        }
        else{
            if($are_padre>0){
                $url_guardar="crudmodificaractividad";
                $valorAcumulado=$objRsRgstroCtvdad->avanceAcumulado($are_padre)-$are_avancelogrado;
                $mostrar_campos=$objRsRgstroCtvdad->avanceAcumulado($are_padre);
                if($mostrar_campos>=100){
                    $display="block";
                }
            }
        }
    }
    else{
        $url_guardar="crudresgistroactividad";
        $Rstrimestre=$objRsMtaPrdcto->Rstrimestre();
        $valorAcumulado=0;
    }

?>
<form id="tipoactividadform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title">Registro de Actividades</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

    <div><strong>Accion: </strong><?php echo $acc_descripcion; ?> | <strong>Linea Base 2018: </strong><?php echo $valorEjecutado ?> | <strong>Meta 2019: </strong> <?php echo $valorEsperado ?></div>
    <hr>
    <div><strong>Unidad de Medida: </strong><?php echo $UnidadMedida; ?></div>
    <hr>
    <div><strong>Actividad: </strong><?php echo $accion_actividad; ?></div>
    <hr>
        <p class="font-weight-bold">* Campos obligatorios</p>
        <!-- ******************** INICIO FORMULARIO ************************* -->

    <div class="form-group">
        <label for="selTipoActividad" class="font-weight-bold">Actividad Realizada * </label> <a href="Javascript:modalInfo();"><i class="fas fa-question-circle"></i></a>
        <!-- <input type="text" class="form-control" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" data-rule-required="true" required> -->
        <select name="selTipoActividad" id="selTipoActividad"  class="form-control" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0">Seleccione...</option>
            <?php
                foreach ($dataTipoactividad as $Tipoactividad) {

                    $tac_codigo=$Tipoactividad['tac_codigo'];
                    $tac_nombre=$Tipoactividad['tac_nombre'];
                    $tac_descripcion=$Tipoactividad['tac_descripcion'];

                    if($are_tipoactividad==$tac_codigo){
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


    <div class="form-group">
        <label for="textNumeroVeces" class="font-weight-bold">Número de Veces *</label>
        <input type="number" class="form-control" id="textNumeroVeces" name="textNumeroVeces" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $are_numeroveces; ?>" required>
        <span class="help-block" id="error"></span>
    </div>

    <div class="form-group">
        <label for="selAvance" class="font-weight-bold">Tipo de Avance *</label> <a href="Javascript:modalInfoDos();"><i class="fas fa-question-circle"></i></a>
        <select name="selAvance" id="selAvance" class="form-control" onchange="changeTipoAvance();" data-rule-required="true" required <?php echo $disabled; ?>>

            <option value="0">Seleccione...</option>
            <option value="1" <?php echo $select_porcentual; ?>>Porcentual</option>
            <option value="2" <?php echo $select_total; ?>>Total</option>
         </select>
        <span class="help-block" id="error"></span>
    </div>

    <div class="form-group">
        <label for="textCantidad" class="font-weight-bold">Avance Lograda*</label>
        <input type="number" class="form-control" id="textCantidad" name="textCantidad" data-rule-required="true" value="<?php echo $are_avancelogrado; ?>" required>
        <span class="help-block" id="error"></span>
    </div>

    <div class="form-group">
        <label for="totalValidacion" class="font-weight-bold">Acumulado Avance Logrado </label>
        <input type="hidden" name="valorAcumulado" id="valorAcumulado" value="<?php echo $valorAcumulado; ?>">
        <input type="text" class="form-control" name="totalValidacion" id="totalValidacion" value="">
        <span class="help-block" id="error"></span>
    </div>

    <div id='datologrado' style="display:<?php echo $display; ?>;">

        <div class="form-group">
            <label for="selActoadmin" class="font-weight-bold">Acto Administrativo*</label>
            <!-- <input type="text" class="form-control" id="textIdentificacion" name="textIdentificacion" aria-describedby="textHelp" data-rule-required="true" required> -->
            <select name="selActoadmin" id="selActoadmin" class="form-control" data-rule-required="true" required>
                <?php
                for ($admin_acto = 0; $admin_acto <= 5; $admin_acto++) {
                    if($are_acuerdo==$admin_acto){
                        $selected_acto="selected";
                    }
                    else{
                        $selected_acto="";
                    }
                    echo "<option value=".$admin_acto." ".$selected_acto."> ".$acto_administrativo[$admin_acto]."</option>";
                }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="textNombreAcuerdo" class="font-weight-bold">Número Acuerdo/Resolución*</label>
            <input type="text" class="form-control" id="textNombreAcuerdo" name="textNombreAcuerdo" data-rule-required="true" value="<?php echo $are_numeroacuerdoresolucion; ?>"  required>
            <span class="help-block" id="error"></span>
        </div>

        <div class="form-group">
            <label for="textNombreTitulo" class="font-weight-bold">Título/Nombre</label>
            <input type="text" class="form-control" id="textNombreTitulo" name="textNombreTitulo" data-rule-required="true" value="<?php echo $are_titulonombre; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        

    </div>



    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        

        <input type="hidden" name="codigoActividadRealizada" id="codigoActividadRealizada" value="<?php echo $are_codigo; ?>">
        <input type="hidden" name="codigoActividad" id="codigoActividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <input type="hidden" name="trimestre" id="trimestre" value="<?php echo $Rstrimestre; ?>">
        <input type="hidden" name="selTipoActividadHijo" id="selTipoActividadHijo" value="<?php echo $are_tipoactividad; ?>">
        <input type="hidden" name="selAvanceHijo" id="selAvanceHijo" value="<?php echo $are_tipoavance; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_formregistroactividad();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<!-- **********************          Inicio Modal Forma    *********************************** -->
	<!-- Large modal -->
	<div class="modal fade infoModal" tabindex="-1" id="infoModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content row flex-grow" style='overflow-y: auto; max-height: calc(90vh - 150px);'>


    </p>
    <br><br>
    <table border='1'>
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
<!-- **********************          Fin Modal Forma       *********************************** -->

<!-- **********************          Inicio Modal Forma    *********************************** -->
	<!-- Large modal -->
	<div class="modal fade infoModal" tabindex="-1" id="infoModalDos" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content row flex-grow" style='overflow-y: auto; max-height: calc(90vh - 150px);'>
                <table border="1">
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
<script src="vjs/registroActividad.js"></script>
