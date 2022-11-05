<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/rsPrflPrsna.php');
    $codigo_persona=$_REQUEST['codigo_persona'];

    $objPrflPrsna->setCodigoPersona($codigo_persona);
    $nombrePersona=$objPrflPrsna->nombrePersona();
    $personaUsuario=$objPrflPrsna->usuarioPersona();
    if($personaUsuario){
        foreach ($personaUsuario as $data_UsuarioPersona) {
            $use_codigo=$data_UsuarioPersona['use_codigo'];
            $use_alias=$data_UsuarioPersona['use_alias'];
        }
        $perfilesPersona=$objPrflPrsna->perfilPersona();
        if($perfilesPersona){
            foreach ($perfilesPersona as $data_PerfilPersona) {
                $ppf_codigo=$data_PerfilPersona['ppf_codigo'];
                $ppf_perfil=$data_PerfilPersona['ppf_perfil'];
            }
        }
        $url_proceso="crudupdateperfilpersona";
        $tarea="MODIFICAR";
    }
    else{

        $url_proceso='crerperfilusuario';
        $tarea="CREAR";
    }


?>
<form id="perfilPersonaForm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>FORMULARO <?php echo $tarea; ?> PERFIL <?php echo strtoupper(tildes($nombrePersona)); ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textUsuario" class="font-weight-bold">Usuario *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textUsuario" name="textUsuario" aria-describedby="textHelp" value="<?php echo $use_alias; ?>" data-rule-required="true" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="textPass" class="font-weight-bold">Contraseña *</label>
                    <input type="password" class="form-control caja_texto_sizer" id="textPass" name="textPass" aria-describedby="textHelp" value="" >
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selPerfil" class="font-weight-bold"> Perfil *</label>
                    <select name="selPerfil" id="selPerfil" class="form-control caja_texto_sizer" data-rule-required="true" required>
                        <option value="0">Seleccione...</option>
                        <?php
                        $perfil=$objPrflPrsna->perfil();
                        foreach ($perfil as $data_perfil) {
                            $pfr_codigo=$data_perfil['pfr_codigo'];
                            $pfr_nombre=$data_perfil['pfr_nombre'];

                            if($pfr_codigo==$ppf_perfil){
                                $select_perfil="selected";
                            }
                            else{
                                $select_perfil="";
                            }
                        ?>
                            <option value="<?php echo  $pfr_codigo; ?>"  <?php echo $select_perfil; ?> ><?php echo $pfr_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <strong>Menu</strong>
        <div class="row">
            <div class="col-sm-6">
                <div class="bg">
                    <div>
                    <?php
                        $menu=$objPrflPrsna->Menu();
                        if($menu){
                            foreach ($menu as $data_menu) {
                                $sys_codigo=$data_menu['sys_codigo'];
                                $sys_nombre=$data_menu['sys_nombre'];

                                $objPrflPrsna->setSistema($sys_codigo);
                                $checkePadre=$objPrflPrsna->checkeadoMenu();
                                if($checkePadre==1){
                                    $chckdPdre="checked";
                                }
                                else{
                                    $chckdPdre="";
                                }

                    ?>
                        <div class="chiller_cb">
                            <input id="sistema<?php echo $sys_codigo; ?>" name="sistema[]" type="checkbox" value="<?php echo $sys_codigo; ?>" data-rule-required="true" required <?php echo $chckdPdre; ?>>
                            <label for="sistema<?php echo $sys_codigo; ?>" class="caja_texto_sizer"><?php echo $sys_nombre; ?></label>
                            <span></span>
                        </div>
                    <?php
                                $subMenu=$objPrflPrsna->SubMenu($sys_codigo);
                                if($subMenu){
                                    foreach ($subMenu as $data_subMenu) {
                                    $sys_codigoH=$data_subMenu['sys_codigo'];
                                    $sys_nombreH=$data_subMenu['sys_nombre'];

                                    $objPrflPrsna->setSistema($sys_codigoH);
                                    $checkeHijo=$objPrflPrsna->checkeadoMenu();

                                    if($checkeHijo==1){
                                        $chckdHjo="checked";
                                    }
                                    else{
                                        $chckdHjo="";
                                    }


                    ?>
                    <div class="segundo_Nivel">
                        <div class="chiller_cb">
                            <input id="sistema<?php echo $sys_codigoH; ?>" name="sistema[]" type="checkbox" value="<?php echo $sys_codigoH; ?>" data-rule-required="true" required <?php echo $chckdHjo; ?>>
                            <label for="sistema<?php echo $sys_codigoH; ?>" class="caja_texto_sizer"><?php echo $sys_nombreH; ?></label>
                            <span></span>
                        </div>
                    </div>

                    <?php
                                    }
                                }//if subMenu
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
        <input type="hidden" id="per_codigo" name="per_codigo" value="<?php echo $codigo_persona; ?>">
        <input type="hidden" id="use_codigo" name="use_codigo" value="<?php echo $use_codigo; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_perfilPersona();"><i class="far fa-save"></i> Guardar </button>
    </div>
</form>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/prflPrsna.js"></script>
