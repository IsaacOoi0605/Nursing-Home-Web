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
        <h1>Dashboard</h1>

        <div class="table1"></div>

        </div>
    </div>  </div>
</div>

</body>

<script>

  $(document).ready(function(){
    $.ajax({
            url:'backend/returnDash.php',
            method:"POST",
            data:{
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
  

  });





  </script>
</html>
