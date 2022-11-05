<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="tableClasificacionPlaneacion" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#tableClasificacionPlaneacion').DataTable({
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
                url: 'jclasificacionplaneacion',
                type: 'POST'
            },
            columns: [
                { data: 'cpl_nombre', title: 'Nombre'},	
                { data: 'cpl_descripcion', title: 'Descripción'},
                { data: 'estado', title: 'Estado'},	
                {
                    data: null, 
                    render: function (data, type, full, meta){
                        return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Clasificación Fuente de Financiación" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["cpl_codigo"]+'\');"></i></div>';
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
            "order": [[0, 'asc']],
            "columnDefs": [
                { "width": "30%", "targets": 0 },
                { "width": "55%", "targets": 1 },
                { "width": "9%", "targets": 2 },
                { "width": "6%", "targets": 3 },
            ],
        });

        
        $('#table-filter-vigencia').on('change', function(){
            var valorselectvgncia=$("#table-filter-vigencia").val();
            filterColumn_vigencia();
        });	

        function filterColumn_vigencia() {
            $('#tableClasificacionPlaneacion').DataTable().column(3).search($('#table-filter-vigencia').val()).draw();
        }

    
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        // Add event listener for opening and closing details
        $('#tableClasificacionPlaneacion tbody').on('click', 'td.details-control', function(){
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
            url:"formclasificacionplaneacion",
            type:"POST",
            data:"data",
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar(codigo_clasificacion_planeacion){
        var codigo_clasificacion_planeacion = codigo_clasificacion_planeacion;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formclasificacionplaneacion",
            type:"POST",
            data:"codigo_clasificacion_planeacion="+codigo_clasificacion_planeacion,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


</script>
<!-- *********************     Fin DataTable     *************************************** *-->