<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dtaFuentesFinanciacion" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dtaFuentesFinanciacion').DataTable({
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
                url: 'jfuentesfinanciacion',
                type: 'POST'
            },
            columns: [
                { data: 'ffi_codigolinix', title: 'Codigo Linix'},	
                { data: 'ffi_referencialinix', title: 'Refenencia Linix'},	
                { data: 'ffi_nombre', title: 'Nombre'},	
                { data: 'ffi_descripcion', title: 'Descripción'},
                { data: 'nombre_tipo_fuente', title: 'Grupo'},
                { data: 'nombre_clasificacion', title: 'Clasificación Presupuesto'},
                { data: 'nombre_clsfcccion_plncion', title: 'Clasificación Planeación'},
                { data: 'estado', title: 'Estado'},	
                {
                    data: null, 
                    render: function (data, type, full, meta){
                        return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Fuente de Financiación" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["ffi_codigo"]+'\');"></i></div>';
                    }
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
              { "width": "5%", "targets": 0 },
              { "width": "8%", "targets": 1 },
              { "width": "14%", "targets": 2 },
              { "width": "20%", "targets": 3 },
              { "width": "16%", "targets": 4 },
              { "width": "14%", "targets": 5 },
              { "width": "12%", "targets": 6 },
              { "width": "7%", "targets": 7 },
              { "width": "4%", "targets": 8 },
            ],
        });

        
        $('#table-filter-vigencia').on('change', function(){
            var valorselectvgncia=$("#table-filter-vigencia").val();
            filterColumn_vigencia();
        });	

        function filterColumn_vigencia() {
            $('#dtaFuentesFinanciacion').DataTable().column(3).search($('#table-filter-vigencia').val()).draw();
        }

    
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        // Add event listener for opening and closing details
        $('#dtaFuentesFinanciacion tbody').on('click', 'td.details-control', function(){
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
            url:"formfuentesfinanciacion",
            type:"POST",
            data:"data",
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar(codigo_fuente_financiacion){
        var codigo_fuente_financiacion = codigo_fuente_financiacion;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formfuentesfinanciacion",
            type:"POST",
            data:"codigo_fuente_financiacion="+codigo_fuente_financiacion,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }


</script>
<!-- *********************     Fin DataTable     *************************************** *-->