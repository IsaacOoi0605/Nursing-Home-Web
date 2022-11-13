<?php
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $changes=$_POST['changes'];
        $disName=$_POST['disName'];
        //set the old disease not available
        $sql="UPDATE disease SET Available=0 where Name='$disName'";
        $result=mysqli_query($conn,$sql);
        //if user want to apply changes to the patient hospitalised
        if($changes){
            //get the old id of the old disease
            $sql="SELECT DiseaseID from disease where Name='$disName'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
            $oldID=$row['DiseaseID'];
            //get the patient id who still hospitalised
            $sql="SELECT HosID from hospitalised where CheckOutDate='0'";
            $result=mysqli_query($conn,$sql);
            $resultCheck=mysqli_num_rows($result);
            if($resultCheck){
                $HosID=array();
                while($row=mysqli_fetch_array($result)){
                    array_push($HosID,$row['HosID']);
                }
                $hos = implode(',', $HosID);
                //update the disease to be not taking
                $sql="UPDATE hosdisease SET Taking=0 where DiseaseID='$oldID' and HosID in (".$hos.") and Taking=1";
                mysqli_query($conn,$sql);
            }
        }


        ?>