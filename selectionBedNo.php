<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bed Number Selection</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Select Bed</h1>
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
            url:'backend/bedNoSel.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
            }
        });
    //the select bed button
    $('.table1').on('click','.ava',function(){
        //get the number of bed
        var bedID=parseInt(($(this).text()).slice(-3));
        $.ajax({
            url:'backend/insertCheckPatient.php',
            method:"POST",
            data:{
              bedID:bedID,
            },
            dataType:"text",
            success:function(response){
              window.location.href='selectionDisease.php';
            }
        });
      })

      $('.table1').on('click','.no',function(){
        //get the number of bed
        alert("This bed is not available!");
      })
  });
  </script>
</html>