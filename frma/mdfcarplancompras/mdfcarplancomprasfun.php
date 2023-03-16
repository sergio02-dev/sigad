<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */

    include('crud/rs/mdfcarplancomprasfun/Rsmdfcarplancomprasfun.php');
    $visibilidad=$_SESSION['visibilidadBotones']; 
    //$codigo_pdi = $_REQUEST['codigo_pdi'];
    $codigoPlanComprasFun=$iduno;
    
    echo"iduno->".$iduno;

    
    $list_sedes = $objMdfcarPlanComprasFun->list_sedes();
   
   
    $cantidad = 0;
    $valor_uni = 0;

    

    if($codigoPlanComprasFun){
        $url_guardar="modifcarformulariofun";
        $task = "MODIFICAR PLAN COMPRAS FUNCIONAMIENTO";

        $form_plancomprasfun = $objMdfcarPlanComprasFun->form_plancomprasfun($codigoPlanComprasFun);
    

        foreach ($form_plancomprasfun as $dat_plancomprasfun) {
            $fun_codigo = $dat_plancomprasfun['fun_codigo'];
            $fun_sede = $dat_plancomprasfun['fun_sede'];
            $fun_vicerrectoria = $dat_plancomprasfun['fun_vicerrectoria'];
            $fun_facultad = $dat_plancomprasfun['fun_facultad'];
            $fun_dependencia = $dat_plancomprasfun['fun_dependencia'];
            $fun_area = $dat_plancomprasfun['fun_area'];
            $fun_linea = $dat_plancomprasfun['fun_linea'];
            $fun_sublinea = $dat_plancomprasfun['fun_sublinea'];
            $fun_equipo = $dat_plancomprasfun['fun_equipo'];
            $fun_equipodescripcion = $dat_plancomprasfun['fun_equipodescripcion'];
            $fun_valorunitario = $dat_plancomprasfun['fun_valorunitario'];
            $fun_cantidad = $dat_plancomprasfun['fun_cantidad'];
            $fun_estado= $dat_plancomprasfun['fun_estado'];
            $total = $dat_plancomprasfun['total'];
        }
       
        if($fun_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }

    $capa_direccion = "#dtaformconsultafun";
    $url_direccion = "dtaformconsultafun";


?>
<!-- ******************** INICIO FORMULARIO ************************* -->
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('prncpal/hd.php'); ?>
    <link rel="stylesheet" href="DataTables/datatables.min.css" />
    <script src="DataTables/datatables.min.js"></script>
</head>

<body>

    
	<!-- *************** Inicio de page container ************************************************ -->
	<div class="page-container" style='padding:0; margin:0;'>

    <div  class="container-fluid">
        <div class="row">
            <div class="col-sm-3">

            <!-- INICIO MENU -->
                <?php include('prncpal/mnu.php') ?>
            <!--..........................................FIN MENU..................................................-->

            </div>
            <div class="col-sm-9 container-principal" >
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>MODIFICAR PLAN DE COMPRAS FUNCIONAMIENTO </strong></h2></div>
                    <div class="col-sm-12">&nbsp;</div>

					<a href="consultafun" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong> Regresar al plan de compras </strong></a>
			
					<!-- **********************          Inicio Modal Forma    *********************************** -->
                        <!-- Large modal -->
                        <div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    Cargando...
                                </div>
                            </div>
                        </div>
                    <!-- **********************          Fin Modal Forma       *********************************** -->
					<br><br>

<form id="plancomprasfuncionamientoform" role="form">
    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="informacionInstitucional" class="font-weight-bold ">INFORMACION INSTITUCIONAL</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                <div class="form-group p-3">
                    <label for="selSede" class="font-weight-bold">Sede</label>
                    <select name="selSede" id="selSede" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option value="0" data-codigo_sede="0" >Seleccione...</option>
                            <?php
                              
                                foreach ($list_sedes as $dat_sede) {
                                    $sed_codigo = $dat_sede['sed_codigo'];
                                    $sed_nombre = $dat_sede['sed_nombre'];

                                if($fun_sede == $sed_codigo){
                                    $select_sede = "selected";
                                }
                                else{
                                    $select_sede = "";
                                }
                            ?>
                                <option value="<?php echo  $sed_codigo; ?>"  <?php echo $select_sede; ?>  data-codigo_sede="<?php echo  $sed_codigo; ?>"><?php echo $sed_nombre; ?></option>
                            <?php
                                }
                            ?>
                    </select>
                    <span class="help-block" id="error"></span>    
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group p-3 listVice">
                    <label for="textTipoVicerrectoria" class="font-weight-bold"> Vicerrectoria</label>
                    <select name="selTipoVicerrectoria" id="selTipoVicerrectoria" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0" data-codigo_sede="<?php echo  $codigo_sede; ?>"  data-codigo_vicerrectoria="0">Seleccione...</option>
                        <?php   
                            $list_vicerrectoria = $objMdfcarPlanComprasFun->list_vicerrectoria($fun_sede);
                            foreach ($list_vicerrectoria as $dat_vice) {
                                $ent_codigo = $dat_vice['ent_codigo'];
                                $ent_nombre = $dat_vice['ent_nombre'];

                                if($fun_vicerrectoria == $ent_codigo){
                                    $select_vicerrectoria = "selected";
                                }
                                else{
                                    $select_vicerrectoria = "";
                                }
                        ?>
                            <option value="<?php echo  $ent_codigo; ?>" <?php echo $select_vicerrectoria; ?>><?php echo $ent_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-4">
                    <div class="form-group p-3 listFac">
                        <label for="textTipoFacultad" class="font-weight-bold"> Facultad</label>
                        <select name="selTipoFacultad" id="selTipoFacultad" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option value="0" data-codigo_facultad="0" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>">Seleccione...</option>
                            <?php
                                $list_facultad = $objMdfcarPlanComprasFun->list_facultad($fun_sede, $fun_vicerrectoria); 
                                foreach ($list_facultad as $dat_fac) {
                                    $codigo_facultad = $dat_fac['codigo_facultad'];
                                    $nombre_facultad = $dat_fac['nombre_facultad'];
                                
                                if($fun_facultad == $codigo_facultad){
                                    $select_facultad = "selected";
                                }
                                else{
                                    $select_facultad = "";
                                }
                            ?>
                                <option value="<?php echo  $codigo_facultad; ?>" <?php echo $select_facultad; ?>><?php echo $nombre_facultad; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group p-3 listDep">
                    <label for="textDependencia" class="font-weight-bold">Dependencia</label>
                    <select name="selDependencia" id="selDependencia" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                        <option value="0" data-codigo_dependencia="0" data-codigo_facultad="<?php echo $codigo_facultad; ?>" data-codigo_sede="<?php echo  $codigo_sede; ?>" data-codigo_vicerrectoria="<?php echo  $codigo_vicerrectoria; ?>">Seleccione...</option>
                        <?php
                            $list_dependencia = $objMdfcarPlanComprasFun->list_dependencia($fun_sede, $fun_vicerrectoria, $fun_facultad); 
                            foreach ($list_dependencia as $dat_dependencia) {
                                $codigo_dependencia = $dat_dependencia['codigo_dependencia'];
                                $nombre_dependencia = $dat_dependencia['nombre_dependencia'];

                            if($fun_dependencia == $codigo_dependencia){
                                $select_dependencia = "selected";
                            }
                            else{
                                $select_dependencia = "";
                            }
                        ?>
                            <option value="<?php echo  $codigo_dependencia; ?>"  <?php echo $select_dependencia; ?>><?php echo $nombre_dependencia; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>       
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="form-group p-3 listArea">
                        <label for="selArea" class="font-weight-bold">Area</label>
                        <select name="selArea" id="selArea" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option value="0">Seleccione...</option>
                            <?php
                                $list_area = $objMdfcarPlanComprasFun->list_area($fun_sede, $fun_vicerrectoria,$fun_facultad,$fun_dependencia); 
                                foreach ($list_area as $dat_area) {
                                    $codigo_area = $dat_area['codigo_area'];
                                    $nombre_area = $dat_area['nombre_area'];
                                
                                    
                                if($fun_area == $codigo_area){
                                    $select_area = "selected";
                                }
                                else{
                                    $select_area = "";
                                }
                            ?>
                                <option value="<?php echo $codigo_area; ?>"<?php echo $select_area; ?>><?php echo $nombre_area; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 bg-light text-dark border pt-2">
        <label for="tipodeGasto" class="font-weight-bold ">TIPO DE GASTO</label>
    </div>
    <div class= "border"> 
        <div class="row " >
            
            <div class="col-sm-4" >
                    
                <div class="form-group p-3">
                    <label for="textTipoGasto" class="font-weight-bold">Tipo de gasto</label>
                    <input type="text" class="form-control caja_texto_sizer" id="textTipoGasto" name="textTipoGasto" aria-describedby="textHelp" value="FUNCIONAMIENTO" data-rule-required="true" disabled>   
                </div>
            </div>
        </div>      
    </div>

  
    <div class= "border" > 
        <div class =" productos" name="productos" id="productos">
            <div class="col-sm-12 bg-light text-dark border pt-2 ">
                     <label for="productos" class="font-weight-bold ">PRODUCTOS</label>
            </div> 
            <div id="mdfcarproductos">
                <?php 
                    include('frma/mdfcarplancompras/productos.php'); 
                
                ?>  
    
            </div>
        </div>
   


    <?php 

     $codigo_session = $_SESSION['idusuario'];
     if ($codigo_session == 1 || $codigo_session==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
    
    ?>
    <div class="row">  
            <div class="col-sm-12">
                <div class="form-group p-3">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>
    </div>
    <?php 
        }
    ?>
    <div class="row">
            <div class="col-sm-12">&nbsp;</div>
    </div>
    <div class="m-0 row justify-content-center">
        <button type="submit" class="btn btn-danger" style="width:120px; height:50px ;" onclick="validar_formfun();"><i class="far fa-save"></i>&nbsp;<strong> Guardar</strong></button>
    
    </div>
    <div class="row">
            <div class="col-sm-12">&nbsp;</div>
    </div>

</div>

<!-- ******************** FIN FORMULARIO ************************* -->
    <div class="modal-footer ">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigoPlanComprasFun" id="codigoPlanComprasFun" value="<?php echo $codigoPlanComprasFun; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
       
    </div>  
</form> 

</body>
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/mdfcarplancompras/mdfcarplandecomprasfun.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
   
    $('#selSede').change(function(){
        var codigo_sede=$(this).find(':selected').data('codigo_sede');
        
        $.ajax({
            url:"vicerrectorialist",
            type:"POST",
            data:"codigo_sede="+codigo_sede,
            async:true,
            success: function(message){
                $(".listVice").empty().append(message);
            }
        });
    });
        
    /*$('#selLineaEquipo').change(function(){
        var codigo_linea = $(this).find(':selected').data('codigo_linea');
       
        if(codigo_linea==0){

        }
        else{
            $.ajax({
                url:"sublinea",
                type:"POST",
                data:"codigo_linea="+codigo_linea,
                async:true,

                success: function(message){
                    $(".subLinea").empty().append(message);
                    $("")
                }
            });
        }
    });*/
    $('#selProyecto').change(function(){
        var codigo_proyecto = $(this).find(':selected').data('codigo_proyecto');
       
        if(codigo_proyecto==0){

        }
        else{
            $.ajax({
                url:"accion",
                type:"POST",
                data:"codigo_proyecto="+codigo_proyecto,
                async:true,

                success: function(message){
                    $(".Accion").empty().append(message);

                }
            });
        }
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('.sma').change(function(){
        var undades = $('#selCantidad').val();
        var str = $('#selValorUnitario').val();
        var valor_unidades = 0;

        valor_unidades = str.toString().replace(/\./g,'');
        
        var total = undades * valor_unidades;

        $('#selValorTotal').val(numberWithCommas(total));
    });



    /*function agregarEquipo(){
        
    
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
    
    };*/
    
</script>