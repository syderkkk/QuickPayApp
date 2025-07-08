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
        .badge.pending { 
            background: #f59e0b; 
        }
        .badge.cancelled { 
            background: #ef4444; 
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
        .transaction-type {
            background-color: #e0f2fe;
            border: 1px solid #0891b2;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: #0891b2;
            text-align: center;
            margin-bottom: 12px;
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
                <div class="badge {{ $transaction->status === 'completed' ? '' : ($transaction->status === 'pending' ? 'pending' : 'cancelled') }}">
                    @if($transaction->status === 'completed')
                        OPERACIÓN COMPLETADA
                    @elseif($transaction->status === 'pending')
                        OPERACIÓN PENDIENTE
                    @else
                        OPERACIÓN {{ strtoupper($transaction->status) }}
                    @endif
                </div>
            </div>
        </div>

        <!-- Tipo de transacción -->
        <div class="transaction-type">
            @if($transaction->type === 'request')
                @if($transaction->receiver_id === auth()->id())
                    SOLICITUD DE PAGO RECIBIDA
                @else
                    PAGO DE SOLICITUD REALIZADO
                @endif
            @else
                ENVÍO DE DINERO DIRECTO
            @endif
        </div>

        <!-- Datos principales -->
        <div class="title">DETALLES DE LA OPERACIÓN</div>
        <table class="info-table">
            <tr>
                <td class="label">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            Pagador:
                        @else
                            Solicitante:
                        @endif
                    @else
                        Remitente:
                    @endif
                </td>
                <td class="value">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            {{ $transaction->sender->name ?? 'USUARIO' }} {{ $transaction->sender->lastname ?? '' }} ({{ $transaction->sender->email ?? 'N/A' }})
                        @else
                            {{ $transaction->receiver->name ?? 'USUARIO' }} {{ $transaction->receiver->lastname ?? '' }} ({{ $transaction->receiver->email ?? 'N/A' }})
                        @endif
                    @else
                        {{ $transaction->sender->name ?? 'USUARIO' }} {{ $transaction->sender->lastname ?? '' }} ({{ $transaction->sender->email ?? 'N/A' }})
                    @endif
                </td>
                <td class="label">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            Solicitante:
                        @else
                            Pagador:
                        @endif
                    @else
                        Destinatario:
                    @endif
                </td>
                <td class="value">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            {{ $transaction->receiver->name ?? 'USUARIO' }} {{ $transaction->receiver->lastname ?? '' }} ({{ $transaction->receiver->email ?? 'N/A' }})
                        @else
                            {{ $transaction->sender->name ?? 'USUARIO' }} {{ $transaction->sender->lastname ?? '' }} ({{ $transaction->sender->email ?? 'N/A' }})
                        @endif
                    @else
                        {{ $transaction->receiver->name ?? 'USUARIO' }} {{ $transaction->receiver->lastname ?? '' }} ({{ $transaction->receiver->email ?? 'N/A' }})
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">ID Transacción:</td>
                <td class="value">{{ $transaction->custom_id ?? strtoupper(substr(md5($transaction->id . $transaction->created_at), 0, 12)) }}</td>
                <td class="label">Referencia:</td>
                <td class="value">QP{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Fecha y Hora:</td>
                <td class="value">
                    {{ \App\Helpers\TimezoneHelper::formatForUser($transaction->created_at, 'd/m/Y - H:i:s') }}
                    <small>({{ auth()->user()->timezone ?? 'UTC' }})</small>
                </td>
                <td class="label">Estado:</td>
                <td class="value"><strong>{{ strtoupper($transaction->status === 'completed' ? 'COMPLETADO' : ($transaction->status === 'pending' ? 'PENDIENTE' : $transaction->status)) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Canal:</td>
                <td class="value">QUICKPAY WEB</td>
                <td class="label">Tipo Operación:</td>
                <td class="value">
                    @if($transaction->type === 'request')
                        SOLICITUD DE PAGO
                    @else
                        TRANSFERENCIA DIGITAL
                    @endif
                </td>
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
                    <td>
                        <span class="currency-symbol">
                            @if($transaction->type === 'request')
                                @if($transaction->receiver_id === auth()->id())
                                    {{-- Yo solicité, muestro la moneda solicitada --}}
                                    {{ $transaction->currency }}
                                @else
                                    {{-- Yo pagué, muestro mi moneda --}}
                                    {{ auth()->user()->wallet->currency }}
                                @endif
                            @else
                                {{-- Envío directo, muestro moneda del remitente --}}
                                {{ $transaction->currency }}
                            @endif
                        </span>
                    </td>
                    <td>
                        @if($transaction->type === 'request')
                            @if($transaction->receiver_id === auth()->id())
                                {{-- Yo solicité (recibo dinero) --}}
                                <span class="amount-positive">+{{ number_format($transaction->amount, 2) }}</span>
                            @else
                                {{-- Yo pagué la solicitud (envío dinero) --}}
                                <span class="amount-negative">-{{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}</span>
                            @endif
                        @else
                            {{-- Envío directo --}}
                            @if($transaction->sender_id === auth()->id())
                                <span class="amount-negative">-{{ number_format($transaction->amount, 2) }}</span>
                            @else
                                <span class="amount-positive">+{{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}</span>
                            @endif
                        @endif
                    </td>
                    <td class="payment-method">
                        @if($transaction->card)
                            <div class="bank-info">{{ strtoupper($transaction->card->brand) }} - Tarjeta {{ $transaction->card->type ?? 'Débito' }} **** {{ $transaction->card->last_four }}</div>
                            <div class="bank-info">{{ $transaction->card->bank_name ?? 'Banco asociado' }}</div>
                            <div class="disclaimer">* Aparecerá como "QUICKPAY {{ strtoupper(($transaction->type === 'request' && $transaction->receiver_id !== auth()->id()) ? $transaction->receiver->name : $transaction->sender->name ?? 'USUARIO') }}" en su estado de cuenta</div>
                        @else
                            <div class="bank-info">SALDO QUICKPAY</div>
                            <div class="bank-info">Billetera Digital</div>
                            <div class="disclaimer">* Operación procesada desde saldo de billetera QuickPay</div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        @if($transaction->reason)
        <div class="concepto"><strong>Concepto:</strong> {{ $transaction->reason }}</div>
        @endif

        {{-- Mostrar conversión si existe --}}
        @if($transaction->type === 'request' && $transaction->receiver_id !== auth()->id() && $transaction->currency !== auth()->user()->wallet->currency && $transaction->exchange_rate)
            {{-- Yo pagué una solicitud en diferente moneda --}}
            <div class="section-title">CONVERSIÓN DE MONEDA</div>
            <table class="details-table">
                <tr>
                    <th>Concepto</th>
                    <th>Tasa de cambio</th>
                    <th>Monto convertido</th>
                </tr>
                <tr>
                    <td><strong>Solicitud pagada</strong></td>
                    <td><strong>1 {{ auth()->user()->wallet->currency }} = {{ number_format(1 / $transaction->exchange_rate, 2) }} {{ $transaction->currency }}</strong></td>
                    <td><span class="currency-symbol">{{ $transaction->currency }}</span> <strong>{{ number_format($transaction->amount, 2) }}</strong></td>
                </tr>
                <tr>
                    <td><strong>Monto debitado de mi cuenta</strong></td>
                    <td><strong>1 {{ $transaction->currency }} = {{ number_format($transaction->exchange_rate, 2) }} {{ auth()->user()->wallet->currency }}</strong></td>
                    <td><span class="currency-symbol amount-negative">{{ auth()->user()->wallet->currency }}</span> <strong>{{ number_format($transaction->converted_amount, 2) }}</strong></td>
                </tr>
            </table>
        @elseif($transaction->type !== 'request' && isset($transaction->converted_amount) && isset($transaction->exchange_rate) && $transaction->currency !== $transaction->receiver_currency)
            {{-- Envío directo con conversión --}}
            <div class="section-title">CONVERSIÓN DE MONEDA</div>
            <table class="details-table">
                <tr>
                    <th>Tasa de cambio</th>
                    <th>Monto convertido</th>
                </tr>
                <tr>
                    <td><strong>1 {{ $transaction->currency }} = {{ number_format($transaction->exchange_rate, 2) }} {{ $transaction->receiver_currency }}</strong></td>
                    <td><span class="currency-symbol">{{ $transaction->receiver_currency }}</span> <strong>{{ number_format($transaction->converted_amount, 2) }}</strong></td>
                </tr>
            </table>
        @endif

        <!-- Resumen final -->
        <table class="summary-table">
            <tr>
                <td class="label">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            MONTO SOLICITADO:
                        @else
                            TOTAL PAGADO:
                        @endif
                    @else
                        @if($transaction->sender_id === auth()->id())
                            TOTAL ENVIADO:
                        @else
                            TOTAL RECIBIDO:
                        @endif
                    @endif
                </td>
                <td class="value">
                    @if($transaction->type === 'request')
                        @if($transaction->receiver_id === auth()->id())
                            <span class="currency-symbol">{{ $transaction->currency }}</span> {{ number_format($transaction->amount, 2) }}
                        @else
                            <span class="currency-symbol">{{ auth()->user()->wallet->currency }}</span> {{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}
                        @endif
                    @else
                        @if($transaction->sender_id === auth()->id())
                            <span class="currency-symbol">{{ $transaction->currency }}</span> {{ number_format($transaction->amount, 2) }}
                        @else
                            <span class="currency-symbol">{{ $transaction->receiver_currency ?? $transaction->currency }}</span> {{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}
                        @endif
                    @endif
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <strong>QUICKPAY S.A.C.</strong> | RUC: 20123456789 | Lima, Perú<br>
            Soporte: support@quickpay.com | +51 1 234-5678<br>
            Documento generado el {{ \App\Helpers\TimezoneHelper::formatForUser(now(), 'd/m/Y H:i:s') }}<br>
            <strong>Comprobante electrónico válido - Operación protegida</strong>
        </div>
    </div>
</body>
</html>