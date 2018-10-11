@extends('admin_layout')
@section('admin_content')

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--   Core JS Files   -->


<link rel="script" href="{{URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}">

  <div class="form-group">
    <label for="Date">Start Date</label>
    <input type="Date" name="startdate" class="form-control" id="startdate">
  
  <div class="form-group">
    <label for="Date">End Date</label>
    <input type="Date" name="enddate"  class="form-control" id="enddate">
  </div>
 
  {{-- <button  onclick="search()" class="btn btn-default">SalesReport</button> --}}
  <button  onclick="inventory()" class="btn btn-default">Inventory</button>



<a href="{{ route('pdfviewInventory',['download'=>'admin.pdfviewInventory']) }}">Download PDF</a>

<div class="container">
  
       
  <table class="table">
    <thead>
      <tr>
        <th>Category</th>
        <th>Product name</th>
        <th>Stock Remaining</th>
        <th>Stock Sold</th>
         
        
          
      </tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
</div>


 

<script type="text/javascript">

  function inventory()
  {

    var Name=$('#startdate').val();
    var company=$('#enddate').val();
    
    $("tbody").html('');

    $.ajax({ 
      type : 'get', 
      url: './getInventoryData',
      data:{
      },
      success:function(records){

var  rows = '';
$.each( records, function( key, value ) {
  rows = rows + '<tr>';
  rows= rows+'<td>'+value.category_name+'</td>';
  rows= rows+'<td>'+value.product_name+'</td>';
  rows= rows+'<td>'+value.product_size+'</td>';
  rows= rows+'<td>'+value.product_sales_quantity+'</td>';
  rows = rows + '</tr>'; 
});
$("tbody").html(rows);
}
});
}
 
 
</script>
 
<script type="text/javascript">
 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 
</script>
 



 @endsection