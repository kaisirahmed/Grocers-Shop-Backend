<!DOCTYPE html>
<html lang="bn" xml:lang="bn">
<head>
	<title>{{ _('All Stock Lists') }}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminAssets/images/logo.png') }}">
<style type="text/css" media="print">
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
	  font-family: bangla;
	}
 
	.invoice h2, .invoice h3, .invoice h4{
	  text-align: center;
	  margin: 0px;
	  font-family: bangla;
	}
	.invoice h5{
	  text-align: center;
	  margin-bottom: 5px; 
	  line-height: 1.5;
	  font-family: bangla;
	}
	table.invoice{
	  border: .1px solid #000;
	  font-weight: normal;
	  font-size: 15px;
	  font-family: bangla;
	  overflow: hidden;
	  position: absolute;
	  z-index: 2;
	}
    .pageNo {
        margin-left: 3cm;
    }
	.invoice-head{
	  top: 0px;
	  text-align: center;
	}
	table.invoice-foot th, table.invoice-foot td{
	  border: 0px;
	  font-weight: normal;
	  font-size: 10px;
	}
	@page {
		header: page-header;
		footer: page-footer;
	}
	.invoice-footer{  
	  text-align: center;
	  display: block;
	}
	 
	.image{
	  width:100%;
	  height: 100%;
	  overflow: hidden;
	  background:url({!! public_path("adminAssets/images/logo.png") !!});
	  background-repeat:no-repeat;
	  background-position:center;
	  background-color: #ffffff;
	  position:absolute;
   	  z-index:1;
	  opacity:0.6;
	  filter:alpha(opacity=60);
	  }
</style>
</head>
<body>
	<htmlpageheader name="page-header">
		{{ date("Y/m/d") }}
	</htmlpageheader>
 <table>
    <tr>
       <td width="110px"></td>
       <td width="80%" align="center">
        <span class="invoice-head">{{ config('pdf.author') }}</span>
        <h3>Stock</h3>
      </td>
      <td></td>
    </tr>
  </table>  
<br/><br/>
 	<table class="invoice" width="100%" border="1" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
	            <th>#</th>
                <th>Product Name</th>
                <th>Current Quantity</th>
                <th>Selling Quantity</th>
                <th>Total Quantity</th>
                <th>Status</th>
	        </tr>
	    </thead>
	    <tbody style="background:url({!! base_path('adminAssets/images/logo.png') !!})">
            @foreach($stocks as $key => $stock)
            <tr> 
                <td>{{ $key+1 }}</td>
                <td>{{ $stock->product->name.' '.$stock->product->sub_name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{!! $stock->selling_quantity !== null ? $stock->selling_quantity : '<p class="tm-tag-invalid">None</p>' !!}</td>
                <td>{{ $stock->total_quantity }}</td>
                <td>
					@if($stock->quantity > 10)
					<span class="badge badge-success">In Stock</span>
					@elseif($stock->quantity > 4 && $stock->quantity < 10)
					<span class="badge badge-warning">Low Stock</span>
					@else
					<span class="badge badge-danger">Out Of Stock</span>
					@endif
                <td>
            </tr>
			@endforeach
		</tbody>
	</table>
 <br>

<htmlpagefooter name="page-footer">
	<div style="text-align:center">
		<b>Powered By:</b><a href="#" style="color: #000000;">Grocers</a>
	</div>
    <span class="pageNo">{PAGENO}</span>
</htmlpagefooter>
</body>
</html> 