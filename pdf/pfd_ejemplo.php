<?php

use Mpdf\Mpdf;
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'Letter',
    'orientation' => 'P',
    'default_font' => 'centurygothic'
]);

$mpdf->defaultfooterfontstyle='calibri';
$mpdf->SetHTMLHeader('
<div style="text-align: center; font-weight: bold;">
    <img src="img/logo/logodocument.png"/>
</div>');



$mpdf->SetHTMLFooter('
    <div style="width:100%; background: url(img/logo/pieoffice.png); background-position: center; background-image-resize: 6; "> 
        <div style="text-align:center; margin-bottom:10px;">¡Soluciones jurídicas en línea!</div> 
    </div>
    <div style="text-align:left; margin-top:7px; margin-left:50px;"> </div>
    <div style="text-align:center; margin-top:-5px; font-family:calibri;">
    <a class="enlcespie" href="mailto:gerencia@lexlegal.com.co">gerencia@lexlegal.com.co</a> - 
    <a class="enlcespie" href="mailto:infoclientes@lexlegal.com.co">infoclientes@lexlegal.com.co</a> 
    </div>
    <div style="text-align:right; margin-top:-35px; margin-right:70px;">{PAGENO}</div>
    <div style="text-align:center; margin-top:15px; font-family:calibri;">Neiva - Huila</div>
');



$mpdf->AddPage('', // L - landscape, P - portrait  pieoffice.png
'', '', '', '',
0, // margin_left
0, // margin right
55, // margin top
32, // margin bottom
5, // margin header
7); // margin footer

$html="

<style>

    body{
        background: url(img/logo/fondowordoffice.png) ;
        background-repeat: no-repeat;
        background-position: center;
        background-image-resize: 1;
        background-image-opacity: 0.7;
    }

    .contenedor{
        margin-left: 3cm;
        margin-right: 3cm;
    }


    table, tr, td{
        border-style:hidden;
    }

    .titulocontrato{
        font-weight: bold;
        font-size:15px;
        text-align:center;
    }

    .titulocontrato-center{
        text-align:center;
    }

    .parrafocontrato{
        text-align:justify;
        font-size:14px;
        font-variant:normal;
        line-height: 1.3;
    }

    .border-table{
        border: 1px solid #000000;
        width:95%;
    }

    .border-table td{
        border: 1px solid #000000;
        padding: 5px 10px;
    }
    .tabla-firma{
        width:100%;
    }
    .alinear-l{
        text-align:left;
        width:50%;
    }
    .alinear-r{
        text-align:left;
        width:50%;
    }

    .enlcespie{
        font-family:calibritalic;
    }

</style>

<div class='contenedor'>

    <p class='titulocontrato' >CONTRATO DE PRESTACIÓN DE SERVICIOS DE ASESORÍA LEGAL Y REPRESENTACIÓN JURÍDICA PREPAGADA – PLAN BÁSICO <br/>Nro. PBPN__20__</p>


    <p class='parrafocontrato'>

        En Neiva (Huila), a los ________________días del mes de ______________________ del año ______, el representante legal de la empresa <strong>ASESORIA JURIDICA, 
        CONSULTORIA Y SERVICIOS INTEGRALES – LEXLEGAL S.A.S.,</strong> por una parte y quien en adelante se denominará <strong>LA EMPRESA</strong> y, por la otra parte, ___________________
        con C.C./C.E./P.E.P. No. _____________________ de ________________, quien para efectos del presente contrato se denominará <strong>EL AFILIADO</strong>; 
        han celebrado de mutuo acuerdo el siguiente contrato de prestación de servicios de asesoría legal prepagada bajo el plan de servicios básico, 
        el cual se regirá por las siguientes

    </p>

    <h4 class='titulocontrato-center' >CLÁUSULAS: </h4>

    <p class='parrafocontrato'>

        <strong>PRIMERA – OBJETO:</strong> El presente contrato tiene por objeto la prestación de servicios de asesoría legal prepagada bajo el plan de 
        servicios básico por parte de <strong>LA EMPRESA</strong> a través de los canales virtuales, digitales y online dispuestos para este fin a favor del 
        <strong>AFILIADO</strong> según lo establecido en el catálogo de servicios del referido plan. (anexo 1)

    </p>


    <p class='parrafocontrato'>

        <strong>PARÁGRAFO PRIMERO:</strong> Este contrato cubre únicamente los servicios del plan básico, seleccionado por el actuar libre y bajo la responsabilidad del <strong>AFILIADO</strong>. 
        Este plan de servicios hace parte integral del presenta contrato, por lo tanto, no podrá sobrepasar lo fijados en este.  En el evento que <strong>EL AFILIADO</strong> 
        requiera asesoría legal o representación jurídica adicional a la establecida en el plan podrá adquirir un nuevo plan de servicios o adicionar servicios según su conveniencia.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO SEGUNDO:</strong> Este plan no contempla la representación en ningún proceso judicial. No obstante, si se adiciona el 
        servicio este no incluye los procesos de mayor cuantía es decir superior a 150 SMMLV, ni procesos judiciales por asuntos de carácter penal.
        Estos procesos podrán ser tramitados con <strong>LA EMPRESA</strong> mediante la modalidad de honorarios fijos, cuota litis o mixto según la negociación e interés del <strong>AFILIADO</strong>. 
        No obstante, <strong>LA EMPRESA</strong> garantiza al <strong>AFILIADO</strong> un precio preferencial en estos procesos.

    </p>


    <p class='parrafocontrato'>

        <strong>SEGUNDA – LEY PARA LAS PARTES:</strong> El presente contrato es celebrado de conformidad con lo dispuesto en el artículo 1602 del Código Civil, 
        por consiguiente es Ley para las partes, no puede ser invalido o terminado si no por consentimiento mutuo o por las siguientes causas legales: 
        <strong>a)</strong> Por disposición de autoridad competente en cumplimento de un mandato legal; 
        <strong>b)</strong> Por las causales específicas que contempla el presente contrato o por cualquier otro tipo de controversia que de común acuerdo deba ser dirimido ante la jurisdicción civil; 
        <strong>c)</strong> Por caducidad de la acción o prescripción del derecho al considerarse que el contrato presta merito ejecutivo y para todos los efectos se asimila a un título cambiario, 
            cuyo término empezara a regir a partir de la aceptación de la solicitud de terminación del contrato; 
        <strong>d)</strong> Por mora en el pago de las cuotas superior a los 60 días. 

    </p>

    <p class='parrafocontrato'>

        <strong>TERCERA – VALOR: LA EMPRESA</strong> se compromete a prestar los servicios de asesoría legal bajo el plan de servicios básico a favor del <strong>AFILIADO</strong> 
        por costo variable conforme este realice el pago, ya sea mediante la tarifa mensual, trimestral, semestral o anual. 

        <table style='width: 100%;'>
            <tr class='border-table'><td>Valor tarifa mensual será de Sesenta Mil pesos M/Cte. ($60.000,00)</td></tr>
            <tr class='border-table'><td>Valor tarifa trimestral de Ciento Setenta Mil pesos M/Cte. ($170.000,00)</td></tr>
            <tr class='border-table'><td>Valor tarifa semestral de Trescientos Treinta Mil pesos M/Cte. ($330.000,00)</td></tr>
            <tr class='border-table'><td>Valor tarifa anual de Seiscientos Ochenta Mil pesos M/Cte. ($680.000,00)</td></tr>
        </table>    

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO PRIMERO:</strong> Los valores referidos incluyen IVA o cualquier otro impuesto sobre las ventas.  

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO SEGUNDO:</strong> En el evento de renovación o prórroga del contrato los valores se actualizarán conforme el incremento del IPC del año siguiente a la firma de este.

    </p>

    <p class='parrafocontrato'>

        <strong>CUARTA – PAGO, MODO Y OPORTUNIDAD:</strong> Los pagos deben realizarse dentro de los 5 días calendarios siguientes a la fecha de corte mensual, 
        trimestral, semestral o anual mediante consignación, transferencia, débito automático o pago PSE, según la elección y conveniencia del <strong>AFILIADO</strong>, 
        en la cuenta bancario de ahorros No. 45400000990 del Banco Bancolombia a nombre de <strong>LA EMPRESA</strong>.

    </p>
    <p class='parrafocontrato'>

        <strong>PARÁGRAFO ÚNICO:</strong>En el evento que <strong>EL AFILIADO</strong> realice sus pagos mediante transferencia o consignación está obligado a informar este a 
        <strong>LA EMPRESA</strong> mediante los canales que esta autorice. 

    </p>

    <p class='parrafocontrato'>

        <strong>QUINTA – PLATAFORMA WEB: EL AFILIADO</strong> accederá a los servicios a través de la plataforma web www.lexlegal.com.co, en donde se le asignará un usuario o 
        clave para su uso exclusivo con el que podrá ingresar en la zona “clientes” y solicitar el servicio requerido.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO ÚNICO: LA EMPRESA</strong> no se hace responsable por los motivos ajenos, fortuitos o irresistibles que imposibiliten la prestación del servicio. 

    </p>

    <p class='parrafocontrato'>

        <strong>SEXTA – TERRITORIO:</strong> Para la asesoría legal prepagada bajo el plan de servicios básicos, en cumplimiento de la cláusula primera, 
        <strong>LA EMPRESA</strong> prestara sus servicios en todo el Territorio Nacional a través de su plataforma web www.lexlegal.com.co.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO ÚNICO:</strong>En el exclusivo evento que se requiera actuaciones, tramites, gestiones o diligencias presenciales se le solicitara 
        al <strong>AFILIADO</strong> para que cancele viáticos o costos que las mismas acarren. Estos viáticos o costos se fijarán exclusivamente conforme a las tarifas del 
        mercado considerando que el domicilio de <strong>LA EMPRESA</strong> es la ciudad de Neiva (Huila).  

    </p>

    <p class='parrafocontrato'>

        <strong>SEPTIMA – VIGENCIA: LA EMPRESA</strong> se compromete a prestar la asesoría legal bajo el plan de servicios básicos, en concordancia con la cláusula primera, 
        siempre y cuando el contrato se encuentre vigente. La vigencia del contrato se sujeta al cumplimiento de las obligaciones mutuas.

    </p>

    <p class='parrafocontrato'>

        <strong>OCTAVA – MORA:</strong> En el evento que <strong>EL AFILIADO</strong> entre en mora en el pago de las cuotas superior a 30 días se suspenderán los 
        servicios bloqueando su acceso a la zona “clientes”. En tratándose de representación judicial por adición del servicio y en aras de prever 
        perjuicios al <strong>AFILIADO</strong> solo hasta el día 45 en mora el profesional en derecho renunciará ante el Despacho Judicial o Entidad Pública por el 
        no pago de honorarios. En el evento que el día 45 corresponda a un día que se corran términos perentorios o preclusivos la representación 
        continuara hasta la finalización del término.
    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO ÚNICO:</strong> La mora superior a 5 días calendarios causara intereses de mora a la tasa máxima que certifique la superintendencia financiera.     

    </p>

    <p class='parrafocontrato'>

        <strong>NOVENA – OBLIGACIONES: LA EMPRESA</strong> se obliga a prestar la asesoría legal prepagada bajo el plan de servicios básicos de forma oportuna y 
        en tiempo como obligación de medio, con profesionalismo y ética conforme a la Ley 1123 de 2007 (Código Disciplinario del Abogado) y 
        a las leyes No. 1952 de 2019 y 2094 de 2021, a través de su plataforma web www.lexlegal.com.co. <strong>EL AFILIADO</strong> se compromete a cancelar la tarifa en el 
        modo u oportunidad prevista en este contrato. También se obliga a: 
        <strong>a)</strong> Informar cualquier anomalía o deficiencia en la prestación de nuestros servicios; 
        <strong>b)</strong> Entregar la documentación e información requerida por <strong>LA EMPRESA</strong> para sus asesorías, consultas, trámites, diligencias y procesos judiciales; 
        <strong>c)</strong> Cancelar los costos que acarreen los trámites, gestiones, diligencias y procesos judiciales; 
        <strong>d)</strong> Cancelar los costos o viáticos que acarreen desplazamiento en las actuaciones, tramites, gestiones o diligencias presenciales; 
        <strong>e)</strong> Abstenerse de entregar documentación o información falsa, adulterada, apócrifa, obtenida ilegalmente o inocua para la prestación de los servicios; 
        <strong>f)</strong> Abstenerse de solicitar servicios en la cuales NO exista fundamento legal o interés legítimo y 
        <strong>g)</strong> cumplir con las demás obligaciones previstas en este contrato y en la Ley.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRADO ÚNICO:</strong>En caso de incompatibilidad o inhabilidad prevista en la Ley <strong>LA EMPRESA</strong> y 
        <strong>EL AFILIADO</strong> podrán de común acuerdo anular el contrato.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA – COSTAS PROCESALES:</strong> Las costas procesales como las pólizas, fotocopias, notificaciones, 
        honorarios por peritajes e inspecciones, los costos de la conciliación previa como requisito de procedibilidad, 
        curadores, aranceles y demás costas judiciales, en caso de adición del servicio, estarán a cargo del <strong>AFILIADO</strong>. 
        Estos dineros deberán ser cancelados directamente en los despachos judiciales o en su defecto a través de las cuentas de 
        <strong>LA EMPRESA</strong> aquí estipuladas y si esto no ocurre, se entenderá que <strong>EL AFILIADO</strong> desiste de la acción jurídica. 

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO PRIMERO:</strong>En consideración a la cuantía, urgencia y necesidad <strong>EL AFILIADO</strong> tendrá como plazo para 
        el pago de las costas entre 5 a 30 días calendarios.  

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO SEGUNDO:</strong> En el evento en que se declare desistimiento de la acción jurídica por este motivo y mientras resulte 
        viable reiniciar el proceso se podrá adelantar a solicitud del <strong>AFILIADO</strong>. 

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO TERCERO:</strong> En el evento que exista un fallo desfavorable dentro de un proceso judicial 
        en el que se condene en costas al <strong>AFILIADO</strong> le corresponde a este asumir su valor en el entendido que las obligaciones 
        de <strong>LA EMPRESA</strong> son exclusivamente de medio.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA PRIMERA – ASESORIA Y CONSULTAS:</strong> Las asesorías y consultas se someten a las condiciones del plan básico las 
        cuales serán agendadas o resueltas en un término máximo de 24 horas. No obstante, atendiendo la complejidad o especialidad podrá, 
        justificadamente, ampliarse este plazo hasta 72 horas.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO ÚNICO:</strong> Hasta que no sea resuelta la asesoría o consulta formulada por el <strong>AFILIADO</strong> no podrán formularse nuevas. 
        Si en una asesoría o consulta se tratan varios temas que no tienen relación entre si se les dará manejo como asesorías y 
        consultas aparte resueltas en el orden y termino previsto.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA SEGUNDA – DURACIÓN:</strong> La duración del presente contrato es de UN AÑO contado a partir del Día___________ Mes____________ Año________________.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO PRIMERO: EL AFILIADO</strong> no podrá finalizar este contrato antes del término inicialmente pactado salvo por circunstancias de fuerza mayor o caso fortuito, 
        por ser un contrato a término fijo, mediante el sistema de PREPAGO, en el cual <strong>LA EMPRESA</strong> asume los costos de honorarios de asesorías y consultas que requiera 
        <strong>EL AFILIADO</strong>, con excepción del cambio de plan o trascurrido el termino de duración del contrato.

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO SEGUNDO:</strong> En el evento que <strong>EL AFILIADO</strong> decida terminar unilateralmente el presente contrato antes del vencimiento de este 
        deberá cancelar previamente el valor de la Clausula Penal e informar por escrito con antelación a 30 días calendarios. 

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA TERCERA – SUSPENSIÓN:</strong> Se suspenderá la prestación de servicios por el incumplimiento del pago oportuno cuando esta supera los 30 días calendarios; 
        reactivándose con el pago de la cuota en mora junto con sus intereses liquidados a la tasa máxima que certifique la Superintendencia Financiera hasta antes de 60 días calendarios. 
        Si <strong>EL AFILIADO</strong> no cancela hasta antes de los referidos 60 días se terminará el contrato haciéndose exigible ejecutivamente la cláusula penal y 
        el valor de las 2 cuotas mensuales sumado los intereses moratorios que se causen. 

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO PRIMERO:</strong> En caso tal de persistir el incumplimiento <strong>LA EMPRESA</strong> podrá afectar los reportes ante entidades de información de riesgos financieros, 
        de acuerdo con la Ley del HABEAS DATA para lo cual <strong>EL AFILIADO</strong> lo autoriza en forma expresa. 

    </p>

    <p class='parrafocontrato'>

        <strong>PARÁGRAFO SEGUNDO:</strong> En caso de encontrarse suspendidos los servicios del contrato por cualquier causal y <strong>EL AFILIADO</strong> este siendo representado por 
        <strong>LA EMPRESA</strong> dentro de un proceso judicial o equivalente, por adición del servicio, se ordenará renunciar al poder otorgado, sin que exista responsabilidad jurídica o 
        disciplinaria por parte de <strong>LA EMPRESA</strong>. En el evento en que el contrato se reactive, será necesario que otorgue nuevo poder para continuar con el mandato o representación.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA CUARTA – SERVICIO ADICIONAL:</strong> En el evento que <strong>EL AFILIADO</strong> requiera un servicio adicional o no contemplado en el plan 
        básico podrá solicitarlo adicionando, según el servicio, el valor de este en su pago mensual, trimestral, semestral o anual.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA QUINTA – RENOVACIÓN Y PRORROGA:</strong> Vencido el término del presente contrato este se renovará automáticamente por el periodo inicial y 
        de forma sucesiva al inicialmente pactado, si ninguna de las partes manifiesta su intención de darlo por terminado con 30 días calendarios de antelación en 
        cumplimiento a lo estipulado en el parágrafo segundo de la cláusula decima segunda del presente.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA SEXTA – CLAUSULA PENAL:</strong> Se fija a título de clausula penal la suma de <strong>UN MILLON DE PESOS ($1.000.000.00) M/Cte</strong>. 
        exigible por la vía ejecutiva a quien incumpliere una o varias cláusulas de este contrato renunciando expresamente a 
        cualquier clase de requerimientos jurídicos para constituirla en mora, sin perjuicio del cobro de las obligaciones principales y sus intereses de Ley. 

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMA SEPTIMA – MERITO EJECUTIVO:</strong> El presente contrato presta merito ejecutivo por contener obligaciones claras, expresas y actualmente exigibles.

    </p>

    <p class='parrafocontrato'>

        <strong>DÉCIMO OCTAVO – NOTIFICACIONES: EL AFILIADO</strong> tendrá como dirección de notificación el correo electrónico _______________, 
        el cual se autoriza para todos los efectos y asuntos relacionados con el negocio jurídico aquí celebrado. 
        <strong>LA EMPRESA</strong> tendrá como dirección de notificación el correo electrónico infoclientes@lexlegal.com.co único correo autorizado para los efectos referidos.

    </p>

    <p class='parrafocontrato'>

        Firman en señal de aceptación a los ________________ días del mes de ______________________ del año ______

    </p>

    <p>

        <table class='tabla-firma'>
            <tr>
                <th class='alinear-l'>____________________________________ <br/> C.C./ C.E./ P.E.P. No. ________________ </th>
                <th  class='alinear-r'>CLAUDIA MARCELA SANCHEZ GALINDO <br/> C.C. No. 1.083.885.496 <br/>REPRESENTANTE LEGAL LEXLEGAL S.A.S.  <br/>NIT. No. 901.429.777 - 5</th>
            </tr>
        </table>

    </p>
</div>
";


$mpdf->WriteHTML($html);
$mpdf->Output();


?>