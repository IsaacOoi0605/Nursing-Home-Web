<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $hosID=$_POST['HosID'];
        $sql="SELECT dis.Name as Name, dis.DiseaseID as disID from hosDisease AS hos INNER JOIN disease AS dis ON hos.DiseaseID=dis.DiseaseID WHERE hos.HosID='$hosID' AND Taking='1'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        echo"<div class='border rounded p-2'><h3>Disease Having</h3>";
        if($resultCheck){
            $dis=array();
            while($row=mysqli_fetch_array($result)){
                echo "<div class='row col-10 border p-2 rounded m-2'><p class='col-10'><strong>".$row['Name']."</strong></p><div class='col-1'><input class='form-check-input check' type='checkbox' checked></div>
                <div class='d-inline disID d-none'>".$row['disID']."</div>
                </div>";
                array_push($dis,$row['disID']);
            };
        }
        else{
            echo"No Disease Having";
        }
        echo"</div>";
        echo"<div class='border rounded p-2 mt-2'><h3>Change Disease</h3>";
        if(empty($dis)){
            $sql="SELECT * from disease WHERE Available=1";
            $result=mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck){
                while($row=mysqli_fetch_array($result)){
                    echo "<div class='row col-10 border p-2 rounded m-2'><p class='col-10'><strong>".$row['Name']."</strong></p><div class='col-1'><input class='form-check-input check' type='checkbox'></div>
                    <div class='d-inline disID d-none'>".$row['DiseaseID']."</div>
                    </div>";
                };
            }
        }
        else{
        $dis = implode(',', $dis);
        $sql="SELECT * from disease where Available=1 and DiseaseID not in (".$dis.")";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck){
            while($row=mysqli_fetch_array($result)){
                echo "<div class='row col-10 border p-2 rounded m-2'><p class='col-10'><strong>".$row['Name']."</strong></p><div class='col-1'><input class='form-check-input check' type='checkbox'></div>
                <div class='d-inline disID d-none'>".$row['DiseaseID']."</div>
                </div>";
            };
        }
        else{
            echo"All disease have been selected;";
        }
    }
        echo "</div>";

        exit();

    
?>