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
        <h1>Bed <?php echo $_GET["level"]; ?></h1>
        <div class='btn btn-primary mb-2' onclick="history.back()">Back</div>
        <div class='btn btn-primary mb-2 float-end AddBed' >Add Number Of Bed</div>
        <div class='btn btn-primary mb-2 changePrice'>Change Bed Price</div>
        <div class="table1"></div>

        </div>
    </div>  </div>
</div>
 <!--bed selection modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bedText"></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-testing" style="">
      <div class="form-group">

            </div>
      </div>
      <div class="modal-footer bedFooter justify-content-center">
      </div>
    </div>
  </div>
</div>
 <!--bed selection modal-->
  <!--insert bed modal-->
  <div class="modal fade" id="bedInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Bed</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-testing" style="">
      <div class="d-flex justify-content-center">
        <button class="btn btn-primary specific me-3">Specific Number</button><button class="btn btn-primary number">Insert in many</button>
      </div>
      <div class="form-group bedNumber">
      </div>
      </div>
      <div class="modal-footer justify-content-center">
      <button class="btn btn-primary confirm me-3">Confirm</button>
      </div>
    </div>
  </div>
</div>
  <!--insert bed modal-->
  <!--change price modal-->
  <div class="modal fade" id="bedPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Bed Price</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-testing" style="">
      <div class="d-flex justify-content-center">
      <label>Bed Price:</label><input class="form-control" type="number" id="bedPriceFigure">
      </div>

      </div>
      <div class="modal-footer justify-content-center">
      <button class="btn btn-primary confirmPrice me-3">Confirm</button>
      </div>
    </div>
  </div>
</div>
  <!--change price modal-->
</body>

<script>
    var bedSeries="<?php echo $_GET["level"];?>";
    var bedID;
    var bedInsertType;
  $(document).ready(function(){
    $.ajax({
            url:'backend/returnBedSeries.php',
            method:"POST",
            data:{
                bedSeriesPHP:bedSeries,
            },
            success:function(response){
                $('.table1').html(response);
            },
        });

    $('.table1').on('click','.bed',function(){
        var Bed=$(this).text();
        bedID=parseInt(($(this).text()).slice(-3));
        var availability;
        $.ajax({
            url:'backend/returnBedAvai.php',
            method:"POST",
            data:{
                bedID:bedID,
                bedSeries:bedSeries
            },
            success:function(response){
              $('.bedFooter').empty();
                if(response=='available'){
                  $('.bedFooter').append('<button type="button" class="btn btn-danger remove">Remove</button><button type="button" class="btn btn-warning notAvai">Set to Not Available</button>');
                }
                else if(response=='not available'){
                  $('.bedFooter').append('<button type="button" class="btn btn-danger remove">Remove</button><button type="button" class="btn btn-success Avai">Set to Available</button>');
                }
                else if(response=='in-used'){
                  $('.bedFooter').append('<button type="button" class="btn btn-primary view">View Patient</button>');
                }
            },
        });
        $('#exampleModal').modal('show');
        $('#bedText').text(Bed);
      })
      

  });

  $(document).on('click','.remove',function(){
    $.ajax({
            url:'backend/removeBedNo.php',
            method:"POST",
            data:{
                bedID:bedID,
                bedSeries:bedSeries
            },
            success:function(response){
              if(response){
                alert(response);
                location.reload(true);
              }
            },
        });

      })

      $(document).on('click','.notAvai',function(){
    $.ajax({
            url:'backend/setBed.php',
            method:"POST",
            data:{
                status:"not available",
                bedID:bedID,
                bedSeries:bedSeries
            },
            success:function(response){
              if(response){
                alert(response);
                location.reload(true);
              }
            },
        });

      })

      $(document).on('click','.Avai',function(){
    $.ajax({
            url:'backend/setBed.php',
            method:"POST",
            data:{
              status:"available",
                bedID:bedID,
                bedSeries:bedSeries
            },
            success:function(response){
              if(response){
                alert(response);
                location.reload(true);
              }
            },
        });

      })
      $(document).on('click','.view',function(){
        $.ajax({
            url:'backend/getBedInfo.php',
            method:"POST",
            data:{
                bedID:bedID,
                bedSeries:bedSeries
            },
            success:function(response){
              if(response){
                patient=JSON.parse(response);
                window.location.href="ViewPatient.php?id="+patient[0]+"&HosID="+patient[1];
              }
            },
        });
      })

      $(document).on('click','.AddBed',function(){
        $('#bedInsert').modal('show');
      })
      $(document).on('click','.specific',function(){
        bedInsertType="specific";
        $('.bedNumber').empty();
        $('.bedNumber').append('<label>Specific bed number:</label><input class="form-control" type="number" id="bedNum">');
      })

      $(document).on('click','.number',function(){
        bedInsertType="number";
        $('.bedNumber').empty();
        $('.bedNumber').append('<label>Insert bed in number:</label><input class="form-control" type="number" id="bedNum">');
      })

      $(document).on('click','.confirm',function(){
        if($('#bedNum').val()>0 && $('#bedNum').val()!=""){
          var bedNum=$('#bedNum').val();
          $.ajax({
            url:'backend/insertBedNum.php',
            method:"POST",
            data:{
              bedInsertType:bedInsertType,
                bedNum:bedNum,
                bedSeries:bedSeries
            },
            success:function(response){
                if(response){
                  alert(response);
                }
                else{
                  location.reload(true);
                }
            },
        });
        }
        else{
          alert("bed number should not be empty")
        }
      })

      $(document).on('click','.changePrice',function(){
        $('#bedPrice').modal('show');
  })
      $('#bedPrice').on('shown.bs.modal',function(){
        $.ajax({
            url:'backend/returnBedPrice.php',
            method:"POST",
            data:{
                bedSeries:bedSeries
            },
            success:function(response){
                $('#bedPriceFigure').val(response);
            },
        });
      })

      $(document).on('click','.confirmPrice',function(){
        if($('#bedPriceFigure').val()>0 && $('#bedPriceFigure').val()!=""){
          var bedPrice=$('#bedPriceFigure').val();
          $.ajax({
            url:'backend/changeBedPrice.php',
            method:"POST",
            data:{
              bedPrice:bedPrice,
                bedSeries:bedSeries
            },
            success:function(response){
                if(response){
                  alert(response);
                }
                else{
                  location.reload(true);
                }
            },
        });
        }
        else{
          alert("PLease enter valid bed price");
        }
  })
  </script>
</html>