<?php
    include('crud/rs/ppi/ppi.php');

    $codigo_plan = $_REQUEST['codigo_plan'];

    $codigo_ppi = $_REQUEST['codigo_ppi'];

    $url_guardar="cierreppi";
    $task = "CIERRE";

    $checkedA = "checked";
    $checkedI = "";
?>
<form id="closeppiform" role="form">
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
                <h5>¿Esta Seguro que desea cerrar el PPI?</h5>
            </div>
        </div>

        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
        <input type="hidden" name="codigo_ppi" id="codigo_ppi" value="<?php echo $codigo_ppi; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_cierre_ppi();"><i class="far fa-save"></i> Cerrar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_crre_ppi.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

