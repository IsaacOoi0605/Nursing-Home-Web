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
        <h1>Change Disease</h1>
        <div class='row'>
        <div class='col-6'><div class='btn btn-primary mb-2 cancel' onclick="history.back()">Cancel</div></div>
        <div class='col-6 text-end'><div class='btn btn-primary mb-2 confirm'>Confirm</div></div>
        </div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
    $(document).ready(function(){
    var hosID="<?php echo $_GET['HosID'];?>";
    $.ajax({
            url:'backend/returnCheckDisease.php',
            method:"POST",
            data:{
              HosID:hosID
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    
    $(document).on('click','.confirm',function(){
        var dis=[];
        $(".check").each(function(){
            if(this.checked){
                dis.push($(this).parent().siblings(".disID").text());
            }
        })
        $.ajax({
            url:'backend/disChange.php',
            method:"POST",
            data:{
              dis:dis,
              HosID:hosID
            },
            success:function(response){
                history.back();
            }
        });
    })

  });





  </script>
</html>