<?php
$recargar=$_REQUEST['recargar'];
if($recargar){
include('crud/rs/crtfcdos.php');
$certif=$_REQUEST['certif'];

}

?>

<label for="act_certificadomod" class="font-weight-bold">Actividad del Certificado a Modificar* </label>
<select name="act_certificadomod" id="act_certificadomod"  class="form-control selectpicker" data-size="10" data-rule-required="true" required >
    <option value="0"  data-codigoestado="0">Seleccione...</option>
    <?php
    if($certif){
        $listaActividades=$objRscrtfcdo->certificadCertficado($certif);
        foreach ($listaActividades as $data_listaactividades) {
            $act_codigo=$data_listaactividades['act_codigo'];
            $act_referencia=$data_listaactividades['act_referencia'];
            $act_certificado=$data_listaactividades['act_certificado'];
            $act_descripcion=$data_listaactividades['act_descripcion'];

            if($act_codigo==$act_certificadopadre){
                $select_actividadCer="selected";
            }
            else{
                $select_actividadCer="";
            }
    ?>
        <option value="<?php echo $act_codigo."-".$act_certificado; ?>" <?php echo $select_actividadCer; ?>><?php echo $act_certificado." ".$act_referencia; ?></option>
    <?php
        }
    }
    ?>
</select>
<span class="help-block" id="error"></span>

<script>
$('.selectpicker').selectpicker({
    liveSearch: true,
    maxOptions: 1
});
</script>