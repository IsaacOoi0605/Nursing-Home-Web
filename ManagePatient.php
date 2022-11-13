<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patient Management</title>
<?php include 'begin.php';?>
    <div class="row">
      <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col" > 
        <br>
        <h1>Manage Patient</h1>

        <div class="table1"></div>

      </div>
    </div>
  </div>
</div>

</body>

<script>
  var handlePost="patient";
  $(document).ready(function(){
    $.ajax({
            url:'backend/selectAll.php',
            method:"POST",
            data:{
              
            },
            success:function(response){
                $('.table1').html(response);
            }
        });

    
    $('.table1').on('click','.edi',function(){
      var id=$(this).parent().siblings(".id").text();
        window.location.href="EditPatient.php?id="+id;})

    $('.table1').on('click','.add',function(){
      <?php
            $_SESSION["userHandle"] = "Patient";?>
      window.location.href = "AddPatient.php";
    })

    $('.table1').on('keyup','.searchCol',function(){
      var input=$(".searchCol").val();
      if(input){
      $.ajax({
            url:'backend/searchCol.php',
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
            url:'backend/selectAll.php',
            method:"POST",
            data:{
              
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