<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient Detail</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Patient Detail</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class='btn btn-primary mb-2 float-end update'>Update</div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
      var id='<?php echo $_GET["id"]?>';
      $.ajax({
            url:'backend/returnPatient.php',
            method:"POST",
            data:{
              idPHP:id,
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
        //delete function
        $('.table1').on('click','.del',function(){
          if (confirm("Do You Sure to Remove the Patient?")) {
            $.ajax({
            url:'backend/deletePatient.php',
            method:"POST",
            data:{
              idPHP:id,
            },
            dataType:"text",
            success:function(response){
              alert("Patient Removed Successfully!");
              window.location.href = 'ManagePatient.php';
            }
        });
  } 
    })
    $('.table1').on('click','.checkIn',function(){
          if (confirm("Do You Sure to Check In the Patient?")) {
            var id=$(this).parent().siblings(".id").text();
      //save the id of the patient into session
      $.ajax({
            url:'backend/insertCheckPatient.php',
            method:"POST",
            data:{
              idPHP:id,
            },
            dataType:"text",
            success:function(response){
              window.location.href='selectionBed.php';
            }
        });
  } 
    })   
    $(document).on('click','.update',function(){
      window.location.href='UpdatePatient.php?id='+id;
    })

  });





  </script>
</html>