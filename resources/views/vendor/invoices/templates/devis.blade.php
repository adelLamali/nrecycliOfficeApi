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
                    /* margin: 36pt; */
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

                .button {
                    width:100%;
                    background-color:#69bf37;
                    border: 1px solid #69bf37;
                    border-radius: 12px 12px 12px 12px !important;
                    padding: 10px !important;
                    color:white;
                    font-size:12px;
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

                .table-middle td {
                    padding: 0.25rem;
                    vertical-align: top;
                    border-top: 1px solid #dee2e6;
                }

                .table-bottom {
                    width: 100%;
                    margin-bottom: 1rem;
                    border: 1px solid #a7a7a7;
                    border-top:0px;
                    border-radius: 0px 0px 16px 16px !important;
                    /* border-bottom-right-radius: 12610px 451px !important;
                    border-bottom-left-radius: 12610px 451px !important; */
                    padding:16px !important;
                }

                /* .table thead th {
                    vertical-align: bottom;
                    border-bottom: 2px solid #dee2e6;
                } */

                .table tbody + tbody {
                    border-top: 2px solid #dee2e6;
                }

                .mt-1 {
                    margin-top: 1rem !important;
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

                .mx {
                    margin-left: 3rem !important;
                    margin-right: 3rem !important;
                }

                .px {
                    padding-left: 3rem !important;
                    padding-right: 3rem !important;
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

                .text-white {
                    color: #ffffff !important;
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
                    font-size: 14px;
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

                .border-l {
                    border : 2px solid #e7e7e7;
                    border-radius : 16px;
                    border-top:0px;
                    border-right:0px;
                    border-bottom:0px;
                }
                .hidden {
                    visibility:hidden !important;
                }
                .margin {
                    margin:36pt;
                }
                .header {

                    background-image : url("{{ $invoice->logo('https://office.nrecycli.com/invoice_header.png')->getLogo() }}");
                    /* width:100%; */
                    height:180px;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center; 
                    background-size: cover;
                }

                .header2 {
                    width : 100%;
                    height : 20px;
                    background : red;
                    border : 1px red;
                    border-bottom-right-radius:  250px 50px;
                    border-bottom-left-radius: 250px 50px; 
                }  

        </style>
    </head>

    <body>

        <table class="header px" width="100%" >
            <tbody>
                <tr class="">
                    <td class="" width="15%">
                        <p class="text-white text-left tabletop-header"> SARL ENRECYCLI </p>
                        <p class="text-left"> Address: </p>
                        <p class="text-left"> Registre: </p>
                        <p class="text-left"> NIF: </p>
                        <p class="text-left"> AI: </p>
                        <p class="text-left"> RIB: </p>
                        <p class="text-left"> Téléphone: </p>
                        <p class="text-left"> Site </p>
                    </td>

                    <td class="" width="25%">
                        <p class="text-white text-left tabletop-header hidden"> SARL ENRECYCLI </p>
                        <p class="text-right text-white"> 116 bd krim Belkacem Alger </p>
                        <p class="text-right text-white"> 19B1000871-16/00 </p>
                        <p class="text-right text-white"> 001916100087170 </p>
                        <p class="text-right text-white"> 16020938138 </p>
                        <p class="text-right text-white"> BEA - 2312353412321 </p>
                        <p class="text-right text-white"> +213 770 739 740 </p>
                        <p class="text-right text-white"> office.nrecycli.com </p>
                    </td>

                    <td width="55%"></td>
                    
                </tr>
            </tbody>
        </table>

        <table class="mx" width="100%">
            <tbody>
                <tr>
                    <td class="" width="30%"></td>
                    <td class="mt-1" width="40%">

                        <p class="text-center text-primary tabletop-header">Devis</p> 
                                                
                    </td>
                    <td class="" width="30%"></td>
                </tr>
            </tbody>
        </table>    

        <table class="mx" width="100%">
            <tbody>
                <tr>

                    <td class="" width="50%">
                        
                        @if($invoice->buyer->number)
                            <p class="text-left">
                                Devis N: {!! $invoice->buyer->number !!}
                            </p>
                        @endif

                        @if($invoice->buyer->date_now)
                            <p class="text-left">
                                Date: {{ $invoice->buyer->date_now }}
                            </p>
                        @endif
                        <p class="hidden">date</p>
                        <p class="hidden">date</p>
                        <p class="hidden">date</p>

                    </td>

                    <td class="border-0 pl-0" width="20%">

                        @if($invoice->buyer->office_name)
                            <p class="text-primary text-left tabletop-header">
                                {{ $invoice->buyer->office_name }}
                            </p>
                        @endif
                        
                        <p class="text-left"> Address: </p>
                        <!-- <p class="text-left"> Registre: </p> -->
                        <!-- <p class="text-left"> NIF: </p>
                        <p class="text-left"> NIS: </p> -->
                        <p class="text-left"> Telephone: </p>
                        @if($invoice->buyer->registre)
                            <p class="text-left">
                                Registre:
                            </p>
                        @else
                        <p class="text-left hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        @if($invoice->buyer->nif)
                            <p class="text-left">
                                NIF:
                            </p>
                        @else
                        <p class="text-left hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        @if($invoice->buyer->nis)
                            <p class="text-left">
                                NIS:
                            </p>
                        @else
                        <p class="text-left hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        @if($invoice->buyer->rip)
                            <p class="text-left">
                                RIB:
                            </p>
                        @else
                        <p class="text-left hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        <p class="text-left hidden"> Telephone: </p>
                        
                    </td>

                    <td class="border-0 pl-0" width="30%">
                        <p class="text-primary text-left tabletop-header hidden"> Office name </p>
                        @if($invoice->buyer->address)
                            <p class="text-right">
                                {{ $invoice->buyer->address }}
                            </p>
                        @endif
                        <!-- <p class="text-right"> 5123 15 651 231 351</p>
                        <p class="text-right"> 62 2 625 32 32 62 32 6 </p>
                        <p class="text-right"> 23 233 2 321 21 0 21 0 </p> -->
                        @if($invoice->buyer->phone_number)
                            <p class="text-right">
                                {{ $invoice->buyer->phone_number }}
                            </p>
                        @endif
                        @if($invoice->buyer->registre)
                            <p class="text-right">
                                {{ $invoice->buyer->registre }}
                            </p>
                        @else
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif

                        @if($invoice->buyer->nif)
                            <p class="text-right">
                                {{ $invoice->buyer->nif }}
                            </p>
                        @else
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        @if($invoice->buyer->nis)
                            <p class="text-right">
                                {{ $invoice->buyer->nis }}
                            </p>
                        @else
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        @if($invoice->buyer->rip)
                            <p class="text-right">
                                {{ $invoice->buyer->rip }}
                            </p>
                        @else
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                        @endif
                        <p class="text-right hidden"> 23 233 2 321 21 0 21 0 </p>
                    </td>

                </tr>
            </tbody>
        </table>

        <table class="mx" width="100%">
            <thead>
                <tr>
                    <td>
                        <p class="text-center tabletop-header ">Devis “ Nrecycli Office Pack ”</p>
                    </td>
                </tr>
            </thead>
        </table>

        {{-- Table --}}
        <table class="table-middle mx mt-1">
            <thead>
                <tr>
                    <td scope="col" class="border-0 pl-0 text-left">Description</td>
                    @if($invoice->hasItemUnits)
                        <td scope="col" class="text-left border-0">{{ __('invoices::invoice.units') }}</td>
                    @endif
                    <td scope="col" class="text-center border-0">Quantity</td>
                    <td scope="col" class="text-center border-0">Prix unitaire</td>
                    @if($invoice->hasItemDiscount)
                        <td scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</td>
                    @endif
                    <td scope="col" class="text-left border-0 pr-0">Total</td>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($invoice->items as $item)
                    @if($item->quantity != 0)
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
                    @endif
                @endforeach
                
            </tbody>
        </table>

        <table class="table-bottom mx">
            <tbody>
                {{-- Summary --}}
                @if($invoice->hasItemOrInvoiceDiscount())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">Remise</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_discount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->taxable_amount)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">Total H.T</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                        </td>
                    </tr>
                @endif
                @if($invoice->tax_rate)
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">TVA {{ $invoice->tax_rate }}%</td>
                        <td class="text-right pr-0">
                            {{ $invoice->formatCurrency($invoice->total_taxes) }}
                        </td>
                    </tr>
                @endif
                <!--@if($invoice->hasItemOrInvoiceTax())
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                        <td class="text-right pr-0">
                            
                        </td>
                    </tr>
                @endif-->
                
                    <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td class="text-left pl-0 total-amount">Total T.T.C</td>
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

        <table class="mx" width="100%">
            <tbody>
                <tr>

                    <td class="text-left"><strong>Mode de paiement:</strong> Chèque ou virement bancaire</td>
                    
                </tr>
            </tbody>
        </table>

        <table class="mx" width="100%">
            <tbody>
                <tr>

                    <td class="text-left"><strong>Modalité de paiement:</strong> 50% d'apport initial a la validation du bon de commande,50% restante 30 jours aprés l'installation</td>
                    
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


