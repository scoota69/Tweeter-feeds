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
	    
	<!-- <script src="jquery-1.7.1.min.js"></script>
	<script>
	    $(function()
{
    var re = /(https?:\/\/(([-\w\.]+)+(:\d+)?(\/([\w/_\.]*(\?\S+)?)?)?))/ig;    
    $('.text').html($('.text').html().replace(re, '<a href="$1" title="">$1</a>'));
});
	</script> -->
</head>

<body>
    <div id="container">
        <header id="header">
            <h1> Tweet results for <?php echo $outputs -> query." "."<br/>";?></h1>
        </header>     
    <?php
    
error_reporting(E_ALL & ~E_DEPRECATED);
    
function makeClickableLinks($text){

        $text = html_entity_decode($text);
        $text = " ".$text;
        $text = ereg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target=_blank>\\1</a>', $text);
        $text = ereg_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
                '<a href="\\1" target=_blank>\\1</a>', $text);
        $text = ereg_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',
        '\\1<a href="http://\\2" target=_blank>\\2</a>', $text);
        $text = ereg_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})',
        '<a href="mailto:\\1" target=_blank>\\1</a>', $text);
        return $text;
}

        $i = 1;
        while ($i <=25) {
            $i++;
	    
	date_default_timezone_set('America/New_York');

    ?>
        <div class="tweet">
            <img class="img" src=" <?php echo $outputs -> results[$i] -> profile_image_url;?>"/>
                <div class="content">
                    <p class="user_name"><a href="https://twitter.com/#!/<?php echo "@".$outputs -> results[$i] -> from_user;?>">
                    <span class="user"><?php echo $outputs -> results[$i] -> from_user_name." ";?></span></a>
                     <span class="at_user"><?php echo "@".$outputs -> results[$i] -> from_user;?></span></p>
                    <p class="text"> <?php echo makeClickableLinks($outputs -> results[$i] -> text);?> </p>	
                </div>
		<div class="time">
                        <?php $timestamp = strtotime($outputs -> results[$i] -> created_at);
			echo date("M j",$timestamp); echo "<br/>"; echo date("g:ia",$timestamp);?>
		</div>
            <div id="clear"></div>
        </div>
<?php } ?>
    </div>
</body>
</html>