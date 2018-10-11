
<style type="text/css">
	table td, table th{
		border:1px solid black;
	}
</style>
<div class="container">


	<br/>
	<center>
	 <h1>Ronmar Furniture</h1>
	 <h1 style="align-self: center;">Sales Report</h1>
	  <h2 >{{   $start  }}</h2>
	  <h2 >{{   $end  }}</h2>

	<table>
		<tr>
		<th>Product Name </th>
        <th>Quantity</th>
         <th>Payment method</th>
         <th>Total</th>
			
		</tr>
		<?php 
		$total = 0.00;

		?>
		@foreach ($records as $key =>  $item)
		<tr>
			<td>{{  $item->product_name  }}</td>
			<td>{{ $item->product_sales_quantity }}</td>
			<td>{{ $item->payment_method }}</td>
			<td>{{ $item->order_total}}</td>
		</tr>

		<?php 
		$str1 = $item->order_total;
          $str = str_replace(",", "", $str1);
          $total = $total + $str;
		//$total +=$item->order_total; ?>
		@endforeach
		<tr>
			<td>Overall Total</td>
			<td></td>
			<td></td>
			<td><?php echo number_format($total) ?></td>
		</tr>
	</table>

	  
</div>