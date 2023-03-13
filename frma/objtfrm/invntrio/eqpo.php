<?php
    include('crud/rs/formpdi/formpdi.php');

    $codigo_sublinea = $_REQUEST['codigo_sublinea'];
    
    $list_equipo = $objFormpdi->list_equipo($codigo_sublinea);
?>

<div style="float: left; margin-bottom: 1px;">
        <label for="textEquipo" class="font-weight-bold"> Equipo</label>
        <i class="fas fa-plus-circle color_icono" title="Agregar Equipo" style="display:<?php echo $visibilidad; ?>; float: right; margin: 0 10px;" onclick="agregarEquipo()"></i>
</div>
<select name="selEquipo" id="selEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0" data-codigo_equipo="0">Seleccione el equipo</option>
     <?php
        foreach ($list_equipo as $data_equipo) {
            $equi_codigo=$data_equipo['equi_codigo'];
            $equi_nombre=$data_equipo['equi_nombre'];

        if($per_tipoidentificacion==$equi_codigo){
            $select_equipo="selected";
        }
        else{
            $select_equipo="";
        }
    ?>
        <option value="<?php echo  $equi_codigo; ?>"data-codigo_equipo="<?php echo $equi_codigo; ?>"><?php echo $select_equipo; ?><?php echo $equi_nombre; ?></option>
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
    $('#selEquipo').change(function(){
        var codigo_equipo = $(this).find(':selected').data('codigo_equipo');
       
        if(codigo_equipo==0){

        }
        else{
            $.ajax({
                url:"caracteristicaequipos",
                type:"POST",
                data:"codigo_equipo="+codigo_equipo,
                async:true,

                success: function(message){
                    $(".caracteristicas").empty().append(message);
                }
            });
        }
    });

    
    

    function agregarEquipo(){
        
    
        $('#frmModal').modal({
            keyboard: true
        });
        
            $.ajax({
                    url:"agregarequipo",
                    type:"POST",
                    data:"",
                    async:true,

                    success: function(message){
                        $(".modal-content").empty().append(message);
                        
                    }
            });
    
    };
   
</script>