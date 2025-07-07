<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Transacción - QuickPay</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            color: #1a1a1a; 
            margin: 0; 
            padding: 0; 
            line-height: 1.3;
            background-color: #f8f9fa;
        }
        .container { 
            max-width: 700px; 
            margin: 16px auto; 
            background: #fff; 
            border: 2px solid #e0e0e0; 
            padding: 20px 24px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 3px solid #284494; 
            padding-bottom: 12px; 
            margin-bottom: 16px;
        }
        .logo { 
            font-size: 28px; 
            font-weight: 700; 
            color: #284494; 
            letter-spacing: 2px; 
            font-family: Arial, sans-serif;
        }
        .subtitle {
            font-size: 12px; 
            color: #333; 
            font-weight: 500;
            margin-top: 3px;
        }
        .ruc-box { 
            border: 2px solid #284494; 
            padding: 8px 16px; 
            text-align: center; 
            font-size: 12px; 
            border-radius: 6px;
            background-color: #f8f9ff;
        }
        .title { 
            font-size: 16px; 
            font-weight: 700; 
            margin-top: 16px; 
            margin-bottom: 12px;
            color: #284494;
            border-left: 4px solid #284494;
            padding-left: 10px;
        }
        .info-table, .details-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 12px; 
        }
        .info-table td { 
            padding: 6px 10px; 
            font-size: 12px; 
            border-bottom: 1px solid #f0f0f0;
        }
        .info-table .label { 
            font-weight: 600; 
            color: #284494; 
            width: 130px; 
            background-color: #f8f9ff;
        }
        .info-table .value {
            font-weight: 500;
            color: #333;
        }
        .details-table th, .details-table td { 
            border: 1px solid #d0d0d0; 
            padding: 8px 12px; 
            font-size: 12px; 
        }
        .details-table th { 
            background: #284494; 
            color: white;
            font-weight: 600;
            text-align: center;
        }
        .details-table td { 
            background: #fff; 
            font-weight: 500;
        }
        .summary-table { 
            width: 100%; 
            margin-top: 16px; 
            border-collapse: collapse; 
            border: 2px solid #284494;
            border-radius: 6px;
        }
        .summary-table td { 
            font-size: 13px; 
            padding: 12px 16px; 
            background-color: #f8f9ff;
        }
        .summary-table .label { 
            text-align: right; 
            font-weight: 700; 
            color: #284494;
        }
        .summary-table .value { 
            text-align: right; 
            font-weight: 700;
            font-size: 16px;
            color: #284494;
        }
        .footer { 
            font-size: 11px; 
            color: #666; 
            text-align: center; 
            margin-top: 32px; 
            border-top: 2px solid #e0e0e0; 
            padding-top: 16px; 
            line-height: 1.6;
        }
        .concepto { 
            margin-top: 16px; 
            font-size: 13px; 
            font-weight: 500;
            background-color: #f8f9ff;
            padding: 12px 16px;
            border-left: 4px solid #284494;
            border-radius: 4px;
        }
        .badge { 
            background: #22c55e; 
            color: #fff; 
            padding: 6px 16px; 
            border-radius: 20px; 
            font-size: 12px; 
            font-weight: 600; 
            margin-top: 8px;
            display: inline-block;
        }
        .section-title { 
            font-size: 16px; 
            font-weight: 700; 
            color: #284494; 
            margin-top: 24px; 
            margin-bottom: 12px; 
            border-left: 4px solid #284494;
            padding-left: 12px;
        }
        .currency-symbol {
            font-weight: 700;
            color: #284494;
        }
        .amount-positive {
            color: #16a34a;
            font-weight: 600;
        }
        .amount-negative {
            color: #dc2626;
            font-weight: 600;
        }
        .payment-method {
            font-size: 12px;
            line-height: 1.5;
        }
        .payment-method .bank-info {
            font-weight: 600;
            color: #284494;
        }
        .payment-method .disclaimer {
            font-size: 10px;
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <div class="logo">QUICKPAY</div>
                <div class="subtitle">COMPROBANTE DE TRANSACCIÓN ELECTRÓNICA</div>
            </div>
            <div class="ruc-box">
                <div><strong>RUC: 20123456789</strong></div>
                <div class="badge">OPERACIÓN COMPLETADA</div>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="title">DETALLES DE LA OPERACIÓN</div>
        <table class="info-table">
            <tr>
                <td class="label">Remitente:</td>
                <td class="value">{{ $transaction->sender->name ?? 'USUARIO' }} ({{ $transaction->sender->email ?? 'N/A' }})</td>
                <td class="label">Destinatario:</td>
                <td class="value">{{ $transaction->receiver->name ?? 'USUARIO' }} ({{ $transaction->receiver->email ?? 'N/A' }})</td>
            </tr>
            <tr>
                <td class="label">ID Transacción:</td>
                <td class="value">{{ strtoupper(substr(md5($transaction->id . $transaction->created_at), 0, 12)) }}</td>
                <td class="label">Referencia:</td>
                <td class="value">QP{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Fecha y Hora:</td>
                <td class="value">{{ $transaction->created_at->format('d/m/Y - H:i:s') }}</td>
                <td class="label">Estado:</td>
                <td class="value"><strong>{{ strtoupper($transaction->status) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Canal:</td>
                <td class="value">QUICKPAY WEB</td>
                <td class="label">Tipo Operación:</td>
                <td class="value">TRANSFERENCIA DIGITAL</td>
            </tr>
        </table>

        <!-- Detalles de la transacción -->
        <div class="section-title">DETALLE DEL MOVIMIENTO</div>
        <table class="details-table">
            <thead>
                <tr>
                    <th style="width: 20%;">MONEDA</th>
                    <th style="width: 30%;">MONTO</th>
                    <th style="width: 50%;">MÉTODO DE PAGO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="currency-symbol">{{ $transaction->currency }}</span></td>
                    <td>
                        @if ($transaction->sender_id === auth()->id())
                            <span class="amount-negative">-{{ number_format($transaction->amount, 2) }}</span>
                        @else
                            <span class="amount-positive">+{{ number_format($transaction->amount, 2) }}</span>
                        @endif
                    </td>
                    <td class="payment-method">
                        <div class="bank-info">VISA - Tarjeta Débito **** 2078</div>
                        <div class="bank-info">Banco de Crédito del Perú - BCP</div>
                        <div class="disclaimer">* Aparecerá como "QUICKPAY {{ strtoupper($transaction->sender->name ?? 'USUARIO') }}" en su estado de cuenta</div>
                    </td>
                </tr>
            </tbody>
        </table>

        @if($transaction->reason)
        <div class="concepto"><strong>Concepto:</strong> {{ $transaction->reason }}</div>
        @endif

        @if(isset($transaction->converted_amount) && isset($transaction->exchange_rate))
        <div class="section-title">CONVERSIÓN DE MONEDA</div>
        <table class="details-table">
            <tr>
                <th>Tasa de cambio</th>
                <th>Monto convertido</th>
            </tr>
            <tr>
                <td><strong>1 {{ $transaction->currency }} = {{ $transaction->exchange_rate }} {{ $transaction->receiver_currency ?? 'USD' }}</strong></td>
                <td><span class="currency-symbol">{{ $transaction->receiver_currency ?? 'USD' }}</span> <strong>{{ number_format($transaction->converted_amount, 2) }}</strong></td>
            </tr>
        </table>
        @endif

        <!-- Resumen final -->
        <table class="summary-table">
            <tr>
                <td class="label">TOTAL PROCESADO:</td>
                <td class="value">
                    <span class="currency-symbol">{{ $transaction->currency }}</span> {{ number_format($transaction->amount, 2) }}
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <strong>QUICKPAY S.A.C.</strong> | RUC: 20123456789 | Lima, Perú<br>
            Soporte: support@quickpay.com | +51 1 234-5678<br>
            Documento generado el {{ now()->format('d/m/Y H:i:s') }}<br>
            <strong>Comprobante electrónico válido - Operación protegida</strong>
        </div>
    </div>
</body>
</html>