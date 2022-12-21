<?php
    include('crud/rs/formfun/formfun.php');

    $codigo_sede = $_REQUEST['codigo_sede'];
    $codigo_vicerrectoria = $_REQUEST['codigo_vicerrectoria'];

    $list_facultad = $objRsFuncionamiento->list_facultad($codigo_sede, $codigo_vicerrectoria); 
?>
<label for="selTipoFacultad" class="font-weight-bold"> Facultad</label>
<select name="selTipoFacultad" id="selTipoFacultad" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0" data-codigo_facultad="0" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>">Seleccione...</option>
    <?php
        foreach ($list_facultad as $dat_fac) {
            $codigo_facultad = $dat_fac['codigo_facultad'];
            $nombre_facultad = $dat_fac['nombre_facultad'];
    ?>
        <option value="<?php echo  $codigo_facultad; ?>" data-codigo_facultad="<?php echo $codigo_facultad; ?>" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>"><?php echo $nombre_facultad; ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>
<script type="text/javascript">

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    $('#selTipoFacultad').change(function(){
        var codigo_vicerrectoria=$(this).find(':selected').data('codigo_vicerrectoria');
        var codigo_sede=$(this).find(':selected').data('codigo_sede');
        var codigo_facultad=$(this).find(':selected').data('codigo_facultad');
        //alert(codigo_facultad)

        $.ajax({
            url:"dependencialist",
            type:"POST",
            data:"codigo_sede="+codigo_sede+'&codigo_vicerrectoria='+codigo_vicerrectoria+'&codigo_facultad='+codigo_facultad,
            async:true,
            success: function(message){
                $(".listDep").empty().append(message);
            }
        });
    });
</script>