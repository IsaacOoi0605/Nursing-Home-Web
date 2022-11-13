<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //get hosID
        $hosID=$_POST['HosID'];
        echo "<div class='border p-3 mb-2 rounded'><h3>Medicine Detail:</h3></div>";
        $sql="SELECT * FROM hosmedicine WHERE HosID='$hosID' and Taking='1'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $medName="";
        if($resultCheck){
          $sql="SELECT med.Name AS Name, varMed.Weight AS Weight,hos.NoOfTimes AS time, hos.NoOfTablet AS tablet from hosmedicine as hos INNER JOIN variantmedicine as varMed ON hos.varID=varMed.varID INNER JOIN medicine as med ON varMed.MedID=med.MedID WHERE hos.HosID='$hosID'AND hos.Taking='1' ORDER BY med.Name ASC";
          $resultMed=mysqli_query($conn,$sql);
          while($row1=mysqli_fetch_array($resultMed)){
          if($row1['Name']!=$medName){
            echo "<div class='border rounded p-2'><h4>".$row1['Name']."</h4></div>";
            $medName=$row1['Name'];
          }
          echo "<div class='border rounded p-2'>";
          echo "<div>Weight:".$row1['Weight']."</div>";
          echo "<div>Number of times to be taken each day:".$row1['time']."</div>";
          echo "<div>Number tablet to be taken:".$row1['tablet']."</div>";
          echo "</div>";
          }
        }
        else{
          echo"No Medicine Taking";
        }

        echo "<div class='border p-3 mb-2 rounded mt-3'><h3>Medication Taken Before:</h3></div>";
        $sql="SELECT * FROM hosmedicine WHERE HosID='$hosID' and Taking='0'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        $medName="";
        if($resultCheck){
          $sql="SELECT med.Name AS Name, varMed.Weight AS Weight,hos.NoOfTimes AS time, hos.NoOfTablet AS tablet from hosmedicine as hos INNER JOIN variantmedicine as varMed ON hos.varID=varMed.varID INNER JOIN medicine as med ON varMed.MedID=med.MedID WHERE hos.HosID='$hosID'AND hos.Taking='0' ORDER BY med.Name ASC";
          $resultMed=mysqli_query($conn,$sql);
          while($row1=mysqli_fetch_array($resultMed)){
          if($row1['Name']!=$medName){
            echo "<div class='border rounded p-2'><h4>".$row1['Name']."</h4></div>";
            $medName=$row1['Name'];
          }
          echo "<div class='border rounded p-2'>";
          echo "<div>Weight:".$row1['Weight']."</div>";
          echo "<div>Number of times to be taken each day:".$row1['time']."</div>";
          echo "<div>Number tablet to be taken:".$row1['tablet']."</div>";
          echo "</div>";
          }
        }
        else{
          echo"No Medicine History";
        }