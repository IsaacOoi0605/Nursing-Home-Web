<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Medicine</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Change Medicine</h1>
        <div class='row'>
        <div class='col-6'><div class='btn btn-primary mb-2 cancel' onclick="history.back()">Cancel</div></div>
        <div class='col-6 text-end'><div class='btn btn-primary mb-2 confirm'>Confirm</div></div>
        </div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
    $(document).ready(function(){
      var hosID="<?php echo $_GET['HosID'];?>";
    $.ajax({
            url:'backend/returnCheckMedicine.php',
            method:"POST",
            data:{
              HosID:hosID
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
      $(document).on('change','.tip',function(){
        //if checked then allow user to modify the amount
        if($(this).is(':checked')){
          $(this).parent().siblings('.content').find('.form-control').attr("readonly", false);
          $(this).parent().siblings('.mt-1').find('.time').attr("readonly", false);}
        //else set the amount to readonly and remove the value inside it
        else{
          $(this).parent().siblings('.content').find('.form-control').attr("readonly", true);
          $(this).parent().siblings('.mt-1').find('.time').attr("readonly", true);}})
          

      $(document).on('click','.confirm',function(){
      var error=0
      //an array to store the medicine selected
      var medicine=[];
      //for each checked medicine
      $(".tip").each(function(){
        if(this.checked){
        var varMed={};
        varMed["id"]=$(this).parent().siblings(".content").find(".varID").text();
        if($(this).parent().siblings(".content").find(".quantity").val()){
        varMed["no"]=$(this).parent().siblings(".content").find(".quantity").val();}
        else{
          error=1;
        }
        if($(this).parent().siblings(".slot").find(".time").val()){
        varMed["time"]=$(this).parent().siblings(".slot").find(".time").val();}
        else{
          error=1;
        }
        if(!(error)){
        medicine.push(varMed);}
      }
      })
      if(!(error)){
        $.ajax({
            url:'backend/medChange.php',
            method:"POST",
            data:{
              medicine:medicine,
              HosID:hosID
            },
            success:function(response){
                history.back();
            }
        });
      }
      else{
          alert("Please ensure all checked column is enter with input.");
        }
    });
  });





  </script>
</html>