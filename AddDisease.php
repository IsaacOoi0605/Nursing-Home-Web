<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Admin</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
    <!--content column-->
    <div class="col" >
      <!--title-->
      <h2>Add New Disease</h2>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <!--form-->
      <form id='form'>
        <br>
        <!--disease name-->
        <div class="form-group">
            <label for="MedName">Enter Disease Name:</label>
            <input type="text" class="form-control nameCol" id="MedName" placeholder="Enter Disease Name">
            <p class="errorMsg text-danger"></p>
        </div>
        <!--disease name-->
        
        <br>
        <!--confirm button-->
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-primary mx-auto w-10 confirm" >Confirm</button>
        </div>
        <!--confirm button-->
      </form>
        <!--form-->
    </div>
    <!--end of content-->
    </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    //to store the index to locate the disease level
    var handleDisease="";

    //error message validation
    $(".form-control").keyup(function(){
      if($(this).val().trim().length==0){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
    })
    //confirm button
    $(".confirm").click(function(){
      var error=0;
      //ensure no empty input
      $('.form-control').each(function() {
        if ($(this).val().trim().length==0) {
          console.log($(this).attr("class"));
          $(this).siblings(".errorMsg").text("This column should not be empty!");
          error=1;
        }
        })
      //if got empty input
      if(error){
        alert("Please ensure every column is filled up!");
      }
      //else do ajax to submit the data
      else {
        const formData = new FormData();
        formData.append('namePHP',$(".nameCol").val());
        $.ajax({
            url:'backend/insertNewDisease.php',
            method:"POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
              if(response==2){
                alert("Disease Name has been taken");
              }else{
              history.back();}
            }
        });
        }

    });

  });
    
  </script>
</html>