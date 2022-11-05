<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/ppi/ppi.php');

    $codigo_plan = $_REQUEST['codigo_plan'];

    $codigo_ppi = $_REQUEST['codigo_ppi'];

    $codigo_fuente = $_REQUEST['codigo_fuente'];

    $estdo_ppi = $objPPI->estdo_ppi($codigo_plan, $codigo_ppi, $codigo_fuente);

    $nombre_fuente = $objPPI->nombre_fuente($codigo_fuente);

    list($anio_inicio, $anio_fin) = $objPPI->anios_plan($codigo_plan);



    $url_guardar="modificarppi";
    $task = "MODIFICAR";

    if($estdo_ppi == 1){
        $checkedA = "checked";
        $checkedI = "";
    }

    if($estdo_ppi == 0){
        $checkedA = "";
        $checkedI = "checked";
    }
    
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
            <div class="col-sm-12">
                <h5><strong>Fuente: <?php echo strtoupper(tildes($nombre_fuente)); ?></strong></h5><hr class="linea">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>
        <?php
            $num = 0;
            for ($vigencias_plan=$anio_inicio; $vigencias_plan <= $anio_fin; $vigencias_plan++) { 

                if($num == 0){
                    echo '<div class="row">';
                }

                $valor_vigencias = $objPPI->valor_fuente($codigo_plan, $codigo_ppi, $codigo_fuente, $vigencias_plan);

        ?>
            <div class="col-sm-6">
                <h6><strong><?php echo $vigencias_plan; ?></strong></h6><hr class="linea">
                <div class="form-group">
                    <label for="txtValor<?php echo $vigencias_plan; ?>" class="font-weight-bold">Valor *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtValor<?php echo $vigencias_plan; ?>" name="txtValor[]" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $valor_vigencias; ?>" required>
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
        <input type="hidden" name="codigo_fuente" id="codigo_fuente" value="<?php echo $codigo_fuente; ?>">
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
</script>

