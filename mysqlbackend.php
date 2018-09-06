<?php

/*Example for addPower values:

$name = "Lance of Faith";
$class = "Cleric";
$level = 1;
$type = 0; 		//types: 0: At-Will 	1: Encounter 	2: Daily
$type2 = 0;		//types: 0: Attack 		1: Utility		2: Combat Action 	3: Item Power 	4: Class Feature 	5: Race Feature
$keywords = array("Divine","Implement","Radiant");
$action = 0;	//types: 0: Standard 	1: Move 		2: Minor 			3: Free 		4: Immediate Interrupt 	5: Immediate Reaction
$range = 0;		//types: O: Ranged 		1: Melee 		2: Close blast		3: Close burst 	4: Area 			5: Personal
$rangevalue = 5;
$aoe = 0;
$flavor = "A brilliant ray of light sears your foe with golden radiance. Sparkles of light linger around the target, guiding your ally’s attack.";
$lines = array(

	// indent, gradient, type (0 for no type), text
	array(0,0,"Target","One creature"),
	array(0,0,"Attack","Wisdom vs. Reflex"),
	array(1,1,"Hit","1d8 + Wisdom modifier radiant damage, and one ally you can see gains a +2 power bonus to his or her next attack roll against the target."),
	array(0,0,"","Increase damage to 2d8 + Wisdom modifier at 21st level.")
);*/

//=================================================
//	MYSQL Anmeldedaten
//=================================================


function connectMySQL () {
	$server = "localhost";
	$user 	= "lhmh_zeitgeist";
	$pass	= "55qaqNLGWYLG5AMk";
	$db 	= "lhmh_zeitgeist";
	$conn = new mysqli($server, $user, $pass, $db);
	if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);
	else return $conn;
}

function disconnectMySQL ($conn) {
	$conn->close();
}

//=================================================
//	Adding a new power, returns power id if successful, -1 otherwise
//=================================================


function addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines) {
	$conn = connectMySQL();

//=================================================
//	Insert appropriate values into "powers" table
//=================================================
	$statementPowerSearch = $conn->prepare("SELECT power_id FROM powers WHERE power_name LIKE ?");
	$statementPowerSearch->bind_param("s",$name);
	$statementPowerSearch->execute();
	$statementPowerSearch->store_result();

	//if power is new, INSERT
	if($statementPowerSearch->num_rows === 0){
		$statementPowerSearch->close();
		echo "New power, inserting... ";
		//prepare NULL values:
    	if ($rangevalue === 0) $rangevalue = NULL;
    	if ($aoe === 0) $aoe = NULL;
    	if ($flavor === "") $flavor = NULL;

		$statementPower = $conn->prepare("INSERT INTO powers (power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$statementPower->bind_param("ssiiiiiiis",$name, $class, $level, $type, $type2, $action, $range, $rangevalue, $aoe, $flavor);
		$statementPower->execute();
		$statementPower->close();
		$powerID = $conn->insert_id;
		echo "Insertion successful, power_id is $powerID <br />\n";
	}
	//if power existed before, get the ID and exit
	else{
		echo "Power already exists, with ID ";
		$powerID = 0;
		$statementPowerSearch->bind_result($powerID);
		$statementPowerSearch->fetch();
		$statementPowerSearch->close();

		echo "$powerID<br />\n";
		echo("Check your input or contact admin for changing or deleting existing powers.");
		return -1;
	}


//=================================================
//	Insert new keywords, bind keyword id to power id;
//=================================================

	$keywordName = "";
	$statementKeywordSearch = $conn->prepare("SELECT keyword_id FROM keywords WHERE keyword_name LIKE ?");
	$statementKeywordInsert = $conn->prepare("INSERT INTO keywords (keyword_name) VALUES (?)");
	$statementKeywordAssoc =$conn->prepare("INSERT INTO power_keywords (power_id, keyword_id) VALUES (?,?)");
	$statementKeywordSearch->bind_param("s", $keywordName);
	$statementKeywordInsert->bind_param("s", $keywordName);

	foreach ($keywords as $key => $value) {
		$keywordName = $value;
		$statementKeywordSearch->execute();
		$statementKeywordSearch->store_result();
		//if keyword is new, insert
		if ($statementKeywordSearch->num_rows === 0) {
			echo "New keyword, inserting ... ";
			$statementKeywordInsert->execute();
			$keywordID = $conn->insert_id;
			echo "Insertion successful, keyword_id is $keywordID <br />\n";
		}
		else {
			echo "Keyword already exists, with ID ";
			$keywordID = 0;
			$statementKeywordSearch->bind_result($keywordID);
			$statementKeywordSearch->fetch();
			echo "$keywordID<br />\n";
		}
		$statementKeywordAssoc->bind_param("ii", $powerID, $keywordID);
		$statementKeywordAssoc->execute();
		echo "Associated $keywordName (id: $keywordID) to $name (id: $powerID)<br />\n";
	}
	$statementKeywordSearch->close();
	$statementKeywordInsert->close();
	$statementKeywordAssoc ->close();


//=================================================
//	Insert and bind the actual text of the power.
//=================================================
	$statementLineInsert = $conn->prepare("INSERT INTO power_lines (power_id, line_number, line_indent, line_gradient, line_type, line_text) VALUES (?,?,?,?,?,?)");
	$statementLineInsert->bind_param("iiiiss",$powerID,$lineNumber,$indent,$gradient,$lineType,$lineText);

	$lineNumber = 0;
	foreach ($lines as $line) {
		echo "Line $lineNumber: ";
		$indent = $line[0];
		echo "indent $indent, ";
		$gradient = $line[1];
		echo "gradient $gradient,<br />\n";
    	$lineType = ($line[2] !== "") ? $line[2] : NULL;
    	echo "<b>$lineType:</b> ";
    	$lineText = $line[3];
    	echo "$lineText<br />\n";
    	$statementLineInsert->execute();
    	$lineNumber++;
	}
	$statementLineInsert->close();
	disconnectMySQL($conn);

	return $powerID;

}

//=================================================
//	Adding multiple (or only one) powers to a user
//=================================================

/*example for Values
$username = "Thomas";
$powers = array(
	array("Lance of Faith",0),
	array("Astral Seal",0),
	);
*/

function assocPowers($username, $powers)
{
	$conn = connectMySQL();

	$userID = 0;
	$statementSearchUser = $conn->prepare("SELECT user_id FROM users WHERE user_name LIKE ?");
	$statementSearchUser->bind_param("s",$username);
	$statementSearchUser->execute();
	$statementSearchUser->store_result();
	if($statementSearchUser->num_rows === 0){
		echo "User not existing, stopping execution.";
		return -1;
	}
	$statementSearchUser->bind_result($userID);
	$statementSearchUser->fetch();
	$statementSearchUser->close();

	$powerIDs = array();
	$powerID = 0;
	$usablecount = 0;
	$powername = "";
	$statementSearchPower = $conn->prepare("SELECT power_id FROM powers WHERE power_name LIKE ?");
	$statementSearchPower->bind_param("s",$powername);
	$statementSearchPower->bind_result($powerID);
	foreach ($powers as $power) {
		$powername = $power[0];
		$statementSearchPower->execute();
		$statementSearchPower->store_result();
		if($statementSearchPower->num_rows === 0){
			echo "Power not existing, stopping execution.";
			return -1;
		}
		$statementSearchPower->fetch();
		$powerIDs[] = array($powerID, $power[1]);

	}
	$statementSearchPower->close();

	$statementAssoc = $conn->prepare("INSERT INTO user_powers (user_id, power_id, user_powers_usablecount) VALUES (?,?,?)");
	$statementAssoc->bind_param("iii",$userID,$powerID,$usablecount);
	foreach ($powerIDs as $power) {
		$powerID = $power[0];
		$usablecount = $power[1];
		$statementAssoc->execute();
		echo "Added power with id $powerID to user $username (id $userID) with $usablecount uses.<br />\n";
	}
	$statementAssoc->close();

	disconnectMySQL($conn);

	return 1;
}

//=================================================
//	Adding a user, returns user id of newly created or existing user
//=================================================


function addUser($username) {

	$conn = connectMySQL();

	$userID = 0;

	$statementSearchUser = $conn->prepare("SELECT user_id FROM users WHERE user_name LIKE ?");
	$statementSearchUser->bind_param("s",$username);
	$statementSearchUser->execute();
	$statementSearchUser->store_result();
	if($statementSearchUser->num_rows === 0) {
		$statementAddUser = $conn->prepare("INSERT INTO users (user_name) VALUES (?)");
		$statementAddUser->bind_param("s",$username);
		$statementAddUser->execute();
		$statementAddUser->close();

		$userID = $conn->insert_id;
	}
	else {
		echo "Username already taken";
		$statementSearchUser->bind_result($userID);
		$statementSearchUser->fetch();
	}

	$statementSearchUser->close();


	disconnectMySQL($conn);

	return $userID;
}

function getUserID($username) {
	$conn = connectMySQL();
	$userID = 0;
	$statementSearchUser = $conn->prepare("SELECT user_id FROM users WHERE user_name LIKE ?");
	$statementSearchUser->bind_param("s",$username);
	$statementSearchUser->execute();
	$statementSearchUser->store_result();
	$statementSearchUser->bind_result($userID);
	$statementSearchUser->fetch();
	return $userID;
	disconnectMySQL($conn);
}

function getPower($powerID) {
	$conn = connectMySQL();
	$stm = $conn->prepare("SELECT power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor FROM powers WHERE power_id LIKE ?");
	$stm->bind_param("s",$username);
	$stm->execute();
	$stm->store_result();
	$stm->bind_result($userID);
	$stm->fetch();
	disconnectMySQL($conn);
}





























?>