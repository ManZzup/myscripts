<?php
//This should be the first line as in the rule book :D
session_start();
//These variables store the Question and the answer
$ques = "";
$ans = "";
//This is the MAJOR array, this holds all the random things, like the question you need to ask. You can add up new ones easily
$words = array(
		0 => array("Num" => "Num"),
		1 => array("Are you human?" => "yes"),
		2 => array("Type 'one' " => "one"),
		3 => array("Type 'test' " => "test"),
		4 => array("AxHGA" => "AxHGA"),
		5 => array("zontek" => "zontek"),
		6 => array("12terd " => "12terd")
	);
	//Now we need to pic up a random question, array_rand is the perfect thing to this
	$r = array_rand($words);
	//Then we check about what we have in the select array
	switch(key($words[$r])){
		//If we have the "NUM" selected, that is a special one
		//Num means the user will be prompted to doa simple addition like 5+6
		case "Num":
			//Pretty basic stuff, generate 2 random numbers and tell the user to put the addition
			$i = rand(1,10);
			$j = rand(1,10);
			$ans = $i+$j;
			$ques = "$i + $j = ";
			break;
		default:
			//If not a number, ask the user a question or ask him to type a word
			$key = key($words[$r]);
			$ques = $key;
			$ans = $words[$r][$key];
			break;
	}

//NOW we put up the answer to the session variable
$_SESSION['cap'] = strtolower($ans);
//This would change the content type, or in english this would tell the browser that
//what ever retuened by this script is an image
header('Content-Type: image/png');

//Following code is to generate the image from the test
//We first specify colour ranges, you can refer to the php manaul for more
$img = imagecreatetruecolor(250,30);
//In the above code, the image size is set to 250x30
$white = imagecolorallocate($img,255,255,255);
$grey = imagecolorallocate($img,128,128,128);
$black = imagecolorallocate($img,0,0,0);
//Filling the rectangle with white as we need black text on white
imagefilledrectangle($img,0,0,399,29, $white);
$text = $ques;
//THE below code is CRITICAL. This is the palce where we tell which font to use.
//Choose any ttf you like and name it as font.ttf or change the following code, make sue
//you put the path to the file correctly
$font = "./font.ttf";
imagettftext($img,20,0,11,21,$grey,$font,$text);
imagettftext($img,20,0,10,20,$black,$font,$text);
//Creating a PNG image, i use png cuz i <3 png [really its so small and efficient ;)]
imagepng($img);
//And then remove the memory parts once the output is given
imagedestroy($img);
?>