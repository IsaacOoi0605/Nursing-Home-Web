<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Medicine</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"> 
        <h2>View Medicine</h2>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class='btn btn-primary mb-2 float-end confirm' >Confirm</div>
        <div class="table1"></div>
      </div>
    </div>

  </div>
</div>

</body>

<script>
  var medID='<?php echo $_GET['mID']?>';
  var medName="";
  $(document).ready(function(){
    $.ajax({
            url:'backend/returnMedicine.php',
            method:"POST",
            data:{
              medID:medID
            },
            success:function(response){
              $('.table1').html(response).slideDown('slow');
              medName=$("#MedName").val();
            }
        });
      $('.table1').on('click','.add',function(){
      var variant='<div class="form-group mb-2 variant"><div class="row"><div class="col-10"><input type="text" class="form-control weightCol" placeholder="Enter Variant Weight(mg)"></div><div class="col-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg></div></div></div>';
      $(variant).insertBefore($(this));
    })
      })
    $('.table1').on('click','.bi',function(){
      $(this).parent().parent().parent().remove();
    })
    $(document).on('click','.removeMed',function(){
      if(confirm("Do you sure to remove the medicine")){
        var remove;
        if(confirm("Do you wish to remove the medicine from the hospitalised patient?")){
          remove=1;
        }
      $.ajax({
            url:'backend/removeMedicine.php',
            method:"POST",
            data:{
              medID:medID,
              remove:remove
            },
            success:function(response){
              history.back();
            }
        });}
    })
    $(document).on('click','.confirm',function(){
      var error=0;
      const varMed=[];
      if(!($('#MedName').val())){
        alert("Medicine Name cant be empty!");
        error=1;
      }
      if(!($('.variant').length)){
        error=2;
      }

      $(".weightCol").each(function(){
        if(!($(this).val())){
         error=1;
        }
        else{
          varMed.push($(this).val());
        }
      })
      if(error==1){
          alert("Plesae ensure all column is filled up"); 
        }
        else if (error==2){
          alert("Number of variant should not less than 0");
        }
        else{
          var newName=$("#MedName").val();
          if(newName==medName){
            newName="";
          }
          $.ajax({
            url:'backend/editMedicine.php',
            method:"POST",
            data:{
              medID:medID,
              varMed:varMed,
              newName:newName
            },
            success:function(response){
              if(response){alert(response);
              history.back();}
              else{
                alert("medicine name has been taken");
              }
            }
        });
        }
    })


    
  </script>
</html>