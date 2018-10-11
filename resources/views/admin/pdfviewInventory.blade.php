<style type="text/css">
	table td, table th{
		border:1px solid black;
	}
</style>
<div class="container">


	<br/>
	<center>
	 <h1>Ronmar Furniture</h1>
	 <h1 style="align-self: center;">Inventory Report</h1>
	  <h2 >{{   $start  }}</h2>
	  <h2 >{{   $end  }}</h2>

	<table>
		<tr>
		 <th>Category</th>
        <th>Product name</th>
        <th>Stock Remaining</th>
        <th>Stock Sold</th>
			
		</tr>
		@foreach ($records as $key =>  $item)
		<tr>
			<td>{{  $item->category_name  }}</td>
			<td>{{ $item->product_name }}</td>
			<td>{{ $item->product_size }}</td>
			<td>{{ $item->product_sales_quantity}}</td>
		</tr>
		@endforeach
	</table>

	  
</div>