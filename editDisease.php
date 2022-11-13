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
          <h1>Edit Disease Detail</h1>
          <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
          <div class="table1"></div>
          <div class="text-center">
          <div class="btn-primary btn inline-block confirm">Confirm</div>
          <div class="btn-danger btn inline-block remove">Remove</div>
</div>
        </div>
      </div>
    </div>
</div>
</body>
<script>
  $(document).ready(function(){
    var DisName="";
    $.ajax({
            url:'backend/returnDisease.php',
            method:"POST",
            success:function(response){
                $('.table1').hide();
                $('.table1').html(response).slideDown('slow');
                DisName=$('.nameCol').val();
            }
        });
    
      $(document).on('click','.confirm',function(){
        if(!($('.nameCol').val())||$('.nameCol').val()==DisName){
          alert("disease name cannot be empty or be the same!");
        }
        else{
          if (confirm("Do you sure to change the name of the disease?")) {
            if(confirm("Do you wish to apply the changes to the patient who having this disease?")){
              var changes=true;}
            else{
              var changes=false;
            }
            var newDis=$('.nameCol').val();
            $.ajax({
            url:'backend/changeDiseaseName.php',
            method:"POST",
            data:{
              changes:changes,
              disName:DisName,
              newDis:newDis
            },
            success:function(response){
                history.back();
            }
        });
          }
        }
    })
    $(document).on('click','.remove',function(){
      if (confirm("Do you sure to remove disease?")){
        if(confirm("Do you wish to delete the disease from the existing patient?")){
              var changes=true;}
            else{
              var changes=false;
            }
            $.ajax({
            url:'backend/removeDisease.php',
            method:"POST",
            data:{
              changes:changes,
              disName:DisName,
            },
            success:function(response){
                history.back();
            }
        });
      }
    })
  
    
  });


  </script>
</html>