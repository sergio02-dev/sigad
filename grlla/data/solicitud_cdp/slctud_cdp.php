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

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="tableCDP" class="table table-striped table-bordered table-sm">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#tableCDP').DataTable({
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
                url: 'jsolicitudcdp',
                type: 'POST'
            },
            columns: [
                { data: 'scdp_fecha', title: 'FECHA'},
                { data: 'scdp_numero', title: '# SOLICITUD'},
                { data: 'descripcion_accion', title: 'NIVEL TRES'},
                { data: 'valor_cdp', title: 'VALOR'},
                { data: 'nombre_fuente', title: 'FUENTES'},
                
                    {
                    data: null, 
                    render: function (data, type, full, meta){
                        if(full["scdp_proceso"] == 2){
                            return '<div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Solicitud" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["scdp_codigo"]+'\');"></i></div> &nbsp;&nbsp; <div class="d-inline-block"><i class="fas fa-lg fa-file-excel" title="Reporte cdp" style="display:<?php echo $visibilidad; ?>; color:#B92109;" onclick="rprte_cdp(\''+full["scdp_codigo"]+'\');"></i></div>';

                        }
                        else{
                            return '<div class="d-inline-block"><i class="fas fa-pencil-alt fa-lg color_icono" title="Editar Solicitud" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["scdp_codigo"]+'\');"></i></div> &nbsp;&nbsp;<div class="d-inline-block"><i class="fas fa-lg fa-file-excel" title="Reporte cdp" style="display:<?php echo $visibilidad; ?>; color:#B92109;" onclick="rprte_cdp(\''+full["scdp_codigo"]+'\');"></i></div>';
                        }
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
                { "width": "1%", "targets": 6 },
            ],
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        /* Formatting function for row details - modify as you need */
        function format(codigo_data) {
            var codigo_cdp=codigo_data.scdp_codigo;
            
            var dataenviar = { 
                                "codigo_cdp" : codigo_data.scdp_codigo, 
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
        $('#tableCDP tbody').on('click', 'td.details-control', function(){
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
            url:"formsolicitudcdp",
            type:"POST",
            data:"data",
            async:true,
            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar(codigo_solicitud){
        var codigo_solicitud = codigo_solicitud;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"modsolicitudcdp",
            type:"POST",
            data:"codigo_solicitud="+codigo_solicitud,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function cdp_expedido(codigo_cdp){
        var codigo_cdp = codigo_cdp;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formcdpexpedido",
            type:"POST",
            data:"codigo_cdp="+codigo_cdp,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    
	function rprte_cdp(codigo_cdp){
        var codigo_cdp = codigo_cdp
        window.location.href = 'reportecdp?codigo_cdp='+codigo_cdp;
    }

</script>
<!-- *********************     Fin DataTable     *************************************** *-->

