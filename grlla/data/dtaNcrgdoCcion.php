<?php 
$codigo_plandesarrollo=$_REQUEST['codigo_plandesarrollo'];
//echo "--> ".$codigo_plandesarrollo;
?>

<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataAccionesPlan" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataAccionesPlan').DataTable({
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
                url: 'jaccionplan?<?php echo $codigo_plandesarrollo;?>',
                type: 'POST'
            },
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { data: 'referenciaAccion', title: 'Codigo Acción'},
                { data: 'acc_descripcion', title: 'Descripción'},
                {
                    data: null, //'act_codigo',
                    render: function (data, type, full, meta){
                        return '<span class="d-inline-block" tabindex="0"  title="Encargados"><button type="button" style="display:<?php echo $visibilidad; ?>;" class="btn btn-danger btn-sm" onclick="encargado_Accion(\''+full["acc_codigo"]+'\');"><i class="fal fa-user-shield"></i></button></span>';
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
            "order": [[1, 'asc']],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function format(codigo_data){
            // `d` is the original data object for the row

            //alert('entro');
            
            var codigo_accion=codigo_data.acc_codigo;
            var dataenviar = { 
                            "codigo_accion" : codigo_data.acc_codigo,  
                            }			

            $.ajax({
                url:"infoencargado",
                type:"POST",
                data:dataenviar, //"codigo_actividad="+codigo_actividad,
                async:true,

                success: function(message){
                    $("#rgsrtoEncargadoAccion"+codigo_accion).empty().append(message);
                }
            });

            return '<div id="rgsrtoEncargadoAccion'+codigo_accion+'"></div>';
        }
        

            // Add event listener for opening and closing details
            $('#dataAccionesPlan tbody').on('click', 'td.details-control', function(){
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

    function encargado_Accion(codigo_accion){
        var codigo_accion=codigo_accion;
       // alert(codigo_accion);

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
                url:"formencargadoaccion",
                type:"POST",
                data:"codigo_accion="+codigo_accion,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
    }


</script>
<!-- *********************     Fin DataTable     *************************************** *-->