<?php
   
   //include('grid/json/prsna.php');

 

?>
<!-- <div class="title cl"><h2><?php echo $nombre_sistema; ?> </h2></div> -->

<article class="col-12 area">
    <h3 class="col-12 nopaddingAncho">Personas</h3>

    <div class="col-12">
        <button id="botonagregar" onclick="agregar();"><img src="img/iconos/mas.png" alt="Crear Persona" title="Crear Persona"></button>
        <button><img src="img/iconos/lupa.png"></button>
    </div>
   
   <table id="example"></table>

</article>

<script src="DataTables/datatables.min.js"></script>


<script>


    $('#example').DataTable({
        "processing": true,
        ajax: {
            url: 'jpersona',
            type: 'POST'
        },
        columns: [
            { data: 'per_identificacion', title: 'Nombre'},
            { data: 'per_nombre', title: 'Nombre'},
            { data: 'per_primerapellido', title: 'Primer Apellido'},
            { data: 'per_segundoapellido', title: 'Segundo Apellido'},
            { render: function () { return '<button id="botonagregar" onclick="agregar();"><img src="img/iconos/mas.png" alt="Crear Persona" title="Crear Persona"></button>';}},
            
        ]
    });

    function agregar(){
        armarModal($(this).attr("id"),4,true,"","frmpersona","variable=valor enviado");
    }

</script>