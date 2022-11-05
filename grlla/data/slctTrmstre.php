<?php
$year=$_REQUEST['year'];
?>
<input type="hidden" id="year" value=<?php echo $year; ?>>
<div class="row">
    <div class="row">
        <div class="col-sm-12">
            <label for="lblTrimestre">Trimestre</label>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="trimestre" id="inlineCheckbox1" value="1">
                <label class="form-check-label" for="inlineCheckbox1">1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="trimestre" id="inlineCheckbox2" value="2">
                <label class="form-check-label" for="inlineCheckbox2">2</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="trimestre" id="inlineCheckbox3" value="3">
                <label class="form-check-label" for="inlineCheckbox3">3</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="trimestre" id="inlineCheckbox3" value="4">
                <label class="form-check-label" for="inlineCheckbox3">4</label>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <input type="button" class="image" value="Generar Excel" onclick="excel()" style="background-image:'ulr(img/16x16/grafico.png)'">
        </div>
    </div>

    <div class="col-sm-4 excel">
    
    </div>
</div>
<input type="hidden" id="trimestresArray" value="">
<input type="hidden" id="trimestresArrayAnio" value="">
<script type="text/javascript">
    function excel(){
        var tipo_grafica=$('input:radio[name=tipo_grafica]:checked').val();
       // alert(tipo_grafica);
        var year=$('#year').val();
        //Se crean los array para almacenar los trimestres
        var trimestre= new Array();
        var anioTrimestre= new Array();
        
        //Agregamos los valores de los checkbox chequeados a los arrays
        $("input:checkbox:checked").each(function(){
            trimestre.push($(this).val());
        });
         cantidad=trimestre.length
        for (var i = 0; i < cantidad ; i++) {
            //alert(trimestre[i]);
            anioTrimestre[i]=year+trimestre[i];
        }

        $('#trimestresArray').val(trimestre);
        $('#trimestresArrayAnio').val(anioTrimestre);


        if(trimestre){
            $.ajax({
                url:"xcel",
                type:"POST",
                data:"year="+year+'&trimestre='+trimestre+'&anioTrimestre='+anioTrimestre,
                async:true,

                success: function(message){
                //$(".modal-body").empty().append(message);
                $(".excel").empty().append(message);
                }
            });
        }
    }
</script>


        <!--<div class="form-group">
            <label for="selAnio" class="font-weight-bold">Trimestre</label>
            <select name="selTrimestre" id="selTrimestre" class="form-control" data-rule-required="true" required>
            <?php
                for ($trimestre = 1; $trimestre <= 4; $trimestre++) {
                    
                    echo "<option value=".$trimestre." data-trim=".$trimestre."> ".$trimestre."</option>";
                }
                ?>
            </select>
        </div>-->