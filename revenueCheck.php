<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Revenue Explorer</title>
<?php include 'begin.php';?>
    <div class="row">
      <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col" > 
        <br>
        <h1>Revenue Explorer</h1>
        <label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
<span class="btn btn-primary confirmDate">Confirm</span>

        <div class="table1" id="content"></div>

      </div>
    </div>
  </div>
</div>

</body>

<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
    function getDataPointsFromCSV(csv) {     
         var dataPoints=[];  
         for (var i = 0; i < csv.length; i++)
             if (csv[i].length > 0) {
                 points = csv[i];
                 const [month, day, year] = points[0].split('/');
                 dataPoints.push({ 
                  x: new Date(Date.parse(points[0],"MM/dd/yyyy")),
                     y: parseFloat(points[1]) 		
                 });
             }
         return dataPoints;
     }
     function generateGraph(dataset) {
    var chart = new CanvasJS.Chart("content", {
         title: {
              text: "Revenue from "+fromDate+" to "+toDate,
         },
         exportEnabled: true,
     axisX:{      
         valueFormatString: "D/MMMM/YYYY",
         labelAngle: -50
     },
     axisY: {
       valueFormatString: "#,###"
   },
         data: [{
              type: "line",
              dataPoints: getDataPointsFromCSV(dataset)
           }]
      });
     
       chart.render();
}
    var fromDate;
    var toDate;
    let table=true;
      $( function() {
    $('#from, #to').datepicker({
        showOn: "both",
        beforeShow: customRange,
        dateFormat: "m/01/yy",
        maxDate:"0"
    });});

    function customRange(input) {
if (input.id == 'to') {
    var minDate = new Date($('#from').val());
    minDate.setDate(minDate.getDate() + 1)

    return {
        minDate: minDate

    };
}
return {}
}
  function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
$(document).on('click','.confirmDate',function(){
    if($('#from').val()){
    fromDate=$('#from').val();}
    else{
        alert("Date should not be empty!");
    }
    if($('#to').val()){
        toDate=$('#to').val();}
    else{
        alert("Date should not be empty!");
    }
    if(fromDate&&toDate){
        $.ajax({
            url:'backend/returnRevenue.php',
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

$(document).on('click','.showGraph',function(){
  if(!(table)){
  }
  else{
    $.ajax({
            url:'backend/returnRevenue.php',
            method:"POST",
            data:{
              form:"graph",
              fromDate:fromDate,
              toDate:toDate
            },
            success:function(response){
              revenue=JSON.parse(response);
              generateGraph(revenue);
            }
        });  }
  table=false;
})

$(document).on('click','.showTable',function(){
  if(table){ 
  }
  else{
    $.ajax({
            url:'backend/returnRevenue.php',
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
  table=true;
})
  </script>
</html>