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
);

*/
//Create rollback in case of error?


function addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines) {

	//MYSQL Anmeldedaten
	$server = "localhost";
	$user 	= "lhmh_zeitgeist";
	$pass	= "55qaqNLGWYLG5AMk";
	$db 	= "lhmh_zeitgeist";

	$conn = connectMySQL($server, $user, $pass, $db);
	if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);


//Insert appropriate values into "powers" table

	//check if power already exists, can't use try / catch, because power name is not unqiue. not sure if possible to make unique (not sure if power names are unique) for now, check like this
	//actually stupid, since if they are not unique, this will be a hindrance, and if they are not, creating a unique index is possible.
	//will keep for now, maybe change later
	$statementPowerSearch = $conn->prepare("SELECT power_id FROM powers WHERE power_name LIKE ?");
	$statementPowerSearch->bind_param("s",$name);
	$statementPowerSearch->execute();
	$statementPowerSearch->store_result();

	//if power didn't exist before, INSERT
	if($statementPowerSearch->num_rows === 0){
		echo "New power, inserting... <br />\n";

		//prepare NULL values:

    	if ($rangevalue === 0) $rangevalue = NULL;
    	if ($aoe === 0) $aoe = NULL;
    	if ($flavor === "") $flavor = NULL;


		//prepared statement for power insert
		$statementPower = $conn->prepare("INSERT INTO powers (power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		//bind params, s= String, i=integer
		$statementPower->bind_param("ssiiiiiiis",$name, $class, $level, $type, $type2, $action, $range, $rangevalue, $aoe, $flavor);
		//execute the insertion
		$statementPower->execute();
		//save id of power to variable
		$powerID = $conn->insert_id;
		//close statement
		$statementPower->close();

		echo "Insertion successful, ID is $powerID";
	}
	//if power existed before, get the ID and save to variable
	else{
		echo "Power already existed, getting ID... <br />\n";

		$statementPowerSearch->bind_result($power_id);
		$statementPowerSearch->fetch();
		$powerID = $power_id;

		echo "ID is $powerID<br />\n";
	}
	//close the search
	$statementPowerSearch->close();

//Insert new keywords, bind keyword id to power id;

	//prepared statement for keyword insert, already existing records are ignored
	$statementKeywordInsert = $conn->prepare("INSERT INTO keywords (keyword_name) VALUES (?)");
	$statementKeywordSearch = $conn->prepare("SELECT keyword_id FROM keywords WHERE keyword_name LIKE ?");
	$statementKeywordAssoc  = $conn->prepare("INSERT INTO power_keywords (power_id, keyword_id) VALUES (?,?)");
	//bind params
	$keywordName = "";
	$keywordID = 0;
	$statementKeywordInsert->bind_param("s", $keywordName);
	$statementKeywordSearch->bind_param("s", $keywordName);
	$statementKeywordAssoc ->bind_param("ii", $powerID, $keywordID);


	foreach ($keywords as $key => $value) {
		$keywordName = $value;

		//catch duplicate entry

		try {
			$statementKeywordInsert->execute();
		}
		catch (Exception $e) {
			if ($conn->errno === 1062) {
				echo "Keyword already exists, getting ID... <br />";
				$statementKeywordSearch->execute();
				$statementKeywordSearch->store_result();
				$statementKeywordSearch->bind_result($keyword_name);
				$statementKeywordSearch->fetch();
				$keywordID = $keyword_name;
				echo "ID is $keywordID";
			}
			else {
				die("Unexpected error inserting while inserting keyword: ".$conn->connect_error);
			}
		}
		$keywordID = $conn->insert_id;



		echo "ID is $keywordID<br />\n";

		$statementKeywordAssoc->execute();

		echo "Associated $keywordName (ID: $keywordID) to $name (ID: $powerID)<br />";
	}

//Insert lines
	$statementLineInsert = $conn->prepare("INSERT INTO power_lines (power_id, line_number, line_indent, line_gradient, line_type, line_text) VALUES (?,?,?,?,?,?)");
	$statementLineInsert->bind_param("iiiiss",$powerID,$lineNumber,$indent,$gradient,$lineType,$lineText);

	$lineNumber = 0;
	foreach ($lines as $lineNumber => $line) {
		$indent = $line[0];
		$gradient = $line[1];
    	$lineType = ($line[2] !== "") ? $line[2] : NULL;
    	$lineText = $line[4];
    	$statementLineInsert->execute();
    	$lineNumber++;
	}

	disconnectMySQL($conn);

	return $powerID;

}

function connectMySQL ($server,$user,$pass,$db) {
	$conn = new mysqli($server, $user, $pass, $db);
	if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);
	else return $conn;
}

function disconnectMySQL ($conn) {
	$conn->close();
}

?>