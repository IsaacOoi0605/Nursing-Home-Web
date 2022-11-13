<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT Level, SUM(ifnull(Availability,0)) AS num from bed GROUP BY Level";
        $result= mysqli_query($conn, $sql);
        $sql1 = "SELECT Level,COUNT(*) FROM bed GROUP BY Level";
        $result1= mysqli_query($conn, $sql1);
        $resultCheck = mysqli_num_rows($result);
        echo("<br><button class='col-12 btn btn-dark add'>Add New Bed Level</button><br>");
        if($resultCheck>0){
          echo"<div class='container mt-5 mb-3'>
          <div class='row'>";
          while($row = mysqli_fetch_array($result)) {
            $row1 = mysqli_fetch_array($result1);
            $occupied=(($row1['COUNT(*)']-$row['num'])/$row1['COUNT(*)'])*100;
            $occ=$row1['COUNT(*)']-$row['num'];
            echo '
          <div class="col-md-4">
          <div class="card p-3 mb-5 pt-0">
            <div class="mt-5">
                <h3 class="heading">Bed Level<br></h3><h3 class="heading bedLevel">'.$row['Level'].'</h3>
                <div class="mt-5">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:';
                        echo ($occupied);
                        echo'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-3">
                        <span class="text1">'.$occ.' Occupied <span class="text2">of '.$row1['COUNT(*)'].' capacity</span></span> 
                    </div>
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

        ?>
