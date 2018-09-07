<?php

require_once 'mysqlbackend.php';

function generatePlayerTable($playername) {

	echo '<table class="playertable">',"\n";
	echo '<tr><td class="playername" colspan="5">',$playername,'</td></tr>',"\n";
	echo '<tr class="bglightyellow"><td colspan="2">Name</td><td style="width:20px;">L.</td><td class="aligncenter">&#9684;</td><td class="aligncenter">#</td></tr>',"\n";
//add powers, one per line
   generatePowerTable(6);

//end table
	echo '</table>';


}

function generatePowerTable($powerID) {

	$powerArray = getPower($powerID);
	$keywordArray = getKeywords($powerID);
	$linesArray = getLines($powerID);

	echo '<tr>',"\n";

	echo '<td class="atwill" colspan="2">',$powerArray['power_name'],"\n";

	echo '<span class="dropdown dropbtn expand">&raquo;',"\n";

	echo '<div class="dropdown-content">';

	echo '<table class="powertable"><tr><th class="atwill powername" colspan="4">',$powerArray['power_name'],'<span class="powerlevel">',$powerArray['power_class'],' ';
	switch ($powerArray['power_type2']) {
		case 0: echo 'Attack'; break;
		case 1: echo 'Utility'; break;
		case 2: echo 'Combat Action'; break;
		case 3: echo 'Item Power'; break;
		case 4: echo 'Class Feature'; break;
		case 5: echo 'Race Feature'; break;
	}
	echo ' ',$powerArray['power_level'],'</span></th></tr>',"\n";

	echo '<tr><td class="flavortext" colspan="4">',$powerArray['power_flavor'],'</td></tr>',"\n";

	echo '<tr><td colspan="4"><b>';
	switch ($powerArray['power_type']) {
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
	switch ($powerArray['power_action']) {
		case 0: echo 'Standard Acion'; break;
		case 1: echo 'Move Action'; break;
		case 2: echo 'Minor Action'; break;
		case 3: echo 'Free Action'; break;
		case 4: echo 'Immediate Interrupt'; break;
		case 5: echo 'Immediate Reaction'; break;
	}
	echo '</b></td><td colspan="2"><b>';
	switch ($powerArray['power_range']) {
		case 0: echo 'Ranged</b> ',$powerArray['power_range_value']; break;
		case 1: echo 'Melee</b> ',$powerArray['power_range_value']; break;
		case 2: echo 'Close Blast</b> ',$powerArray['power_range_value']; break;
		case 3: echo 'Close Burst</b> ',$powerArray['power_range_value']; break;
		case 4: echo 'Area</b> ',$powerArray['power_range_aoe'],' in ',$powerArray['power_range_value']; break;
		case 5: echo 'Personal</b>'; break;
	}
	echo '</td></tr>',"\n";

	foreach ($linesArray as $line) {
		echo '<tr><td colspan="4"';
		if($line['line_indent']!=0 or $line['line_gradient']!=0) {
			echo ' class="';
			if($line['line_indent'] == 1) echo 'indent';
			elseif($line['line_indent'] == 2) echo 'indent2';
			if($line['line_indent']!=0 or $line['gradient']!=0) echo ' ';
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
	echo '</span>',"\n";
	echo '</td>',"\n";
	echo '<td class="alignright">1</td>',"\n";
	echo '<td class="aligncenter">&#9684;</td>',"\n";
	echo '<td class="aligncenter">&#8734;</td>',"\n";
	echo '</tr>',"\n";
}



























?>