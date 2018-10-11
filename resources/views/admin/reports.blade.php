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
 
  <button  onclick="search()" class="btn btn-default">SalesReport</button>
  {{-- <button  onclick="inventory()" class="btn btn-default">Inventory</button> --}}



<a href="{{ route('pdfview',['download'=>'admin.pdfview']) }}">Download PDF</a>

<div class="container">
  
       
  <table class="table">
    <thead>
      <tr>
        <th>Product Name </th>
        <th>Quantity</th>
         <th>Payment method</th>
         <th>Total</th>
         
          
      </tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
</div>


 

<script type="text/javascript">


  function search()
  {
    var Name=$('#startdate').val();
    var company=$('#enddate').val();

    $.ajax({

      type : 'get',

      url: './getdata',


      data:{

        'Name':Name,
        'company':company,
      },
      success:function(records){
        var  rows = '';
        var grand_total = 0.00;
        $.each( records, function( key, value ) {
          rows = rows + '<tr>';

          rows = rows + '<td>'+value.product_name+'</td>';
          rows = rows + '<td>'+value.product_sales_quantity+'</td>';
          rows = rows + '<td>'+value.payment_method+'</td>';
          rows = rows + '<td>'+value.order_total+'</td>';        
          rows = rows + '</td>';
          rows = rows + '</tr>';
          str = value.order_total;
          str = str.replace(",", "");
          grand_total = grand_total+parseFloat(str);

        });

        rows = rows + '<tr>';

        rows = rows + '<td><strong> OverallTotal </strong></td>';
        rows = rows + '<td></td>';
        rows = rows + '<td></td>';
        rows = rows + '<td><strong>'+grand_total.toFixed(2)+'</strong></td>';        
        rows = rows + '</td>';
        rows = rows + '</tr>';
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