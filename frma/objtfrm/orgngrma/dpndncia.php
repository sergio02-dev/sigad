<?php
    include('crud/rs/formfun/formfun.php');

    $codigo_sede = $_REQUEST['codigo_sede'];
    $codigo_vicerrectoria = $_REQUEST['codigo_vicerrectoria'];
    $codigo_facultad = $_REQUEST['codigo_facultad'];

    $list_dependencia = $objRsFuncionamiento->list_dependencia($codigo_sede, $codigo_vicerrectoria, $codigo_facultad); 
?>
<label for="selDependencia" class="font-weight-bold">Dependencia</label>
<select name="selDependencia" id="selDependencia" class="form-control caja_texto_sizer" data-rule-required="true" required>
    <option value="0" data-codigo_dependencia="0" data-codigo_facultad="<?php echo $codigo_facultad; ?>" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>">Seleccione...</option>
    <?php
        foreach ($list_dependencia as $dat_dependencia) {
            $codigo_dependencia = $dat_dependencia['codigo_dependencia'];
            $nombre_dependencia = $dat_dependencia['nombre_dependencia'];
    ?>
        <option value="<?php echo  $codigo_dependencia; ?>" data-codigo_dependencia="<?php echo  $codigo_dependencia; ?>" data-codigo_facultad="<?php echo $codigo_facultad; ?>" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>"><?php echo $nombre_dependencia; ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>  
<script type="text/javascript">
    $('#selDependencia').change(function(){
        var codigo_vicerrectoria=$(this).find(':selected').data('codigo_vicerrectoria');
        var codigo_sede=$(this).find(':selected').data('codigo_sede');
        var codigo_facultad=$(this).find(':selected').data('codigo_facultad');
        var codigo_dependencia=$(this).find(':selected').data('codigo_dependencia');
        


        $.ajax({
            url:"areaslist",
            type:"POST",
            data:"codigo_sede="+codigo_sede+'&codigo_vicerrectoria='+codigo_vicerrectoria+'&codigo_facultad='+codigo_facultad+'&codigo_dependencia='+codigo_dependencia,
            async:true,
            success: function(message){
                $(".listArea").empty().append(message);
            }
        });
    });
</script>