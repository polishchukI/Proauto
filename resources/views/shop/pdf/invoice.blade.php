<!DOCTYPE html>
<html>
<head>
    <title>Invoice Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div style="width: 100%; max-width: 960px; margin: auto">
        <table width="100%">
            <tr style="border-bottom: 1px solid #000000">
                <td><h2>Invoice</h2></td>
                <td style="text-align: right"><h3>{{$order["invoice"]}}#{{$order["id"]}}</h3></td>
            </tr>
            <tr>
                <td style="padding-bottom: 16px;">
                    <strong>Billed To:</strong><br>
                    {{$order["firstname"]}} {{$order["lastname"]}}<br>
                    {{$order["street"]}}, {{$order["address"]}}<br>
                    {{$order["city"]}}<br>
                    {{$order["state"]}}, {{$order["country"]}}<br>
                    {{$order["zipcode"]}}
                </td>
                <td style="text-align: right; padding-bottom: 16px;">
                    <strong>Shipped To:</strong><br>
                    {{$order["shipping_firstname"]}} {{$order["shipping_lastname"]}}<br>
                    {{$order["shipping_street"]}}, {{$order["shipping_address"]}}<br>
                    {{$order["shipping_city"]}}<br>
                    {{$order["shipping_state"]}}, {{$order["shipping_country"]}}<br>
                    {{$order["shipping_zipcode"]}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Payment Method:</strong><br>
                        Visa ending **** 4242<br>
                        {{$order["shipping_email"]}}
                </td>
                <td style="text-align: right">
                    <strong>Order Date:</strong><br>
                    March 7, 2014<br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Order summary</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <thead>
                            <tr style="background-color: #eee">
                                <th style="text-align: left; padding: 5px 10px;">Item</th>
                                <th style="text-align: center; padding: 5px 10px;">Price</strong></th>
                                <th style="text-align: center; padding: 5px 10px;">Quantity</th>
                                <th style="text-align: right; padding: 5px 10px;">Totals</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td style="text-align: left; padding: 5px 10px;">{{ $product['title'] }}</td>
                                    <td style="text-align: center; padding: 5px 10px;">{{ $product['price'] }}</td>
                                    <td style="text-align: center; padding: 5px 10px;">{{ $product['quantity'] }}</td>
                                    <td style="text-align: right; padding: 5px 10px;">{{ $product['totals'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align: center; padding: 5px 10px;"><strong>Shipping</strong></td>
								<td style="text-align: right; padding: 5px 10px;">{{$order['shipping'] }}</td>
							</tr>
							<tr>
								<td colspan="2"></td>
                                <td style="text-align: center; padding: 5px 10px;"><strong>Count</strong></td>
								<td style="text-align: right; padding: 5px 10px;">{{ $order['count'] }}</td>
							</tr>
							<tr>
								<td colspan="2"></td>
                                <td style="text-align: center; padding: 5px 10px;"><strong>Subtotal</strong></td>
								<td style="text-align: right; padding: 5px 10px;">{{ $order['subtotal'] }}</td>
							</tr>
							<tr>
								<td colspan="2"></td>
                                <td style="text-align: center; padding: 5px 10px;"><strong>Tax</strong></td>
								<td style="text-align: right; padding: 5px 10px;">{{ $order['tax'] }}</td>
							</tr>
							<tr>
								<td colspan="2"></td>
                                <td style="text-align: center; padding: 5px 10px;"><strong>Totals</strong></td>
								<td style="text-align: right; padding: 5px 10px;">{{ $order['total']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>