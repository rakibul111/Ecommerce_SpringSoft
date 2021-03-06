@extends('admin.layout.master')
@section('title', 'Order Details')
@section('pageTitle') <a href="#">Order Details</a> @endsection
@section('parentPageTitle') <a href="{{route('order.view')}}">Orders</a> @endsection


@section('content')
    <style type="text/css">
        .prof li{
            background:cornflowerblue;
            padding: 7px;
            margin: 3px;
            border-radius: 15px;
        }
        .prof li a{
            color: wheat;
            padding-left: 15px;
        }
        .mytable tr td{
            padding: 15px;
        }
        .not-found{
            text-align: center;
        }

    </style>

    <div class="row clearfix">

        <div class="col-lg-12">
            <div class="card-body">
            @if(!empty($order->id))
                <div class="row">
                    <table class="txt-center table table-bordered mytable" width="100%" border="1">
                        <tr>
                            <td width="30%">

                            </td>
                            <td width="40%">
                                <h4><strong>Ecommerce Norda</strong></h4>


                            </td>
                            <td width="30%">
                                <strong>Order NO: #{{ $order->id }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Shipping Information</strong></td>
                            <td colspan="2" style="text-align: left;">
                                <strong>Name:</strong>{{ $order->biling_fname.' '.$order->biling_lname }} &nbsp;&nbsp;&nbsp&nbsp;&nbsp;
                                <strong>Email:</strong>{{ $order->biling_email }}&nbsp;&nbsp;&nbsp&nbsp;&nbsp;
                                <strong>Address:</strong>{{ $order->biling_address }}&nbsp;&nbsp&nbsp;&nbsp;<br>
                                <strong>Mobile:</strong>{{ $order->biling_phone }}&nbsp;&nbsp;
                                <strong>Payment:</strong>&nbsp;&nbsp;
                                {{ $order->payment }}
                                @if ($order->payment=='Bkash')
                                    <span> (Bkash Mobile:{{ $order->bkash_mobile }})</span>
                                    <span> (Transaction No:{{ $order->transaction }})</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>Order Details</strong> </td>
                        </tr>
                        <tr>
                            <td><strong>Product Name & Image</strong></td>
                            <td><strong>Color & Size</strong></td>
                            <td><strong>Quantity & Price</strong></td>
                        </tr>
                        @foreach ($product as $key=>$details)
                            <tr>
                                <td>
                                    <img src="{{ asset('upload/products_images/'.$details->product['image']) }}" style="width: 50px; height: 50px;"> &nbsp; {{ $details->product['name'] }}
                                </td>
                                <td>
                                    {{ $details->color['name']??'' }}<br>
                                    {{ $details->size['name']??'' }}
                                </td>

                                <td>

                                    {{ $details['qty'] }} pieces<br>

                                    @if ($details->product['promo_price'])
                                        {{ $details->product['promo_price'] }} tk <br>
                                    @else
                                        {{ $details->product['price'] }} tk <br>
                                    @endif
                                    @if ($details->product['promo_price'])
                                        @php
                                            $subtotal=$details['qty']* $details->product['promo_price'];
                                        @endphp
                                    @else
                                        @php
                                            $subtotal= $details['qty']* $details->product['price'];
                                        @endphp

                                    @endif


                                    Total {{ $subtotal }}

                                </td>

                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td colspan="2" style="text-align: right;"><strong>Grand Total</strong></td>
                            <td><strong>{{ $order->order_total }}</strong></td>

                        </tr> --}}


                    </table>

                </div>
            @else <div class="not-found center alert alert-danger">Product Not found!</div>
            @endif
            </div>
        </div>

    </div>

@endsection
