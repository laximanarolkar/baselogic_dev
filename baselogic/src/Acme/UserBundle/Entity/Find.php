<?php


require_once("window.php");


$termArray = $_POST['search_term'];

 $count = 0;
 if (isset ($termArray)){
 foreach($termArray as $value){
	if ($count == 0){$term = "manufacturer = '$termArray[0]'";}
	else{ $term = $term.(" OR manufacturer = '$value'");}
	$count = $count+1;}
}

 $styleArray = $_POST['search_style'];

 $count = 0;
 if (isset ($styleArray)){
 foreach($styleArray as $value){
	if ($count == 0){$style = "style = '$styleArray[0]'";}
	else{ $style = $style.(" OR style = '$value'");}
	$count = $count+1;}
 }
 
 $optionsArray = $_POST['search_options'];
 

$frame = strip_tags(substr($_POST['search_frame'],0, 100));
$frame = mysql_escape_string($frame); 


$width = strip_tags(substr($_POST['search_width'],0, 100));
$width = mysql_escape_string($width);

$height = strip_tags(substr($_POST['search_height'],0, 100));
$height = mysql_escape_string($height); 

$unitedinch = intval($height) + intval($width);

if($width%6>=3){$callOutWidth = $width+(6-$width%6);}
else if($width%6<3){$callOutWidth = $width-($width%6);}
else {$callOutWidth = $width;}
$width2 = $callOutWidth;
if($height%6>=3){$callOutLength = $height+(6-$height%6);}
else if($height%6<3){$callOutLength = $height-($height%6);}
else{$callOutLength = $height;}
$height2 = $callOutLength;
$callOutWidth = floor($callOutWidth/12) . $callOutWidth%12;
$callOutLength = floor($callOutLength/12) . $callOutLength%12;

$callOut = "callout = " . $callOutWidth . $callOutLength;

$sql = "SELECT * FROM windows  WHERE ($term) AND ($style) AND frame = '$frame' AND ((width = '$width2' AND height = '$height2') OR (ui = $unitedinch) OR ($callOut)) ORDER BY base,style";

$query_result = mysql_query($sql);

$window_product = window_function($query_result, $optionsArray);


$encoded = json_encode($window_product);

echo $encoded;


?>
