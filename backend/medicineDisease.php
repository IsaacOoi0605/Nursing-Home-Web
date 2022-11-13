<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT * from medicine";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          while($row = mysqli_fetch_array($result)) {
            echo '<div class="row disease">';
            echo '<div class="border col-11 bg-light ms-2 mt-2 rounded name removed '.$row['Name'].'"><h3>'.$row['Name'].'</h3></div>';
            $variant=json_decode($row['Variant']);
            foreach($variant as $wei => $pri){
                echo '<div class="ms-1 row removed variant">
                    <div class="border col-10 bg-light ps-2 rounded content '.$wei.'"><div class="row"><div class="col">
                        Weight:<p class="mb-0 weight">'.$wei.'</p>
                        Price:<p class="mb-0 price">'.$pri.'</p></div>
                        <div class="border rounded me-2 bg-white col-4 pt-4"><input class="form-control" type="number" id="quantity" name="quantity" min="0" max="100" readonly></div></div>
                     </div>
                     <div class="col-2 align-self-center">
                        <input class="tip" type="checkbox" id="tick">
                     </div></div>
                     ';
            }
            echo '</div>';
        };
        }
        else{
            echo"<h1>No result found.</h1>";
        }

        ?>