<?php 
    include('crud/rs/actoAdministrativo.php');
    
    $visibilidad=$_SESSION['visibilidadBotones']; 

    $vigencia_actos = $objActoAdmin->vigencia_actos();
    
?>
<style>
    div#tipoAcuerdo {
        position: absolute;
        margin-top: 4px;
        margin-left: 68%;
        height: 24px;
        z-index: 1000;
    }
</style>
<div id='selectvigencia'>
    <label>Vigencia</label>
    <select id="table-filter-vigencia">
        <option value="">Todos</option>
        <?php 
            if($vigencia_actos){
                foreach ($vigencia_actos as $dta_vgncia_actos) {
                    $add_vigencia = $dta_vgncia_actos['add_vigencia'];
        ?>
        <option value="<?php echo $add_vigencia; ?>"><?php echo $add_vigencia; ?></option>
        <?php
                }
            }
        ?>
    </select>
</div>
<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataActoAdministrativo" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataActoAdministrativo').DataTable({
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
                url: 'jactoadministrativo',
                type: 'POST'
            },
            columns: [
                { data: 'add_nombre', title: 'Nombre'},
                { data: 'add_descripcion', title: 'Descripción'},
                { data: 'add_vigencia', title: 'Vigencia'},	
                { data: 'tac_nombre', title: 'Tipo de Acto'},	
                {
                    data: null, 
                    render: function (data, type, full, meta){
                        if(full["add_urlactoadmin"]){
                            return '<div class="d-inline-block"><a style="color:#FFFFFF;" target="_blank" href="'+full["add_urlactoadmin"]+'" title="Acuerdo"><i class="fas fa-file-pdf fa-lg color_icono"></i></a></div>&nbsp;&nbsp;<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Acuerdo" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["aad_codigo"]+'\');"></i></div>';
                        }
                        else{
                            return '<div class="d-inline-block"><i class="fas fa-edit fa-lg color_icono" title="Editar Acuerdo" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["aad_codigo"]+'\');"></i></div>';
                        }
                        
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
              { "width": "30%", "targets": 0 },
              { "width": "40%", "targets": 1 },
              { "width": "10%", "targets": 2 },
              { "width": "10%", "targets": 3 },
              { "width": "10%", "targets": 4 },
            ],
        });

        $('#table-filter-tipo').on('change', function(){
            var valorselectsbs=$("#table-filter-tipo").val();
            filterColumn_tipo();
        });	

        function filterColumn_tipo() {
            $('#dataActoAdministrativo').DataTable().column(2).search($('#table-filter-tipo').val()).draw();
        }

        $('#table-filter-vigencia').on('change', function(){
            var valorselectvgncia=$("#table-filter-vigencia").val();
            filterColumn_vigencia();
        });	

        function filterColumn_vigencia() {
            $('#dataActoAdministrativo').DataTable().column(2).search($('#table-filter-vigencia').val()).draw();
        }


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

            // Add event listener for opening and closing details
            $('#dataActoAdministrativo tbody').on('click', 'td.details-control', function(){
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
                url:"formactoadministrativo",
                type:"POST",
                data:"valor="+valor,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
    }
    function editar(codigo_actoAdministrativo){
        var codigo_actoAdministrativo=codigo_actoAdministrativo;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
                url:"formactoadministrativo",
                type:"POST",
                data:"codigo_actoAdministrativo="+codigo_actoAdministrativo,
                async:true,

                success: function(message){
                    $(".modal-content").empty().append(message);
                }
            });
    }



</script>
<!-- *********************     Fin DataTable     *************************************** *-->