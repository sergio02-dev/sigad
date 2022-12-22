<?php
$codigo_proyecto=$_REQUEST['codigo_proyecto'];  

?>

 <br>
<input type="hidden" value="<?php echo $codigo_proyecto; ?>" id="codigo_proyecto">
<table id="dataAccion<?php echo $codigo_proyecto; ?>" class="table table-striped table-bordered">

<!--<tfoot>
	<tr>
		<th colspan="4" style="text-align:right">Total Página:</th>
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

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataPPI" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataPPI').DataTable({
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
                url: 'jconsultarpdi',
                type: 'POST'
            },
            columns: [
              
                { data: 'sed_nombre', title: 'Sede'},
                { data: 'ofi_nombre', title: 'Dependencia'},
                { data: 'acc_nombre', title: 'Accion'},
                { data: 'equi_nombre', title: 'Equipo'},
                { data: 'deq_descripcion', title: 'Descripcion'},
                { data: 'pdi_cantidad', title: 'Cantidad'},
                { data: 'pdi_valorunitario', title: 'Valor unitario'},
                { data: 'estado', title: 'Estado'},
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                }
             
            ],
            //dom:            "Bfrtip",
            scrollY:        "600px",
            //scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 7
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "14%", "targets": 3 },
                { "width": "32%", "targets": 4 },
                { "width": "4%", "targets": 5 },
                { "width": "10%", "targets":6 },
                { "width": "10%", "targets": 7 },
                
               
                
            ],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

       	/////Inicio Mas primera columna
		function format(codigo_data) {
			var sed_nombre =  codigo_data.sed_nombre;
            var vic_nombre = codigo_data.vic_nombre;
            var fac_nombre = codigo_data.fac_nombre;
            var ofi_nombre = codigo_data.ofi_nombre;
            var area_nombre = codigo_data.area_nombre;
            var acc_nombre = codigo_data.acc_nombre;
            var pdi_plantafisica = codigo_data.pdi_plantafisica;
            var lin_nombre = codigo_data.lin_nombre;
            var slin_nombre = codigo_data.slin_nombre;
            var equi_nombre = codigo_data.equi_nombre;
            var deq_descripcion = codigo_data.deq_descripcion;
            var pdi_cantidad = codigo_data.pdi_cantidad;
            var pdi_valorunitario = codigo_data.pdi_valorunitario;
			var dataenviar = {
								"sed_nombre": sed_nombre,
                                "vic_nombre": vic_nombre,
                                "fac_nombre": fac_nombre,
                                "ofi_nombre": ofi_nombre,
                                "area_nombre": area_nombre,
                                "acc_nombre": acc_nombre,
                                "pdi_plantafisica": pdi_plantafisica,
                                "lin_nombre": lin_nombre,
                                "slin_nombre": slin_nombre,
                                "equi_nombre": equi_nombre,
                                "deq_descripcion": deq_descripcion,
                                "pdi_cantidad": pdi_cantidad,
                                "pdi_valorunitario": pdi_valorunitario,
							}

			$.ajax({
				url:"infoplancompraspdi",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#registroActividad"+sed_nombre).empty().append(message);
				}
			});

			return '<div id="registroActividad'+sed_nombre+'"></div>';
		}
		// Fin Mas primera columna

        // Add event listener for opening and closing details
        $('#dataPPI tbody').on('click', 'td.details-control', function(){
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#dataAccion<?php echo $codigo_proyecto; ?> tbody').on('click', 'td.details-control', function(){
		var tr = $(this).closest('tr');
		var row = table.row(tr);

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			row.child(format(row.data())).show();
			tr.addClass('shown');
		}
	});
    });

    function agregar(){

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formconsultarpdi",
            type:"POST",
            data:"",
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editarDependencia(codigo_consultarpdi){
        var codigo_consultarpdi = codigo_consultarpdi;
        //alert(codigo_dependencia);
        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formconsultarpdi",
            type:"POST",
            data:"codigo_consultarpdi="+codigo_consultarpdi,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }



</script>
<!-- *********************     Fin DataTable     *************************************** *-->