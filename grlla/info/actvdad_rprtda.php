<?php
    $codigo_actividad = $_REQUEST['codigo_actividad'];
?>
<div class="capita-actividad<?php echo $codigo_actividad; ?>">
    <?php
        include('rcrga_actvdad_rprtda.php');
    ?>
</div>
