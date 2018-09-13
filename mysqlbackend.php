<?php



//=================================================
//	MYSQL Anmeldedaten
//=================================================


function connectMySQL () {
	$server = 'localhost';
	$user 	= 'lhmh_zeitgeist';
	$pass	= '55qaqNLGWYLG5AMk';
	$db 	= 'lhmh_zeitgeist';
	$conn = new mysqli($server, $user, $pass, $db);
	if ($conn->connect_error) die('Connection failed: '.$conn->connect_error);
	else return $conn;
}

function disconnectMySQL ($conn) {
	$conn->close();
}

//====================================================================
//	Adding a new power, returns power id if successful, -1 otherwise
//====================================================================
/*Example for addPower values:

$name = "Lance of Faith";
$class = "Cleric";
$level = 1;
$type = 0; 		//types: 0: At-Will 	1: Encounter 	2: Daily
$type2 = 0;		//types: 0: Attack 		1: Utility		2: Combat Action 	3: Item Power 	4: Class Feature 	5: Race Feature
$keywords = array("Divine","Implement","Radiant");
$action = 0;	//types: 0: Standard 	1: Move 		2: Minor 			3: Free 		4: Immediate Interrupt 	5: Immediate Reaction
$range = 0;		//types: O: Ranged 		1: Melee 		2: Close blast		3: Close burst 	4: Area 			5: Personal 	6: Melee touch
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


function addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines) {
	$conn = connectMySQL();

//	Insert appropriate values into "powers" table
	$stmPowerSearch = $conn->prepare('SELECT power_id FROM powers WHERE power_name LIKE ?');
	$stmPowerSearch->bind_param('s',$name);
	$stmPowerSearch->execute();
	$stmPowerSearch->store_result();

	//if power is new, INSERT
	if($stmPowerSearch->num_rows == 0){
		$stmPowerSearch->close();
		echo 'New power, inserting... ';
		//prepare NULL values:
    	if ($rangevalue == 0) $rangevalue = NULL;
    	if ($aoe == 0) $aoe = NULL;
    	if ($flavor == '') $flavor = NULL;

		$stmPower = $conn->prepare('INSERT INTO powers (power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$stmPower->bind_param('ssiiiiiiis',$name, $class, $level, $type, $type2, $action, $range, $rangevalue, $aoe, $flavor);
		$stmPower->execute();
		$stmPower->close();
		$powerID = $conn->insert_id;
		echo "Insertion successful, power_id is $powerID <br />\n";
	}
	//if power existed before, get the ID and exit
	else{
		echo 'Power already exists, with ID ';
		$powerID = 0;
		$stmPowerSearch->bind_result($powerID);
		$stmPowerSearch->fetch();
		$stmPowerSearch->close();

		echo "$powerID<br />\n";
		echo('Check your input or contact admin for changing or deleting existing powers.');

		disconnectMySQL($conn);
		return -1;
	}


//	Insert new keywords into keywords and also bind keywords in power_keywords

	$keywordName = '';
	$stmKeywordSearch = $conn->prepare('SELECT keyword_id FROM keywords WHERE keyword_name = ?');
	$stmKeywordInsert = $conn->prepare('INSERT INTO keywords (keyword_name) VALUES (?)');
	$stmKeywordAssoc =$conn->prepare('INSERT INTO power_keywords (power_id, keyword_id) VALUES (?,?)');
	$stmKeywordSearch->bind_param('s', $keywordName);
	$stmKeywordInsert->bind_param('s', $keywordName);

	foreach ($keywords as $value) {
		$keywordName = trim($value);
		$stmKeywordSearch->execute();
		$stmKeywordSearch->store_result();
		//if keyword is new, insert
		if ($stmKeywordSearch->num_rows == 0) {
			echo 'New keyword, inserting ... ';
			$stmKeywordInsert->execute();
			$keywordID = $conn->insert_id;
			$stmKeywordSearch->free_result();
			echo "Insertion successful, keyword_id is $keywordID <br />\n";
		}
		else {
			echo 'Keyword already exists, with ID ';
			$keywordID = 0;
			$stmKeywordSearch->bind_result($keywordID);
			$stmKeywordSearch->fetch();
			$stmKeywordSearch->free_result();
			echo "$keywordID<br />\n";
		}
		$stmKeywordAssoc->bind_param("ii", $powerID, $keywordID);
		$stmKeywordAssoc->execute();
		echo "Associated $keywordName (id: $keywordID) to $name (id: $powerID)<br />\n";
	}
	$stmKeywordSearch->close();
	$stmKeywordInsert->close();
	$stmKeywordAssoc ->close();



//	Insert and bind the text in power_lines

	$stmLineInsert = $conn->prepare('INSERT INTO power_lines (power_id, line_number, line_indent, line_gradient, line_type, line_text) VALUES (?,?,?,?,?,?)');
	$stmLineInsert->bind_param('iiiiss',$powerID,$lineNumber,$indent,$gradient,$lineType,$lineText);

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
    	$stmLineInsert->execute();
    	$lineNumber++;
	}
	$stmLineInsert->close();
	disconnectMySQL($conn);

	return $powerID;

}

//==================================================
//	Adding multiple (or only one) powers to a user
//==================================================

/*example for Values
$username = 'Thomas';
$powers = array(
	array('Lance of Faith',0),
	array('Astral Seal',0),
	);

EXPECTS a nested array for $powers, so won't accept $powers=array('Lance of Faith',0); only $powers=array(array('Lance of Faith',0));
*/

