<?php

    $codigo_accion=$_REQUEST['codigo_accion'];
	$codigo_subsistema=$_REQUEST['codigo_subsistema'];
	$codigo_plan =$_REQUEST['codigo_plan'];
	include('crud/rs/mtaPrdcto.php');
	$visibilidad=$_SESSION['visibilidadBotones']; 

    list($inicio,$fin)=$objRsMtaPrdcto->anio_inicio_fin($codigo_plan); 

    list($unidad_medida, $linea_base, $meta_resultado)=$objRsMtaPrdcto->unidad_linea_meta($codigo_accion);
    
     
?>

 <div class="col-sm-12">
    <strong>Unidad de Medida: <?php echo $unidad_medida; ?> | Linea Base <?php echo $inicio; ?>: <?php echo $linea_base ?> | Meta  <?php echo $fin; ?>: <?php echo $meta_resultado ?></strong>
 </div>
 <br>
<input type="hidden" value="<?php echo $codigo_accion; ?>" id="accion_code">
<table id="dataActividad<?php echo $codigo_accion; ?>" class="table table-striped table-bordered">

<tfoot>
	<tr>
		<th colspan="5" style="text-align:right">Total Página:</th>
		<th colspan="3"></th>
	</tr>
</tfoot>
</table>

<br>
<h4><strong>Actividades</strong></h4>
<hr>

<table id="tablaAccion<?php echo $codigo_accion; ?>" class="table table-striped table-bordered">

<!--<tfoot>
	<tr>
		<th colspan="5" style="text-align:right">Total Página:</th>
		<th colspan="3"></th>
	</tr>
</tfoot>-->
</table>

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



<script>

$(document).ready(function() {
    var table =	$('#dataActividad<?php echo $codigo_accion; ?>').DataTable({
		"processing": true,
		 "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
        },
		ajax: {
			url: 'jactividadesaccion?<?php echo $codigo_accion; ?>',
			type: 'POST'
		},
		columns: [
			
            { data: 'act_fechaexpedicion', title: 'Fecha Exp.'},
            { data: 'act_certificado', title: 'Certificado'},
			{ data: 'act_referencia', title: 'Codigo Actividad'},
			{ data: 'act_descripcion', title: 'Actividad'},
			{ data: 'nombre_etapa', title: 'Etapa de la Actividad'},
			{ data: 'aco_valor', title: 'Valor Etapa'},
			{ 
				data: null,
				render: function (data, type, full, meta){
					return '<div class="d-inline-block"><i class="fas fa-list fa-lg color_icono" title="Registro de Actividades" style="display:'+full["ver_boton"]+'" onclick="registrar_actividad(\''+full["act_codigo"]+'\',\''+full["acc_descripcion"]+'\',\''+full["act_accion"]+'\',\''+full["cee_etapa"]+'\',\''+full["cee_actividad"]+'\',\''+full["pde_codigo"]+'\');"></i> </div>';
				}
			},
			{
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
			
			
		],
        scrollY:        "600px",
        scrollCollapse: true,
        paging:         false,
        buttons:        [ 'colvis' ],
        fixedColumns:   {
            leftColumns: 2
        },
		"order": [[1, 'asc']],
		"footerCallback": function (row, data, start, end, display) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function (i) {
				return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
			};

			// Total over all pages
            total = api
                .column(6)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column(6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			// Update footer
			$(api.column(6).footer()).html(
			'$' + formatNumber(pageTotal) + ' <br/>( $' + formatNumber(total) + ' Sub total Accion)');
		}
	});

	function formatNumber(num) {
		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	}

    /* Formatting function for row details - modify as you need */
    function formatEtapa(codigo_data) {

        var accion_code=$('#accion_code').val();
        var codigo_actividad=codigo_data.act_codigo;
		var codigo_etapa = codigo_etapa;
        var dataenviar = { 
                            "codigo_certificado" : codigo_actividad, 
							"acc_descripcion" : codigo_data.acc_descripcion,
							"codigo_accion" : codigo_data.act_accion,
							"codigo_etapa" : codigo_data.cee_etapa,  
                            "codigo_actividad" : codigo_data.cee_actividad, 
                            "codigo_plan": codigo_data.pde_codigo,
                        }	
                        

        $.ajax({
            url:"inforgstroactvdad",
            type:"POST",
            data:dataenviar, 
            async:true,

            success: function(message){
                $("#registroActividad"+codigo_etapa).empty().append(message);
            }
        });

        return '<div id="registroActividad'+codigo_etapa+'"></div>';
    }

    // Add event listener for opening and closing details
    $('#dataActividad<?php echo $codigo_accion; ?> tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(formatEtapa(row.data())).show();
            tr.addClass('shown');
        }
    });

	///Tabla dos 

	var tableDos =	$('#tablaAccion<?php echo $codigo_accion; ?>').DataTable({
		"processing": true,
		 "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
        },
		ajax: {
			url: 'jactividadesreportadas?<?php echo $codigo_accion; ?>',
			type: 'POST'
		},
		columns: [
			{
                "className":      'details-control-tabla',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'ref_actividad', title: 'Codigo Actividad'},
			{ data: 'certificados', title: 'Certificados'},
            { data: 'acp_descripcion', title: 'Actividad'},
			{ 
				data: null,
				render: function (data, type, full, meta){
					return '<div class="d-inline-block"> <i class="fas fa-list fa-lg color_icono" title="Registro de Actividades" style="display:<?php echo $visibilidad; ?>;" onclick="registro_reporte_actividad(\''+full["codigo_actividad"]+'\',\''+full["codigo_accion"]+'\',\''+full["codigo_plan"]+'\');"></i></div>';
				}
			},
			
			
		],
        scrollY:        "600px",
        scrollCollapse: true,
        paging:         false,
        buttons:        [ 'colvis' ],
        fixedColumns:   {
            leftColumns: 2
        },
		"order": [[1, 'asc']],
	});

	function formatNumber(num) {
		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	}

    /* Formatting function for row details - modify as you need */
    function formatActividad(codigo_data) {

        var codigo_actividad=codigo_data.codigo_actividad;
		
        var dataenviar = { 
                            "codigo_actividad" : codigo_actividad, 
							"codigo_accion" : codigo_data.codigo_accion,
							"codigo_plan" : codigo_data.codigo_plan,
                        }	
                        

        $.ajax({
            url:"infoactivdadreportada",
            type:"POST",
            data:dataenviar, 
            async:true,

            success: function(message){
                $("#actividadReportadaDetalles"+codigo_actividad).empty().append(message);
            }
        });

        return '<div id="actividadReportadaDetalles'+codigo_actividad+'"></div>';
    }

    // Add event listener for opening and closing details
    $('#tablaAccion<?php echo $codigo_accion; ?> tbody').on('click', 'td.details-control-tabla', function(){
        var tr = $(this).closest('tr');
        var row = tableDos.row(tr);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(formatActividad(row.data())).show();
            tr.addClass('shown');
        }
    });


});



