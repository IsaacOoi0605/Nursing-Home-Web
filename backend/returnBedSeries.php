<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedSeries=$_POST["bedSeriesPHP"];
        $sql="SELECT * FROM bed where Level='$bedSeries'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
        $sql = "SELECT Level, SUM(ifnull(Availability,0)) AS num from bed WHERE Level='$bedSeries'";
        $result= mysqli_query($conn, $sql);
        $sql1 = "SELECT Level,COUNT(*) FROM bed WHERE Level='$bedSeries'";
        $result1= mysqli_query($conn, $sql1);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo"<div class='container-fluid mt-5 mb-3'>";
          while($row = mysqli_fetch_array($result)) {
            $row1 = mysqli_fetch_array($result1);
            $occupied=(($row1['COUNT(*)']-$row['num'])/$row1['COUNT(*)'])*100;
            $occ=$row1['COUNT(*)']-$row['num'];
            echo '
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width:';
              echo ($occupied);
              echo'%" aria-valuenow='."100".' aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="mt-3">
              <span class="text1">'.$occ.' Occupied <span class="text2">of '.$row1['COUNT(*)'].' capacity</span></span> 
            </div>';
          };
        }
        $sql = "SELECT BedID,Availability from bed WHERE Level='$bedSeries'";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){

          echo "<div class='row gx-0'>";
          while($row = mysqli_fetch_array($result)){
            echo"<div class='col-xs-6 col-sm-4 col-lg-2 mt-3'><div class='bed btn ";
            if($row['Availability']){ echo "btn-success ava";}
            else{echo "btn-warning no";}
            echo "'>".$bedSeries."-";
            if($row['BedID']<10){
              echo "00";
            }
            elseif($row['BedID']<100){
              echo "0";
            }
            echo $row['BedID'];
            echo "</div></div>";
          }
          echo '</div>';
        }
        echo"</div>";}
        else{
          echo"No Bed Inserted Before";
        }
        ?>