function assocPowers($userName, $powers)
{
	$conn = connectMySQL();

	$userID = getUserID($userName);
	if($userID == -1){
		trigger_error("User $userName not existing, stopping execution.", E_USER_ERROR);
	}

	$powerIDs = array();
	$powerID = 0;
	$usablecount = 0;
	$powername = "";
	$stmPowerSearch = $conn->prepare("SELECT power_id FROM powers WHERE power_name = ?");
	$stmPowerSearch->bind_param("s",$powername);
	foreach ($powers as $power) {
		$powername = $power[0];
		$stmPowerSearch->execute();
		$stmPowerSearch->store_result();
		$stmPowerSearch->bind_result($powerID);
		if($stmPowerSearch->num_rows == 0){
			trigger_error("Power $powername doesn't exist.", E_USER_WARNING);
			disconnectMySQL($conn);
			return -1;
		}
		$stmPowerSearch->fetch();
		echo "Power $powername exists with id $powerID, adding to array to associate.\n";
		$powerIDs[] = array($powerID, $power[1]);
		$stmPowerSearch->free_result();
	}
	$stmPowerSearch->close();

	$stmAssoc = $conn->prepare('INSERT INTO user_powers (user_id, power_id, user_powers_usablecount) VALUES (?,?,?)');
	$stmAssoc->bind_param('iii',$userID,$powerID,$usablecount);
	foreach ($powerIDs as $power) {
		$powerID = $power[0];
		$usablecount = $power[1];
		$stmAssoc->execute();
		echo "Added power with id $powerID to user $username (id $userID) with $usablecount uses.<br />\n";
	}
	$stmAssoc->close();

	disconnectMySQL($conn);

	return 1;
}

//====================================================================
//	Adding a user, returns user id of newly created or existing user
//====================================================================


function addUser($username) {
	$userID=getUserID($username);
	if($userID-1) {

		$conn = connectMySQL();
		$stmAddUser = $conn->prepare('INSERT INTO users (user_name) VALUES (?)');
		$stmAddUser->bind_param('s',$username);
		$stmAddUser->execute();
		$stmAddUser->close();

		$userID = $conn->insert_id;
	}
	else {
		trigger_error('Username already exists', E_USER_ERROR);
		return $userID;
	}

	echo "User $username added with ID $userID";


	disconnectMySQL($conn);

	return $userID;
}

