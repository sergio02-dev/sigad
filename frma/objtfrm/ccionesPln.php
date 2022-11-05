<?php 
$plan=$_REQUEST['plan'];
$persona=$_REQUEST['persona'];
include('crud/rs/rsAccionEncrgdo.php');


$accion_plan=$rsAccionEncargado->accion_plan($plan);

if($accion_plan){
    $numero=1;
    foreach($accion_plan as $data_accion_plan){
        $pde_codigo=$data_accion_plan['pde_codigo'];
        $acc_codigo=$data_accion_plan['acc_codigo'];
        $acc_referencia=$data_accion_plan['acc_referencia'];
        $sub_referencia=$data_accion_plan['sub_referencia'];
        $acc_numero=$data_accion_plan['acc_numero'];
        $acc_descripcion=$data_accion_plan['acc_descripcion'];

        if($pde_codigo==1){
            $accion_descripcion=$sub_referencia.'.'.$acc_referencia.' '.$acc_descripcion;
        }
        else{
            $accion_descripcion=$acc_referencia.'.'.$acc_numero.' '.$acc_descripcion;
        }

        $accion_chek=$rsAccionEncargado->check_accion($acc_codigo, $persona);

        if($accion_chek==1){
            $chckdEncrgdo="checked";
        }
        else{
            $chckdEncrgdo="";
        }

        if($numero==1){
            echo"<div class='row'>";
        }
?>
        <div class="col-sm-6">
            <div class="bg" style="align-items: left;">
                <div class="chiller_cb_accion">
                    <input id="accion<?php echo $acc_codigo; ?>" name="accion[]" type="checkbox" value="<?php echo $acc_codigo; ?>" data-rule-required="true" required <?php echo $chckdEncrgdo; ?>>
                    <label for="accion<?php echo $acc_codigo; ?>" class="caja_texto_sizer"><?php echo $accion_descripcion; ?></label>
                    <span></span>
                </div>
            </div>
        </div>
<?php 

        if($numero==2){
            echo"</div>";
            $numero=0;
        }
       
        $numero++;
    }
}
?>