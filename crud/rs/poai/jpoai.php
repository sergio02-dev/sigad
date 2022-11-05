<?php
    include('prcsos/poai/rsPoai.php');

    $objPoai = new RsPOAI();

    $rs_poai = $objPoai->datListaPoai($codigo_plan);
?>