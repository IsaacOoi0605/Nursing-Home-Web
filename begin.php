
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <script type = "text/javascript"
         src = "https://www.tutorialspoint.com/jquery/jquery-3.6.0.js">
      </script>
		
      <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
      </script>
  <script>
     $(document).ready(function(){
    <?php $url=array("CheckInNewPatient.php","selectionBed.php","selectionBedNo.php","selectionDisease.php","selectionMed.php","conCheckPat.php");
      $sub=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
      if(!in_array($sub,$url)){if(isset($_SESSION['checkPatientID'])){require_once 'backend/unsetHospitalised.php';}
      }?>

      $(".menu").click(function(){
        $(".sidenav").toggle();
    });
       var validation='<?php if(isset($_SESSION["position"]))
       {echo $_SESSION["position"];}
       ?>';
       if (validation==="nurse"){
          $(".nurse").remove();
       }
       else if (validation==="admin"){
          $(".admin").remove();
       }
       else if (validation==="superAdmin"){
        $(".superAdmin").remove();
       }
       else{alert("You shall not here!");
      window.location.href = 'Login.php';}
    $(".logout").click(function(){
      $.ajax({
            url:'backend/logout.php',
            method:"POST",
            data:{
            },
            success:function(response){
                alert("Successfully Logout!");
                window.location.replace('Login.php');
            }
        });
    });
    $(".dropdown-btn").click(function(){
      if($(this).next().is(":visible")){
        $(this).next().slideUp();
      }
      else{
        $(this).next().slideDown();
      }
    });
    });
  </script>
  <style>

@media screen and (max-width: 700px) {
    .sidenav {
        display: none !important;
    }
}
    .sidenav a, .dropdown-btn {

  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  display: block;
  border: none;
  background: none;

  text-align: left;
  cursor: pointer;
  outline: none;
}
.dropdown-container {

  display: none;
  background-color: #262626;
  padding-left: 8px;
}

  </style>
</head>
<body>

<div class="container-fluid p-1 bg-dark text-white text-center row sticky-top w-100">
  <div class="col-4"><div class='menu btn btn-light float-start ms-2 mt-2'><i class="fa fa-bars" aria-hidden="true"></i></div></div>
  <h1 class="col-4"><?php echo $_SESSION["position"];?></h1>
  <div class="col-4 pt-2">
  <button class="btn btn-light float-end logout ">Logout</button></div>
</div>

<div class="container-fluid min-vh-100" >
  <div class="row">
    <div class="col-3 bg-secondary min-vh-100 sidenav " style="max-width: 300px; position:fixed;">
      <ul class="nav flex-column">
        <a href="Dashboard.php">Dashboard</a>
        <li class="nav-item nurse">
            <button class="dropdown-btn userManage">User Management</button>
            <div class="dropdown-container">
              <a class="admin" href="ManageAdmin.php">Manage Admin</a>
              <a href="ManageNurse.php">Manage Nurse</a>
            </div>
        </li>
        <li class="nav-item">
            <button class="dropdown-btn">Patient</button>
            <div class="dropdown-container">
              <a href="ManagePatient.php">View All Patient</a>
              <a href="CheckInPatient.php">View Check-In Patient</a>
              <a href="HospitalisedHis.php">Hospitalised History</a>
            </div>
        </li>
        <li class="nav-item nurse">
            <button class="dropdown-btn">Bed</button>
            <div class="dropdown-container">
              <a href="ManageBed.php">Manage Bed</a>
              <a href="bedForecast.php">Bed Forecast</a>
            </div>
        </li>
        <li class="nav-item nurse">
            <button class="dropdown-btn userManage">Disease</button>
            <div class="dropdown-container">
              <a href="ManageDisease.php">Manage Disease</a>
              <a href="AddDisease.php">Add Disease</a>
            </div>
        </li>
        <li class="nav-item nurse">
            <button class="dropdown-btn">Medicine</button>
            <div class="dropdown-container">
              <a href="ManageMedicine.php">Manage Medicine</a>
              <a href="AddMedicine.php">Add Medicine</a>
            </div>
        </li>
        <li class="nav-item nurse">
            <button class="dropdown-btn">Revenue</button>
            <div class="dropdown-container">
              <a href="revenue.php">Revenue Forecast</a>
              <a href="revenueCheck.php">Revenue Explorer</a>
            </div>
        </li>
        <li class="nav-item">
          <button class="dropdown-btn">Setting</button>
            <div class="dropdown-container">
              <a href="signup.php">Change Password</a>
              <a href="chgInfo.php">Change Personal Details</a>
              <a class="nurse" href="feedbackReview.php">Support Ticket Review</a>
              <a class="admin superAdmin" href="feedback.php">Submit Ticket</a>
              <a class="admin superAdmin" href="feedbackHistory.php">Support Ticket History</a>
            </div>
        </li>
      </ul>
    </div>