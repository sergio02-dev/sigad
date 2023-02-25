<?php

        include('crud/rs/ctvdadPoai.php');

        $codigo_indicador=$_REQUEST['ind_codigo'];
       
        $unidad = $_REQUEST['unidad'];
       
       

    
    

?>
<input type="number" id="txtUnidad<?php echo $codigo_indicador; ?>" min="1" class="form-control caja_texto_sizer" name="txtUnidad<?php echo $codigo_indicador; ?>"  value= "<?php echo $unidad?>" aria-describedby="textHelp"  >
<span class="help-block" id="error"></span>  

