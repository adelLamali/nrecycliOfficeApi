<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="stylesheet" href="{{ public_path('vendor/invoices/bootstrap.min.css') }}">

        <!-- <style type="text/css" media="screen">
            * {
                font-family: "DejaVu Sans";
            }
            html {
                margin: 0;
            }
            body {
                font-size: 10px;
                margin: 36pt;
            }
            body, h1, h2, h3, h4, h5, h6, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .table{
                border:2px;
                border-radius:10px;
            }
        </style> -->
        <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 0;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: separate;
            border-spacing:0;
        }

        th {
            text-align: inherit;
        }

        h4, .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4, .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
        }

        .table-middle {
            width: 100%;
            /* margin-bottom: 1rem; */
            border: 1px solid #a7a7a7;
            border-radius:16px 16px 0px 0px !important;
            padding:16px !important;
        }

        .table-middle th,
        .table-middle td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table-bottom {
            width: 100%;
            margin-bottom: 1rem;
            border: 1px solid #a7a7a7;
            border-top:0px;
            border-radius: 0px 0px 16px 16px !important;
            padding:16px !important;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .mb-10 {
            margin-bottom: 6rem !important;
        }

        .mb-15 {
            margin-bottom: 9rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-primary {
            color: #69bf37 !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
            line-height: 1.1;
        }

        .tabletop-header {
            font-size: 16px;
            font-weight: 400;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }
        .border-l{
            border : 2px solid #e7e7e7;
            border-radius : 16px;
            border-top:0px;
            border-right:0px;
            border-bottom:0px;
        }
        .hidden{
            visibility:hidden !important;
        }
    </style>
    </head>

    <body>

        <table class="" width="100%">
            <tbody>
                <tr>

                    <td class="border-0 pl-0">
                        @if($invoice->logo)
                            <img src="{{ $invoice->getLogo() }}" alt="logo" height="128">
                        @endif
                    </td>
                    <td class="text-left tabletop-header"><strong>Facture</strong></td>
                    
                </tr>
            </tbody>
        </table>
        
        <table class=" mb-5" width="100%">
            <tbody>
                <tr>
                    <!-- <td class="border-0 pl-0" width="50%">
                    @if($invoice->logo)
                        <img src="{{ $invoice->getLogo() }}" alt="logo" height="128">
                    @endif
                    </td> -->

                    <td class="border-0 pl-0" width="19%">
                        <p class="text-primary text-left tabletop-header"> SARL NRECYCLI </p>
                        <p class="text-left"> Address: </p>
                        <p class="text-left"> Registre: </p>
                        <p class="text-left"> NIF: </p>
                        <p class="text-left"> NIS: </p>
                        <p class="text-left"> RIP: </p>
                        <p class="text-left"> Telephone: </p>
                        <p class="text-left"> Site </p>
                    </td>

                    <td class="border-0 pl-0" width="30%">
                        <p class="text-primary text-left tabletop-header hidden"> SARL NRECYCLI </p>
                        <p class="text-right"> 116 boulevard krim belkacem Alger </p>
                        <p class="text-right"> 5123 15 651 231 351</p>
                        <p class="text-right"> 62 2 625 32 32 62 32 6 </p>
                        <p class="text-right"> 23 233 2 321 21 0 21 0 </p>
                        <p class="text-right"> BEA - 2312353412321 </p>
                        <p class="text-right"> +213 770 739 740 </p>
                        <p class="text-right"> office.nrecycli.com </p>
                    </td>

                    <td width="2%">

                    </td>

                    <td class="border-0 pl-0" width="19%">

                        @if($invoice->buyer->office_name)
                            <p class="text-primary text-left tabletop-header">
                                {{ $invoice->buyer->office_name }}
                            </p>
                        @endif
                        
                        <p class="text-left"> Address: </p>
                        <p class="text-left"> Registre: </p>
                        <p class="text-left"> NIF: </p>
                        <p class="text-left"> NIS: </p>
                        <p class="text-left"> Telephone: </p>
                        <p class="text-left hidden"> Telephone: </p>
                        <p class="text-left hidden"> Telephone: </p>
                        
                    </td>

                    <td class="border-0 pl-0" width="30%">
                        <p class="text-primary text-left tabletop-header hidden"> Customer </p>
                        @if($invoice->buyer->address)
                            <p class="text-right">
                                {{ $invoice->buyer->address }}
                            </p>
                        @endif
                        <p class="text-right"> 5123 15 651 231 351</p>
                        <p class="text-right"> 62 2 625 32 32 62 32 6 </p>
                        <p class="text-right"> 23 233 2 321 21 0 21 0 </p>
                        @if($invoice->buyer->phone_number)
                            <p class="text-right">
                                {{ $invoice->buyer->phone_number }}
                            </p>
                        @endif
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                    </td>

                </tr>
            </tbody>
        </table>

        

        {{-- Table --}}
        <table class="table-middle">
            <thead>
                <tr>
                    <td scope="col" class="border-0 pl-0 text-left">{{ __('invoices::invoice.description') }}</td>
                    @if($invoice->hasItemUnits)
                        <td scope="col" class="text-left border-0">{{ __('invoices::invoice.units') }}</td>
                    @endif
                    <td scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</td>
                    <td scope="col" class="text-center border-0">{{ __('invoices::invoice.price') }}</td>
                    @if($invoice->hasItemDiscount)
                        <td scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</td>
                    @endif
                    <td scope="col" class="text-left border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</td>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0 text-left">{{ $item->title }}</td>
                    <td class=" text-center">{{ $item->quantity }}</td>
                    <td class=" text-center">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                   
                    <td class="text-primary text-left pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>

        <table class="table-bottom ">
            <tbody>
                {{-- Summary --}}
                @if($invoice->hasItemOrInvoiceDiscount())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_discount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->taxable_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->tax_rate)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->tax_rate }}%
                        </td>
                    </tr>
                @endif
                @if($invoice->hasItemOrInvoiceTax())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_taxes) }}
                        </td>
                    </tr>
                @endif
                
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0 total-amount">{{ __('invoices::invoice.total_amount') }}</td>
                        <td class="text-primary text-right pr-0 total-amount">
                            {{ $invoice->formatCurrency($invoice->total_amount) }}
                        </td>
                    </tr>
            </tbody>
        </table>

        <table class=" mb-5" width="100%">
            <tbody>
                <tr>

                    <td class="text-center"><strong>signature</strong></td>
                    <td class="text-center"><strong>signature</strong></td>
                    
                </tr>
            </tbody>
        </table>

        <table class="" width="100%">
            <tbody>
                <tr>

                    <td class="text-left"><strong>mode de paiment:</strong> Cheque de verment banqaire</td>
                    
                </tr>
            </tbody>
        </table>

        <table class="" width="100%">
            <tbody>
                <tr>

                    <td class="text-left"><strong>modalité de payment:</strong> 50% d'apport initial a la validation du bon de commande,50% restante 30 jours aprés l'installation</td>
                    
                </tr>
            </tbody>
        </table>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="stylesheet" href="{{ public_path('vendor/invoices/bootstrap.min.css') }}">

        <style type="text/css" media="screen">
            * {
                font-family: "DejaVu Sans";
            }
            html {
                margin: 0;
            }
            body {
                font-size: 10px;
                margin: 36pt;
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
        </style>
    </head>

    <body>
        {{-- Header --}}
        @if($invoice->logo)
            <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
        @endif
        <table class="table mt-5">
            <tbody>
                <tr>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase">
                            <strong>{{ $invoice->name }}</strong>
                        </h4>
                    </td>
                    <td class="border-0 pl-0">
                        <p>{{ __('invoices::invoice.serial') }} <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                        <p>{{ __('invoices::invoice.date') }}: <strong>{{ $invoice->getDate() }}</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Seller - Buyer --}}
        <table class="table">
            <thead>
                <tr>
                    <th class="border-0 pl-0 party-header" width="48.5%">
                        {{ __('invoices::invoice.seller') }}
                    </th>
                    <th class="border-0" width="3%"></th>
                    <th class="border-0 pl-0 party-header">
                        {{ __('invoices::invoice.buyer') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-0">
                        @if($invoice->seller->name)
                            <p class="seller-name">
                                <strong>{{ $invoice->seller->name }}</strong>
                            </p>
                        @endif

                        @if($invoice->seller->address)
                            <p class="seller-address">
                                {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }}
                            </p>
                        @endif

                        @if($invoice->seller->code)
                            <p class="seller-code">
                                {{ __('invoices::invoice.code') }}: {{ $invoice->seller->code }}
                            </p>
                        @endif

                        @if($invoice->seller->vat)
                            <p class="seller-vat">
                                {{ __('invoices::invoice.vat') }}: {{ $invoice->seller->vat }}
                            </p>
                        @endif

                        @if($invoice->seller->phone)
                            <p class="seller-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }}
                            </p>
                        @endif

                        @foreach($invoice->seller->custom_fields as $key => $value)
                            <p class="seller-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                        @endforeach
                    </td>
                    <td class="border-0"></td>
                    <td class="px-0">
                        @if($invoice->buyer->name)
                            <p class="buyer-name">
                                <strong>{{ $invoice->buyer->name }}</strong>
                            </p>
                        @endif

                        @if($invoice->buyer->address)
                            <p class="buyer-address">
                                {{ __('invoices::invoice.address') }}: {{ $invoice->buyer->address }}
                            </p>
                        @endif

                        @if($invoice->buyer->code)
                            <p class="buyer-code">
                                {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                            </p>
                        @endif

                        @if($invoice->buyer->vat)
                            <p class="buyer-vat">
                                {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                            </p>
                        @endif

                        @if($invoice->buyer->phone)
                            <p class="buyer-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                            </p>
                        @endif

                        @foreach($invoice->buyer->custom_fields as $key => $value)
                            <p class="buyer-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Table --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.description') }}</th>
                    @if($invoice->hasItemUnits)
                        <th scope="col" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                    @endif
                    <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                    @if($invoice->hasItemDiscount)
                        <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                    @endif
                    @if($invoice->hasItemTax)
                        <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                    @endif
                    <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0">{{ $item->title }}</td>
                    @if($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach
                {{-- Summary --}}
                @if($invoice->hasItemOrInvoiceDiscount())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_discount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->taxable_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->tax_rate)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->tax_rate }}%
                        </td>
                    </tr>
                @endif
                @if($invoice->hasItemOrInvoiceTax())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_taxes) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->shipping_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.shipping') }}</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                        </td>
                    </tr>
                @endif
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }}</td>
                        <td class="text-right pr-0 total-amount">
                            {{ $invoice->formatCurrency($invoice->total_amount) }}
                        </td>
                    </tr>
            </tbody>
        </table>

        @if($invoice->notes)
            <p>
                {{ trans('invoices::invoice.notes') }}: {!! $invoice->notes !!}
            </p>
        @endif

        <p>
            {{ trans('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }}
        </p>
        <p>
            {{ trans('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }}
        </p>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html> -->
