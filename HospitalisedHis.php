<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hospitalised Record</title>
<?php include 'begin.php';?>
    <div class="row">
      <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col" > 
        <br>
        <h1>Hospitalised Record</h1>
        <label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
<span class="btn btn-primary confirmDate">Confirm</span>

        <div class="table1"></div>

      </div>
    </div>
  </div>
</div>

</body>

<script>
      $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
          maxDate: "0"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        maxDate: "0"

      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  
$(document).on('click','.confirmDate',function(){
    if($('#from').val()){
    var fromDate=$('#from').val();}
    else{
        alert("Date should not be empty!");
    }
    if($('#to').val()){
        var toDate=$('#to').val();}
    else{
        alert("Date should not be empty!");
    }
    if(fromDate&&toDate){
        $.ajax({
            url:'backend/returnHosHis.php',
            method:"POST",
            data:{
                fromDate:fromDate,
                toDate:toDate
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    }
})

$('.table1').on('click','.view',function(){
    var id=$(this).parent().siblings(".PatID").text();
      var HosID=$(this).parent().siblings(".HosID").text();
      window.location.href="ViewPatient.php?id="+id+"&HosID="+HosID;})

 $('.table1').on('keyup','.searchCol',function(){
    var search=$(this).val();
    if($(this).val()){
        $("tr").each(function(){
        if($(this).children(".name").text().includes(search)){
            $(this).show();
        }
        else{
            $(this).hide();
    }});
    }
    else{
        $("tr").show();
    }
})


  </script>
</html>