<html lang="en-GB">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8; charset=ISO-8859-1" />

        <title>Invoice: {{$id}} - Company Name</title>


        <!-- Css -->
        <link rel="stylesheet" href="/css/print.css" type="text/css">
        <style type="text/css">
            * {
                font-family: DejaVu Sans, sans-serif !important;
            }
        </style>
    </head>

    <body onload="window.print();">
        @if($paid)
        <div class="container" style="height: 300px;
        width: 100%;
        position: absolute;
        /* margin-left: -50px; */
        text-align: center;
        top: 50%;
        margin-top: -50px;">
            {{-- <img src="/w3images/notebook.jpg" alt="Notebook" style="width:100%;"> --}}

            <svg id="svg3216" viewBox="0 0 300.6 298.79" version="1.1" style="width: 300px;">
                <g id="layer1" transform="translate(-310.54 -390.74)">
                    <g id="g3666" stroke="black" fill="black" style="opacity: 0.5"
                        transform="matrix(.74643 -.73236 .73236 .74643 283.66 580.45)">
                        <path id="path3040" stroke-linejoin="round"
                            d="m24.789 18.284c-7.756 0-14 6.244-14 14v117.72c0 7.756 6.244 14 14 14h246.31c7.756 0 14-6.244 14-14v-117.72c0-7.756-6.244-14-14-14h-246.31zm5.0938 5.9375h236.12c6.648 0 12 5.352 12 12v109.88c0 6.648-5.352 12-12 12h-236.12c-6.648 0-12-5.352-12-12v-109.88c0-6.648 5.352-12 12-12z"
                            stroke-opacity=".55708" stroke-linecap="round" stroke-width=".6" />
                        <g id="text3042">
                            <path id="path3519"
                                d="m85.705 74.103c4.96 0.000033 8.768 0.88003 11.424 2.64 2.656 1.728 3.984 4.576 3.984 8.544-0.00003 4-1.344 6.896-4.032 8.688-2.688 1.76-6.528 2.64-11.52 2.64h-2.352v11.136h-7.488v-32.784c1.632-0.31997 3.36-0.54397 5.184-0.672 1.824-0.12797 3.424-0.19197 4.8-0.192m0.48 6.384c-0.54401 0.000027-1.088 0.01603-1.632 0.048-0.51201 0.03203-0.96001 0.06403-1.344 0.096v9.6h2.352c2.592 0.000017 4.544-0.35198 5.856-1.056 1.312-0.70398 1.968-2.016 1.968-3.936-0.000021-0.92798-0.17602-1.696-0.528-2.304-0.32002-0.60798-0.80002-1.088-1.44-1.44-0.60802-0.38397-1.36-0.63997-2.256-0.768-0.89602-0.15997-1.888-0.23997-2.976-0.24" />
                            <path id="path3521"
                                d="m140.46 107.75c-0.35203-1.152-0.75203-2.336-1.2-3.552-0.41603-1.216-0.83203-2.432-1.248-3.648h-12.96c-0.41601 1.216-0.84801 2.432-1.296 3.648-0.41601 1.216-0.80001 2.4-1.152 3.552h-7.776c1.248-3.584 2.432-6.896 3.552-9.936s2.208-5.904 3.264-8.592c1.088-2.688 2.144-5.232 3.168-7.632 1.056-2.432 2.144-4.8 3.264-7.104h7.152c1.088 2.304 2.16 4.672 3.216 7.104 1.056 2.4 2.112 4.944 3.168 7.632 1.088 2.688 2.192 5.552 3.312 8.592s2.304 6.352 3.552 9.936h-8.016m-8.976-25.728c-0.16002 0.48002-0.40002 1.136-0.72 1.968-0.32002 0.83202-0.68802 1.792-1.104 2.88-0.41602 1.088-0.88002 2.288-1.392 3.6-0.48002 1.312-0.97602 2.688-1.488 4.128h9.456c-0.51202-1.44-1.008-2.816-1.488-4.128-0.48002-1.312-0.94402-2.512-1.392-3.6-0.41602-1.088-0.78402-2.048-1.104-2.88-0.32002-0.83198-0.57602-1.488-0.768-1.968" />
                            <path id="path3523" d="m164.31 74.487h7.488v33.264h-7.488v-33.264" />
                            <path id="path3525"
                                d="m198.52 101.65c0.35199 0.032 0.75199 0.064 1.2 0.096 0.47998 0.00001 1.04 0.00001 1.68 0 3.744 0.00001 6.512-0.94399 8.304-2.832 1.824-1.888 2.736-4.496 2.736-7.824-0.00003-3.488-0.86403-6.128-2.592-7.92s-4.464-2.688-8.208-2.688c-0.51202 0.000027-1.04 0.01603-1.584 0.048-0.54402 0.000027-1.056 0.03203-1.536 0.096v21.024m21.648-10.56c-0.00004 2.88-0.44804 5.392-1.344 7.536-0.89603 2.144-2.176 3.92-3.84 5.328-1.632 1.408-3.632 2.464-6 3.168s-5.024 1.056-7.968 1.056c-1.344 0-2.912-0.064-4.704-0.192-1.792-0.096-3.552-0.32-5.28-0.672v-32.4c1.728-0.31997 3.52-0.52797 5.376-0.624 1.888-0.12797 3.504-0.19197 4.848-0.192 2.848 0.000033 5.424 0.32003 7.728 0.96 2.336 0.64003 4.336 1.648 6 3.024s2.944 3.136 3.84 5.28c0.89596 2.144 1.344 4.72 1.344 7.728" />
                        </g>
                    </g>
                </g>

            </svg>
            {{-- <div class="content">
                <h1>Heading</h1>
                <p>Lorem ipsum dolor sit amet, an his etiam torquatos. Tollit soleat phaedrum te duo, eum cu recteque
                    expetendis neglegentur. Cu mentitum maiestatis persequeris pro, pri ponderum tractatos ei.</p>
            </div> --}}
        </div>
        @endif
        <div class="row border-bottom-1">
            <div class="col-58">
                <div class="text company">
                    <div style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    width: 100%;
                    margin:20px;">
                        <img class="logo" src="/file_storage/{{ $main_logo->value }}" alt="Logo" />
                    </div>
                </div>
            </div>

            <div class="col-42">
                <div class="text company">
                    <strong class="name-top">Company Name</strong><br>
                    <p style="margin-bottom: 0">{{ $invoice_addr->value }}</p>
                    <p class="support" style="margin-top: 5px"><strong>Support</strong></p>
                    <p class="phone">Phone 1</p>
                    <p class="phone">phone 2</p>
                    <p style="margin-top: 5px"><strong>web:</strong>website</p>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-58">
                <div class="text company">
                    <br>
                    <strong>Bill To</strong><br>
                    <p>{{$customer->name}}</p>

                    <p>{{$customer->address}}</p>

                    <p>
                    </p>

                    <p>
                        Phone: +88 {{$customer->phone}}
                    </p>

                    <p>

                    </p>
                </div>
            </div>

            <div class="col-42">
                <div class="text company">
                    <br>
                    <strong>
                        Invoice Number:
                    </strong>
                    <span class="float-right">{{$id}}</span><br><br>

                    <strong>
                        Courier:
                    </strong>
                    <span class="float-right">{{$courier->name}}</span><br><br>

                    <strong>
                        Invoice Date:
                    </strong>
                    <span class="float-right">{{$date}}</span><br><br>

                    <!-- <strong>
                    Payment Due:
                </strong>
                <span class="float-right">06 Aug 2020</span><br><br> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-100">
                <div class="text">
                    <table class="lines">


                        <thead style="background-color:#b9b9b9  !important; -webkit-print-color-adjust: exact;">
                            <tr>
                                <th class="item text-left text-white">Items</th>

                                <th class="quantity text-white">Quantity</th>

                                <th class="price text-white">Rate</th>

                                <th class="total text-white">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $key => $row)
                            <tr>
                                <td class="item">
                                    {{$row->name}}
                                </td>

                                <td class="quantity">{{$row->quantity}}</td>

                                <td class="price">&#2547;{{$row->selling_price}}</td>

                                <td class="total">&#2547;{{$row->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-9">
            <div class="col-58">
                <div class="text company">
                </div>
            </div>

            <div class="col-42 float-right text-right">
                <div class="text company">
                    <div class="border-top-1 py-2">
                        <strong class="float-left">Subtotal:</strong>
                        <span>&#2547;{{$subtotal}}</span><br>
                    </div>
                    <!-- <div class="border-top-1 py-2">
                    <strong class="float-left">Discount (10%):</strong>
                    <span>&#2547;40.00</span><br>
                </div> -->
                    <div class="border-top-1 py-2">
                        <strong class="float-left">Courier Charge:</strong>
                        <span>&#2547;{{$courier->charge}}</span><br>
                    </div>
                    <div class="border-top-1 py-2">
                        <strong class="float-left">Total:</strong>
                        <span>&#2547;{{number_format( $total, 0 , '.' , ',' )}}</span>
                    </div>
                    @if(isset($payment))
                    <div class="border-top-1 py-2">
                        <strong class="float-left">Paid:</strong>
                        <span>&#2547;{{$payment}}</span>
                    </div>
                    <div class="border-top-1 py-2">
                        <strong class="float-left">Remaining:</strong>
                        <span>&#2547;{{number_format( $total - $payment, 0 , '.' , ',' )}}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

</html>
