<?php

require_once 'mysqlbackend.php';

function generatePlayerTable($playername) {

	echo "<table class=\"playertable\">\n";
	echo "<tr><td class=\"playername\" colspan=\"5\">".$playername."</td></tr>";
	echo "<tr class=\"bglightyellow\"><td colspan=\"2\">Name</td><td style=\"width:20px;\">L.</td><td class=\"aligncenter\">&#9684;</td><td class=\"aligncenter\">#</td></tr>";
//add powers, one per line


//end table
	echo "</table>";


}

function generatePowerTable($powerID) {

	$conn = connectMySQL();
	$stmP = $conn->prepare("SELECT power_name, power_class, power_level, power_type, power_type2, power_action, power_range, power_range_value, power_range_aoe, power_flavor FROM powers WHERE power_id LIKE ?");
	$stmP->bind_param("i",$powerID);
	$stmP->execute();
	$power = $stmP->get_result();
	if($power->num_rows === 0) exit("Not a valid powerID");
	$powerArray = $power->fetch_assoc();
	$stmP->close();

	$stmK = $conn->prepare("SELECT keyword_name FROM keywords WHERE keyword_id IN (SELECT keyword_id FROM power_keywords WHERE power_ID LIKE ?)");
	$stmK->bind_param("i",$powerID);
	$stmK->execute();
	$keyword = $stmK->get_result();
	$keywordNames = array();
	while($row = $keyword->fetch_assoc()) {
	  $keywordNames[] = $row['keyword_name'];
	}


	$stmK->close();



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
	echo "<tr><td colspan=\"4\"><b>",$powerArray['power_type'];

	if ($keyWordNames.count()!==0) {
		echo " &#10022; ";
		foreach ($keyWordNames as $keyword) {

			//Komma Problem lösen! 
			echo $keyword;
		}

	}



	" &#10022; Divine, Implement, Radiant</b></td></tr>\n";
}



























?>