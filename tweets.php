<?php

    $json = file_get_contents("https://search.twitter.com/search.json?q=fitness&rpp=25&include_entities=true&result_type=mixed");

    $outputs = json_decode($json);
        echo $outputs -> page." ";
        echo $outputs -> query." ";
        echo $outputs -> results."<br/>";
?>
<?php
$i = 1;
while ($i <=25) {
    echo $i++;
?>
    <div>
        <img src=" <?php echo $outputs -> results[$i] -> profile_image_url;?>"/>
        <p> <?php echo $outputs -> results[$i] -> from_user_name." "."@";
              echo $outputs -> results[$i] -> from_user;?></p>
         <p> <?php echo $outputs -> results[$i] -> text;
            echo $outputs -> results[$i] -> created_at; ?> </p>
    </div>        
<?php } ?>