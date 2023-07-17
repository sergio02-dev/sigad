<?php
    include('crud/rs/poai/poai.php');

    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_poai = $_REQUEST['codigo_poai'];

    $codigo_poai_proyecto = $objPoai->codigo_poai_proyecto($codigo_poai);
    $proyecto_accion = $objPoai->proyecto_accion($codigo_accion);

    if($codigo_poai_proyecto == $proyecto_accion){
        $list_acto_admin = $objPoai->resolucion_data();
    }
    else{
        $list_acto_admin = $objPoai->acuerdo_data();
    }
?>
<label for="selAcuerdo" class="font-weight-bold">Acuerdo *</label>
<select name="selAcuerdo" id="selAcuerdo"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
<option value="0" data-tipo_fuente="0"> Seleccione ...</option>
    <?php
        
        if($list_acto_admin){
            foreach ($list_acto_admin as $dat_acuerdo) {
                $aad_codigo = $dat_acuerdo['aad_codigo'];
                $add_nombre = $dat_acuerdo['add_nombre'];

                $caracteres = strlen($add_nombre);
                if($caracteres > 60){
                    $descripcion = substr($add_nombre,0,100)."...";
                }
                else{
                    $descripcion = $add_nombre;
                }

                if($aad_codigo == $tpo_acuerdo){
                    $selectAcuerdo = "selected";
                }
                else{
                    $selectAcuerdo = "";
                }
        
    ?>
        <option value="<?php echo  $aad_codigo; ?>" <?php echo $selectAcuerdo; ?>><?php echo $descripcion; ?></option>
    <?php
            }
        }
        else{
    ?>
        <option value="0"> No hay Acuerdos</option>
    <?php
        }
    ?>
</select>
<div class="alert alert-danger alerta-forcliente" id="error_acuerdo" role="alert"></div>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>