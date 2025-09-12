<?php
//ez procesando la factura gg
$factura = [
    // Datos del emisor (quien factura)
    'emisor' => [
        'nombre'    => 'Ferretería El Roble S.A. de C.V.',
        'nit'       => '0614-290123-101-3',
        'nrc'       => '123456-7',
        'giro'      => 'Comercialización de materiales de construcción',
        'direccion' => 'Av. Central #123, San Miguel, SV',
        'telefono'  => '+503 2660-0000',
        'email'     => 'facturacion@elroble.com.sv',
    ],

    // Datos del receptor (cliente)
    'receptor' => [
        'nombre'    => 'Constructora Los Pinos',
        'nit'       => '0614-120987-102-5',
        'nrc'       => '765432-1',
        'direccion' => 'Col. Escalón, Pasaje 3, San Salvador, SV',
        'telefono'  => '+503 2222-3333',
        'email'     => 'compras@lospinos.sv',
    ],

    // Encabezado de la factura
    'encabezado' => [
        'tipoComprobante' => 'Factura Consumidor Final',  // o 'Crédito Fiscal'
        'serie'           => 'F001',
        'numero'          => '00012345',
        'fechaEmision'    => '2025-09-11',
        'moneda'          => 'USD',
        'condicionPago'   => 'CONTADO', // CONTADO | CREDITO
        'diasCredito'     => 0,         // usar si condicionPago = CREDITO
        'formaPago'       => 'EFECTIVO',// EFECTIVO | TARJETA | TRANSFERENCIA
        'observaciones'   => 'Entrega inmediata. Garantía de fábrica 6 meses.'
    ],

    // Parámetros de cálculo
    'parametros' => [
        'iva'                => 0.13,   // 13%
        'descuentoMaxLinea'  => 0.20    // 20% del importe bruto por línea
    ],

    // Cargos/Descuentos globales (opcionales)
    'cargos' => [
        ['descripcion' => 'Envío a obra', 'monto' => 4.00]
    ],
    'anticipos' => 0.00,

    // Detalle de productos/servicios
    'items' => [
        [
            'codigo'         => 'P-001',
            'descripcion'    => 'Martillo 16oz mango fibra',
            'unidad'         => 'UND',
            'cantidad'       => 3,
            'precioUnitario' => 7.50,
            'descuento'      => 0.50,     // descuento absoluto por unidad (opción A)
            'tipoTributo'    => 'GRAVADO' // GRAVADO | EXENTO
        ],
        [
            'codigo'         => 'P-002',
            'descripcion'    => 'Clavos 2" (caja 500u)',
            'unidad'         => 'CJ',
            'cantidad'       => 2,
            'precioUnitario' => 9.80,
            'descuento'      => 0.00,
            'tipoTributo'    => 'GRAVADO'
        ],
        [
            'codigo'         => 'S-010',
            'descripcion'    => 'Servicio de corte de madera',
            'unidad'         => 'SERV',
            'cantidad'       => 1,
            'precioUnitario' => 6.00,
            'descuento'      => 0.00,
            'tipoTributo'    => 'EXENTO' // No grava IVA
        ],
        [
            'codigo'         => 'P-050',
            'descripcion'    => 'Broca para concreto 3/8"',
            'unidad'         => 'UND',
            'cantidad'       => 4,
            'precioUnitario' => 2.35,
            'descuento'      => 0.20,    // descuento por unidad
            'tipoTributo'    => 'GRAVADO'
        ],
    ]
];

//funcion para formatear moneda
function fmt($num) {
    return '$' . number_format($num, 2);
}

$items = $factura['items'];
$ivaRate = $factura['parametros']['iva'];
$descMax = $factura['parametros']['descuentoMaxLinea'];
$cargos = $factura['cargos'] ?? [];
$anticipos = $factura['anticipos'] ?? 0;

$totalGravado = 0;
$totalExento = 0;
$totalDescuentos = 0;
$detalleHtml = '';

foreach ($items as $i => $item) {
    $bruto = $item['cantidad'] * $item['precioUnitario'];
    $descLinea = $item['descuento'] * $item['cantidad'];
    $descPermitido = $bruto * $descMax;
    if ($descLinea > $descPermitido) {
        $descLinea = $descPermitido; //ajustando descuento maximo por linea ez
    }
    $neto = $bruto - $descLinea;
    $totalDescuentos += $descLinea;
    if ($item['tipoTributo'] == 'GRAVADO') {
        $totalGravado += $neto;
    } else {
        $totalExento += $neto;
    }
    $detalleHtml .= '<tr>' .
        '<td>' . ($i+1) . '</td>' .
        '<td>' . $item['codigo'] . '</td>' .
        '<td>' . $item['descripcion'] . '</td>' .
        '<td>' . $item['unidad'] . '</td>' .
        '<td>' . $item['cantidad'] . '</td>' .
        '<td>' . fmt($item['precioUnitario']) . '</td>' .
        '<td>' . fmt($bruto) . '</td>' .
        '<td>' . fmt($descLinea) . '</td>' .
        '<td>' . fmt($neto) . '</td>' .
        '<td>' . $item['tipoTributo'] . '</td>' .
        '</tr>';
}

