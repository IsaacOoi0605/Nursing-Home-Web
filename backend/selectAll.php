<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        if(!isset($_POST['postPHP'])){
          $sql = "SELECT * FROM patient";
          $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo"<br>";
          echo "<div class='row'><div class='col-10'><input type='text' class='form-control searchCol col-10' id='userPass' placeholder='Search'></div><button class='col-2 btn btn-dark add'>Add</button></div>";
          echo "<br>";
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
          echo("<br><button class='col-12 btn btn-dark add'>Add</button><br>");
          echo("<br><h1  class='text-center'>No result found</h1>");
        }
        }
        else{
        $pos=$_POST['postPHP'];
        $sql = "SELECT * FROM users WHERE position ='$pos'";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          echo"<br>";
          //search column
          echo "<div class='row'><div class='col-10'><input type='text' class='form-control searchCol col-10' id='userPass' placeholder='Search'></div><button class='col-2 btn btn-dark add'>Add</button></div>";
          //radio button
          echo '<div class="form-check form-check-inline">
          <input class="form-check-input radioName" type="radio" name="flexRadioDefault" id="radioName">
          <label class="form-check-label" for="radioName">
            Search by Name
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input radioID" type="radio" name="flexRadioDefault" id="radioID" checked>
          <label class="form-check-label" for="radioID">
            Search by ID
          </label>
        </div>';
          echo "<br>";
          //table 
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
          echo("<br><button class='col-12 btn btn-dark add'>Add</button><br>");
          echo("<br><h1 class='text-center'>No result found</h1>");
        }}

        exit();

    
?>