<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Disease Selection</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
        <br>
        <h1>Select Disease</h1>
        <button class="btn btn-primary btn-lg float-start prev" onclick="history.back()">Back</button>
        <button class="btn btn-primary btn-lg float-end next">Next</button>
        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  $(document).ready(function(){
    var disCheck=[];
    disCheck=<?php if(isset($_SESSION['checkDisease'])){
    echo json_encode($_SESSION['checkDisease']);
    }
    else{
      $emptyArray=array();
      echo json_encode($emptyArray);
    }
    ?>;
    //retrieve disease from the database
    $.ajax({
            url:'backend/disSel.php',
            method:"POST",
            success:function(response){
                $('.table1').html(response);
                if(disCheck.length!=0){
                  var i;
                  for (i = 0; i <disCheck.length; ++i) {
                    $(".form-check-input").each(function(){
                      if($(this).parent().siblings(".disease").find(".disID").text()==disCheck[i]){
                        $(this).prop("checked", true);
                      }
                    });
                  }
                }
            }
        });
    //next button
    $(document).on('click','.next',function(){
      //an array to store the disease added
      var disease=[];
        //for each checked disease
        $(".form-check-input").each(function(){
          //if the checkbox is checked
          if(this.checked){ 
            //save the disease id into the disease array
            disease.push($(this).parent().siblings(".disease").find(".disID").text());
          }
        });
        //send the disease array to the backend session
        var gotDis;
        if(disease.length==0){
          gotDis=0;
        }
        else{
          gotDis=1;
        }
        $.ajax({
            url:'backend/insertCheckPatient.php',
            method:"POST",
            data:{
              diseaseList:disease,
              gotDis:gotDis
            },
            success:function(response){
              //proceed to medicine selection
              window.location.href="selectionMed.php";
            }
        });
      })
  });
  </script>
</html>