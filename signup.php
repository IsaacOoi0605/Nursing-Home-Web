<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Password</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Change Password</h2>
        <form>
            <br>
            <div class="form-group">
              <label for="userPass">Enter Current Password:</label>
              <input type="password" class="form-control passCol" id="userPass" placeholder="Password">
              <input type="checkbox" class="showPass" > Show Password
              <p class="errorMsg text-danger"></p>
            </div>
            <div class="form-group">
                <label for="userNewPass">Enter New Password:</label>
                <input type="password" class="form-control passCol" id="userNewPass" placeholder="Enter Your New Password">
                <input type="checkbox" class="showPass"> Show Password
                <p class="errorMsg text-danger newPass"></p>
              </div>
              
            
            <div class="form-group">
                <label for="userRePass">Re-enter New Password:</label>
                <input type="password" class="form-control passCol" id="userRePass" placeholder="Re-enter New Password">
                <input type="checkbox" class="showPass"> Show Password
                <p class="errorMsg text-danger newPass"></p>
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

  
    $(".showPass").change(function(){
        if($(this).is(':checked')){
        $(this).siblings(".passCol").attr('type','text');}
        else{
            $(this).siblings(".passCol").attr('type','password');
    }
        
    });


    $(".passCol").keyup(function(){
      if($(this).val()==""){
        $(this).siblings(".errorMsg").text("This column should not be empty!");}
      else{
        $(this).siblings(".errorMsg").text("");
      }
      
    })
    $(".confirm").click(function(){
      if($("#userPass").val()==""||$("#userNewPass").val()==""||$("#userRePass").val()==""){
        alert("Please ensure every column is filled!");
      }
      else if($("#userPass").val()==$("#userNewPass").val()){
        alert("New password cannot same with old password!");
      }
      else if($("#userNewPass").val()===$("#userRePass").val()){
        var oldPass=$("#userPass").val();
        var newPass=$("#userNewPass").val();
        //verifying old password
        $.ajax(
          {
            url: 'backend/changePassVerify.php',
            method:'POST',
            data:{
              oldPassPHP: oldPass,
              modifyTest:"verify"
            },
            success: function(response){
              //return response 1 if old password is valid
              if (response==="1"){
                alert("old password is correct!");
                //proceed ajax to change new password
                $.ajax(
                  {
                    url: 'backend/changePassVerify.php',
                    method:'POST',
                    data:{
                      newPassPHP:newPass,
                    },
                    success: function(response){
                      alert("Password Changed Successfully!");
                      $.ajax({
                        url:'backend/logout.php',
                        method:"POST",
                        data:{
                        },
                        success:function(response){
                            alert("Please Re-login.");
                            window.location.href = 'Login.php';
                        }
                      });
                    },
                    dataType:'text'});
              }
              //else alert to user password is invalid
              else{alert("Password is incorrect!");}
            },
            dataType:'text',
          }

        );
      }
      else{
        $(".newPass").text("Please ensure password are match");
      }
    })
  });



  </script>
</html>