<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Admin</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Manage Check-In Patient</h1>

        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    $.ajax({
            url:'backend/selectAllCheckPatient.php',
            method:"POST",
            data:{
              inputPHP:"check"
            },
            success:function(response){
                $('.table1').html(response);
            }
        });

    
    $('.table1').on('click','.view',function(){
      var id=$(this).parent().siblings(".id").text();
      var HosID=$(this).parent().siblings(".HosID").text();
        window.location.href="ViewPatient.php?id="+id+"&HosID="+HosID;})

    $('.table1').on('click','.checkIn',function(){
      window.location.href = "CheckInNewPatient.php";
    })

    $('.table1').on('keyup','.searchCol',function(){
      var input=$(".searchCol").val();
      if(input){
      $.ajax({
            url:'backend/searchColCheckIn.php',
            method:"POST",
            data:{
              inputPHP:input,
              validate:"check"
            },
            dataType:"text",
            success:function(response){
              $("table").remove();
              $(".table1").children("h1").remove();
              $('.table1').append(response);
            }
        });}
        else{
          $.ajax({
            url:'backend/selectAllCheckPatient.php',
            method:"POST",
            data:{
              inputPHP:"check"
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
        }
    })

  });





  </script>
</html>