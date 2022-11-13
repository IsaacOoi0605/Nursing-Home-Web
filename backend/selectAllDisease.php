<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT * from disease WHERE Available=1";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo("<br><button class='col-12 btn btn-dark add'>Add New Disease</button><br>");
        if($resultCheck>0){
          echo"<div class='container mt-5 mb-3'>
          <div class='row'>";
          while($row = mysqli_fetch_array($result)) {
            echo '
          <div class="col-md-4">
          <div class="card p-3 mb-5 pt-0">
            <div class="mt-5">
                <h3 class="heading">'.$row['Name'].'<br></h3>
                <h4 class="id d-none">'.$row['DiseaseID'].'</h4>
                <div class="mt-5">
                    <br>
                    <a href="#" class="btn btn-primary view">View</a>
                </div>
            </div>
        </div>
        </div>';
          };
          echo"</div>
          </div>";
        }
        else{
            echo"<h1>No result found.</h1>";
        }

        ?>