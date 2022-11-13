<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Check In Confirmation</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Check In Confirmation</h1>
        <div class="mb-2">
        <button class="btn btn-primary btn-lg prev" onclick="history.back()">Back</button>
        <button class="btn btn-primary btn-lg float-end confirm">Confirm</button>
        </div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    //retrieve patient check in info from the database
    $.ajax({
            url:'backend/returnConfirm.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
            }
        });
    //confirm button
    $(document).on('click','.confirm',function(){
      $.ajax({
            url:'backend/checkInNew.php',
            method:"POST",
            success:function(response){
                window.location.href='CheckInPatient.php';
            }
        });
    })
  });
  </script>
</html>