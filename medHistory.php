<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medication History</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Medication History</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">back</div>

        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
    $(document).ready(function(){
      var hosID="<?php echo $_GET['HosID'];?>";
    $.ajax({
            url:'backend/returnMedHistory.php',
            method:"POST",
            data:{
              HosID:hosID
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
  });





  </script>
</html>