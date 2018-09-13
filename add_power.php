<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = 'Zeitgeist - Add new Power';
require 'head.php';
require_once 'generatePowerTables.php';
require_once 'mysqlbackend.php';
?>
<body>
<div id="textblock">
<?php
require_once 'mysqlbackend.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

	if(!isset($_POST['power_name']) or !isset($_POST['power_class']) or !isset($_POST['power_level']) or !isset($_POST['power_type']) or !isset($_POST['power_type2']) or !isset($_POST['power_action']) or !isset($_POST['power_range']) or !isset($_POST['power_range_value']) or !isset($_POST['power_range_aoe']) or !isset($_POST['power_flavor']) or !isset($_POST['keywords']) or empty($_POST['power_name'])) trigger_error('A value has not been set. Aborting...', E_USER_ERROR);
	else {
		$power_name = 		cleanInput($_POST['power_name']);
		$power_class =		cleanInput($_POST['power_class']);
		$power_level =		cleanInput($_POST['power_level']);
		$power_type =		cleanInput($_POST['power_type']);
		$power_type2 =		cleanInput($_POST['power_type2']);
		$power_action =		cleanInput($_POST['power_action']);
		$power_range =		cleanInput($_POST['power_range']);
		$power_range_value =cleanInput($_POST['power_range_value']);
		$power_range_aoe =	cleanInput($_POST['power_range_aoe']);
		$power_flavor =		cleanInput($_POST['power_flavor']);
		$user =				cleanInput($_POST['user']);
	}

	$keywordArray = array();
	if(!empty($_POST['keywords'])) {
		$keywordArray = explode(',',cleanInput($_POST['keywords']));
		foreach($keywordArray as $index => $keyword) {
			$keywordArray[$index] = trim($keyword);
		}
	}

	$linesArray = array();
	for($i=0;$i<12;$i++) {
		$grad = 0;
		if(!empty($_POST["line{$i}gradient"])) $grad = 1;
		if(!empty(trim($_POST["line{$i}"])) or !empty(trim($_POST["line{$i}type"]))) {
			$linesArray[] = array(cleanInput($_POST["line{$i}indent"]),$grad,cleanInput($_POST["line{$i}type"]),cleanInput($_POST["line{$i}"]));
		}
		else {
			break;
		}
	}

	$powerID = addPower ($power_name,$power_class,$power_level,$power_type,$power_type2,$keywordArray,$power_action,$power_range,$power_range_value,$power_range_aoe,$power_flavor,$linesArray);

	if ($powerID != -1) assocPowers($user,array(array($power_name,($power_type=='0')?0:1)));

	echo '<form action="http://zeitgeist.lhmh.bplaced.net/add_power_form.php"><input type="Submit" value="Enter next power"></form>';
}
else {
	echo 'Something went wrong, please return to <a href="http://zeitgeist.lhmh.bplaced.net/add_power_form.php" style="text-decoration: none; color: blue;">start</a>... ';
}
?>
</div>
</body>
</html>