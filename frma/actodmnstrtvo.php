<?php

   $codigo_actoAdministrativo=$_REQUEST['codigo_actoAdministrativo'];
   include('crud/rs/ctoDminstrtvo.php');

   $list_acuerdos = $objActoAdmin->list_acuerdos();

    if($codigo_actoAdministrativo){

       $objActoAdmin->setCodigoActoAdministrativo($codigo_actoAdministrativo);
       $acto_adminform=$objActoAdmin->actoAdminForm();

       foreach($acto_adminform as $data_actoAdminform){
           $aad_codigo = $data_actoAdminform['aad_codigo'];
           $add_nombre = $data_actoAdminform['add_nombre'];
           $add_tipoactoadmin = $data_actoAdminform['add_tipoactoadmin'];
           $add_vigencia = $data_actoAdminform['add_vigencia'];
           $add_urlactoadmin = $data_actoAdminform['add_urlactoadmin'];
           $add_descripcion = $data_actoAdminform['add_descripcion'];
           $add_padre = $data_actoAdminform['add_padre'];
       }
        $url_guardar="crudupdateactoadministrativo";
        $task = "MOFICICACI&Oacute;N";

        if($add_tipoactoadmin == 1){
            $capa_acuerdo = "none";
            $checkedA = "checked";
            $checkedR = "";
        }

        if($add_tipoactoadmin == 2){
            $capa_acuerdo = "block";
            $checkedA = "";
            $checkedR = "checked";
        }

        $anio_inicio = $add_vigencia;

        $anio_fin = $anio_inicio + 1;
    }
    else{
        $url_guardar="crudactoadminstrativo";
        $task = "REGISTRO";
        $anio_inicio = date("Y");
        $capa_acuerdo = "none";

        $anio_fin = $anio_inicio + 1;
    }
    //echo "anio fin ".$anio_fin;
?>
<form id="actoadministrativoform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> ACTO ADMINISTRATIVO</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtVigencia" class="font-weight-bold">Año *</label>

                    <select name="txtVigencia" id="txtVigencia"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <?php
                            for ($vigencias = $anio_inicio; $vigencias <= $anio_fin; $vigencias++) { 
                                $anios = $vigencias;
                        
                                if($anios == $add_vigencia){
                                    $selected_vigncia = "selected";
                                }
                                else{
                                    $selected_vigncia = "";
                                }
                        ?>
                            <option value="<?php echo  $anios; ?>" <?php echo $selected_vigncia; ?> ><?php echo $anios; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Tipo de Acto *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="rAcuerdo" name="chktipoacto" class="tpo_acto" aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="rAcuerdo"><span>Acuerdo&nbsp;&nbsp;</span></label>

                        <input type="radio"   id="rResolucion" name="chktipoacto" class="tpo_acto" aria-describedby="textHelp" data-rule-required="true" value="2" <?php echo $checkedR; ?> required />
                        <label for="rResolucion"><span>Resolución&nbsp;&nbsp;</span> </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-5" >
                <div class="form-group capa_acuerdo" style="display: <?php echo $capa_acuerdo; ?>" >
                    <label for="selAcuerdo" class="font-weight-bold">Acuerdo *</label>
                    <select name="selAcuerdo" id="selAcuerdo"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0"> Seleccione ...</option>
                        <?php
                            foreach ($list_acuerdos as $dta_list_acuerdos) {
                                $aaad_codigo = $dta_list_acuerdos['aad_codigo'];
                                $aadd_nombre = $dta_list_acuerdos['add_nombre'];
                                $aadd_tipoactoadmin = $dta_list_acuerdos['add_tipoactoadmin'];
                        
                                if($add_padre == $aaad_codigo){
                                    $selected_daddy = "selected";
                                }
                                else{
                                    $selected_daddy = "";
                                }
                        ?>
                            <option value="<?php echo  $aaad_codigo; ?>" <?php echo $selected_daddy; ?> ><?php echo substr($aadd_nombre,0,88); ?> ...</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $add_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold"> Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $add_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="txtUrl" class="font-weight-bold">Url Documento *</label>
            <input type="text" class="form-control caja_texto_sizer" id="txtUrl" name="txtUrl" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $add_urlactoadmin; ?>" required>
            <span class="help-block" id="error"></span>
        </div>

        


    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoActo" id="codigoActo" value="<?php echo $aad_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_actoAdministrativo();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroActoAdministrativo.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.tpo_acto').change(function(){
        var tip_acto = $('input:radio[name=chktipoacto]:checked').val();
        
        if(tip_acto == 1){
            $('.capa_acuerdo').fadeOut(100);
        }

        if(tip_acto == 2){
            $('.capa_acuerdo').fadeIn(100);
        }
        
        
    });
</script>
