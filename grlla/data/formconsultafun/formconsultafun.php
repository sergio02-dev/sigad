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
                url: 'jformconsultafun',
                type: 'POST'
            },
            columns: [
                { data: 'sed_nombre', title: 'Sede'},               
                { data: 'ofi_nombre', title: 'Depedencia'},
                { data: 'equi_nombre', title: 'Equipo'},
                { data: 'fun_cantidad', title: 'Cantidad'},
                { data: 'fun_valorunitario', title: 'Valor Unitario'},
                { data: 'estado', title: 'Estado'},
                {
                    
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                
                },	
                

            ],
            //dom:            "Bfrtip",
            scrollY:        "600px",
            //scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 6
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "25%", "targets": 1 },
                { "width": "15%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { "width": "15%", "targets": 5 },
                { "width": "4%", "targets": 6 },
            ],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function format(codigo_data) {
			var fun_codigo = codigo_data.fun_codigo;
            var sed_nombre = codigo_data.sed_nombre;
            var ofi_nombre = codigo_data.ofi_nombre;
            var equi_nombre = codigo_data.equi_nombre;
            var deq_descripcion = codigo_data.deq_descripcion;
            var fun_cantidad = codigo_data.fun_cantidad;
            var fun_valorunitario = codigo_data.fun_valorunitario;
            var estado = codigo_data.estado;
            var are_nombre = codigo_data.are_nombre;
            var ent_nombre = codigo_data.ent_nombre;
            var fac_nombre = codigo_data.fac_nombre;
            var lin_nombre = codigo_data.lin_nombre;
            var slin_nombre = codigo_data.slin_nombre;
            


			var dataenviar = {
								"fun_codigo": fun_codigo,
                                "sed_nombre": sed_nombre,
                                "ofi_nombre": ofi_nombre,
                                "equi_nombre": equi_nombre,
                                "deq_descripcion": deq_descripcion,
                                "fun_cantidad": fun_cantidad,
                                "fun_valorunitario": fun_valorunitario,
                                "estado": estado,
                                "are_nombre": are_nombre,
                                "ent_nombre": ent_nombre,
                                "fac_nombre": fac_nombre,
                                "lin_nombre": lin_nombre,
                                "slin_nombre": slin_nombre,
                                

							}

			$.ajax({
				url:"infofuncionamiento",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#infoPlanCompras"+fun_codigo).empty().append(message);
				}
			});

			return '<div id="infoPlanCompras'+fun_codigo+'"></div>';
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

    

    



</script>
<!-- *********************     Fin DataTable     *************************************** *-->