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
        <h1>Edit Admin</h1>
        <div></div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
      var id='<?php echo $_GET["id"]?>';
      var pos='admin';
      $.ajax({
            url:'backend/returnAdmin.php',
            method:"POST",
            data:{
              idPHP:id,
              posPHP:pos
            },
            success:function(response){
                $('.table1').html(response);
            }
        });

        $('.table1').on('click','.del',function(){
          if (confirm("Do You Sure to Remove the Admin?")) {
            var userPos="admin";
            $.ajax({
            url:'backend/deleteUser.php',
            method:"POST",
            data:{
              idPHP:id,
              posPHP:userPos
            },
            dataType:"text",
            success:function(response){
              alert("Admin Removed Successfully!");
              history.back();
            }
        });
  } 
    })   
    $('.table1').on('click','.reset',function(){
          if (confirm("Do You Sure to Reset the Admin's Password to 12345678?")) {
            var userPos="admin";
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
              history.back();
            }
        });
      } 
    });

  });





  </script>
</html>