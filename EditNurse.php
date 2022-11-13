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
        <h1>Edit Nurse</h1>

        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>
<script>
  $(document).ready(function(){
      var id='<?php echo $_GET["id"]?>';
      var userPos="nurse";
      $.ajax({
            url:'backend/returnAdmin.php',
            method:"POST",
            data:{
              idPHP:id,
              posPHP:userPos
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
        
        $('.table1').on('click','.del',function(){
          if (confirm("Do You Sure to Remove the Admin?")) {
            $.ajax({
            url:'backend/deleteUser.php',
            method:"POST",
            data:{
              idPHP:id,
              posPHP:userPos
            },
            dataType:"text",
            success:function(response){
              alert("Nurse Removed Successfully!");
              window.location.href = 'ManageNurse.php';
            }
        });
  } 
    })   
    $('.table1').on('click','.reset',function(){
          if (confirm("Do You Sure to Reset the Password to 12345678?")) {
            var userPos="nurse";
            var pass="12345678";
            $.ajax({
            url:'backend/resetUser.php',
            method:"POST",
            data:{
              idPHP:id,
              posPHP:userPos,
              passPHP:pass
            },
            dataType:"text",
            success:function(response){
              alert("Password Reset Successfully!");
              window.location.href = 'ManageNurse.php';
            }
        });
  } 
    })

  });





  </script>
</html>