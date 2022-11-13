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
        <h1>Add Bed Level</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class="table1"></div>


        <form>
            <div class="form-group">
              <label for="bedName">Bed Name</label>
              <input type="text" class="form-control bedName" id="bedName"placeholder="Naming" onkeypress="return Validate(event);">
              <p class="errorMsg text-danger"></p>
            </div>
            <br>
            <div class="form-group">
              <label for="numBed">Number Of Bed</label>
              <input type="number" class="form-control numBed" id="numBed" placeholder="Number of Bed" >
              <p class="errorMsg text-danger"></p>
            </div>
            <br>
            <div class="form-group">
              <label for="priceBed">Price Of Bed</label>
              <input type="number" class="form-control priceBed" id="priceBed" placeholder="Price of Bed" >
              <p class="errorMsg text-danger"></p>
            </div>
            <br>
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary mx-auto w-10 confirm" >Confirm</button>
            </div>

          </form>

        </div>
    </div>  </div>
</div>

</body>

<script>

  $(document).ready(function(){

    $(".form-control").keyup(function(){
      if($(this).val().trim().length== 0){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
    })
    $(".confirm").click(function(){
      var error;
    $('.form-control').each(function() {
        if ($(this).val().trim().length== 0) {
          $(this).siblings(".errorMsg").text("This column should not be empty!");
          error="1";
        }
        });
        var numBed=$('.numBed').val();
        numBed=parseInt(numBed, 10);
      if(numBed===0){
        $('.numBed').siblings(".errorMsg").text("This should bigger than 0");
        error="1";
      }
      else if(numBed>100){
        $('.numBed').siblings(".errorMsg").text("This should not bigger than 100");
        error="1";
      }
      var priceBed=$('.priceBed').val();
        priceBed=parseInt(priceBed, 10);
      if(priceBed===0){
        $('.priceBed').siblings(".errorMsg").text("This should bigger than 0");
        error="1";
      }
      var bedName=$(".bedName").val();
      bedName=bedName.toUpperCase();
      if(error){
      }
      else{
        $.ajax({
            url:'backend/addBed.php',
            method:"POST",
            data:{
              bedName:bedName,
            },
            success:function(response){
                if(response=="1"){
                  alert("Name has been taken");
                }
                else{
                  for (let i = 1; i <=numBed; i++) {
          $.ajax({
            url:'backend/addBed.php',
            method:"POST",
            data:{
              number:i,
              bedName:bedName,
              priceBed:priceBed
            },
            success:function(response){
                window.location.href = "ManageBed.php";
            }
        });
        }
                }
            }
        });

      }
      
      });
  });

  function Validate(e) {
        var keyCode = e.keyCode || e.which;
        var regex = /^[A-Za-z]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        return isValid;
    }




  </script>
</html>