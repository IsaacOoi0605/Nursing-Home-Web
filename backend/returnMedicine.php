<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $medID=$_POST['medID'];
        $sql = "SELECT * FROM medicine WHERE MedID ='$medID'";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        echo"<div class='btn btn-danger removeMed'>Remove</div>";
        echo '<form id="form">
                <!--medicine name-->
                <div class="form-group">
                    <label for="MedName">Enter Medicine Name:</label>
                    <input type="text" class="form-control nameCol" id="MedName" placeholder="Enter Medicine Name" value="'.$row['Name'].'">
                    <p class="errorMsg text-danger"></p>
                </div>
                <!--medicine name-->';
        echo '<h3>Medicine Variant</h3>';
        $sql = "SELECT * FROM variantmedicine WHERE MedID ='$medID' and Available=1";
        $result= mysqli_query($conn, $sql);
        $num=1;
        while($row=mysqli_fetch_array($result)){
                echo'<div class="form-group mb-2 variant">
                <div class="row">
                <div class="col-10">
                <input type="text" class="form-control weightCol" placeholder="Enter Variant Weight(mg)" value="'.$row['Weight'].'">
                </div>
                <div class="col-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
              </svg>
              </div>
                </div></div>';
            $num+=1;
        }
        echo '<div class="row container-fluid mt-4 add"><button class="btn btn-outline-secondary col-12" type="button">+</button></div>';
        exit();

    
?>