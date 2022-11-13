<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bed Number Selection</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Select Bed</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <h3>Current bed choosing:<?php echo $_GET['bed']?></h3>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    var bedLevel="<?php echo $_GET['bedLevel']; ?>";
    var id="<?php echo $_GET['id']; ?>";
    var hosid="<?php echo $_GET['HosID']; ?>";
    //retrieve patient who has no hospitalised
    $.ajax({
            url:'backend/returnBedSeries.php',
            method:"POST",
            data:{
                bedSeriesPHP:bedLevel,
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    //the select bed button
    $('.table1').on('click','.ava',function(){
        //get the number of bed
        var bedID=parseInt(($(this).text()).slice(-3));
        if(confirm("Are you sure to change to this bed?")){
        $.ajax({
            url:'backend/changeBed.php',
            method:"POST",
            data:{
              bedLevel:bedLevel,
              bedID:bedID,
              patID:id
            },
            dataType:"text",
            success:function(response){
              window.history.go(-3);
            }
        });}
      })

      $('.table1').on('click','.no',function(){
        //alert bed not available
        alert("This bed is not available!"); 
      })
  });
  </script>
</html>