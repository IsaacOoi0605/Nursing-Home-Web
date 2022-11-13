<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $input=$_POST['inputPHP'];
        if($input=="check"){
          $sql = "SELECT hos.HosID,hos.CheckInDate,pat.PatientID,pat.Name,pat.IC,pat.img_path FROM patient AS pat INNER JOIN hospitalised as hos ON hos.PatientID=pat.PatientID WHERE hos.CheckOutDate='0'";
          $result= mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck>0){
            echo"<br>";
            echo "<div class='row'><div class='col-10'><input type='text' class='form-control searchCol col-10' id='userPass' placeholder='Search'></div><button class='col-2 btn btn-dark checkIn'>Check In</button></div>";
            echo "<br>";
            echo("<table class='table table-striped table-dark'>
            <thead>
              <tr>
              <th scope='col' class='text-center'>Hospitalised ID</th>
                <th scope='col' class='text-center'>Patient ID</th>
                <th scope='col' class='text-center'>Image</th>
                <th scope='col' class='text-center'>Name</th>
                <th scope='col' class='text-center'>IC</th>
                <th scope='col' class='text-center'>Check In Date</th>
                <th scope='col' class='text-center'>Days</th>
                <th scope='col' class='text-center'>View</th>
              </tr>
            </thead>");
            while($row = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo "<td class='HosID text-center'>" . $row['HosID'] . "</td>";
              echo "<td class='id text-center'>" . $row['PatientID'] . "</td>";
              echo "<td class='id text-center'><img src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='80' width='100'/></td>";
              echo "<td class='text-center'>" . $row['Name'] . "</td>";
              echo "<td class='text-center'>" . $row['IC'] . "</td>";
              echo "<td class='text-center'>" . $row['CheckInDate'] . "</td>";
            $today=date("Y/m/d");
            $today=strtotime($today);
            $date=strtotime($row['CheckInDate']);
            $day=$today-$date;
            $day=round($day/(60*60*24))+1;
            echo "<td class='text-center'>" . $day . "</td>";
              echo "<td class='text-center'><button class='btn btn-success view'>View</button></td>";
              echo "</tr>";
            };
            echo("</table>");
            
        }
        else{
          echo("<br><button class='col-12 btn btn-dark checkIn'>Check In</button><br>");
          echo("<br><h1  class='text-center'>No result found</h1>");
        }}
        else{
          $sql = "SELECT * FROM patient WHERE Hospitalised=0";
          $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo"<br>";
          echo "<div class='row'><div class='col'><input type='text' class='form-control searchCol col-10' id='userPass' placeholder='Search'></div></div>";
          echo "<br>";
          echo("<table class='table table-striped table-dark'>
          <thead>
            <tr>
              <th scope='col' class='text-center'>Patient ID</th>
              <th scope='col' class='text-center'>Image</th>
              <th scope='col' class='text-center'>Name</th>
              <th scope='col' class='text-center'>IC</th>
              <th scope='col' class='text-center'>Contact</th>
              <th scope='col' class='text-center'>Select</th>
            </tr>
          </thead>");
          while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td class='id text-center'>" . $row['PatientID'] . "</td>";
            echo "<td class='id text-center'><img src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='80' width='100'/></td>";
            echo "<td class='text-center'>" . $row['Name'] . "</td>";
            echo "<td class='text-center'>" . $row['IC'] . "</td>";
            echo "<td class='text-center'>" . $row['Contact'] . "</td>";
            echo "<td class='text-center' style='color:green'><button class='btn btn-success sel'>Select</button></td>";
            echo "</tr>";
          };
          echo("</table>");
          
        }
        else{
          echo("<br><button class='col-12 btn btn-dark add'>Add</button><br>");
          echo("<br><h1  class='text-center'>No result found</h1>");
        }
        }
?>