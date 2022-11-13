<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Admin</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Add New <?php echo $_SESSION['userHandle'];?></h2>
      <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <form id='form'>
            <br>
            <div class="form-group">
              <label for="userName">Enter Username:</label>
              <input type="text" class="form-control nameCol" id="userName" placeholder="Enter Username">
              <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
                <label for="userPass">Enter Password:</label>
                <input type="password" class="form-control passCol" id="userPass" placeholder="Enter Password">
                <input type="checkbox" class="showPass"> Show Password
                <p class="errorMsg text-danger newPass"> </p>
              </div>
              
              <div class="form-group">
                <label for="userRePass">Re-enter Password:</label>
                <input type="password" class="form-control passReCol" id="userRePass" placeholder="Re-enter Password">
                <input type="checkbox" class="showPass"> Show Password
                <p class="errorMsg text-danger newPass"></p>
              </div>
            <div class="form-group">
            <label for="Image">Upload Image:</label>
            <input id="Image" name="img" class="form-control img" type="file" accept='image/png, image/gif, image/jpeg' onchange="showImage(this);"/>
            <br>
              <img id="blah" src="#" alt="your image" />
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

    $(".passCol").keyup(function(){
      if($(this).val()==""){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
      
      
    })

    

    $(".nameCol").keyup(function(){
      if($(this).val()==""){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
      
    })
    //confirm button
    $(".confirm").click(function(){
      var error;
      $('.form-control').each(function() {
        if ($(this).val() == '') {
          $(this).siblings(".errorMsg").text("This column should not be empty!");
          error="1";
        }
        });
      if(error){
        alert("Please ensure every column is filled up!");
      }
      else {
        const form = document.getElementById('form');
        const formData = new FormData(form);
        formData.append('namePHP',$(".nameCol").val());
        formData.append('passPHP',$(".passCol").val());
        var userPos='<?php echo $_SESSION['userHandle'];?>';
        userPos=userPos.toLowerCase();
        formData.append('posPHP',userPos);
        $.ajax({
            url:'backend/insertNew.php',
            method:"POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
              if(response==="1"){
                alert("Username has been taken. Please take another one."); 
              }
              else if(response==="0"){alert("admin insert fail");}
              else{alert(response);
                window.location.href = "Manage"+userPos+".php";}
            }
        });}

    });
    $(".showPass").change(function(){
        if($(this).is(':checked')){
        $(this).siblings(".passCol").attr('type','text');}
        else{
            $(this).siblings(".passCol").attr('type','password');
    }})
  });
  function showImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result).width(150).height(200);
        };
        $('#blah').show();
       reader.readAsDataURL(input.files[0]);
  }
}



  </script>
</html>