<?php $visibilidad=$_SESSION['visibilidadBotones']; ?>
<!-- **********************     Inicio Tabla Datatable     *********************************** -->
<table id="dataPlanDesarrollo" class="table table-striped table-bordered">

</table>

<script>
    $(document).ready(function() {
        var table =	$('#dataPlanDesarrollo').DataTable({
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
                url: 'jplandesarrollo',
                type: 'POST'
            },
            columns: [
                { data: 'pde_nombre', title: 'Nombre'},
                { data: 'pde_yearinicio', title: 'Inicio'},
                { data: 'pde_yearfin', title: 'Fin'},
                {
                    data: null,
                    title: 'PPI',
                    render: function (data, type, full, meta){
                        if(full["codigo_ppii"] == 0){
                            return '';
                        }
                        else{
                            return '<div class="d-inline-block"> <a href="ppi?'+full["pde_codigo"]+'-'+full["codigo_ppii"]+'" title="PPI"><i class="fas fa-file-invoice-dollar fa-lg color_icono"></i></a> </div>';
                        }
                    },
                },
                { data: 'add_nombre', title: 'Acuerdo de Consejo Superior'},
                { data: 'pde_niveluno', title: 'Nivel  Uno'},
                {
                    data: null,
                    render: function (data, type, full, meta){
                        if(full["estado_ppi"] == 1){
                            return '<div class="d-inline-block"> <i class="fas fa-plus fa-lg color_icono" title="Agregar '+full["pde_niveluno"]+'" style="display:<?php echo $visibilidad; ?>;" onclick="aggNivelUno(\''+full["pde_codigo"]+'\',\''+full["pde_actoadmin"]+'\',\''+full["pde_referencianiveluno"]+'\');" ></i> </div> &nbsp;&nbsp; <div class="d-inline-block"> <a href="niveluno?'+full["pde_codigo"]+'" title="Ver más"><i class="far fa-eye fa-lg color_icono"></i></a></div>';
                        }
                        else{
                            return '';
                        }
                    },


                },
                { data: 'pde_niveldos', title: 'Nivel  Dos'},
                {
                    data: null,
                    render: function (data, type, full, meta){
                        if(full["estado_ppi"] == 1){
                            return '<div class="d-inline-block"> <i class="fas fa-plus fa-lg color_icono" title="Agregar '+full["pde_niveldos"]+'" style="display:<?php echo $visibilidad; ?>;" onclick="aggNivelDos(\''+full["pde_codigo"]+'\',\''+full["pde_actoadmin"]+'\',\''+full["pde_niveluno"]+'\',\''+full["pde_referencianiveldos"]+'\');"></i> </div> &nbsp;&nbsp; <div class="d-inline-block"> <a href="nivelDos?'+full["pde_codigo"]+'" title="Ver más" ><i class="far fa-eye fa-lg color_icono"></i></a> </div> ';
                        }
                        else{
                            return '';
                        }
                    },
                },
                { data: 'pde_niveltres', title: 'Nivel  Tres'},
                {
                    data: null,
                    render: function (data, type, full, meta){
                        if(full["estado_ppi"] == 1){
                            return '<div class="d-inline-block"> <i class="fas fa-plus fa-lg color_icono" title="Agregar '+full["pde_niveltres"]+'" style="display:<?php echo $visibilidad; ?>;" onclick="aggNivelTres(\''+full["pde_codigo"]+'\',\''+full["pde_actoadmin"]+'\',\''+full["pde_niveluno"]+'\' ,\''+full["pde_niveldos"]+'\');"></i> </div> &nbsp;&nbsp; <div class="d-inline-block"> <a href="niveltres?'+full["pde_codigo"]+'" title="Ver más"><i class="far fa-eye fa-lg color_icono"></i></a> </div>';
                        }
                        else{
                            return '';
                        }
                    },
                },
                {
                    data: null, /*'act_codigo'*/
                    title: 'Plan Indicativo',
                    render: function (data, type, full, meta){
                        if(full["estado_ppi"] == 1){
                            if(full["cantidadsusbistemas"]==0){
                                return '<div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" title="Editar PDI" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["pde_codigo"]+'\');"></i></div> &nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-file-excel fa-lg color_icono" title="Reporte PDI" onclick="rprte(\''+full["pde_codigo"]+'\');"></i> </div>';
                            }
                            else{
                                return '<div class="d-inline-block"> <i class="fas fa-file-excel fa-lg color_icono" title="Reporte PDI" onclick="rprte(\''+full["pde_codigo"]+'\');"></i> </div> &nbsp;&nbsp; <div class="d-inline-block"> <i class="fas fa-undo fa-lg color_icono" style="display: '+full["actualizar_plan"]+';" title="Actualizar PDI" onclick="actualizar_plan(\''+full["pde_codigo"]+'\');"></i> </div><!--<div class="d-inline-block"> <i class="fas fa-file-excel fa-lg color_icono" onclick="generarExcel(\''+full["pde_codigo"]+'\');"></i> </div> -->';
                            }
                        }
                        else{
                            return '<div class="d-inline-block"> <i class="fas fa-edit fa-lg color_icono" title="Editar PDI" style="display:<?php echo $visibilidad; ?>;" onclick="editar(\''+full["pde_codigo"]+'\');"></i></div> ';
                        }
                    }
                },


            ],
            scrollY:        "620px",
            scrollCollapse: true,
            paging:         false,
            buttons:        [ 'colvis' ],
            fixedColumns:   {
                leftColumns: 2
            },
            "order": [[1, 'asc']],
            "columnDefs": [
              { "width": "9%", "targets": 0 },
              { "width": "4%", "targets": 1 },
              { "width": "4%", "targets": 2 },
              { "width": "3%", "targets": 3 },
              { "width": "17%", "targets": 4 },
              { "width": "10%", "targets": 5 },
              { "width": "10%", "targets": 6 },
              { "width": "10%", "targets": 7 },
              { "width": "10%", "targets": 8 },
              { "width": "10%", "targets": 9 },
              { "width": "10%", "targets": 10 },
              { "width": "3%", "targets": 11 },
            ],
        });


        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        // Add event listener for opening and closing details
        $('#dataPlanDesarrollo tbody').on('click', 'td.details-control', function(){
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

    function format(codigo_data) {

        var plan=codigo_data.pde_codigo;
        var dataenviar = {
                        "pde_codigo" : codigo_data.pde_codigo,
                        }

        $.ajax({
            url:"informacionniveles",
            type:"POST",
            data:dataenviar, //"codigo_actividad="+codigo_actividad,
            async:true,

            success: function(message){
                $("#infoPlan"+plan).empty().append(message);
            }
        });

        return '<div id="infoPlan'+plan+'"></div>';
    }

    function agregar(){
        var valor=1;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formplandesarrollo",
            type:"POST",
            data:"valor="+valor,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }
    

    function actualizar_plan(codigo_plandesarrollo){
        var codigo_plandesarrollo=codigo_plandesarrollo;

        $('#frmModal').modal({
            keyboard: true
        });

        $.ajax({
            url:"formactualizarplandesarrollo",
            type:"POST",
            data:"codigo_plandesarrollo="+codigo_plandesarrollo,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function editar(codigo_plandesarrollo){
        var codigo_plandesarrollo=codigo_plandesarrollo;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formplandesarrollo",
            type:"POST",
            data:"codigo_planDesarrollo="+codigo_plandesarrollo,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function rprte(codigo_plandesarrollo){
        var codigo_plandesarrollo=codigo_plandesarrollo;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formreportepdi",
            type:"POST",
            data:"codigo_planDesarrollo="+codigo_plandesarrollo,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function aggNivelUno(codigo_plandesarrollo, actoAdministrativo, referencia_nivelUno){
        var codigo_plandesarrollo=codigo_plandesarrollo;
        var actoAdministrativo=actoAdministrativo;
        var referencia_nivelUno=referencia_nivelUno;
        //alert(referencia_nivelUno);

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formniveluno",
            type:"POST",
            data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&referencia_nivelUno='+referencia_nivelUno,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function aggNivelDos(codigo_plandesarrollo, actoAdministrativo, nombre_niveluno, referencia_nivelDos){
        var codigo_plandesarrollo=codigo_plandesarrollo;
        var actoAdministrativo=actoAdministrativo;
        var nombre_niveluno=nombre_niveluno;
        var referencia_nivelDos=referencia_nivelDos;

        $('#frmModal').modal({
                keyboard: true
        });
        $.ajax({
            url:"formniveldos",
            type:"POST",
            data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&nombre_niveluno='+nombre_niveluno+'&referencia_nivelDos='+referencia_nivelDos,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function aggNivelTres(codigo_plandesarrollo, actoAdministrativo, nombre_niveluno, nombre_niveldos){
        var codigo_plandesarrollo=codigo_plandesarrollo;
        var actoAdministrativo=actoAdministrativo;
        var nombre_niveluno=nombre_niveluno;
        var nombre_niveldos=nombre_niveldos;

        $('#frmModal').modal({
            keyboard: true
        });
        $.ajax({
            url:"formniveltres",
            type:"POST",
            data:"codigo_planDesarrollo="+codigo_plandesarrollo+'&actoAdministrativo='+actoAdministrativo+'&nombre_niveluno='+nombre_niveluno+'&nombre_niveldos='+nombre_niveldos,
            async:true,

            success: function(message){
                $(".modal-content").empty().append(message);
            }
        });
    }

    function generarExcel(codigo_plandesarrollo){
        var codigo_plandesarrollo = codigo_plandesarrollo;
        //alert(codigo_plandesarrollo);

        if(codigo_plandesarrollo == 1){
            window.location.href = 'reporteplandesarrolloantiguo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        else{
            window.location.href = 'excelplandesarrollo?codigo_plandesarrollo='+codigo_plandesarrollo;
        }
        
    }


</script>
<!-- *********************     Fin DataTable     *************************************** *-->
