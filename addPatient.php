<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Patient</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Add New <?php echo $_SESSION['userHandle'];?></h2>
      <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>

        <form id='form'>
            <br>
            <div class="form-group">
            <label for="Image">Upload Image:</label>
            <input id="Image" name="img"class="form-control img" type="file" accept='image/png, image/gif, image/jpeg' onchange="showImage(this);"/>
            <br>
              <img id="blah" src="#" alt="your image" />
            </div>
            <br>
            <div class="form-group">
              <label for="Name">Enter Name:</label>
              <input type="text" class="form-control nameCol" id="Name" placeholder="Enter Patient's Name">
              <p class="errorMsg text-danger"></p>
            </div>
            
              <div class="form-group">
              <div class="form-group">
              <label for="IC">Enter IC Number:</label>
              <input type="text" class="form-control ICCol" id="IC" placeholder="Enter Patient's IC Number">
              <p class="errorMsg text-danger"></p>
            </div>
              <div class="form-group">
              <label for="userPhone">Enter Contact Number:</label>
              <input type="tel" class="form-control phoneCol" id="userPhone" placeholder="01234567890" >
              <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
              <label for="userAdd">Enter Patient Address:</label>
              <textarea type="tel" class="form-control addCol" id="userAdd" placeholder="Patient Address" ></textarea>  
              <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
              <label for="zip">Enter PostCode:</label>
              <input id="zip" class="form-control zipCol" name="zip" type="text" inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$">
              <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
              <label for="State">Example multiple select</label>
    <select class="form-control" id="State">
    <option selected="true" disabled="disabled" value="">Choose State</option>
      <option>Johor</option>
      <option>Kedah</option>
      <option>Kelantan</option>
      <option>Negeri Sembilan</option>
      <option>Pahang</option>
      <option>Perak</option>
      <option>Perlis</option>
      <option>Pulau Pinang</option>
      <option>Selangor</option>
      <option>Terengganu</option>
      <option>Kuala Lumpur</option>
      <option>Sabah</option>
      <option>Sarawak</option>
    </select>
                <p class="errorMsg text-danger newPass"> </p>
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
    $("#blah").hide();

    $(".form-control").keyup(function(){
      if($(this).val()==""){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
      
    })
    //send request to backend to insert the patient info
    $(".confirm").click(function(){
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
      //else submit insert request to backend
      else {
        const form = document.getElementById('form');
        const formData = new FormData(form);
        formData.append('username',$(".nameCol").val());
        formData.append('userIC',$(".ICCol").val());
        formData.append('userPhone',$(".phoneCol").val());
        formData.append('userAdd',$(".addCol").val());
        formData.append('userZip',$(".zipCol").val());
        formData.append('userState',$('#State').find(":selected").text());
        $.ajax({
            url:'backend/insertNewPatient.php',
            method:"POST",
            data:formData,
            contentType: false,
             cache: false,
            processData:false,
            success:function(response){
              if(response==="1"){
                alert("Username has been taken. Please take another one."); 
              }
              else if(response==="0"){alert("patient insert fail");}
              else{
                history.back();}
            }
        });}

    });

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