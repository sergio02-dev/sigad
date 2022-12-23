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
                url: 'jformfun',
                type: 'POST'
            },
            columns: [
                { data: 'ent_nombre', title: 'Nombre'},
                { data: 'estado', title: 'Estado'},
                {
                    data: null,
                    render: function (data, type, full, meta){
                        return '<div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" title="Editar Funcionamiento" style="display:<?php echo $visibilidad; ?>;" onclick="editarFacultades(\''+full["fun_codigo"]+'\');"></i> </div> ';
                    },
                    title: 'Editar'
                },	

            ],
            //dom:            "Bfrtip",
            scrollY:        "600px",
            //scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 2
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                { "width": "90%", "targets": 0 },
                { "width": "6%", "targets": 1 },
                { "width": "4%", "targets": 2 },
            ],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function format(codigo_data) {
			var codigo_fuente = codigo_data.ppi_fuente;
            var codigo_plan = codigo_data.ppi_plan;
            var codigoPpi = codigo_data.ppi_codigoppi;

			var dataenviar = {
								"codigo_fuente": codigo_fuente,
                                "codigo_plan": codigo_plan,
                                "codigoPpi": codigoPpi,
							}

			$.ajax({
				url:"infoppi",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#infoPpi"+codigo_fuente).empty().append(message);
				}
			});

			return '<div id="infoPpi'+codigo_fuente+'"></div>';
		}

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
    });

    function agregarEquipo(){

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formularioModalEquipo",
            type:"POST",
            data:"",
            async:true,

        success: function(message){
            $(".modal-content").empty().append(message);
        }
    });
}

    
    



</script>
<!-- *********************     Fin DataTable     *************************************** *-->