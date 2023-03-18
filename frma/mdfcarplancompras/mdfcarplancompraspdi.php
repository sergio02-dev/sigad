
<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */

    include('crud/rs/mdfcarplancompraspdi/Rsmdfcarplancompraspdi.php');
    $visibilidad=$_SESSION['visibilidadBotones']; 
    //$codigo_pdi = $_REQUEST['codigo_pdi'];
    $codigoPlanComprasPdi=$iduno;
    echo"codigo_plancomoras-->".$codigoPlanComprasPdi;
    

    $list_linea = $objMdfcarPlanComprasPdi->list_linea();
    $list_sedes = $objMdfcarPlanComprasPdi->list_sedes();
    $list_proyecto = $objMdfcarPlanComprasPdi->list_proyecto();
    $cantidad = 0;
    $valor_uni = 0;

    

    if($codigoPlanComprasPdi){
        $url_guardar="modificarformulariopdi";
        $task = "MODIFICAR PLAN COMPRAS PDI";

        $form_plancompraspdi = $objMdfcarPlanComprasPdi->form_plancompraspdi($codigoPlanComprasPdi);
    

        foreach ($form_plancompraspdi as $dat_plancompraspdi) {
            $pdi_codigo = $dat_plancompraspdi['pdi_codigo'];
            $pdi_sede = $dat_plancompraspdi['pdi_sede'];
            $pdi_vicerrectoria = $dat_plancompraspdi['pdi_vicerrectoria'];
            $pdi_facultad = $dat_plancompraspdi['pdi_facultad'];
            $pdi_dependencia = $dat_plancompraspdi['pdi_dependencia'];
            $pdi_area = $dat_plancompraspdi['pdi_area'];
            $pdi_accion = $dat_plancompraspdi['pdi_accion'];
            $pdi_plantafisica = $dat_plancompraspdi['pdi_plantafisica'];
            $pdi_linea = $dat_plancompraspdi['pdi_linea'];
            $pdi_sublinea = $dat_plancompraspdi['pdi_sublinea'];
            $pdi_equipo = $dat_plancompraspdi['pdi_equipo'];
            $pdi_equipodescripcion = $dat_plancompraspdi['pdi_equipodescripcion'];
            $pdi_valorunitario = $dat_plancompraspdi['pdi_valorunitario'];
            $pdi_cantidad = $dat_plancompraspdi['pdi_cantidad'];
            $pdi_estado= $dat_plancompraspdi['pdi_estado'];
            $total = $dat_plancompraspdi['total'];
        }
        $proyecto = $objMdfcarPlanComprasPdi->mdfcar_list_proyecto($pdi_accion);
       
        if($pdi_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }
        else{
            $checkedA = "";
            $checkedI = "checked";
        }
        
    }



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
					<div class="col-sm-12 modal-header capa_titulo"><h2> <strong>MODIFICAR PLAN DE COMPRAS PDI </strong></h2></div>
                    <div class="col-sm-12">&nbsp;</div>

					<a href="consultarpdi" class="btn btn-danger btn-sm"><span class="fas fa-undo-alt"></span> <strong> Regresar al plan de compras </strong></a>
			
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

