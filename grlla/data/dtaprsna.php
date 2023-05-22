<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataPersona" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataPersona').DataTable({
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
                url: 'jpersona',
                type: 'POST'
            },
            columns: [
                {
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
                { data: 'per_tipoidentificacion', title: 'Tipo Identificación'},
                { data: 'per_identificacion', title: 'Identificación'},
                { data: 'nombre_cmpltoprsna', title: 'Nombre'},	
                { data: 'per_correo', title: 'Correo'},								
                {
                    data: null, 
                    render: function (data, type, full, meta){
                        return '<div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" style="display:<?php echo $visibilidad; ?>;" title="Editar Persona" onclick="editar(\''+full["per_codigo"]+'\');"></i> </div> &nbsp;&nbsp; <div class="d-inline-block"><i class="fas fa-users-cog fa-lg color_icono" title="Perfil Persona" style="display:<?php echo $visibilidad; ?>;" onclick="perfiles(\''+full["per_codigo"]+'\');"></i> </div> &nbsp;&nbsp;<!--<div class="d-inline-block"> <i class="fab fa-bandcamp fa-lg color_icono" title="Asignar Acciones" onclick="acciones_cargo(\''+full["per_codigo"]+'\');"></i></div> -->&nbsp;&nbsp;<div class="d-inline-block"> <i class="fas fa-briefcase fa-lg color_icono" style="display:<?php echo $visibilidad; ?>;" title="Vinculación" onclick="prcso_vinculacion(\''+full["per_codigo"]+'\');"></i></div>';
                    }
                }
            ],
            //dom:            "Bfrtip",
            scrollY:        "600px",
            //scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 2
            },
            "order": [[3, 'asc']],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "33%", "targets": 3 },
                { "width": "27%", "targets": 4 },
                { "width": "10%", "targets": 5 },              
            ],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function format(codigo_data) {
			var codigo_persona = codigo_data.per_codigo;
			var dataenviar = {
								"codigo_persona": codigo_persona
							}

			$.ajax({
				url:"infoprsona",
				type:"POST",
				data:dataenviar, 
				async:true,

				success: function(message){
					$("#infoPersona"+codigo_persona).empty().append(message);
				}
			});

			return '<div id="infoPersona'+codigo_persona+'"></div>';
		}

        // Add event listener for opening and closing details
        $('#dataPersona tbody').on('click', 'td.details-control', function(){
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
            url:"frmpersona",
            type:"POST",
            data:"codigo_sectroAdmin=1",
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
	}
    function editar(codigo_persona){
        var codigo_persona=codigo_persona;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"frmpersona",
            type:"POST",
            data:"codigo_persona="+codigo_persona,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function perfiles(codigo_persona){
        var codigo_persona=codigo_persona;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"perfilpersona",
            type:"POST",
            data:"codigo_persona="+codigo_persona,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function acciones_cargo(codigo_persona){
        var codigo_persona=codigo_persona;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formularioaccionescargo",
            type:"POST",
            data:"codigo_persona="+codigo_persona,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function prcso_vinculacion(codigo_persona){
        var codigo_persona = codigo_persona;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formvinculacion",
            type:"POST",
            data:"codigo_persona="+codigo_persona,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    


</script>
<!-- *********************     Fin DataTable     *************************************** *-->