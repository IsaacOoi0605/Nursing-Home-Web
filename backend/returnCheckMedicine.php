<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $HosID=$_POST['HosID'];
        $sql="SELECT * from hosmedicine where HosID='$HosID' and Taking='1'";
        $result= mysqli_query($conn, $sql);
        $resultCheck=mysqli_num_rows($result);
        $medicine=array();
        echo"<h3>Medicine Taking</h3>";
        if($resultCheck){
            $medName="";
            $sql="SELECT varMed.varID as varID, med.Name AS Name, varMed.Weight AS Weight,hos.NoOfTimes AS time, hos.NoOfTablet AS tablet from hosmedicine as hos INNER JOIN variantmedicine as varMed ON hos.varID=varMed.varID INNER JOIN medicine as med ON varMed.MedID=med.MedID WHERE hos.HosID='$HosID'AND hos.Taking='1' ORDER BY med.Name ASC";
            $resultMed=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($resultMed)){
            if($row['Name']!=$medName){
            echo "<div class='border rounded p-2'><h4>".$row['Name']."</h4></div>";
            $medName=$row['Name'];
            }
            echo '<div class="ms-1 row removed variant mb-1 mt-1">
                    <div class="border col-10 bg-light ps-2 rounded content '.$row['Weight'].'"><div class="row"><div class="col">
                        Weight:<p class="mb-0 weight">'.$row['Weight'].'</p>
                        <p class="varID d-none">'.$row['varID'].'</p></div>
                        <div class="border rounded me-2 bg-white col-4 pt-4 pb-3"><input class="form-control quantity" type="number" id="quantity" name="quantity" min="0" max="100" value="'.$row['tablet'].'"></div></div>
                     </div>
                     <div class="col-2 align-self-center">
                        <input class="tip" type="checkbox" id="tick" checked>
                     </div>
                     <div class="row mt-1 slot">
                     <div class="col-sm-2"><input class="form-control time d-inline-block" type="number" value="'.$row['time'].'"></div>
                     <div class="col-sm-2">Times Per Day</div>
                     </div>
                     </div>
                     ';
                     array_push($medicine,$row['varID']);
            }
        }
        else{
            echo"No Medicine Taking";
        }
        echo"<h3 class='mt-3'>Medicine Not Taking</h3>";
        $medName="";
        if(empty($medicine)){
            $sql="SELECT med.Name AS Name, varMed.Weight AS Weight, varMed.varID as varID from variantmedicine as varMed inner join medicine as med on med.MedID=varMed.MedID WHERE varMed.Available=1 ORDER BY med.Name ASC ";
            $result=mysqli_query($conn,$sql);
            $medName="";
            while($row=mysqli_fetch_array($result)){
                if($row['Name']!=$medName){
                    echo "<div class='border rounded p-2'><h4>".$row['Name']."</h4></div>";
                    $medName=$row['Name'];
                  }
                  echo '<div class="ms-1 row removed variant mb-1 mt-1">
                  <div class="border col-10 bg-light ps-2 rounded content '.$row['Weight'].'"><div class="row"><div class="col">
                      Weight:<p class="mb-0 weight">'.$row['Weight'].'</p>
                      <p class="varID d-none">'.$row['varID'].'</p></div>
                      <div class="border rounded me-2 bg-white col-4 pt-4 pb-3"><input class="form-control quantity" type="number" id="quantity" name="quantity" min="0" max="100" readonly></div></div>
                   </div>
                   <div class="col-2 align-self-center">
                      <input class="tip" type="checkbox" id="tick">
                   </div>
                   <div class="row mt-1 slot">
                   <div class="col-sm-2"><input class="form-control time d-inline-block" type="number" readonly></div>
                   <div class="col-sm-2">Times Per Day</div>
                   </div>
                   </div>
                   ';
                
            }
        }
        else{
            $medicine=implode(',', $medicine);
            $sql="SELECT med.Name AS Name, varMed.Weight AS Weight, varMed.varID as varID from variantmedicine as varMed inner join medicine as med on med.MedID=varMed.MedID WHERE varMed.Available=1 AND varMed.varID not in (".$medicine.") ORDER BY med.Name ASC";
            $result=mysqli_query($conn,$sql);
            $resultCheck=mysqli_num_rows($result);
            $medName="";
            if($resultCheck){
            while($row=mysqli_fetch_array($result)){
                if($row['Name']!=$medName){
                    echo "<div class='border rounded p-2'><h4>".$row['Name']."</h4></div>";
                    $medName=$row['Name'];
                  }
                  echo '<div class="ms-1 row removed variant mb-1 mt-1">
                  <div class="border col-10 bg-light ps-2 rounded content '.$row['Weight'].'"><div class="row"><div class="col">
                      Weight:<p class="mb-0 weight">'.$row['Weight'].'</p>
                      <p class="varID d-none">'.$row['varID'].'</p></div>
                      <div class="border rounded me-2 bg-white col-4 pt-4 pb-3"><input class="form-control quantity" type="number" id="quantity" name="quantity" min="0" max="100" readonly></div></div>
                   </div>
                   <div class="col-2 align-self-center">
                      <input class="tip" type="checkbox" id="tick">
                   </div>
                   <div class="row mt-1 slot">
                   <div class="col-sm-2"><input class="form-control time d-inline-block" type="number" readonly></div>
                   <div class="col-sm-2">Times Per Day</div>
                   </div>
                   </div>
                   ';
                
            }}
            else{
                echo"All Medicine Has been selected";
            }
        }
        ?>