<form id="plancomprasPDIform" role="form">
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

                                if($pdi_sede == $sed_codigo){
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
                            $list_vicerrectoria = $objMdfcarPlanComprasPdi->list_vicerrectoria($pdi_sede);
                            foreach ($list_vicerrectoria as $dat_vice) {
                                $ent_codigo = $dat_vice['ent_codigo'];
                                $ent_nombre = $dat_vice['ent_nombre'];

                                if($pdi_vicerrectoria == $ent_codigo){
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
                                $list_facultad = $objMdfcarPlanComprasPdi->list_facultad($pdi_sede, $pdi_vicerrectoria); 
                                foreach ($list_facultad as $dat_fac) {
                                    $codigo_facultad = $dat_fac['codigo_facultad'];
                                    $nombre_facultad = $dat_fac['nombre_facultad'];
                                
                                if($pdi_facultad == $codigo_facultad){
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
                            $list_dependencia = $objMdfcarPlanComprasPdi->list_dependencia($pdi_sede, $pdi_vicerrectoria, $pdi_facultad); 
                            foreach ($list_dependencia as $dat_dependencia) {
                                $codigo_dependencia = $dat_dependencia['codigo_dependencia'];
                                $nombre_dependencia = $dat_dependencia['nombre_dependencia'];

                            if($pdi_dependencia == $codigo_dependencia){
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
                                $list_area = $objMdfcarPlanComprasPdi->list_area($pdi_sede, $pdi_vicerrectoria,$pdi_facultad,$pdi_dependencia); 
                                foreach ($list_area as $dat_area) {
                                    $codigo_area = $dat_area['codigo_area'];
                                    $nombre_area = $dat_area['nombre_area'];
                                
                                    
                                if($pdi_area == $codigo_area){
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
                    <input type="text" class="form-control caja_texto_sizer" id="textTipoGasto" name="textTipoGasto" aria-describedby="textHelp" value="PDI" data-rule-required="true" disabled>   
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-sm-12">
                    <div class="form-group p-3">
                        <label for="selProyecto" class="font-weight-bold"> Proyecto</label>
                        <select name="selProyecto" id="selProyecto" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                            <option value="0" data-codigo_proyecto="0">Seleccione el proyecto</option>
                            <?php
                                
                                foreach ($list_proyecto as $data_proyecto) {
                                    $pro_codigo=$data_proyecto['pro_codigo'];
                                    $pro_referencia=$data_proyecto['pro_referencia'];
                                    $pro_descripcion = $data_proyecto['pro_descripcion'];
                                    $pro_numero = $data_proyecto['pro_numero'];

                                if($proyecto == $pro_codigo){
                                    $select_proyecto = "selected";
                                }
                                else{
                                    $select_proyecto = "";
                                }
                                    

                            ?>
                                <option value="<?php echo  $pro_referencia ?>" <?php echo $select_proyecto; ?>  data-codigo_proyecto="<?php echo $pro_codigo; ?>"><?php echo substr($pro_referencia.'.'.$pro_numero.' '.$pro_descripcion,0,200)."..."; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <span class="help-block" id="error"></span>  
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group p-3 Accion">
                            <label for="selAccion" class="font-weight-bold"> Accion</label>
                           <select name="selAccion" id="selAccion" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
                                <option value="0"  data-codigo_caracteristicas="0" data-plantafisica="0" >Seleccione la accion</option>
                                <?php
                                    $list_accion = $objMdfcarPlanComprasPdi->list_accion($proyecto);
                                    foreach ($list_accion as $data_tipoAccion) {
                                        $acc_codigo=$data_tipoAccion['acc_codigo'];
                                        $acc_referencia = $data_tipoAccion['acc_referencia'];
                                        $acc_descripcion=$data_tipoAccion['acc_descripcion'];
                                        $acc_numero = $data_tipoAccion['acc_numero'];

                                        $plantafisica = $objMdfcarPlanComprasPdi->planta_fisica($acc_codigo);

                                        if($pdi_accion == $acc_codigo){
                                            $select_accion = "selected";
                                        }
                                        else{
                                            $select_accion = "";
                                        }
                                        

                                ?>
                                    <option value="<?php echo  $acc_codigo; ?>" <?php echo $select_accion; ?>><?php echo $acc_referencia.'.'.$acc_numero.' '.$acc_descripcion ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <span class="help-block" id="error"></span>  
                        </div>
            </div>
        </div>
      
            <div class="platafisicara" name="plantafisicara" id="plantafisicara">          
                <div class="row" >
                    <div class="col-sm-8 plantaFisica"  style="display: none">
                        <div class=" p-3 ">
                         <label for="platafisicara"  class="font-weight-bold">Caracteristicas Planta Fisica </label> 
                         <textarea type="text" class="form-control caja_texto_sizer" id="inputPlantaFisica" name="inputPlantaFisica" aria-describedby="textHelp"   data-rule-required="true"><?php echo $pdi_plantafisica ?></textarea>
                         <span class="help-block" id="error"></span>
                        </div>
                    </div>
                </div>
            </div>
      
       
    </div>

  
    <div class= "border" > 
        <div class =" productos" name="productos" id="productos">
                <div class="col-sm-12 bg-light text-dark border pt-2 ">
                        <label for="productos" class="font-weight-bold ">PRODUCTOS</label>
                </div> 
                <div id="mdfcarproductospdi">
                    <?php 
                        include('frma/mdfcarplancompras/productospdi.php'); 
                    ?>  
                </div>
        </div>

        <?php if ($codigo_session == 1 || $codigo_session==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){

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
            <button type="submit" class="btn btn-danger" style="width:120px; height:50px ;" onclick="validar_formpdi();"><i class="far fa-save"></i>&nbsp;<strong> Guardar</strong></button>
        
        </div>
        <div class="row">
                <div class="col-sm-12">&nbsp;</div>
        </div>
    </div>

<!-- ******************** FIN FORMULARIO ************************* -->
    <div class="modal-footer ">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigoPlanComprasPdi" id="codigoPlanComprasPdi" value="<?php echo $codigoPlanComprasPdi; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
       
    </div>  
</form> 

</body>
                            
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/mdfcarplancompras/mdfcarplandecompraspdi.js"></script>
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


    
</script>
