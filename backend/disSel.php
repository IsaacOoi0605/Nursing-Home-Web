<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql="SELECT * from disease WHERE Available=1";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
            echo "<div class='row'>";
            while($row = mysqli_fetch_array($result)){
                echo "<div class='col-1'></div><div class='row col-10 border pt-2'><p class='col-10'><strong>".$row['Name']."</strong></p><div class='col-1'><input class='form-check-input' type='checkbox' id='flexCheckDefault'></div>
                <div class='disease'><div class='d-inline'>Disease ID:</div><div class='d-inline disID'>".$row['DiseaseID']."</div></div>
                </div><div class='col-1'></div>";
            }
            echo "</div>";
        }
        else{echo("<h1>No result found.</h1>");};?>