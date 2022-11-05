<?php 
    include('crud/rs/plnccion.php');

    $codigo_accion=$_REQUEST['codigo_accion'];

   /* $objPrflPrsna->setCodigoPersona($codigo_persona);
    $personaUsuario=$objPrflPrsna->usuarioPersona();
    if($personaUsuario){
       
       
        $url_proceso="crudupdateperfilpersona";
        $tarea="Modificar";
    }
    else{
        $url_proceso='crerperfilusuario';
        $tarea="Crear";
    }*/

    //echo "-->".$codigo_persona;

   /* if($codigo_persona){
        
        $url_proceso="crudupdatepersona";
    }
    else{
        $url_proceso="crudregistropersona";
    }*/
    $url_proceso="crudregistroencargado";
?>
<form id="formencargado" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong> FORMULARIO ENCARGADO ACCIÓN</strong> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!--<p class="font-weight-bold">* campos obligatorios</p>-->
        <!-- ******************** INICIO FORMULARIO ************************* -->

        

        <strong>Usuarios </strong>
        <div class="row"> 
            <div class="col-sm-6">
                <div class="bg">
                    <div>
                    <?php 
                        $personaEncargado=$objPlanAccion->personas_encargados();
                        if($personaEncargado){
                            foreach ($personaEncargado as $data_personas_encargados) {
                                $per_codigo=$data_personas_encargados['per_codigo'];
                                $per_nombre=$data_personas_encargados['per_nombre'];
                                $per_primerapellido=$data_personas_encargados['per_primerapellido'];
                                $per_segundoapellido=$data_personas_encargados['per_segundoapellido'];

                                $persona_nombre=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

                                $checkeEncargado=$objPlanAccion->checked_encargado($codigo_accion, $per_codigo);
                                if($checkeEncargado==0){
                                    $chckdEncrgdo="";
                                }
                                else{
                                    $chckdEncrgdo="checked";
                                }
                            
                    ?>
                        <div class="chiller_cb">
                            <input id="personaencargado<?php echo $per_codigo; ?>" name="personaencargado[]" type="checkbox" value="<?php echo $per_codigo; ?>" data-rule-required="true" required <?php echo $chckdEncrgdo; ?>>
                            <label for="personaencargado<?php echo $per_codigo; ?>"><?php echo $persona_nombre; ?></label>
                            <span></span>
                        </div>
                    <?php   
                    
                            }//Foreach Menu
                        }//if Menu
                    ?>
                    
                    </div>
                </div>

            </div>
        </div>
    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" id="url_proceso" name="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" id="codigo_accion" name="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_encargado();"><i class="far fa-save"></i> Guardar </button>
    </div>
</form>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroEncragadoAccion.js"></script>