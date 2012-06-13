<?php

    $json = file_get_contents("https://search.twitter.com/search.json?q=fitness&rpp=25&include_entities=true&result_type=mixed");
    $outputs = json_decode($json);
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>tweets</title>
	<meta name="twitter" content="A template for tweets">
	<!--Stylesheets-->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="container">
        <header id="header">
            <h1> Tweet results for <?php echo $outputs -> query." "."<br/>";?></h1>
        </header>     
    <?php   
        $i = 1;
        while ($i <=25) {
            $i++;
    ?>
        <div class="tweet">
            <img class="img" src=" <?php echo $outputs -> results[$i] -> profile_image_url;?>"/>
                <div class="content">
                    <p class="user_name"><a href="https://twitter.com/#!/<?php echo "@".$outputs -> results[$i] -> from_user;?>">
                    <span class="user"><?php echo $outputs -> results[$i] -> from_user_name." ";?></span></a>
                     <span class="at_user"><?php echo "@".$outputs -> results[$i] -> from_user;?></span></p>
                    <p class="text"> <?php echo $outputs -> results[$i] -> text;
                            echo $outputs -> results[$i] -> created_at; ?> </p>
                </div>
                <div id="clear"></div>
        </div>
<?php } ?>
    </div>
</body>
</html>