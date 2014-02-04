<?php

	require('utils.php');
	
	check_security();
	
	if(!isset($_GET["action"])) exit;
	
	$action = $_GET["action"];	
	$returncode = 1;
	
	if($action == "MERGE") $returncode = sketch_merge();
	elseif($action == "UPLOAD") $returncode = sketch_upload();
	elseif($action == "DELETE") $returncode = sketch_delete();
	
	$result = array('returncode' => $returncode);
	echo json_encode($result);	
?>