function registrar_actividad(codigo_certificado, acc_descripcion, codigo_accion, codigo_etapa, codigo_actividad, codigo_plan){
	var codigo_certificado = codigo_certificado;
	var acc_descripcion = acc_descripcion;
	var codigo_accion = codigo_accion;
	var codigo_etapa = codigo_etapa;
	var codigo_actividad = codigo_actividad;
	var codigo_plan = codigo_plan;
	//alert("Codigo Certificado  "+codigo_certificado+" Descripcion Accion "+acc_descripcion+" Codigo Accion "+codigo_accion+" Codigo Etapa "+codigo_etapa+" codigo actividad "+codigo_actividad+" codigo Plan "+codigo_plan);

	$('#frmModal').modal({
		keyboard: true
	});

	$.ajax({
		url:"formrgstroactvdadetpa",
		type:"POST",
		data:"codigo_certificado="+codigo_certificado+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion+'&codigo_etapa='+codigo_etapa+'&codigo_actividad='+codigo_actividad+'&codigo_plan='+codigo_plan,
		async:true,

		success: function(message){
			$(".modal-content").empty().append(message);
		}
	});
		
}

function registro_reporte_actividad(codigo_actividad, codigo_accion, codigo_plan){
	var codigo_actividad = codigo_actividad;
	var codigo_accion = codigo_accion;
	var codigo_plan = codigo_plan;
	
	$('#frmModal').modal({
		keyboard: true
	});

	$.ajax({
		url:"formreporteactivdadreportada",
		type:"POST",
		data:"codigo_actividad="+codigo_actividad+"&codigo_accion="+codigo_accion+"&codigo_plan="+codigo_plan,
		async:true,

		success: function(message){
			$(".modal-content").empty().append(message);
		}
	});
		
}




</script>
