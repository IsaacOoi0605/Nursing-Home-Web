<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $hosID=$_POST['HosID'];
        $dis=$_POST['dis'];
        if(empty($dis)){
            $sql="UPDATE hosdisease set Taking='0' where HosID=$hosID";
            $result= mysqli_query($conn, $sql);
        }
        else{
        $disNot = implode(',', $dis);
        $sql="UPDATE hosdisease set Taking='0' where HosID=$hosID and DiseaseID not in (".$disNot.")";
        $result= mysqli_query($conn, $sql);
        foreach ($dis as $disID){
            //check if the disease already exist in database and having by patient
            $sql="SELECT * from hosdisease where HosID=$hosID and DiseaseID=$disID and Taking='1'";
            $result= mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            //if not exist do nothing
            if($resultCheck){
            }
            else{
                //check patient before having the disease or not
                $sql="SELECT * from hosdisease where HosID=$hosID and DiseaseID=$disID and Taking='0'";
                $result= mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                //if having disease before then just update the taking to 1
                if($resultCheck){
                    $sql="UPDATE hosdisease set Taking='1' where HosID=$hosID and DiseaseID=$disID";
                    $result= mysqli_query($conn, $sql);
                }
                //else insert into the patient disease table
                else{
                    $sql="INSERT into hosdisease (DiseaseID,HosID,Taking) values ('$disID','$hosID',TRUE)";
                    $result= mysqli_query($conn, $sql);
                }
            }
        }
        }

?>