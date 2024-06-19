<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>
<!-- END: Head -->

<body>
    <!-- BEGIN: Invoice -->
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h1>Invoice</h1>
                            </td>
                            <td>
                                Invoice #: {{ $order->id }}<br>
                                Created: {{ $order->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $order->user->name }}<br>
                                {{ $order->user->email }}<br>
                                {{ $order->user->phone }}<br>
                                {{ $order->user->address }}
                            </td>
                            <td>
                                {{ $setting->website_title }}<br>
                                left4code@gmail.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Description</td>
                <td>Price</td>
            </tr>

            @foreach($order->items as $item)
            <tr class="item">
                <td>{{ $item->service->name_service }} x {{ $item->quantity }} kg</td>
                <td>{{ formatRupiah($item->price * $item->quantity) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td></td>
                <td>Subtotal: {{ formatRupiah($order->total_price - $order->tax_amount) }}</td>
            </tr>

            <tr class="total">
                <td></td>
                <td>Tax ({{ $order->tax_rate }}%): {{ formatRupiah($order->tax_amount) }}</td>
            </tr>

            <tr class="total">
                <td></td>
                <td>Total: {{ formatRupiah($order->total_price) }}</td>
            </tr>
        </table>
    </div>
    <!-- END: Invoice -->
</body>
</html>
