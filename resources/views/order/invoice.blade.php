<html>
	<head>
		<meta charset="utf-8">
    <title>{{ $order->user->name }}</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Invoicebus Invoice Template">
    <meta name="author" content="Invoicebus">
    <style>

      /* reset */
    @font-face {
        font-family: bangla;    
        font-weight: 400;
        font-weight:normal;
        font-style: normal;
      }
      body {
        font-family: bangla;
      }

      body, html{
        background-color: #ffffff;
        font-size: 15px;
        font-family: bangla;
        border: 0;
        box-sizing: content-box;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
      }
   
    /* heading */

    h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

    /* table */

    table { font-size: 75%; table-layout: fixed; width: 100%; }
    table { border-collapse: separate; border-spacing: 2px; }
    th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
    th, td { border-radius: 0.25em; border-style: solid; }
    th { background: #EEE; border-color: #BBB; }
    td { border-color: #DDD; }

    /* page */

    html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
    html { background: #999; cursor: default; }

    body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
    body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

    /* header */

    header { margin: 0 0 3em; }
    header:after { clear: both; content: ""; display: table; }

    header h1 { background: #80b10a; border-radius: 0.25em; color: #FFF; padding: 0.5em 0; }
    header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
    header address p { margin: 0 0 0.25em; }
    header span, header img { display: block; margin-left: 400px; }
    header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
    header img { max-height: 100%; max-width: 100%; }
    header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

    /* article */

    article, article address, table.meta, table.inventory { margin: 0 0 3em; }
    article:after { clear: both; content: ""; display: table; }
    article h1 { clip: rect(0 0 0 0); position: absolute; }

    article address { float: left; font-size: 125%; font-weight: bold; }

    /* table meta & balance */

    table.meta, table.balance { margin-left:400px; margin-top:0px; }
    table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

    /* table meta */

    table.meta th { width: 40%; }
    table.meta td { width: 60%; }

    /* table items */

    table.inventory { clear: both; width: 100%; }
    table.inventory th { font-weight: bold; text-align: center; }

    table.inventory td:nth-child(1) { width: 26%; }
    table.inventory td:nth-child(2) { width: 38%; }
    table.inventory td:nth-child(3) { text-align: right; width: 12%; }
    table.inventory td:nth-child(4) { text-align: right; width: 12%; }
    table.inventory td:nth-child(5) { text-align: right; width: 12%; }

    /* table balance */

    table.balance th, table.balance td { width: 50%; }
    table.balance td { text-align: right; }

    /* aside */

    aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
    aside h1 { border-color: #ffffff; border-bottom-style: solid; }

    /* javascript */

    .add, .cut
    {
      border-width: 1px;
      display: block;
      font-size: .8rem;
      padding: 0.25em 0.5em;	
      float: left;
      text-align: center;
      width: 0.6em;
    }

    .add, .cut
    {
      background: #9AF;
      box-shadow: 0 1px 2px rgba(0,0,0,0.2);
      background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
      background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
      border-radius: 0.5em;
      border-color: #0076A3;
      color: #FFF;
      cursor: pointer;
      font-weight: bold;
      text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
    }

    .add { margin: -2.5em 0 0; }

    .add:hover { background: #00ADEE; }

    .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
    .cut { -webkit-transition: opacity 100ms ease-in; }

    tr:hover .cut { opacity: 1; }

    @media print {
      * { -webkit-print-color-adjust: exact; }
      html { background: none; padding: 0; }
      body { box-shadow: none; margin: 0; }
      span:empty { display: none; }
      .add, .cut { display: none; }
    }

   @page { 
   @top-center{
          content: "{{ date('Y/m/d') }}"; 
      }
    }
    div#printhead {
    position: fixed; top: 0; left: 0; width: 100%; height: 20em;
    padding-bottom: 1em;
    border-bottom: 1px solid;
    margin-bottom: 10px;
    }

    @media screen {
      div#printhead {
      }
      div#docbody {
      margin-top: 0;
      }
    }

    @media print {
      div#printhead {
      display: block;
      }
      div#docbody {
      margin-top: 3em;
      }
    }
    </style>
	</head>
	<body>
    <htmlpageheader name="page-header">
      {{ date("Y/m/d") }}
    </htmlpageheader>
		<header>
			<h1>Invoice</h1>
      <img style="margin-left:500px;width:300px;" alt="" src="{!! public_path('adminAssets/images/logo-text.png') !!}">
			<address>
        <h3>Ship To</h3>
				<p>{{ $order->user->name }}</p>
				<p>{{ implode(', ',$order->user->addresses()->where('is_default',1)->pluck('area')->toArray()) }}<br>{{ implode(', ', $order->user->addresses()->where('is_default',1)->pluck('address')->toArray()) }}</p>
				<p>{{ implode(', ', $order->user->addresses->where('is_default',1)->pluck('mobile_number')->toArray()) }}</p>
			</address>
      
		</header>
    
		<article>
			<table class="meta" style="margin-top:-50px;">
				<tr>
					<th><span>Invoice #</span></th>
					<td><span>{{ $order->invoice_number }}</span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span>{{ date("F d, Y",strtotime($order->order_date)) }}</span></td>
				</tr>
				<tr>
					<th><span>Amount Due</span></th>
					<td><span id="prefix">৳</span><span>{{ $order->total_price }}</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Item</span></th>
						<th><span>Description</span></th>
						<th><span>Rate</span></th>
						<th><span>Quantity</span></th>
						<th><span>Price</span></th>
					</tr>
				</thead>
				<tbody>
          @foreach($order->productOrders as $key => $product)
					<tr>
						<td><span>{{ $product->product_name }}</span></td>
						<td><span> </span></td>
						<td><span data-prefix>৳</span><span>{{ $product->price }}</span></td>
						<td><span>{{ $product->quantity }}</span></td>
						<td><span data-prefix>৳</span><span>{{ $product->price * $product->quantity }}</span></td>
					</tr>
          @endforeach
				</tbody>
			</table>
		 
			<table class="balance">
				<tr>
					<th><span>Sub Total</span></th>
					<td><span data-prefix>$</span><span>{{ $order->total_price }}</span></td>
				</tr>
				<tr>
					<th><span>Amount Paid</span></th>
					<td><span data-prefix>৳</span><span>
            @if($order->payment_status == 'Unpaid') 
            00.0
            @else
            {{ $order->total_price }}
            @endif
          </span></td>
				</tr>
        <tr>
					<th><span>Delivery Charge</span></th>
					<td><span data-prefix>৳</span><span>{{ $order->delivery_charge }}</span></td>
				</tr>
				<tr>
					<th><span>Balance Due</span></th>
					<td><span data-prefix>৳</span><span>
            @if($order->payment_status == 'Unpaid') 
            {{ $order->total_price }}
            @else
              00.0
            @endif
          </span></td>
				</tr>
        <tr>
					<th><span>Total Amount</span></th>
					<td><span data-prefix>৳</span><span>{{ $order->total_price + $order->delivery_charge }}</span></td>
				</tr>

			</table>
		</article>
		<!-- <aside>
			<h1><span>Additional Notes</span></h1>
			<div>
				<p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
			</div>
		</aside> -->
    <htmlpagefooter name="page-footer">
      <b>Powered By: </b><a href="https://grocerbd.com" style="color: #000000;text-decoration: none;"> Grocers BD</a>
    </htmlpagefooter>
	</body>
</html>