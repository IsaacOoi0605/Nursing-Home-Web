<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medicine Selection</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Select Medicine</h1>
        <div class="mb-2">
        <button class="btn btn-primary btn-lg prev" onclick="history.back()">Back</button>
        <button class="btn btn-primary btn-lg float-end next">Next</button>
        </div>
        <div><input class="form-control searchCol" placeholder="Enter Medicine"></div>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    var medCheck=[];
    medCheck=<?php if(isset($_SESSION['checkMedicine'])){
    echo json_encode($_SESSION['checkMedicine']);
    } 
    else{
      $emptyArray=array();
      echo json_encode($emptyArray);
    }
    ?>;
    //retrieve medicine from the database
    $.ajax({
            url:'backend/medSel.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
                $('.id').hide();
                $('.varID').hide();
                if(medCheck.length!=0){
                  var i;
                  for (i = 0; i <medCheck.length; ++i) {
                    var newMed=medCheck[i];
                    $('.varID').each(function() {
                        if($(this).text()==newMed["id"]){
                          $(this).parent().siblings(".item").children(".quantity").val(newMed["no"]);
                          $(this).parent().siblings(".item").children(".quantity").attr("readonly", false);
                          $(this).parent().parent().parent().siblings(".col-2").find(".tip").prop("checked", true);
                          $(this).parent().parent().parent().siblings(".slot").find(".time").val(newMed["time"]);
                          $(this).parent().parent().parent().siblings(".slot").find(".time").attr("readonly", false);
                        }
                    });
                  }
                }
                 
            }
        });
    //checkbox let user enter number of medicine when checked
    $(document).on('change','.tip',function(){
        //if checked then allow user to modify the amount
        if($(this).is(':checked')){
          $(this).parent().siblings('.content').find('.form-control').attr("readonly", false);
          $(this).parent().siblings('.mt-1').find('.time').attr("readonly", false);
          $(this).parent().siblings('.mt-1').find('.day').attr("readonly", false);}
        //else set the amount to readonly and remove the value inside it
        else{
          $(this).parent().siblings('.content').find('.form-control').attr("readonly", true);
          $(this).parent().siblings('.mt-1').find('.time').attr("readonly", true);
          $(this).parent().siblings('.mt-1').find('.day').attr("readonly", true);}})
    //search column function
    $(document).on('keyup','.searchCol',function(){
        var input=$(this).val();
      $(".medicine").each(function(){
        var medName=$(this).find("h3").text();
        if(!(medName.includes(input))){
            $(this).hide();
        }
      });
      if(!(input)){
        $(".medicine").show();
      }
    })
    //next button
    $(document).on('click','.next',function(){
      var error=0
      //an array to store the medicine selected
      var medicine=[];
      //for each checked medicine
      $(".tip").each(function(){
        if(this.checked){
        var varMed={};
        varMed["name"]=$(this).parent().parent().siblings(".name").find(".medName").text();
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
      //if no error submit to backend to save in session
      if(!(error)){
        var gotMed;
        if(medicine.length==0){
          gotMed=0;
        }
        else{
          gotMed=1;
        }
      $.ajax({
            url:'backend/insertCheckPatient.php',
            method:"POST",
            data:{
              medicine:medicine,
              gotMed:gotMed
            },
            success:function(response){
                window.location.href="conCheckPat.php";
            }
        });
      }
      else{
          alert("Please ensure all checked column is enter with input.");
        }
      })
  });
  </script>
</html>