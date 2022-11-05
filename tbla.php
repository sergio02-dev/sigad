<html>
    <head>
    </head>
    <body>
        <input type="button" onclick="tableToExcel('tabla', 'W3C Example Table')" value="Export to Excel">
        <table id="tabla" border="1"  cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th rowspan="2">Proyectos</th>
                    <th rowspan="2" >Accion</th>
                    <th rowspan="2">Linea de <br> Base</th>
                    <th rowspan="2">Meta de <br> Resultado</th>
                    <th colspan="2" >2018</th>
                    <th colspan="7">EVALUACIÓN PDI</th>
                </tr>
                <tr>
                    <th>META</th>
                    <th>RECURSOS</th>
                    <th>ACTIVIDADES</th>
                    <th>$ ASIGNADO</th>
                    <th>$ EJECUTADO</th>
                    <th>META LOGRADA</th>
                    <th>EFICACIA</th>
                    <th>EFICIENCIA</th>
                    <th>EFECTIVIDAD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="5">Identidad con la teleología institucional (SF-PY.1)</td>
                    <td rowspan="5">Actividades de Inducción y Reinducción con estudiantes, profesores y administrativos.</td>
                    <td rowspan="5">120</td>
                    <td rowspan="5">200</td>
                    <td rowspan="5">30%</td>
                    <td rowspan="5">$1'052.203</td>
                    <td>Actividades del proyecto</td>
                    <td>234.000</td>
                    <td>125.990</td>
                    <td>70.3</td>
                    <td>12</td>
                    <td rowspan="5"></td>
                    <td rowspan="5"></td>
                </tr>
                <tr>
                    <td>Actividades del proyecto</td>
                    <td>234.000</td>
                    <td>125.990</td>
                    <td>70.3</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Actividades del proyecto</td>
                    <td>234.000</td>
                    <td>125.990</td>
                    <td>70.3</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Actividades del proyecto</td>
                    <td>234.000</td>
                    <td>125.990</td>
                    <td>70.3</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Actividades del proyecto</td>
                    <td>234.000</td>
                    <td>125.990</td>
                    <td>70.3</td>
                    <td>12</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">DOCENTES, ESTUDIANTES Y ADMINISTRATIVOS</td>
                    <td></td>
                    <td></td>
                    <td>TOTALES $ Y ACUMULADOS METAS LOGRADAS</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>
                <tr>
                    <td colspan="4">ACUMULADOS</td>
                    <td></td>
                    <td></td>
                    <td>COMPARACIÓN CON LO PROYECTADO</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        
        </table>
        <br>
        <table border="1">
        <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        </tr>
         <tr>
             <td rowspan="6">proyecto</td>
              <td rowspan="2">Accion 1</td> 
            <td>Actividad 1</td>
         </tr>
          <tr>
             <td>Actividad 2</td>
         </tr>
          <tr>
             <td rowspan="4">Accion 2</td>
              <td>Actividad 3</td> 
         </tr>
         <tr>
             <td>Actividad 4</td>
         </tr>
         <tr>
             <td>Actividad 5</td>
         </tr>
         <tr>
             <td>Actividad 6</td>
         </tr>
         
        <!-- <tr>
            <td>Accion 1</td>
            <td>Accion 2</td>
            <td>Accion 3</td>
            <td>Accion 4</td>
            <td>Accion 5</td>
            <td>Accion 6</td>
            <td>Accion 7</td>
            <td>Accion 8</td>
            <td>Accion 9</td>
            <td>Accion 10</td>
         </tr>-->
        </table>
    </body>
    <script>
    
        var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
        })()
    </script>
<html>