<?php 
    $visibilidad=$_SESSION['visibilidadBotones'];  
?>
<!-- **********************          Inicio Modal Forma    *********************************** -->
<div class="modal fade" tabindex="-1" id="frmModal" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            Cargando...
        </div>
    </div>
</div>
<!-- **********************          Fin Modal Forma       *********************************** -->

<div class="row">
    <div class="col-md-12">
        &nbsp;<span class="d-inline-block" tabindex="0"  title="Reporte POAI"><button type="button" style="display: <?php echo $visibilidad; ?>" class="btn btn-danger btn-sm" onclick="rprte_rp();"><i class="fas fa-file-excel"></i>&nbsp;&nbsp;<strong>REPORTE RP</strong></button></span>
    </div>
</div>

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="tableRpRegistro" class="table table-striped table-bordered table-sm">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#tableRpRegistro').DataTable({
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
                url: 'jrp',
                type: 'POST'
            },
            columns: [
                { data: 'fecha_expedicion', title: 'FECHA EXPEDICIÓN'},
                { data: 'numero_expedicion', title: '# EXPEDICIÓN'},
                { data: 'descripcion_accion', title: 'NIVEL TRES'},
                { data: 'valor_cdp', title: 'VALOR'},
                { data: 'nombre_fuente', title: 'FUENTES'},
                {
                    data: null, 
                    render: function (data, type, full, meta){
                        if(full['existe_rp'] == 1){
                            if(full['ver_editar'] == 1){
                                return '<div class="d-inline-block"><i class="fas fa-file-signature fa-lg color_icono" title="Modificar RP" style="display:<?php echo $visibilidad; ?>;" onclick="modificar_rp(\''+full["codigo_cdp"]+'\', \''+full["codigo_rp"]+'\');"></i></div> &nbsp;&nbsp; ';
                            }
                            else{
                                return '';
                            }
                        }
                        else{
                            return '<div class="d-inline-block"><i class="fas fa-file-invoice fa-lg color_icono" title="Registrar RP" style="display:<?php echo $visibilidad; ?>;" onclick="registro_rp(\''+full["codigo_cdp"]+'\');"></i></div> &nbsp;&nbsp; ';
                        }
                    }
                },
                /*{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},*/


            ],
            scrollY:        "600px",
            scrollX:        false,
            scrollCollapse: true,
            paging:         false,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 2
            },
            "order": [[0, 'desc']],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "8%", "targets": 1 },
                { "width": "38%", "targets": 2 },
                { "width": "18%", "targets": 3 },
                { "width": "22%", "targets": 4 },
                { "width": "3%", "targets": 5 },
                //{ "width": "1%", "targets": 6 },
            ],
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        /* Formatting function for row details - modify as you need */
        function format(codigo_data) {
            var codigo_cdp=codigo_data.codigo_solicitud;
            
            var dataenviar = { 
                                "codigo_cdp" : codigo_data.codigo_solicitud, 
                            }	
                            
            $.ajax({
                url:"infosolicitudcdp",
                type:"POST",
                data:dataenviar, 
                async:true,

                success: function(message){
                    $("#indoSolicitudCDP"+codigo_cdp).empty().append(message);
                }
            });
            return '<div id="indoSolicitudCDP'+codigo_cdp+'"></div>';
        }

        // Add event listener for opening and closing details
        $('#tableRpRegistro tbody').on('click', 'td.details-control', function(){
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

    function registro_rp(codigo_cdp){
        var codigo_cdp = codigo_cdp;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formrp",
            type:"POST",
            data:"codigo_cdp="+codigo_cdp,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


    function modificar_rp(codigo_cdp, codigo_rp){
        var codigo_cdp = codigo_cdp;
        var codigo_rp = codigo_rp;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formrp",
            type:"POST",
            data:"codigo_cdp="+codigo_cdp+'&codigo_rp='+codigo_rp,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function rprte_rp(){
		$('#frmModal').modal({
			keyboard: true
		});

		$.ajax({
			url:"formreporterp",
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

