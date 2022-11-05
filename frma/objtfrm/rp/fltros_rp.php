<?php
    include('crud/rs/rp/rprte_rp.php');

    $plan_desarrollo = $_REQUEST['plan_desarrollo'];

    $nivel_uno = $objRprteRP->nivel_uno($plan_desarrollo);
    $nivel_dos = $objRprteRP->nivel_dos($plan_desarrollo);
    $nivel_tres = $objRprteRP->nivel_tres($plan_desarrollo);

    $list_nivel_uno = $objRprteRP->list_nivel_uno($plan_desarrollo);

    $vigencia_plan_accion = $objRprteRP->vigencia_plan_accion($plan_desarrollo);
?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="selVigencia" class="font-weight-bold"> Vigencia *</label>
            <select name="selVigencia" id="selVigencia" class="form-control caja_texto_sizer selectpickerVigencia" data-rule-required="true" required>
                <?php
                if($vigencia_plan_accion){
                    foreach ($vigencia_plan_accion as $dat_vigencia) {
                        $codigo_vigencia = $dat_vigencia['codigo_vigencia'];

                ?>
                    <option value="<?php echo $codigo_vigencia; ?>"><?php echo $codigo_vigencia; ?></option>
                <?php
                    }
                }
                else{
                ?>
                    <option value="0">No hay Datos</option>
                <?php
                }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_vigencia" role="alert"></div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            <label for="textNumeroVeces" class="font-weight-bold">Reporte Plan Acción *</label>
            <div class="radio tipo1">
                <!--<input type="radio" id="rcompleto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedCompleto; ?> required/>
                <label for="rcompleto"><span>&nbsp;Completo&nbsp;&nbsp;</span> </label>-->

                <input type="radio" id="rsubsistema" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="2" required />
                <label for="rsubsistema"><span>&nbsp;Por <?php echo $nivel_uno; ?>&nbsp;&nbsp;</span> </label> 

                <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="3" required />
                <label for="rproyecto"><span>&nbsp;Por <?php echo $nivel_dos; ?>&nbsp;</span> </label>

                <input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="4" required />
                <label for="rproyecto"><span>&nbsp;Por <?php echo $nivel_tres; ?> &nbsp;</span> </label>

                <!--<input type="radio" id="rproyecto" name="chkrprte" class="radioReporte" aria-describedby="textHelp" data-rule-required="true" value="5" required />
                <label for="rproyecto"><span>&nbsp;Por Actividades</span> </label>-->
            </div>
        </div>
        <div class="alert alert-danger alerta-forcliente" id="error_reporte" role="alert"></div>
    </div>
</div>

<div class="row subsistema" style="display: none;">
    <div class="col-md-12">
        <div class="form-group">
            <label for="selSubSistema" class="font-weight-bold"> <?php echo $nivel_uno; ?> *</label>
            <select name="selSubSistema" id="selSubSistema" class="form-control caja_texto_sizer selectpickerSubSistema" data-rule-required="true" required>
                <option value="0" data-sub_sistema="0">Seleccione...</option>
                <?php
                foreach ($list_nivel_uno as $dat_nivel_uno) {

                    $sub_codigo = $dat_nivel_uno['sub_codigo'];
                    $sub_nombre = $dat_nivel_uno['sub_nombre'];
                    $sub_referencia = $dat_nivel_uno['sub_referencia'];
                    $sub_ref = $dat_nivel_uno['sub_ref'];

                    $dscrpcion = $sub_referencia.$sub_ref."  ".$sub_nombre;
                ?>
                    <option value="<?php echo $sub_codigo; ?>" data-sub_sistema="<?php echo $sub_codigo; ?>" data-codigo_plan="<?php echo $plan_desarrollo; ?>"><?php echo $dscrpcion; ?> ...</option>
                <?php
                    }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_sub_sistema" role="alert"></div>
        </div>
    </div>
</div>

<div class="row proyecto" style="display: none;">

</div>

<div class="row accion" style="display: none;">
    
</div>

<div class="row actividad" style="display: none;">
    
</div>

<script type="text/javascript"> 

    $('.selectpickerSubSistema').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerVigencia').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    

    $('#selSubSistema').change(function(){
        var sub_sistema = $(this).find(':selected').data('sub_sistema');
        var codigo_plan = $(this).find(':selected').data('codigo_plan');

        if(sub_sistema == 0){

        }
        else{
            $.ajax({
                url:"lisproyectosrp",
                type:"POST",
                data:"sub_sistema="+sub_sistema+'&codigo_plan='+codigo_plan,
                async:true,

                success: function(message){
                    $(".proyecto").empty().append(message);
                }
            });
        }
    });

    $('.radioReporte').click(function(){
        var chkrprte = $('input:radio[name=chkrprte]:checked').val();

        if(chkrprte == 1){//Todo
            $('.subsistema').fadeOut(100);
            $('.proyecto').fadeOut(100);
            $('.accion').fadeOut(100);
            $('.actividad').fadeOut(100);
        }

        if(chkrprte == 2){//Sub sistema
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeOut(100);
            $('.accion').fadeOut(100);
            $('.actividad').fadeOut(100);
        }

        if(chkrprte == 3){//Proyecto
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeIn(100);
            $('.accion').fadeOut(100);
            $('.actividad').fadeOut(100);
        }

        if(chkrprte == 4){//Acción
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeIn(100);
            $('.accion').fadeIn(100);
            $('.actividad').fadeOut(100);
        }

        if(chkrprte == 5){//Actividad
            $('.subsistema').fadeIn(100);
            $('.proyecto').fadeIn(100);
            $('.accion').fadeIn(100);
            $('.actividad').fadeIn(100);
        }
    });
</script>