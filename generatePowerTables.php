<?php

require_once 'mysqlbackend.php';

function generatePlayerTable($playername) {

	echo "<table class=\"playertable\">\n";
	echo "<tr><td class=\"playername\" colspan=\"5\">".$playername."</td></tr>";
	echo "<tr class=\"bglightyellow\"><td colspan=\"2\">Name</td><td style=\"width:20px;\">L.</td><td class=\"aligncenter\">&#9684;</td><td class=\"aligncenter\">#</td></tr>";
//add powers, one per line
   generatePowerTable(6);

//end table
	echo "</table>";


}

function generatePowerTable($powerID) {

	$conn = connectMySQL();
	$stmP = $conn->prepare("SELECT power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor FROM powers WHERE power_id LIKE ?");
	$stmP->bind_param("i",$powerID);
	$stmP->execute();
	$powerResult = $stmP->get_result();
	if($powerResult->num_rows === 0) exit("ID $powerID not a valid powerID");
	$powerArray = $powerResult->fetch_assoc();
	$stmP->close();

	$stmK = $conn->prepare("SELECT keyword_name FROM keywords WHERE keyword_id IN (SELECT keyword_id FROM power_keywords WHERE power_ID LIKE ?) ORDER BY keyword_name");
	$stmK->bind_param("i",$powerID);
	$stmK->execute();
	$keywordResult = $stmK->get_result();
	$keywordNames = array();
	while($row = $keywordResult->fetch_assoc()) {
	  $keywordNames[] = $row['keyword_name'];
	}
	$stmK->close();

	$stmL = $conn->prepare("SELECT power_id, line_number, line_indent, line_gradient, line_type, line_text FROM power_lines WHERE power_id LIKE ? ORDER BY line_number)");
	$stmL->bind_param("i",$powerID);
	$stmL->execute();
	$lineResult = $stmL->get_result();
	$linesArray = array();
	while($row = $keywordNames->fetch_assoc()) {
	  $linesArray[] = $row['keyword_name'];
	}
	$stmL->close();

	disconnectMySQL($conn);

	echo "<tr>\n";

	echo "<td class=\"atwill\" colspan=\"2\">",$powerArray['power_name'],"\n";

	echo "<span class=\"dropdown dropbtn expand\">&raquo;\n";

	echo "<div class=\"dropdown-content\">";

	echo "<table class=\"powertable\"><tr><th class=\"atwill powername\" colspan=\"4\">",$powerArray['power_name'],"<span class=\"powerlevel\">",$powerArray['power_class']," ";
	switch ($powerArray['power_type2']) {
		case 0: echo "Attack"; break;
		case 1: echo "Utility"; break;
		case 2: echo "Combat Action"; break;
		case 3: echo "Item Power"; break;
		case 4: echo "Class Feature"; break;
		case 5: echo "Race Feature"; break;
	}
	echo " ",$powerArray['power_level'],"</span></th></tr>\n";

	echo "<tr><td class=\"flavortext\" colspan=\"4\">",$powerArray['power_flavor'],"</td></tr>\n";

	echo "<tr><td colspan=\"4\"><b>";
	switch ($powerArray['power_type']) {
		case 0: echo "At-Will"; break;
		case 1: echo "Encounter"; break;
		case 2: echo "Daily"; break;
	}
	if (count($keywordNames)!= 0) {
		echo " &#10022; ";
		for($i=0;$i<(count($keywordNames)-1);$i++){
			echo $keywordNames[$i],", ";
		}
		echo $keywordNames[(count($keywordNames)-1)]
	}
	echo "</b></td></tr>\n";

	echo "<tr><td colspan=\"2\"><b>";
	switch ($powerArray['power_action']) {
		case 0: echo "Standard Acion"; break;
		case 1: echo "Move Action"; break;
		case 2: echo "Minor Action"; break;
		case 3: echo "Free Action"; break;
		case 4: echo "Immediate Interrupt"; break;
		case 5: echo "Immediate Reaction"; break;
	}
	echo "</b></td><td colspan=\"2\"><b>";
	switch ($powerArray['power_range']) {
		case 0: echo "Ranged</b> ",$powerArray['power_range_value']; break;
		case 1: echo "Melee</b> ",$powerArray['power_range_value']; break;
		case 2: echo "Close Blast</b> ",$powerArray['power_range_value'],"</td></tr>\n"; break;
		case 3: echo "Close Burst</b> ",$powerArray['power_range_value'],"</td></tr>\n"; break;
		case 4: echo "Area</b> ",$powerArray['power_range_aoe']," in ",$powerArray['power_range_value'],"</td></tr>\n"; break;
		case 5: echo "Personal</b></td></tr>\n"; break;
	}
	echo "</td></tr>\n";

	var_dump($linesArray);
}



























?>