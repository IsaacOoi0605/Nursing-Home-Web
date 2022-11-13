<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Revenue</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col" > 
        <br>
        <h1>Revenue Forecast</h1>

        <label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
<span class="btn btn-primary confirmDate">Confirm</span>
        <div class="overlay"><div style="width:100%;height:0;padding-bottom:30%;position:relative;"><iframe src="https://giphy.com/embed/KG4PMQ0jyimywxNt8i" width="100%" height="50%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div><p></p>
</div>
        <div class="table1" id="graph"></div>
        </div>
    </div>
  </div>
</div>

</body>
<style>
body.loading{
    overflow: hidden;   
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay{
    display: block;
}

.overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("loader.gif") center no-repeat;
}
</style>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
        $( function() {
    var dateFormat = "m/01/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 3,
          dateFormat:"m/1/yy",
          minDate:"0",
          maxDate:"+6M"
        })
        .on( "change", function() {
          var date = $(this).datepicker("getDate");
          date.setMonth(date.getMonth() + 1);
          to.datepicker( "option", "minDate", date);
          }),
      to = $( "#to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 3,
        dateFormat:"m/1/yy",
        maxDate:"+6M"
      })
      .on( "change", function() {
      });
 

  } );
  function getDataPointsFromCSV(csv) {     
         var dataPoints=[];  
         for (var i = 0; i < csv.length; i++)
             if (csv[i].length > 0) {
                 points = csv[i];
                 dataPoints.push({ 
                     x: new Date(Date.parse(points[0],"MM/dd/yyyy")),
                     y: parseFloat(points[1]) 		
                 });
             }
         return dataPoints;
     }
  function generateGraph(dataset,fromDate,toDate) {
    var chart = new CanvasJS.Chart("graph", {
         title: {
              text: "Revenue Forecast from "+fromDate+" to "+toDate,
         },
         exportFileName: "Revenue Forecast from "+fromDate+" to "+toDate,
         exportEnabled: true,
     axisX:{      
         valueFormatString: "D/MMMM/YYYY" ,
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
      $(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
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
            url:'backend/python.php',
            method:"POST",
            data:{
              fromDate:fromDate,
              toDate:toDate
            },
            success:function(response){
              if(response){
                revenue=response;
                parsedTest = JSON.parse(revenue);
                generateGraph(parsedTest,fromDate,toDate);}
                else{
                  $(".table1").html("404 error.Please check the backend site");
                }
            }
        });
    }
})
  </script>

</html>