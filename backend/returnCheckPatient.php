<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $id=$_POST['id'];
        $hosID=$_POST['HosID'];
        //patient detail
        $sql = "SELECT * FROM patient WHERE PatientID ='$id'";
        $result= mysqli_query($conn, $sql);
        echo "<div class='border p-3 mb-2 rounded'><h3>Patient Details:</h3>";
        if($result){
            $row = mysqli_fetch_array($result);
            echo "<div class='row'>";
            //patient name
            echo "<div class='col-4'>Patient Name:";
            echo"<div class=''><input class='form-control input-sm ' value='".$row['Name']."' readonly></div></div>";
            //patient ic
            echo "<div class='col-4'>Patient IC:";
            echo"<div class=''><input class='form-control input-sm ' value='".$row['IC']."' readonly></div></div></div>";
            //patient image
            echo "<div><img class='mt-3' src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='120' width='100'/></div>";
            echo "<button class='btn btn-primary me-3 mt-3 viewMore'>View More Patient Detail</button>";
        }
        else{
            echo "Patient Detail Not Found.";
        }
        echo "</div>";
        //check patient is checkout or not
        $sql = "SELECT * FROM hospitalised WHERE HosID ='$hosID' AND CheckOutDate!='0'";
        $result= mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
          $checkOut=FALSE;
        }
        else{
          $checkOut=TRUE;
        }
        //bed detail
        $sql = "SELECT hos.BedID, hos.BedLevel,b.Cost FROM hospitalised AS hos INNER JOIN bed AS b ON hos.BedID=b.BedID AND hos.BedLevel=b.Level WHERE hos.HosID=$hosID";
        $result= mysqli_query($conn, $sql);
        echo "<div class='border p-3 mb-2 rounded'><h3>Bed Details:</h3>";
        if($result){
        $row = mysqli_fetch_array($result);
        $bedID=$row['BedID'];
        $bedLev=$row['BedLevel'];
        $bedCost=$row['Cost'];
        //bed level
        echo "<div class='row'><div class='col-2 pt-1'>Bed Selected:</div>";
        echo"<div class='col-4'><input class='form-control input-sm bed' value='".$bedLev."-";
        if($bedID<10){
            echo "00";
          }
          elseif($bedID<100){
            echo "0";
          }
        echo $bedID;
        echo"' readonly></div>";
        //bed price
        echo "<div class='col-1 pt-1'>Bed Price:</div><div class='col-4'><input class='form-control input-sm' value='RM".$bedCost."' readonly></div></div>";
        //change bed
        if($checkOut){
        echo"<div class='mt-2 btn btn-primary chgBed'>Change Bed</div>";}}
        else{
            echo"No Bed Information found.";
        }
        echo "</div>";
        //disease detail
        echo "<div class='border p-3 mb-2 rounded'><h3>Disease Detail:</h3>";
        $sql="SELECT dis.Name from hosDisease AS hos INNER JOIN disease AS dis ON hos.DiseaseID=dis.DiseaseID WHERE hos.HosID='$hosID' AND Taking='1'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck){
          while($row=mysqli_fetch_array($result)){
            echo"<div class='border rounded p-3 mb-2 bg-light'>".$row['Name']."</div>";
          }
        }
        else{
          echo"No Disease Having";
        }
        echo"<div class='row p-3'>";
        if($checkOut){
        echo"<div class='btn btn-primary rounded col-sm-2 me-4 mb-2 chgDis'>Change Disease</div>";}
        echo"<div class='btn btn-primary col-sm-2 rounded mb-2 viewDis'>View Disease History</div></div>";
        echo "</div>";
        //medicine detail
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
        echo"<div class='row p-3'>";
        if($checkOut){
        echo"<div class='btn btn-primary rounded col-sm-2 me-4 mb-2 chgMed'>Change Medicine</div>";}
        echo"<div class='btn btn-primary col-sm-3 rounded mb-2 viewMed'>View Medication History</div></div>";
        echo "</div>";
        //cost and hospitalised detail
        echo "<div class='border p-3 mb-2 rounded'><h3>Hospitalised Detail:</h3>";

        $sql = "SELECT * FROM hospitalised WHERE HosID ='$hosID'";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        //check in date
        echo "<div>Check In Date: <b>".$row['CheckInDate']."</b></div>";
        if($checkOut){
        //check in days
        $today=date("Y/m/d");
        $today=strtotime($today);
        $date=strtotime($row['CheckInDate']);
        $day=$today-$date;
        $day=round($day/(60*60*24))+1;
        echo "<div>Days: <b>".$day."</b></div>";
        //cost detail
        $cost=$day*$bedCost;
        echo "<div>Cost: <b>RM".$cost."</b></div>";
        }
        echo "</div>";
        //checkout button
        if($checkOut){
        echo"<div class='text-center mb-2'><button class='btn btn-danger checkOut'>Check Out</button></div>";
        }
        exit();

    
?>