$subtotalGeneral = $totalGravado + $totalExento;
$iva = $totalGravado * $ivaRate;
$totalCargos = 0;
foreach ($cargos as $cargo) {
    $totalCargos += $cargo['monto'];
}
$totalAPagar = $subtotalGeneral + $iva + $totalCargos - $anticipos;

//encabezado
$enc = $factura['encabezado'];
$emisor = $factura['emisor'];
$receptor = $factura['receptor'];

//fecha vencimiento si es credito
$fechaVenc = '';
if (strtoupper($enc['condicionPago']) == 'CREDITO') {
    $fechaVenc = date('Y-m-d', strtotime($enc['fechaEmision'] . ' + ' . $enc['diasCredito'] . ' days'));
}

//css bonito ez
echo '<style>
body { font-family: Arial, sans-serif; background: #f7f7f7; }
.factura-box { max-width: 900px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px #aaa; }
.encabezado, .totales { margin-bottom: 20px; }
.encabezado td { padding: 4px 8px; }
table.detalle { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
table.detalle th, table.detalle td { border: 1px solid #ccc; padding: 8px; text-align: center; }
table.detalle th { background: #e3e3e3; }
.totales td { padding: 6px 12px; }
.totales { background: #f0f0f0; border-radius: 6px; }
.titulo { font-size: 1.5em; font-weight: bold; margin-bottom: 10px; color: #2a4d7c; }
</style>';

echo '<div class="factura-box">';
echo '<div class="titulo">Factura</div>';
echo '<table class="encabezado">';
echo '<tr><td><b>Emisor:</b> ' . $emisor['nombre'] . '</td><td><b>Receptor:</b> ' . $receptor['nombre'] . '</td></tr>';
echo '<tr><td>NIT: ' . $emisor['nit'] . ' | NRC: ' . $emisor['nrc'] . '</td><td>NIT: ' . $receptor['nit'] . ' | NRC: ' . $receptor['nrc'] . '</td></tr>';
echo '<tr><td>Giro: ' . $emisor['giro'] . '</td><td>Direccion: ' . $receptor['direccion'] . '</td></tr>';
echo '<tr><td>Direccion: ' . $emisor['direccion'] . '</td><td>Telefono: ' . $receptor['telefono'] . '</td></tr>';
echo '<tr><td>Telefono: ' . $emisor['telefono'] . '</td><td>Email: ' . $receptor['email'] . '</td></tr>';
echo '<tr><td>Email: ' . $emisor['email'] . '</td><td></td></tr>';
echo '</table>';

echo '<table class="encabezado">';
echo '<tr><td><b>Serie:</b> ' . $enc['serie'] . '</td><td><b>Numero:</b> ' . $enc['numero'] . '</td></tr>';
echo '<tr><td>Fecha Emision: ' . $enc['fechaEmision'] . '</td><td>Moneda: ' . $enc['moneda'] . '</td></tr>';
echo '<tr><td>Condicion de Pago: ' . $enc['condicionPago'] . '</td><td>Forma de Pago: ' . $enc['formaPago'] . '</td></tr>';
if ($fechaVenc) {
    echo '<tr><td colspan="2">Fecha Vencimiento: ' . $fechaVenc . '</td></tr>';
}
echo '<tr><td colspan="2">Observaciones: ' . $enc['observaciones'] . '</td></tr>';
echo '</table>';

echo '<table class="detalle">';
echo '<tr><th>#</th><th>Codigo</th><th>Descripcion</th><th>Unidad</th><th>Cantidad</th><th>Precio Unitario</th><th>Importe Bruto</th><th>Descuento</th><th>Importe Neto</th><th>Tributo</th></tr>';
echo $detalleHtml;
echo '</table>';

echo '<table class="totales">';
echo '<tr><td><b>Subtotal Gravado:</b></td><td>' . fmt($totalGravado) . '</td></tr>';
echo '<tr><td><b>Subtotal Exento:</b></td><td>' . fmt($totalExento) . '</td></tr>';
echo '<tr><td><b>Total Descuentos:</b></td><td>' . fmt($totalDescuentos) . '</td></tr>';
echo '<tr><td><b>IVA (13%):</b></td><td>' . fmt($iva) . '</td></tr>';
foreach ($cargos as $cargo) {
    echo '<tr><td><b>Cargo:</b> ' . $cargo['descripcion'] . '</td><td>' . fmt($cargo['monto']) . '</td></tr>';
}
if ($anticipos > 0) {
    echo '<tr><td><b>Anticipos:</b></td><td>- ' . fmt($anticipos) . '</td></tr>';
}
echo '<tr><td><b>Subtotal General:</b></td><td>' . fmt($subtotalGeneral) . '</td></tr>';
echo '<tr><td><b>Total a Pagar:</b></td><td style="font-size:1.2em;color:#2a4d7c;font-weight:bold;">' . fmt($totalAPagar) . '</td></tr>';
echo '</table>';
echo '</div>';