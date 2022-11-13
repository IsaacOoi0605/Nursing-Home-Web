<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Admin</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Add New Medicine</h2>
      <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>

        <form id='form'>
            <br>
            <div class="form-group">
                <label for="MedName">Enter Medicine Name:</label>
                <input type="text" class="form-control nameCol" id="MedName" placeholder="Enter Medicine Name">
                <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
                <label>Please Enter the Variant:</label>
                <div class="bg-light rounded container-fluid pt-2 pb-2 border border-secondary">
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="form-control weightCol" placeholder="Enter Weight (mg)">
                    </div>
                </div>
                </div>
                <div class="row container-fluid mt-4 addB"><button class="btn btn-outline-secondary col-12 add" type="button">+</button></div>
            </div>
              <br>
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary mx-auto w-10 confirm" >Confirm</button>
            </div>

          </form></div>
        </div>
    </div>

  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    $(".imgView").hide();
    //add button
    $(".add").click(function(){
        $('<div class="bg-light rounded container-fluid pt-2 pb-2 mt-2 border border-secondary" id="new"><div class="row"><div class="col-11"><input type="text" class="form-control weightCol" placeholder="Enter Weight (mg)"></div><div class="col-1 pt-3"><button class="btn btn-danger del" type="button">-</button></div></div></div>').insertBefore( ".addB" );
    })
    //error message validation
    $(".form-control").keyup(function(){
      if($(this).val().trim().length== 0){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
    })
    //confirm button
    $(".confirm").click(function(){
      var error;
      //prevent empty input
      $('.form-control').each(function() {
        if ($(this).val().trim().length== 0) {
          $(this).siblings(".errorMsg").text("This column should not be empty!");
          error="1";
        }
        });
      //if got error
      if(error){
        alert("Please ensure every column is filled up!");
      }
      //else no error
      else {
        const all=[];
        $('.weightCol').each(function(){
          all.push($(this).val());
        });
        const form = document.getElementById('form');
        const formData = new FormData(form);
        formData.append('allPHP',all);
        formData.append('namePHP',$(".nameCol").val());
        $.ajax({
            url:'backend/insertNewMedicine.php',
            method:"POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
              if(response){
              window.location.href = "ManageMedicine.php";}
              else{
                alert("Medicine Name has been taken");
              }
            }
        });}

    });
    //delete function
    $(document).on('click','.del',function(){
      $(this).parent().parent().parent().remove();
    })
  });




  </script>
</html>