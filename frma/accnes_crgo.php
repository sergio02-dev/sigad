<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    $codigo_persona=$_REQUEST['codigo_persona'];
    include('crud/rs/rsAccionEncrgdo.php');

    include('crud/rs/rsPrflPrsna.php');


    $objPrflPrsna->setCodigoPersona($codigo_persona);
    $nombrePersona=$objPrflPrsna->nombrePersona();

    $rsPlanes=$rsAccionEncargado->plan_desarrollo();
   
?>
<form id="formaccioncargo" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>ACCIONES A CARGO <?php echo strtoupper(tildes($nombrePersona)); ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
    
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selPlanDesarrollo" class="font-weight-bold"> Plan de Desarrollo</label>
                    <select name="selPlanDesarrollo" id="selPlanDesarrollo" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0" data-plan="0">Seleccione...</option>
                        <?php
                            foreach ($rsPlanes as $data_plan_desarrollo) {
                                $pde_codigo=$data_plan_desarrollo['pde_codigo'];
                                $pde_nombre=$data_plan_desarrollo['pde_nombre'];

                        ?>
                            <option value="<?php echo  $pde_codigo; ?>" data-plan="<?php echo $pde_codigo; ?>"><?php echo $pde_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
    
        <div class="accionesplan">
        
        </div>

 
    
    


    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="url_proceso" name="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" id="per_codigo" name="per_codigo" value="<?php echo $codigo_persona; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_encargado();"><i class="far fa-save"></i> Guardar </button>
    </div>
</form>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_accionesacargo.js"></script>
<script type="text/javascript">
$('#selPlanDesarrollo').change(function(){
    var plan=$(this).find(':selected').data('plan');
    var per_codigo=$('#per_codigo').val();

    if(plan==0){

    }
    else{
    $.ajax({
        url:"formaccionesplan",
        type:"POST",
        data:"plan="+plan+'&persona='+per_codigo,
        async:true,

        success: function(message){
        //$(".modal-body").empty().append(message);
        $(".accionesplan").empty().append(message);
        }
    });

    }
});
</script>