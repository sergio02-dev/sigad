<?php
    include('crud/rs/formfun/formfun.php');

    $codigo_sede = $_REQUEST['codigo_sede'];
    $codigo_vicerrectoria = $_REQUEST['codigo_vicerrectoria'];
    $codigo_facultad = $_REQUEST['codigo_facultad'];
    $codigo_dependencia = $_REQUEST['codigo_dependencia'];



    $list_area = $objRsFuncionamiento->list_area($codigo_sede, $codigo_vicerrectoria, $codigo_facultad, $codigo_dependencia); 
?>
<label for="selArea" class="font-weight-bold">Area</label>
<select name="selArea" id="selArea" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0">Seleccione...</option>
    <?php
        foreach ($list_area as $dat_area) {
            $codigo_area = $dat_area['codigo_area'];
            $nombre_area = $dat_area['nombre_area'];
    ?>
        <option value="<?php echo $codigo_area; ?>"><?php echo $nombre_area; ?></option>
    <?php
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
