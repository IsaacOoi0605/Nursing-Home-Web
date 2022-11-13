<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT * from medicine where Available=1";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
            //fetch each medicine name
          while($row = mysqli_fetch_array($result)) {
            echo '<div class="row medicine mb-1">';
            echo '<div class="border col-11 bg-light ms-2 mt-2 rounded name removed '.$row['Name'].'"><h3 class="medName">'.$row['Name'].'</h3><h4 class="id">'.$row['MedID'].'</h4></div>';
            //fetch data from variant medicine for each medicine
            $medId= $row['MedID'];
            $sql="SELECT * FROM variantMedicine WHERE MedID='$medId' AND Available=1";
            $resultVar=mysqli_query($conn,$sql);
            //for each variant generate one column
            while($row=mysqli_fetch_array($resultVar)){
                echo '<div class="ms-1 row removed variant mb-1 mt-1">
                    <div class="border col-10 bg-light ps-2 rounded content '.$row['Weight'].'"><div class="row"><div class="col">
                        Weight:<p class="mb-0 weight">'.$row['Weight'].'</p>
                        <p class="varID">'.$row['varID'].'</p></div>
                        <div class="border rounded me-2 bg-white col-4 pt-4 pb-3 item"><input class="form-control quantity" type="number" id="quantity" name="quantity" min="0" max="100" readonly></div></div>
                     </div>
                     <div class="col-2 align-self-center">
                        <input class="tip" type="checkbox" id="tick">
                     </div>
                     <div class="row mt-1 slot">
                     <div class="col-sm-2"><input class="form-control time d-inline-block" type="number" readonly></div>
                     <div class="col-sm-2">Times Per Day</div>
                     </div>
                     </div>
                     ';
            }
            echo '</div>';
        };
        }
        else{
            echo"<h1>No result found.</h1>";
        }

        ?>