<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //insert each patient daily cost into table
        $date=date("Y-m-d");
        $sql = "SELECT hos.HosID, b.Cost FROM hospitalised AS hos INNER JOIN bed AS b ON hos.BedID=b.BedID AND hos.BedLevel=b.Level WHERE hos.CheckOutDate='0'";
        $result=mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck){
                while($row=mysqli_fetch_array($result)){
                        $hosID=$row['HosID'];
                        $cost=$row['Cost'];
                        $sql = "INSERT INTO patientrevenue (todayDate,HosID,Cost) VALUES ('$date','$hosID','$cost')";
                        $resultIns= mysqli_query($conn, $sql);
                }}
        //after insert daily patient cost then insert revenue today
        $sql="SELECT SUM(Cost) as cost from patientrevenue where todayDate='$date'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $totalRevenue=$row['cost'];
        $sql="INSERT into revenue (Date, Revenue) VALUES('$date','$totalRevenue')";
        $result=mysqli_query($conn,$sql);
?>