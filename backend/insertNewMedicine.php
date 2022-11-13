<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //retrieve medicine name and variant from ajax
        $name=$_POST['namePHP'];
        $all=$_POST['allPHP'];
        $sql="SELECT * from medicine where Name='$name' and Available=1";
        $result= mysqli_query($conn, $sql);
        $resultCheck=mysqli_num_rows($result);
        if($resultCheck){
        }
        else{
        $sql="SELECT * from medicine where Name='$name' and Available=0";
        $result= mysqli_query($conn, $sql);
        $resultCheck=mysqli_num_rows($result);
        if($resultCheck){  
            $sql="UPDATE medicine SET Available=1 where Name='$name'";
            mysqli_query($conn, $sql);
            $sql="SELECT MedID from medicine where Name='$name' and Available=1";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_array($result);
            $lastID=$row['MedID'];
            $variant=explode(",",$all);
            foreach ($variant as $weight){
                $sql = "SELECT varID from variantmedicine where MedID='$lastID' and Weight=$weight";
                $result= mysqli_query($conn, $sql);
                $resultCheck=mysqli_num_rows($result);
                if($resultCheck){
                    $sql = "UPDATE variantmedicine SET Available=1 where MedID='$lastID' and Weight=$weight";
                    mysqli_query($conn, $sql);
                }
                else{
                    $sql ="INSERT INTO variantmedicine (MedID,Weight,Available) VALUES ('$lastID)', '$weight',1)";
                    mysqli_query($conn, $sql);
                }
            }
            echo("success");
        }
        else{
            //insert medicine into medicine table
            $sql = "INSERT INTO medicine (Name) VALUES ('$name')";
            $result= mysqli_query($conn, $sql);
            //get the id of the inserted row
            $last_id = $conn->insert_id;
            //insert the medicine variant into variant medicine table
            $variant=explode(",",$all);
            foreach ($variant as $weight){
            $sql = "INSERT INTO variantmedicine (MedID,Weight,Available) VALUES ('$last_id)', '$weight',1)";
            $result= mysqli_query($conn, $sql);}
            if($result){
                echo ("success");
            }}
    }
        exit();

    
?>