<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <script type = "text/javascript"
         src = "https://www.tutorialspoint.com/jquery/jquery-3.6.0.js">
      </script>
		
      <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
      </script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Login Page</h1>

</div>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
 
    </div>
    <div class="col-sm-4">
        <form>
            <div class="form-group">
              <label for="userName">Username</label>
              <input type="text" class="form-control" id="userName"placeholder="Username">

            </div>
            <br>
            <div class="form-group">
              <label for="userPass">Password</label>
              <input type="password" class="form-control pass1" id="userPass" placeholder="Password">
              <input type="checkbox" onclick="showPass()"> Show Password
            </div>
            <p class="errorMsg text-danger"></p>
            <br>
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary mx-auto w-10 login" >Login</button>
            </div>
            <div class="text-center mt-2"><a class="link-primary">Submit Support Ticket</a></div>
          </form>
    </div>
    <div class="col-sm-4">

    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Support Ticket</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-testing" style="height:30vh;overflow-y: auto;">
      <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" placeholder="Enter Description Here..."></textarea>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submit">Submit</button>
      </div>
    </div>
  </div>
</div>
</body>

<script>
  $(document).ready(function(){
    $(".pass1").on('keypress',function(e){
    if(e.which == 13) {
        login();
    }
});  
var validation='<?php if(isset($_SESSION["position"]))
       {echo $_SESSION["position"];}
       ?>';
       if (validation){
        window.location.replace('Dashboard.php');
       }


  });
  function showPass() {
      
        var x = document.getElementById("userPass");
        if (x.type === "password") {
            x.type = "text";
         } else {
            x.type = "password";
         }
        }
  
 

  $(".login").click(function(){
      login();
  });
    function login() {
      var name=$("#userName").val();
      var password=$("#userPass").val();
      if (name ==""||password=="")
        alert("Username and password should not be empty");
      else{
        $.ajax({
            url: 'backend/accVerify.php',
            method:'POST',
            data:{
              login:1,
              namePHP: name,
              passPHP: password
            },
            success: function(response){
              if (response>0){
                window.location.replace('Dashboard.php');}
              else{alert("Information entered is invalid!");}
            },
            dataType:'text',
          });}
      }
      $(document).on('click','.link-primary',function(){
    $('#exampleModal').modal('show');
  })

  $(document).on('click','.close',function(){
    $('#description').val('');
  })      
  $(document).on('click','.submit',function(){
    if($('#description').val()){
      $('#exampleModal').modal('hide');
      var description=$('#description').val();
      $('#description').val('');
      $.ajax(
          {
            url: 'backend/GuestFeedback.php',
            method:'POST',
            data:{
              description:description
            },
            success: function(response){
              if (response){
                alert("successfully submitted");
                }
              else{alert("Having issue, Please try again later.");}
            },
            dataType:'text',
          }

        );
    }
    else{
      alert("Description cant not be empty!");
    }
  })
  </script>
</html>
