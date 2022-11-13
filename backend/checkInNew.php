<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";
    $db="management";
    $conn = mysqli_connect($server,$user,$password,$db);
    //retrieve patient ID
    $patID=$_SESSION['checkPatientID'];
    //retrieve bed level
    $bedSeries=$_SESSION['checkBedSeries'];
    //retrieve bed id
    $bedID=$_SESSION['checkBedID'];
    //retrieve today date
    $date=date("Y/m/d");
    //insert into database
    $sql = "INSERT INTO hospitalised (PatientID,CheckInDate,BedID,BedLevel) VALUES ('$patID','$date','$bedID','$bedSeries')";
    $result= mysqli_query($conn, $sql);
    //get the hospitalised id of the insert
    $hos_id = $conn->insert_id;
    //make patient check in
    $sql = "UPDATE patient SET Hospitalised = 1 WHERE PatientID='$patID'";
    unset($_SESSION['checkPatientID']);
    mysqli_query($conn, $sql);
    //make bed not available
    $sql = "UPDATE bed SET Availability = 0 WHERE Level='$bedSeries' AND BedID='$bedID'";
    mysqli_query($conn, $sql);
    unset($_SESSION['checkBedSeries']);
    unset($_SESSION['checkBedID']);
    //update disease info
    if (isset($_SESSION['checkDisease'])){
        $disease=$_SESSION['checkDisease'];
        foreach ($disease as $dis){
            $sql = "INSERT INTO hosDisease (DiseaseID,HosID,Taking) VALUES ('$dis','$hos_id','1')";
            $result= mysqli_query($conn, $sql);
        }
        unset($_SESSION['checkDisease']);
    }
    //update medicine info
    if (isset($_SESSION['checkMedicine'])){
        $medicine=$_SESSION['checkMedicine'];
        foreach($medicine as $med){
            $medID=$med['id'];
            echo $medID;  
            $medTime=$med['time'];
            echo $medTime;
            $medNo=$med['no'];
            echo $medNo;
            $sql="INSERT INTO hosMedicine (varID,HosID,NoOfTimes,NoOfTablet) VALUES ('$medID','$hos_id','$medTime','$medNo')";
            $result= mysqli_query($conn, $sql);
        }
        unset($_SESSION['checkMedicine']);
    }
    exit();

    
?>