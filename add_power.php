<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = 'Zeitgeist - Add new Power';
require 'head.php';
require_once 'generatePowerTables.php';
require_once 'mysqlbackend.php';
?>
<body>

<?php
/*$power_name 		= "";
$power_class 		= "";
$power_level 		= "";
$power_type 		= "";
$power_type2 		= "";
$power_action 		= "";
$keywords 			= ""; 
$power_range 		= "";
$power_range_value 	= "";
$power_range_aoe 	= "";
$power_flavor 		= "";
$line0 				= "";
$line0type			= "";
$line0indent 		= 0;
$line0gradient 		= 0;
$line1 				= "";
$line1type			= "";
$line1indent 		= 0;
$line1gradient 		= 0;
$line2 				= "";
$line2type			= "";
$line2indent 		= 0;
$line2gradient 		= 0;
$line3 				= "";
$line3type			= "";
$line3indent 		= 0;
$line3gradient 		= 0;
$line4 				= "";
$line4type			= "";
$line4indent 		= 0;
$line4gradient 		= 0;
$line5 				= "";
$line5type			= "";
$line5indent 		= 0;
$line5gradient 		= 0;
$line6 				= "";
$line6type			= "";
$line6indent 		= 0;
$line6gradient 		= 0;
$line7 				= "";
$line7type			= "";
$line7indent 		= 0;
$line7gradient 		= 0;*/



if ($_SERVER['REQUEST_METHOD']=='POST') {
	$powerName = "";
	$keywordArray = array();
	$linesArray = array();
	if (empty($_POST['power_name'])) {
		$power_name = 'Placeholder';
		echo 'Name is required!'."\n";
	}
	else {
		$power_name = cleanInput($_POST['power_name']);
	}

	if(!empty($_POST['keywords'])) {
		$keywordArray = explode(',',cleanInput($_POST['keywords']));
	}
	for($i=0;$i<8;$i++) {
		$grad = 0;
		if(isset($_POST["line{$i}gradient"])) $grad = 1;
		if(!empty($_POST["line{$i}"])){
			$linesArray[] = array('line_indent'=>cleanInput($_POST["line{$i}indent"]),'line_gradient'=>$grad,'line_type'=>cleanInput($_POST["line{$i}type"]),'line_text'=>cleanInput($_POST["line{$i}"]));
		}
		else {
			break;
		}
	}





	echo 'Preview: ';
	echo '<div style="position: absolute; background-color: #f9f9f9; box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.3); z-index: 1">';
	echo '<table class="powertable"><tr><th class="atwill powername" colspan="4">',$power_name,'<span class="powerlevel">',cleanInput($_POST['power_class']),' ';
	switch ($_POST['power_type2']) {
		case 0: echo 'Attack'; break;
		case 1: echo 'Utility'; break;
		case 2: echo 'Combat Action'; break;
		case 3: echo 'Item Power'; break;
		case 4: echo 'Class Feature'; break;
		case 5: echo 'Race Feature'; break;
	}
	echo ' ',cleanInput($_POST['power_level']),'</span></th></tr>',"\n";

	echo '<tr><td class="flavortext" colspan="4">',cleanInput($_POST['power_flavor']),'</td></tr>',"\n";

	echo '<tr><td colspan="4"><b>';
	switch (cleanInput($_POST['power_type'])) {
		case 0: echo 'At-Will'; break;
		case 1: echo 'Encounter'; break;
		case 2: echo 'Daily'; break;
	}
	if (count($keywordArray)!= 0) {
		echo ' &#10022; ';
		for($i=0;$i<(count($keywordArray)-1);$i++){
			echo $keywordArray[$i],', ';
		}
		echo $keywordArray[(count($keywordArray)-1)];
	}
	echo '</b></td></tr>',"\n";

	echo '<tr><td colspan="2"><b>';
	switch (cleanInput($_POST['power_action'])) {
		case 0: echo 'Standard Acion'; break;
		case 1: echo 'Move Action'; break;
		case 2: echo 'Minor Action'; break;
		case 3: echo 'Free Action'; break;
		case 4: echo 'Immediate Interrupt'; break;
		case 5: echo 'Immediate Reaction'; break;
	}
	echo '</b></td><td colspan="2"><b>';
	switch (cleanInput($_POST['power_range'])) {
		case 0: echo 'Ranged</b> ',cleanInput($_POST['power_range_value']); break;
		case 1: echo 'Melee</b> ',cleanInput($_POST['power_range_value']); break;
		case 2: echo 'Close Blast</b> ',cleanInput($_POST['power_range_value']); break;
		case 3: echo 'Close Burst</b> ',cleanInput($_POST['power_range_value']); break;
		case 4: echo 'Area</b> ',cleanInput($_POST['power_range_aoe']),' in ',cleanInput($_POST['power_range_value']); break;
		case 5: echo 'Personal</b>'; break;
	}
	echo '</td></tr>',"\n";

	foreach ($linesArray as $line) {
		echo '<tr><td colspan="4"';
		if($line['line_indent']!=0 or $line['line_gradient']!=0) {
			echo ' class="';
			if($line['line_indent'] == 1) echo 'indent';
			elseif($line['line_indent'] == 2) echo 'indent2';
			if($line['line_indent']!=0 and $line['gradient']!=0) echo ' ';
			if($line['line_gradient'] == 1) echo 'gradient';
			echo '"';
		}
		echo '>';
		if($line['line_type'] != NULL) echo '<b>',$line['line_type'],':</b> ';
		echo $line['line_text'];
		echo '</td></tr>',"\n";
	}

	echo '</table>',"\n";
	echo '</div>',"\n";

}
else {
echo 'Something went wrong, please return to <a href="http://zeitgeist.lhmh.bplaced.net/add_power_form.php" style="text-decoration: none; color: blue;">start</a>... ';
}

?>
</body>
</html>