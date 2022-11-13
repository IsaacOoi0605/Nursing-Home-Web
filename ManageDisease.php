<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Admin</title>
<?php include 'begin.php';?>

    <div class="row">
      <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
        <div class="col"> 
          <br>
          <h1>Manage Disease</h1>
          <div class="table1"></div>
      
        </div>
      </div>
    </div>
</div>

</body>
<script>
  $(document).ready(function(){
    $.ajax({
            url:'backend/selectAllDisease.php',
            method:"POST",
            success:function(response){
                $('.table1').hide();
                $('.table1').html(response).slideDown('slow');

            }
        });
  
    //add funciton
    $('.table1').on('click','.add',function(){
      window.location.href="AddDisease.php";
    })

    $('.table1').on('click','.view',function(){
      diseaseID=$(this).parent().siblings(".id").text();
      $.ajax({
            url:'backend/returnDisease.php',
            method:"POST",
            data:{
              idPHP:diseaseID,
            },            
            success:function(response){
                window.location.href="editDisease.php";

            }
        });
    })
  });


  </script>
</html>