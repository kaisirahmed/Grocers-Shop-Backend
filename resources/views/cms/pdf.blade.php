<!DOCTYPE html>
<html lang="bn" xml:lang="bn">
<head>
	<title>{{ _('All Page Lists') }}</title>
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
        text-align: center;
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
        <h3>Page List</h3>
      </td>
      <td></td>
    </tr>
  </table>  
<br/><br/>
 	<table class="invoice" width="100%" border="1" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
	            <th width="4%">#</th>
	            <th width="12%">Page Name</th>
	            <th width="12%">Page Name (Bangla)</th>
	            <th width="10%">Permalink</th>
	            <th width="5%">Visibility</th>
	            <th width="8%">Status</th>
	        </tr>
	    </thead>
	    <tbody style="background:url({!! base_path('adminAssets/images/logo.png') !!})">
			@foreach($cms as $key => $cms)
			<tr> 
				<td>{{ $key+1 }}</td>
				<td>{{ $cms->name }}</td>
				<td>{{ $cms->name_bn }}</td>
				<td>{{ $cms->slug }}</td>
				<td><span class="badge badge-{{ $cms->visibility === 1 ? 'success' : 'warning' }}">{{ $cms->visibility === 1 ? 'Public' : 'Private' }}</span></td>
				<td>
					<span class="badge badge-{{ $cms->status === 1 ? 'success' : 'warning' }}">{{ $cms->status === 1 ? 'Active' : 'Inactive' }}</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 <br>

<htmlpagefooter name="page-footer">
	<b>Powered By:</b><a href="#" style="color: #000000">Grocers</a>
    <span class="pageNo">{PAGENO}</span>
</htmlpagefooter>
</body>
</html> 