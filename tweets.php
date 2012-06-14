<?php
    //some json code and files ready to be convereted 
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
    <div id="container"> <!-- wraps up all the tweets in a designed area and default parameter for the site -->
        <header id="header">
            <h1> Tweet results for <span><?php echo $outputs -> query." "."<br/>";?></span></h1>
        </header>     
    <?php
    
error_reporting(E_ALL & ~E_DEPRECATED);

  //the regular expressions to allow regular text to be converted into hyperlinks such as the http:// and @
	function makeClickableLinks($text){

        $text = html_entity_decode($text);
        $text = " ".$text;
        $text = ereg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target=_blank>\\1</a>', $text);
        $text = ereg_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target=_blank>\\1</a>', $text);
        $text = ereg_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
        '\\1<a href="http://\\2" target=_blank>\\2</a>', $text);
        $text = ereg_replace('([[:space:]()[{}])(@[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
        '\\1<a href="https://twitter.com/#!/\\2" target=_blank>\\2</a>', $text);
        return $text;	
}

// this loop allows the code to be ran to its desired amount, which is 25
        $i = 1;
        while ($i <=25) {
            $i++;

//the date_default_timezone_set is needed for the timestamp to occur because the browser needs a default timezone to operate	    
	date_default_timezone_set('America/New_York');

    ?>
   
   <!-- section of the tweets -->  
        <div class="tweet">
            <img class="img" src=" <?php echo $outputs -> results[$i] -> profile_image_url;?>"/> <!-- picture -->
                <div class="content">
		    <!-- determines the user namde and the user location -->
                    <p class="user_name"><a href="https://twitter.com/#!/<?php echo "@".$outputs -> results[$i] -> from_user;?>">
                    <span class="user"><?php echo $outputs -> results[$i] -> from_user_name." ";?></span></a>
                     <span class="at_user"><?php echo "@".$outputs -> results[$i] -> from_user;?></span></p>
		    <!-- determines the text from the user -->
                    <p class="text"> <?php echo makeClickableLinks($outputs -> results[$i] -> text);?> </p>	
                </div>
		<div class="time">
		    <!-- gets the time for the tweet -->
                        <?php $timestamp = strtotime($outputs -> results[$i] -> created_at);
			echo date("M j",$timestamp); echo "<br/>"; echo date("g:ia",$timestamp);?>
		</div>
            <div id="clear"></div> <!-- clears the float -->
        </div> <!-- end of the tweets section -->
<?php } ?>
    </div> <!-- closses the container which holds all the information -->
</body>
</html>