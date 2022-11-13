<?php
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $hosID=$_POST['HosID'];
        echo "<div class='rounded border p-2'><h4>Disease Current Having</h4>";
        $sql="SELECT dis.Name from hosDisease AS hos INNER JOIN disease AS dis ON hos.DiseaseID=dis.DiseaseID WHERE hos.HosID='$hosID' AND Taking='1'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck){
          while($row=mysqli_fetch_array($result)){
            echo"<div class='border rounded p-3 mb-2 bg-light'>".$row['Name']."</div>";
          }
        }
        else{
            echo"<div>No Disease Having Now</div>";
        }
        echo "</div>";
        echo "<div class='rounded border p-2 mt-2'><h4>Disease Have in the Past</h4>";
        $sql="SELECT dis.Name from hosDisease AS hos INNER JOIN disease AS dis ON hos.DiseaseID=dis.DiseaseID WHERE hos.HosID='$hosID' AND Taking='0'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck){
          while($row=mysqli_fetch_array($result)){
            echo"<div class='border rounded p-3 mb-2 bg-light'>".$row['Name']."</div>";
          }
        }
        else{
            echo"<div>No Disease History</div>";
        }
        echo "</div>";
?>