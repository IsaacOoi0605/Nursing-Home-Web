<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        if(isset($_POST['idPHP'])){
            $_SESSION['disID']=$_POST['idPHP'];
        }
        else{
            $id=$_SESSION['disID'];
            $sql = "SELECT * from disease WHERE DiseaseID='$id'";
            $result= mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck>0){
                while($row = mysqli_fetch_array($result)) {
                echo '<form id="form">
                <!--disease name-->
                <div class="form-group">
                    <label for="MedName">Enter Disease Name:</label>
                    <input type="text" class="form-control nameCol" id="MedName" placeholder="Enter Disease Name" value="'.$row['Name'].'">
                    <p class="errorMsg text-danger"></p>
                </div>
                <!--disease name-->';
                  };
            }
        }

        ?>