<?php
include "include/config.php";
 $id = htmlspecialchars($_GET['id']);
$error = false;
if(db_connect()){
	$qry = "SELECT Link FROM downloads WHERE ID=$id";
	try{
		$result = mysql_query($qry);
		if(mysql_num_rows($result)==1){
			while($rows = mysql_fetch_array($result)){
				$f=$rows['Link'];
			}
			$path = pathinfo($f);
			$n = $path['basename'];
			header('Content-type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$n.'');
			readfile($f);
		}else $error = true;
	}catch(Exception $e){
		$error = true;
	}
	if($error) header("Location: index.php");
}

?>
