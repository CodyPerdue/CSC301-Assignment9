<?php

require_once('functions.php');

function filterInput($data,$allowed_fields){
	for($i=0;$i<count(array_keys($data));$i++)
		if(!in_array(array_keys($data)[$i],$allowed_fields)) unset($data[array_keys($data)[$i]]);
	return $data;
}

function writeJSON($file,$data){
	$array=jsonToArray($file);
	$h=fopen($file,'w+');
	array_push($array, $data);
	fwrite($h,is_array($array) ? json_encode($array) : $array);
	fclose($h);
}

function readJSON($file,$index=null){
	$h=fopen($file,'r');
	$output='';
	while(!feof($h)) $output.=fgets($h);
	fclose($h);
	$output=json_decode($output,true);
	return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
}

function modifyJSON($file,$data,$index){
	$input=readJSON($file);
	$input[$index]=array_merge($input[$index],$data);
	writeJSON($file,$input);
}

function deleteJSON($file,$index){
	$input=readJSON($file);
	unset($input[$index]);
	writeJSON($file,$input);
}