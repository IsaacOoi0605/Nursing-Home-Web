<?php
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $hosID=$_POST['HosID'];
        $medicine=$_POST['medicine'];
        if(empty($medicine)){
            $sql="UPDATE hosmedicine SET Taking='0' where HosID='$hosID'";
            $result= mysqli_query($conn, $sql);
        }
        else{
            $checkMed=array();
            foreach($medicine as $med){
                $medID=$med['id'];
                array_push($checkMed,$medID);
                $medNo=$med['no'];
                $medTime=$med['time'];
                $sql="SELECT * from hosmedicine where VarID='$medID' and HosID='$hosID'";
                $result= mysqli_query($conn, $sql);
                if($row=mysqli_fetch_array($result)){
                    $sql="UPDATE hosmedicine SET Taking='1', NoOfTablet='$medNo',NoOfTimes=$medTime where VarID='$medID' and HosID='$hosID'";
                    $result= mysqli_query($conn, $sql);
                }
                else{
                    $sql="INSERT INTO hosmedicine (varID, HosID,NoOfTimes,NoOfTablet,Taking) VALUES ('$medID', '$hosID', '$medTime','$medNo',TRUE)";
                    $result= mysqli_query($conn, $sql);
                }
            }
            $medNot = implode(',', $checkMed);
            $sql="UPDATE hosmedicine set Taking='0' where HosID=$hosID and varID not in (".$medNot.")";
            $result= mysqli_query($conn, $sql);
            }


?>