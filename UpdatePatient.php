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
        <h1>Update Patient</h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class='btn btn-primary mb-2 float-end confirm'>Confirm</div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
      var id='<?php echo $_GET["id"]?>';
      
      $.ajax({
            url:'backend/updateReturnPatient.php',
            method:"POST",
            data:{
              idPHP:id,
            },
            success:function(response){
                $('.table1').html(response);
                $("#blah").hide();
            }
        });

    $(document).on('click','.confirm',function(){
      var error;
      //validate no empty input
      $('.form-control').each(function() {
        if($(this).attr("id")=='IC'){
          if($(this).val().length!=12){
            $(this).siblings(".errorMsg").text("Please Enter Valid IC Number");
            error="1";
          }
        }
        if($(this).attr("id")=='userPhone'){
          if($(this).val().length!=11&&$(this).val().length!=10){
            $(this).siblings(".errorMsg").text("Please Enter Valid Phone Number");
            error="1";
          }
        }
        if ($(this).val() == '') {
          $(this).siblings(".errorMsg").text("This column should not be empty!");
          error="1";
        }
        });
      //validate state selection
      if($('#State option:selected').text()==="Choose State"){
        $('#State').siblings(".errorMsg").text("Please Choose State of the Address!");
        error="1";
      }
      //if error exist means some column is missing input alert the user to enter input
      if(error){
        alert("Please ensure every column is filled up with valid information!");
      }
      else{
      const form = document.getElementById('form');
        const formData = new FormData(form);
        formData.append('userID',$("#ID").val());
        formData.append('username',$("#name").val());
        formData.append('userIC',$("#IC").val());
        formData.append('userPhone',$("#Phone").val());
        formData.append('userAdd',$("#Address").val());
        formData.append('userZip',$("#postcode").val());
        formData.append('userState',$('#State').val());
        $.ajax({
            url:'backend/updatePatientInfo.php',
            method:"POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
              if(response){
                history.back();
              }
            }
        });}
    })

    $(document).on('keyup','.form-control',function(){
      if($(this).val()==""){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
    })
  });

  function showImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result).width(150).height(200);
        };
        $('#blah').show();
       reader.readAsDataURL(input.files[0]);
       var youtubeimgsrc = $('#blah').attr("src");
  }
}




  </script>
</html>