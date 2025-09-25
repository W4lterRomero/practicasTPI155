<?php
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
        'formaPago'       => 'EFECTIVO', // EFECTIVO | TARJETA | TRANSFERENCIA
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="titulo">
            <h1>Factura</h1>
        </div>
        <div class="data">
            <div class="dataPrincipal" style="display:flex; gap:1rem;">
                <div class="dataPrincipal_Emisor">
                    <?php
                    foreach ($factura['receptor'] as $key => $value): ?>
                        <p><strong><?= ucfirst($key) ?> :</strong> <?= $value ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="dataPrincipal_Receptor">
                    <?php
                    foreach ($factura['emisor'] as $key => $value): ?>

                        <p><strong> <?=  ucfirst($key) ?>: </strong>  <?= $value ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="data_producto">
                <div class="encabezado">
                    <?php foreach ($factura['encabezado'] as $key => $value): ?>
                        <p><strong> <?=  ucfirst($key) ?> :</strong>  <?= $value  ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="table_productos">
            <table cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Importe Bruto</th>
                        <th>Descuento</th>
                        <th>Importe Neto</th>
                        <th>Tributo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($factura['items'] as $i => $item): ?>
                        <?php
                        $importeBruto = $item['cantidad'] * $item['precioUnitario'];
                        $descuentoTotal = $item['cantidad'] * $item['descuento'];
                        $importeNeto = $importeBruto - $descuentoTotal;
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $item['codigo'] ?></td>
                            <td><?= $item['descripcion'] ?></td>
                            <td><?= $item['unidad'] ?></td>
                            <td><?= $item['cantidad'] ?></td>
                            <td><?= number_format($item['precioUnitario'], 2) ?></td>
                            <td><?= number_format($importeBruto, 2) ?></td>
                            <td><?= number_format($descuentoTotal, 2) ?></td>
                            <td><?= number_format($importeNeto, 2) ?></td>
                            <td><?= $item['tipoTributo'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="totales">
            <?php $matriz = [[1, 2, 3], [4, 5, 6]];
            foreach ($matriz as $fila): ?>

                <?php foreach ($fila as $value): ?>
                    <?php echo"";?>

                <?php endforeach; ?>

            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>