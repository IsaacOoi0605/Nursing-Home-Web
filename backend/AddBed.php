<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        if(isset($_POST['priceBed'])){
        $id=$_POST['number'];
        $name=$_POST['bedName'];
        $price=$_POST['priceBed'];
        $sql = "INSERT INTO bed (BedID, LEVEL, Cost, Availability) VALUES ('$id', '$name','$price',TRUE)";
        $result0= mysqli_query($conn, $sql);


        
        if($result0){
                echo ('Bed insert successfully');
            }}
        else{
                $name=$_POST['bedName'];
                $sql = "SELECT * FROM bed WHERE LEVEL LIKE '$name'";
                $result= mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck>0){
                        echo"1";
                }
        }
        exit();
?>