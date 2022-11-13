<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Personal Details</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Change Personal Details</h2>
      <div class="table1"></div>
    </div>
        </div>
    </div>

  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    var imgsrc;
    $.ajax({
            url:'backend/returnChgInfo.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
            }
        });
  });
  function showImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.img').attr('src', e.target.result).width(200).height(200);
        };
       reader.readAsDataURL(input.files[0]);
       $('.saveImg').removeClass("d-none");
       imgsrc = $('.img').attr("src");
  }
}

$(document).on('click','.saveImg',function(){
      if (confirm("Do You Sure to change the image?")) {
        const form = document.getElementById('form');
        const formData = new FormData(form);
        $.ajax({
            url:'backend/chgImageUser.php',
            method:"POST",
            data:formData,
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
                alert("successfully changed image");
                $('.saveImg').addClass("d-none");

            }
        });
          }
    })


  </script>
</html>