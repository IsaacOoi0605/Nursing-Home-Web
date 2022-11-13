<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $medID=$_POST['medID'];
        //set medicine into not available
        $sql="UPDATE medicine SET Available=0 where MedID='$medID'";
        mysqli_query($conn,$sql);
        if(isset($_POST['remove'])){
        //remove medicine from hospitalised patient
        $sql="SELECT varID from variantmedicine where MedID='$medID' and Available=1";
        $result=mysqli_query($conn,$sql);
        $varID=array();
        while($row=mysqli_fetch_array($result)){
            array_push($varID,$row['varID']);
        }
        $sql="SELECT HosID from hospitalised where CheckOutDate='0'";
        $result=mysqli_query($conn,$sql);
        $HosID=array();
        while($row=mysqli_fetch_array($result)){
            array_push($HosID,$row['HosID']);
        }
        $newHos=implode(",",$HosID);
        $newVar=implode(",",$varID);
        echo $newHos;
        echo $newVar;
        $sql="UPDATE hosmedicine SET Taking=0 where HosID in (".$newHos.") and varID in (".$newVar.")";
        mysqli_query($conn,$sql);}
        //set medicine variant into not available
        $sql="UPDATE variantmedicine SET Available=0 where MedID='$medID'";
        mysqli_query($conn,$sql);
?>