<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $input=$_POST['inputPHP'];
        $output=addslashes($input);
        if(!isset($_POST['postPHP'])){
          $sql = "SELECT * FROM patient WHERE patientID LIKE '%$output%' OR IC LIKE '%$output%' OR Name LIKE '%$output%'";
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
              <th scope='col' class='text-center'>Edit</th>
            </tr>
          </thead>");
          while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td class='id text-center'>" . $row['PatientID'] . "</td>";
            echo "<td class='id text-center'><img src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='80' width='100'/></td>";
            echo "<td class='text-center'>" . $row['Name'] . "</td>";
            echo "<td class='text-center'>" . $row['IC'] . "</td>";
            echo "<td class='text-center'>" . $row['Contact'] . "</td>";
            echo "<td class='text-center' style='color:green'><button type='button' class='btn btn-success edi'>Edit</button></td>";
            echo "</tr>";
          };
          echo("</table>");
        }
        else{
          echo("<h1>No result found</h1>");
        }
          }
        else{
        $pos=$_POST['postPHP'];
        $search=$_POST['searchPHP'];
        //if search is by ID
        if ($search==="ID"){
          $sql = "SELECT * FROM users WHERE ID LIKE '%$output%' AND position = '$pos'";
        }
        //if search is by Name
        else{
          $sql = "SELECT * FROM users WHERE username LIKE '%$output%' AND position = '$pos'";
        }
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo("<table class='table table-striped table-dark'>
          <thead>
            <tr>
              <th scope='col' class='text-center'>ID</th>
              <th scope='col' class='text-center'>Name</th>
              <th scope='col' class='text-center'>Image</th>
              <th scope='col' class='text-center'>Position</th>
              <th scope='col' class='text-center'>Edit</th>
            </tr>
          </thead>");
          while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td class='id text-center'>" . $row['ID'] . "</td>";
            echo "<td class='text-center'>" . $row['username'] . "</td>";
            echo "<td class='id text-center'><img src='data:image/jpeg;base64,".base64_encode($row['image'])."'height='80' width='100'/></td>";
            echo "<td class='pos text-center'>" . $row['position'] . "</td>";
            echo "<td class='text-center' style='color:green'><button type='button' class='btn btn-success edi'>Edit</button></td>";
            echo "</tr>";
          };
          echo("</table>");
        }
        else{
          echo("<h1>No result found</h1>");
        }
      }
        exit();

    
?>