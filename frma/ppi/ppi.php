<?php
    include('crud/rs/ppi/ppi.php');

    $codigo_plan = $_REQUEST['codigo_plan'];

    $codigo_ppi = $_REQUEST['codigo_ppi'];

    list($anio_inicio, $anio_fin) = $objPPI->anios_plan($codigo_plan);

    $list_tipo_fuente = $objPPI->list_tipo_fuente();

    $url_guardar="registroppi";
    $task = "REGISTRO";

    $checkedA = "checked";
    $checkedI = "";
?>
<form id="ppiform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> PPI</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selTipoFuenteFinanciacion" class="font-weight-bold">Grupo Fuente de Financiaci&oacute;n *</label>
                    <select name="selTipoFuenteFinanciacion" id="selTipoFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            if($list_tipo_fuente){
                                foreach ($list_tipo_fuente as $data_list_tipo_fuente) {
                                    $tff_codigo = $data_list_tipo_fuente['tff_codigo'];
                                    $tff_nombre = $data_list_tipo_fuente['tff_nombre'];
                            
                        ?>
                            <option value="<?php echo  $tff_codigo; ?>" data-tipo_fuente="<?php echo  $tff_codigo; ?>"><?php echo $tff_nombre; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay Grupos de fuentes de Financiacion</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group fuenteee">
                    <label for="selFuenteFinanciacion" class="font-weight-bold">Fuente de Financiaci&oacute;n *</label>
                    <select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0"> Seleccione el Tipo de Fuente ...</option>
                        
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <?php
            $num = 0;
            for ($vigencias_plan=$anio_inicio; $vigencias_plan <= $anio_fin; $vigencias_plan++) { 

                if($num == 0){
                    echo '<div class="row">';
                }
        ?>
            <div class="col-sm-6">
                <h6><strong><?php echo $vigencias_plan; ?></strong></h6><hr class="linea">
                <div class="form-group">
                    <label for="txtValor<?php echo $vigencias_plan; ?>" class="font-weight-bold">Valor *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtValor<?php echo $vigencias_plan; ?>" name="txtValor[]" aria-describedby="textHelp" data-rule-required="true" value="0" required>
                    <input type="hidden" id="txtVigencia<?php echo $vigencias_plan; ?>" name="txtVigencia[]" value="<?php echo $vigencias_plan; ?>">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        <?php
            $num++;
                if($num == 2){
                    echo '</div>';
                    $num = 0;
                }
        
            }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>
        </div>   
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
        <input type="hidden" name="codigo_ppi" id="codigo_ppi" value="<?php echo $codigo_ppi; ?>">
        <input type="hidden" name="codigo_tipo_fuente" id="codigo_tipo_fuente" value="<?php echo $tff_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_ppi();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_ppi.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('#selTipoFuenteFinanciacion').change(function(){
        var tipo_fuente = $(this).find(':selected').data('tipo_fuente');
        var codigo_plan = $('#codigo_plan').val();

        if(tipo_fuente == 0){

        }
        else{
            $.ajax({
                url:"selectfuentefinanciacion",
                type:"POST",
                data:"tipo_fuente="+tipo_fuente+'&codigo_plan='+codigo_plan,
                async:true,

                success: function(message){
                    $(".fuenteee").empty().append(message);
                }
            });

        }
    });
</script>

