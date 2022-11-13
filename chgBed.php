<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Bed</title>
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
      var bedLevel=$(this).parent().siblings(".bedLevel").text();
      //proceed to bed number selection
      window.location.href="chgBedNo.php?bedLevel="+bedLevel+"&bed=<?php echo $_GET['bed'];?>"+"&id="+"<?php echo $_GET['id'];?>"+"&HosID="+"<?php echo $_GET['HosID'];?>";
  });
})
  </script>
</html>