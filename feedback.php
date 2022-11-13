<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Support Ticket</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Submit Support Ticket</h2>
      <label for="description">Description</label>
        <textarea class="form-control mb-2" id="description" placeholder="Enter Description Here..."></textarea>
        <button type="button" class="btn btn-primary submit">Submit</button>
    </div>
        </div>
    </div>

  </div>
</div>

</body>

<script>

  $(document).on('click','.submit',function(){
    if($('#description').val()){
      var description=$('#description').val();
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
                window.location.href="Dashboard.php";
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