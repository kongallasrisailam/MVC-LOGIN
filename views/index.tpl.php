<?php

        $arr = $_SESSION['details'];
   ?>     
       
    <h3 style='color:green'> wellcome to home ur email id is <?php echo  $arr['email'];?> </h3>
    <ul>
    <?php 
    $_SESSION['update']=$arr;
      foreach($arr as $keys => $values)
            {
                if($keys!=='password'){
                    echo "<li>$keys ".":". " $values</li>";
                }
            }
    ?>
    </ul>
    <a href="index.php?path=logout" >logout</a><br>
    <a href="index.php?path=profile_update&id=<?php echo $_SESSION['update']['id']?>">update details</a>

<?php
   

    
?>