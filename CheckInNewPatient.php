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
        <h1>Select Patient</h1>
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
            url:'backend/selectAllCheckPatient.php',
            method:"POST",
            data:{
              inputPHP:"noCheck"
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    //the select patient button
    $('.table1').on('click','.sel',function(){
      //get the id of the patient
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
      })
    //search column function
    $('.table1').on('keyup','.searchCol',function(){
      var input=$(".searchCol").val();
      if(input){
      $.ajax({
            url:'backend/searchColCheckIn.php',
            method:"POST",
            data:{
              inputPHP:input,
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
              inputPHP:"noCheck"
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