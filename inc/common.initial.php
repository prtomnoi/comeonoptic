<?php
error_reporting(0);

require("template.php");
require("common.config.php");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$template = new template();
$time = time();



function magic_quote($data){
	if (is_array($data)){
		foreach($data as $a1 => $a2){
			$r[$a1] = addslashes($a2);
		}
	} else {
		$r = addslashes($data);
	}
	return $r;
}


function pageresult($syntax,$itemperpage,$currentpage,&$allpage,$ajax = false){
	
	// reform if none var use ".php?"
	$adder = (substr($syntax, -4) == ".php" ? "?p=" : "&p=");
	if ($allpage < 1){ $allpage = 1; }
	if ($currentpage < 1){ $currentpage = 1; }

	// Perform
	$page_selected = "<b>%1\$d</b> ";
	if ($ajax != ""){
		$page_link = "<a href=\"".$syntax."%1\$s\" onclick=\"".$ajax."('%2\$d'); return false;\">%2\$d</a> ";
		$aj = true;
	} else {
		$page_link = "<a href=\"".$syntax."%1\$s\">%2\$d</a> ";
		$aj = false;
	}

	if ($allpage < 15){
		for ($i = 1;$i<=$allpage;$i++){
			$show .= ($i == $currentpage ? sprintf($page_selected,$i) : sprintf($page_link,$adder.$i,$i));
		}
	} else {
		if ($currentpage - 3 > 5){
			$pause[] = 5;
			$pause[] = $currentpage - 3;
		}
		
		if ($currentpage + 3 < $allpage - 4){
			$pause[] = $currentpage + 3;
			$pause[] = $allpage - 4;
		}

		reset($pause);

		for ($i = 1;$i<=$allpage;$i++){
			if ($i == current($pause)){
				$show .= "... ";
				$i = next($pause);
				next($pause);
			}
			$show .= ($i == $currentpage ? sprintf($page_selected,$i) : sprintf($page_link,$adder.$i,$i));
		}
		
	}
	
	return $show;
}

function pageresultul($syntax,$itemperpage,$currentpage,&$allpage,$ajax = false){
	
	// reform if none var use ".php?"
	$adder = (substr($syntax, -4) == ".php" ? "?p=" : "&p=");
	if ($allpage < 1){ $allpage = 1; }
	if ($currentpage < 1){ $currentpage = 1; }

	  /*
	  <li><a href=\"#\">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li><a href="#">8</a></li>
							<li><a href=\"#\"> ... </a></li>
	  
	  */
		
	$page_selected = "<li><a href=\"#\">%1\$d</a></li>";
	if ($ajax != ""){
		$page_link = "<li><a href=\"".$syntax."%1\$s\">%2\$d</a></li>";
		$aj = true;
	} else {
		$page_link = "<li><a href=\"".$syntax."%1\$s\">%2\$d</a></li>";
		$aj = false;
	}

	if ($allpage < 10){
		for ($i = 1;$i<=$allpage;$i++){
			$show .= ($i == $currentpage ? sprintf($page_selected,$i) : sprintf($page_link,$adder.$i,$i));
		}
	} else {
		if ($currentpage - 3 > 5){
			$pause[] = 3;
			$pause[] = $currentpage - 3;
		}
		
		if ($currentpage + 2 < $allpage - 2){
			$pause[] = $currentpage + 2;
			$pause[] = $allpage - 2;
		}

		reset($pause);

		for ($i = 1;$i<=$allpage;$i++){
			if ($i == current($pause)){
				$show .= "<li><a href=\"#\"> ... </a></li>";
				$i = next($pause);
				next($pause);
			}
			$show .= ($i == $currentpage ? sprintf($page_selected,$i) : sprintf($page_link,$adder.$i,$i));
		}
		
	}
	
	return $show;
}





// Debug Function
function show_array($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

?>