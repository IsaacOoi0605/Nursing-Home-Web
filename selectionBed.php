<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bed Level Selection</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Select Bed</h1>
        <button class="btn btn-primary btn-lg prev" onclick="history.back()">Back</button>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    //retrieve patient who has no hospitalised
    $.ajax({
            url:'backend/bedSelPat.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
            }
        });
    //the select bed button
    $('.table1').on('click','.sel',function(){
      //get the name series of the bed
      var bedSeries=$(this).parent().siblings(".bedLevel").text();
      //save the id of the patient into session
      $.ajax({
            url:'backend/insertCheckPatient.php',
            method:"POST",
            data:{
              bedSeries:bedSeries,
            },
            dataType:"text",
            success:function(response){
              window.location.href='selectionBedNo.php';
            }
        });
      })
  });
  </script>
</html>