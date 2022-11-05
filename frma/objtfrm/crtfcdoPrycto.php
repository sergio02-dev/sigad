<?php


$codigo_subsistema=$_REQUEST['codigo_subsistema'];
$referencia_subsistema=$_REQUEST['referencia_subsistema'];
$codigo_plan = $_REQUEST['codigo_plan'];

 //echo "----->".$referencia_subsistema;

include('crud/rs/crtfcdos.php');

$proyecto=$objRscrtfcdo->selectProyecto($codigo_subsistema);

 ?>
    <input type="hidden" name="referencia_subsistema" id="referencia_subsistema" value="<?php echo $referencia_subsistema; ?>">


    <div class="form-group" id='id_proyecto'>
        <label for="selProyecto" class="font-weight-bold">Proyecto * </label>
        <select name="selProyecto" id="selProyecto"  class="form-control caja_texto_sizer selectpickerPrycto" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0" data-codigoPro='0'>Seleccione...</option>
            <?php
                foreach ($proyecto as $dataproyecto) {
                    $pro_codigo = $dataproyecto['pro_codigo'];
                    $pro_descripcion = $dataproyecto['pro_descripcion'];
                    $pro_referencia = $dataproyecto['pro_referencia'];
                    $pro_numero = $dataproyecto['pro_numero'];


                    if($pro_codigo==$act_proyecto){
                        $select_proyecto="selected";
                    }
                    else{
                        $select_proyecto="";
                    }

                    if($codigo_plan == 1){
                        $rfrncia_proyecto = $referencia_subsistema.".".$pro_referencia;
                    }
                    else{
                        $rfrncia_proyecto = $pro_referencia.".".$pro_numero;
                    }

                    $texto_proyecto = $rfrncia_proyecto." ".$pro_descripcion;
            
            ?>
                <option value="<?php echo  $pro_codigo; ?>" <?php echo $select_proyecto; ?> data-codigopro="<?php echo $pro_codigo; ?>" data-referenciapro="<?php echo $rfrncia_proyecto; ?>"><?php echo $texto_proyecto; ?></option>
            <?php
                }
            ?>
        </select>
        <span class="help-block" id="error"></span>
    </div>
    <input type="hidden" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
    <script type="text/javascript">
        $('.selectpickerPrycto').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });

        $('#selProyecto').change(function(){
          var codigo_proyecto=$(this).find(':selected').data('codigopro');
          var referencia_proyecto=$(this).find(':selected').data('referenciapro');
          var referencia_subsistema=$('#referencia_subsistema').val();
          var codigo_plan = $('#codigo_plan').val();

          //alert('--->'+referencia_proyecto);
            if(codigo_proyecto==0){

            }
            else{
            $.ajax({
                url:"certificadoaccion",
                type:"POST",
                data:"codigo_proyecto="+codigo_proyecto+"&referencia_subsistema="+referencia_subsistema+"&referencia_proyecto="+referencia_proyecto+'&codigo_plan='+codigo_plan,
                async:true,

                success: function(message){
                    //$(".modal-body").empty().append(message);
                    $("#id_accion").empty().append(message);
                }
            });

          }
        });
    </script>