function getUsers() {
	$conn = connectMySQL();
	$stmSearchUser = $conn->prepare('SELECT user_id, user_name FROM users ORDER BY user_id');
	$stmSearchUser->execute();
	$userResult= $stmSearchUser->get_result();
	$userArray = array();
	while($row = $userResult->fetch_assoc()) {
	  	if (!empty($row['user_name'])) $userArray[$row['user_id']] = $row['user_name'];
	}
	disconnectMySQL($conn);
	return $userArray;
}

function getUserID($username) {
	$conn = connectMySQL();
	$userID = 0;
	$stmSearchUser = $conn->prepare('SELECT user_id FROM users WHERE user_name = ?');
	$stmSearchUser->bind_param('s',$username);
	$stmSearchUser->execute();
	$stmSearchUser->store_result();
	if($stmSearchUser->num_rows == 0) return -1;
	$stmSearchUser->bind_result($userID);
	$stmSearchUser->fetch();

	disconnectMySQL($conn);
	return $userID;
}

//TO OPTIMIZE: allow getPower to accept an array, return an array of multiple powers. for now, this will do.

function getPower($powerID) {
	$conn = connectMySQL();
	$stm = $conn->prepare('SELECT power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor FROM powers WHERE power_id = ?');
	$stm->bind_param('i',$powerID);
	$stm->execute();
	$powerResult = $stm->get_result();
	if($powerResult->num_rows == 0) exit("ID $powerID not a valid powerID");
	$powerArray = $powerResult->fetch_assoc();
	$stm->close();
	disconnectMySQL($conn);
	return $powerArray;
}

function getKeywords($powerID) {
	$conn = connectMySQL();
	$stm = $conn->prepare('SELECT keyword_name FROM keywords WHERE keyword_id IN (SELECT keyword_id FROM power_keywords WHERE power_ID = ? ) ORDER BY keyword_name');
	$stm->bind_param('i',$powerID);
	$stm->execute();
	$keywordResult = $stm->get_result();
	$keywordArray = array();
	while($row = $keywordResult->fetch_assoc()) {
	  	if (!empty($row['keyword_name'])) $keywordArray[] = $row['keyword_name'];
	}
	$stm->close();
	disconnectMySQL($conn);
	return $keywordArray;
}

function getLines($powerID) {
	$conn = connectMySQL();
	$stm = $conn->prepare('SELECT line_indent, line_gradient, line_type, line_text FROM power_lines WHERE power_id = ? ORDER BY line_number');
	$stm->bind_param('i',$powerID);
	$stm->execute();
	$lineResult = $stm->get_result();
	$linesArray = array();
	while($row = $lineResult->fetch_assoc()) {
	  	$linesArray[] = array 	(
		  							'line_indent'	=>$row['line_indent'],
		  							'line_gradient'	=>$row['line_gradient'],
		  							'line_type'		=>$row['line_type'],
		  							'line_text'		=>$row['line_text']
	  							);
	}
	$stm->close();
	disconnectMySQL($conn);
	return $linesArray;
}

function getPowers($userID){
	$conn = connectMySQL();
	$stm = $conn->prepare('SELECT powers.power_name, powers.power_type, powers.power_level, powers.power_id, user_powers.user_powers_usablecount, user_powers.user_powers_usedcount FROM powers INNER JOIN user_powers ON powers.power_id = user_powers.power_id WHERE user_powers.user_id = ? ORDER BY power_type, ( CASE power_type2 WHEN 2 THEN 1 WHEN 5 THEN 2 WHEN 4 THEN 3 WHEN 1 THEN 4 WHEN 0 THEN 4 WHEN 3 THEN 6 END ), power_level, power_name');
	$stm->bind_param('i',$userID);
	$stm->execute();
	$powerIDResult = $stm->get_result();
	$powerIDArray = array();
	while($row = $powerIDResult->fetch_assoc()) {
	  	$powerIDArray[] = array('power_id'=>$row['power_id'],'usablecount'=>$row['user_powers_usablecount'], 'usedcount'=>$row['user_powers_usedcount']);
	}
	$stm->close();
	disconnectMySQL($conn);
	return $powerIDArray;

}

function cleanInput($data) {
	$data = trim(stripslashes(htmlspecialchars($data)));
	return $data;
}
?>