<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feedback</title>
<?php include 'begin.php';?>
    <div class="row">
    <div class="col-3 min-vh-100 sidenav" style="max-width: 300px;"></div>
      <div class="col"  > 
      <h2>Submitted Supported Ticket</h2>
      <div class="content"></div>
    </div>
        </div>
    </div>

  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ticket Content</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-testing" style="height:30vh;overflow-y: auto;">
      <div class="form-group">
              <textarea class="form-control" id="description" readonly  rows="7" cols="50"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>

<script>
$.ajax({
            url: 'backend/feedHis.php',
            method:'POST',
            success: function(response){
              $(".content").html(response);
            }
          });


$(document).on('click','.view',function(){
    $('#exampleModal').modal('show');
    var content=$(this).parent().siblings(".feedback").text();
    $('#description').val(content);
  })

  </script>
</html>s