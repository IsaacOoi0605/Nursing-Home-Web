<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $medID=$_POST['medID'];
        $varMed=$_POST['varMed'];
        $newName=$_POST['newName'];
        //if name changes then applied changes
        if($newName){
            $sql="SELECT Name from medicine where Name='$newName'";
            $result=mysqli_query($conn,$sql);
            $resultCheck=mysqli_num_rows($result);
            if($resultCheck){
                exit();
            }
            else{
                $sql="UPDATE medicine SET Name='$newName' where MedID='$medID'";
                mysqli_query($conn,$sql);
            }
        }
        $varMedNew = implode(',', $varMed);
        //set the variant weight medicine not in the list into not available
        $sql="UPDATE variantmedicine SET Available=0 where MedID ='$medID' and Weight not in (".$varMedNew.")";
        mysqli_query($conn,$sql);
        //set the patient who having the medicine into not taking as the medicine is not available
        $sql="SELECT varID from variantmedicine where Available=0 and MedID='$medID'";
        $result=mysqli_query($conn,$sql);
        $resultCheck=mysqli_num_rows($result);
        if ($resultCheck){
            $VarID=array();
            while($row=mysqli_fetch_array($result)){
                array_push($VarID,$row['varID']);
            }
        }
        if(!empty($VarID)){
            $sql="SELECT HosID from hospitalised where CheckOutDate=0";
            $result=mysqli_query($conn,$sql);
            $resultCheck=mysqli_num_rows($result);
            if ($resultCheck){
            $HosID=array();
            while($row=mysqli_fetch_array($result)){
                array_push($HosID,$row['HosID']);
            }
        }
        }
        if(!empty($HosID)){
            $HosNew=implode(',', $HosID);
            $VarNew=implode(',', $VarID);
            $sql="UPDATE hosmedicine SET Taking=0 where HosID in (".$HosNew.") AND varID in (".$VarNew.")";
            mysqli_query($conn,$sql);
        }
        //for each variant in medicine list
        foreach ($varMed as $var){
            $sql="SELECT * from variantmedicine where MedID='$medID' and Weight='$var'";
            $result= mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            //if not exist do nothing
            if($resultCheck){
                $sql="UPDATE variantmedicine SET Available=1 where MedID ='$medID' and Weight ='$var'";
                mysqli_query($conn, $sql);
            }
            else{
                $sql="INSERT INTO variantmedicine (MedID,Weight,Available) VALUES ('$medID','$var',1)";
                mysqli_query($conn, $sql);
            }
        }
        echo "successfully applied changes";
        exit();

    
?>