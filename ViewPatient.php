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
        <h1>Patient Details</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
    $(document).ready(function(){
    var id="<?php echo $_GET['id'];?>";
    var hosID="<?php echo $_GET['HosID'];?>";
    $.ajax({
            url:'backend/returnCheckPatient.php',
            method:"POST",
            data:{
              id:id,
              HosID:hosID
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    
    $(document).on('click','.viewMore',function(){
      $.ajax({
            url:'EditPatient.php',
            method:"POST",
            data:{
              idPHP:id,
            },
            dataType:"text",
        });
        window.location.href="EditPatient.php?id="+id;
    })

    $(document).on('click','.checkOut',function(){
      if (confirm("Do You Sure to Check Out the Patient?")) {
        $.ajax({
            url:'backend/checkOutPatient.php',
            method:"POST",
            data:{
              id:id
            },
            success:function(response){
                window.location.href="CheckInPatient.php";
            }
        }); 
          }
    })

    $(document).on('click','.chgBed',function(){
      if (confirm("Do change the bed of the patient?")) {
        window.location.href="chgBed.php?bed="+$(".bed").val()+"&id="+id+"&HosID="+hosID;
          }
    })

    $(document).on('click','.chgDis',function(){
      if (confirm("Do change the disease having of the patient?")) {
        window.location.href="changeDis.php?HosID="+hosID;
          }
    })

    $(document).on('click','.viewDis',function(){
      window.location.href="diseaseHistory.php?HosID="+hosID;
    })

    $(document).on('click','.chgMed',function(){
      window.location.href="changeMed.php?HosID="+hosID;
    })

    $(document).on('click','.viewMed',function(){
      window.location.href="MedHistory.php?HosID="+hosID;
    })
  });





  </script>
</html>