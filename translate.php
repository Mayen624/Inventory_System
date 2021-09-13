<?php 
	//$page_name = "menulateral";
	
	$file = file_get_contents("lang.json");
	$list = json_decode($file, true);
	
	$page_strings = $list[$page_name];
	//var_dump($page_strings);    

?>