<?php
    include('crud/rs/formfun/formfun.php');

    $codigo_sede = $_REQUEST['codigo_sede'];

    $list_vicerrectoria = $objRsFuncionamiento->list_vicerrectoria($codigo_sede); 
?>
<label for="selTipoVicerrectoria" class="font-weight-bold"> Vicerrectoria</label>
<select name="selTipoVicerrectoria" id="selTipoVicerrectoria" class="form-control caja_texto_sizer" data-rule-required="true" required>
    <option value="0" data-codigo_sede="<?php echo  $codigo_sede; ?>"  data-codigo_vicerrectoria="0">Seleccione...</option>
    <?php
        foreach ($list_vicerrectoria as $dat_vice) {
            $ent_codigo = $dat_vice['ent_codigo'];
            $ent_nombre = $dat_vice['ent_nombre'];
    ?>
        <option value="<?php echo  $ent_codigo; ?>" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $ent_codigo; ?>" ><?php echo $ent_nombre; ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>
<script type="text/javascript">
    $('#selTipoVicerrectoria').change(function(){
        var codigo_vicerrectoria=$(this).find(':selected').data('codigo_vicerrectoria');
        var codigo_sede=$(this).find(':selected').data('codigo_sede');

        $.ajax({
            url:"facultadeslist",
            type:"POST",
            data:"codigo_sede="+codigo_sede+'&codigo_vicerrectoria='+codigo_vicerrectoria,
            async:true,
            success: function(message){
                $(".listFac").empty().append(message);
            }
        });
    });
</script>