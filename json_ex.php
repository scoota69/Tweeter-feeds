<?php

    $json = '{"firstName":"John","lastName":"Smith","age":25,"address":{"streetAddress":"21 2nd Street","city":"New York","state":"NY","postalCode":"10021"},"phoneNumber":[{"type":"home","number":"212 555-1234"},{"type":"fax","number":"646 555-4567"}]}';
 
    $output = json_decode($json);
    //echo $output; not going to work because it cannot echo out a object but only a string
    
    //var_dump($output);
  ?>
  <h1>
    <?php
    //or you can do it this way $output -> firstName." ".$output -> lastName;
  echo $output ->firstName;
  echo " ";
  echo $output ->lastName;
  ?></h1>
    <address>
        <?php
            //print_r($output ->address);
            //echo $output -> address;
            echo $output -> address -> streetAddress."</br>";
            echo $output -> address -> city.", ";
            echo $output -> address -> state."</br>";
            echo $output -> address -> postalCode;
        
      ?>  
    </address>
<?php
   // $json = file_get_contents("example.json");
    
    $json = file_get_contents("https://search.twitter.com/search.json?q=fitness&rpp=25&include_entities=true&result_type=mixed");
        //var_dump($json);
    $outputs = json_decode($json);
        //var_dump($outputs);
        //echo parse_url($json, PHP_URL_PATH);
        echo $outputs -> page." ";
        echo $outputs -> query." ";
        echo $outputs -> results."<br/>";
?>
<?php
$i = 1;
while ($i <=25) {
    echo $i++;
}
?>
    <div>
        <img src=" <?php echo $outputs -> results[0] -> profile_image_url;?>"/>
        <img src=" <?php echo $outputs -> results[0] -> profile_image_url_https;?>"/>
        <p> <?php echo $outputs -> results[0] -> from_user_name." "."@";
              echo $outputs -> results[0] -> from_user;?></p>
         <p> <?php echo $outputs -> results[0] -> text;
            echo $outputs -> results[0] -> created_at; ?> </p>
    </div>        
