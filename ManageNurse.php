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
        <h1>Manage Nurse</h1>

        <div class="table1"></div>

        </div>
    </div>
  </div>
</div>

</body>

<script>
  var handlePost="nurse";
  $(document).ready(function(){
    $.ajax({
            url:'backend/selectAll.php',
            method:"POST",
            data:{
              postPHP:handlePost,
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
    
    $('.table1').on('click','.edi',function(){
      var id=$(this).parent().siblings(".id").text();
        window.location.href="EditNurse.php?id="+id;
      })

  

    $('.table1').on('click','.add',function(){
      <?php
            $_SESSION["userHandle"] = "Nurse";?>
      window.location.href = "Add.php";
    })

    $('.table1').on('keyup','.searchCol',function(){
      search();
    })
    $('.table1').on('change','.form-check-input',function(){
      if($(".searchCol").val()){
        search();
      }
    })

  });
  function search(){
  var input=$(".searchCol").val();
      if(input){
        if($('.radioID').prop("checked")===true){
          var search="ID";}
        else{var search="Name";}
      $.ajax({
            url:'backend/searchCol.php',
            method:"POST",
            data:{
              searchPHP:search,
              inputPHP:input,
              postPHP:handlePost
            },
            dataType:"text",
            success:function(response){
              $("table").remove();
              $(".table1").children("h1").remove();
              $('.table1').append(response);
            }
        });}
        else{
          $.ajax({
            url:'backend/selectAll.php',
            method:"POST",
            data:{
              postPHP:handlePost,
            },
            success:function(response){
                $('.table1').html(response);
            }
        });
        }}




  </script>
</html>