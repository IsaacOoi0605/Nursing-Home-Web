<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $input=$_POST['inputPHP'];
        $output=addslashes($input);
        if(isset($_POST['validate'])){
          $sql = "SELECT hos.HosID,hos.CheckInDate,pat.PatientID,pat.Name,pat.IC,pat.img_path FROM patient AS pat INNER JOIN hospitalised as hos ON hos.PatientID=pat.PatientID WHERE (pat.patientID LIKE '%$output%' OR pat.IC LIKE '%$output%' OR pat.Name LIKE '%$output%') AND hos.CheckOutDate='0'";
          $result= mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo("<table class='table table-striped table-dark'>
          <thead>
            <tr>
            <th scope='col' class='text-center'>Hospitalised ID</th>
              <th scope='col' class='text-center'>Patient ID</th>
              <th scope='col' class='text-center'>Image</th>
              <th scope='col' class='text-center'>Name</th>
              <th scope='col' class='text-center'>IC</th>
              <th scope='col' class='text-center'>CheckInDate</th>
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
          echo("<h1>No result found</h1>");
        }}
        else{
          $sql = "SELECT * FROM patient WHERE (patientID LIKE '%$output%' OR IC LIKE '%$output%' OR Name LIKE '%$output%')AND Hospitalised=0";
          $result= mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
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
          echo("<h1>No result found</h1>");
        }
        }
?>