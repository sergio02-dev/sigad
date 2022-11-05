<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataAperturaReporte" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataAperturaReporte').DataTable({
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
                url: 'japerturareporte',
                type: 'POST'
            },
            columns: [
               
                { data: 'apr_fechainicio', title: 'Fecha Inicio'},
                { data: 'apr_fechafin', title: 'Fecha Fin'},
                { data: 'apr_trimestres', title: 'Trimestre'},
                {
                    data: null,
                    render: function (data, type, full, meta){
                        return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Apertura Reporte" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["apr_codigo"]+'\');"></i> </div>';
                    }
                },


            ],
            //dom:            "Bfrtip",
            scrollY:        "600px",
           // scrollX:        true,
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

            // Add event listener for opening and closing details
            $('#dataAperturaReporte tbody').on('click', 'td.details-control', function(){
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
        var valor=1;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
                url:"formaperturareporte",
                type:"POST",
                data:"valor="+valor,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
    }
    function editar(codigo_apertura){
        var codigo_apertura=codigo_apertura;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
                url:"formaperturareporte",
                type:"POST",
                data:"codigo_apertura="+codigo_apertura,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
    }

</script>
<!-- *********************     Fin DataTable     *************************************** *-->