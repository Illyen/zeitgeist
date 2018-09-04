<?php

/*Example for addPower values:*/
$name = "Lance of Faith";
$class = "Cleric";
$level = 1;
$type = 0; 		//types: 0: At-Will 	1: Encounter 	2: Daily
$type2 = 0;		//types: 0: Attack 		1: Utility		2: Combat Action 	3: Item Power 	4: Class Feature 	5: Race Feature
$keywords = array("Divine","Implement","Radiant");
$action = 0		//types: 0: Standard 	1: Move 		2: Minor 			3: Free 		4: Immediate Interrupt 	5: Immediate Reaction	





function addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines) {

	//MYSQL Anmeldedaten
	$server = "localhost";
	$user 	= "lhmh_zeitgeist";
	$pass	= "55qaqNLGWYLG5AMk";
	$db 	= "lhmh_zeitgeist";

	$conn = new mysqli($server, $user, $pass, $db);
	if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

	$sql = "INSERT INTO powers (power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor)
	VALUES ($name, $class, $level, $type, $type2, $action, $range, $rangevalue, $aoe, $flavor)";

give iliery minecraft:diamond_sword{Enchantments:[{id:"minecraft:fire_aspect",lvl:2},{id:"minecraft:knockback",lvl:2},{id:"minecraft:looting",lvl:3},{id:"minecraft:mending",lvl:1},{id:"minecraft:sharpness",lvl:5},{id:"minecraft:sweeping",lvl:3},{id:"minecraft:unbreaking",lvl:3}]} 1


	$conn->close();


}

function connectMySQL ($server,$user,$pass) {
	$conn = new mysqli($server, $user, $pass);
	if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);
	else return $conn;
}

function disconnectMySQL ($conn) {
	$conn->close();
}

?>