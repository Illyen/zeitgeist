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
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$keywordArray = array();
	$linesArray = array();
	if (empty($_POST['power_name'])) {
		$power_name = 'Baka';
	}
	else {
		$power_name = cleanInput($_POST['power_name']);
	}

	if(!empty($_POST['keywords'])) {
		$keywordArray = explode(',',cleanInput($_POST['keywords']));
		foreach($keywordArray as $index => $keyword) {
			$keywordArray[$index] = trim($keyword);
		}	
	}
	for($i=0;$i<12;$i++) {
		$grad = 0;
		if(!empty($_POST["line{$i}gradient"])) $grad = 1;
		if(!empty(trim($_POST["line{$i}"])) or !empty(trim($_POST["line{$i}type"]))) {
			$linesArray[] = array('line_indent'=>cleanInput($_POST["line{$i}indent"]),'line_gradient'=>$grad,'line_type'=>cleanInput($_POST["line{$i}type"]),'line_text'=>cleanInput($_POST["line{$i}"]));
		}
		else {
			break;
		}
	}

//======================//
//	PREVIEW GENERATION	//
//======================//
	/*echo '<table class="playertable">',"\n";
	echo '<tr><td class="playername" colspan="5">','PREVIEW','</td></tr>',"\n";
	echo '<tr class="bglightyellow"><td colspan="2">Name</td><td style="width:20px;">L.</td><td class="aligncenter">&#9684;</td><td class="aligncenter">#</td></tr>',"\n";
	echo '<tr>',"\n";

	echo '<td class="',($_POST['power_type']==0)?'atwill':(($_POST['power_type']==1)?'encounter':'daily'),'" colspan="2">',cleanInput($_POST['power_name']),"\n";
	echo '<span class="dropdown dropbtn expand">&raquo;',"\n";

	echo '<div class="dropdown-content" style="display:inline-block;">';*/
	echo 'PREVIEW&nbsp;&nbsp;';
	echo '<div style="background-color: #f9f9f9; box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.3); z-index: 1; width:358px; display: inline-flex;">'."\n";
	echo '<table class="powertable">'."\n";
	echo '<tr><th class="',($_POST['power_type']==0)?'atwill':(($_POST['power_type']==1)?'encounter':'daily'),' powername" colspan="4">',$power_name,'<span class="powerlevel">',($_POST['power_class']=='0')?'':(cleanInput($_POST['power_class']).' ');
	switch ($_POST['power_type2']) {
		case 0: echo 'Attack'; break;
		case 1: echo 'Utility'; break;
		case 2: echo 'Combat Action'; break;
		case 3: echo 'Item Power'; break;
		case 4: echo 'Feature'; break;
		case 5: echo 'Race Feature'; break;
	}
	echo ' ',(empty($_POST['power_level']))?'':(cleanInput($_POST['power_level'])),'</span></th></tr>',"\n";
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
			echo trim($keywordArray[$i]),', ';
		}
		echo $keywordArray[(count($keywordArray)-1)];
	}
	echo '</b></td></tr>',"\n";
	echo '<tr><td colspan="2"><b>';
	switch (cleanInput($_POST['power_action'])) {
		case '0': echo 'Standard Action'; break;
		case '1': echo 'Move Action'; break;
		case '2': echo 'Minor Action'; break;
		case '3': echo 'Free Action'; break;
		case '4': echo 'Immediate Interrupt'; break;
		case '5': echo 'Immediate Reaction'; break;
	}
	echo '</b></td><td colspan="2"><b>';
	switch (cleanInput($_POST['power_range'])) {
		case '0': echo 'Ranged</b> ',cleanInput($_POST['power_range_value']); break;
		case '1': echo 'Melee</b> ',cleanInput($_POST['power_range_value']); break;
		case '2': echo 'Close Blast</b> ',cleanInput($_POST['power_range_value']); break;
		case '3': echo 'Close Burst</b> ',cleanInput($_POST['power_range_value']); break;
		case '4': echo 'Area</b> ',cleanInput($_POST['power_range_aoe']),' in ',cleanInput($_POST['power_range_value']); break;
		case '5': echo 'Personal</b>'; break;
		case '6': echo 'Melee</b> touch '; break;
		case '7': echo 'Melee</b> weapon '; break;
		case '8': echo 'Ranged</b> weapon '; break;
		case '9': echo 'Melee </b> or <b>Ranged</b> weapon '; break;
	}
	echo '</td></tr>',"\n";
	foreach ($linesArray as $line) {
		echo '<tr><td colspan="4"';
		if($line['line_indent']!=0 or $line['line_gradient']!=0) {
			echo ' class="';
			if($line['line_indent'] == 1) echo 'indent';
			elseif($line['line_indent'] == 2) echo 'indent2';
			if($line['line_indent']!=0 && $line['line_gradient']==1) echo ' ';
			if($line['line_gradient'] == 1) echo 'gradient';
			echo '"';
		}
		echo '>';
		if($line['line_type'] != NULL) echo '<b>',$line['line_type'],($line['line_text']==NULL)?'':':','</b> ';
		echo $line['line_text'];
		echo '</td></tr>',"\n";
	}
	echo '</table>',"\n";
	echo '</div>',"\n";/*
	echo '</span>',"\n";
	echo '</td>',"\n";
	echo '<td class="aligncenter">',(empty($_POST['power_level']))?'-':(cleanInput($_POST['power_level'])),'</td>',"\n";
	echo '<td class="aligncenter">';
	switch ($_POST['power_action']) {
		case 0: echo '&#9684;'; break;
		case 1: echo '&#10689;'; break;
		case 2: echo '&#9685;'; break;
		default: echo '&#9678;';
	}
	echo '</td>',"\n";
	echo '<td class="aligncenter">',($_POST['power_type']==0)?'&#8734;':'<input type="checkbox">','</td>',"\n";
	echo '</tr>',"\n";
	echo '</table>',"\n";*/
}
else {
	echo 'Something went wrong, please return to <a href="http://zeitgeist.lhmh.bplaced.net/add_power_form.php" style="text-decoration: none; color: blue;">start</a>... ';
}
?>
<ul style="display: inline-table; list-style: none;">
	<li>
		<form action="add_power_form.php" method="POST">
			<input type="hidden" name="power_name" value=<?php 			echo '"',cleanInput($_POST['power_name']),'"'?>>
			<input type="hidden" name="power_class" value=<?php 		echo '"',cleanInput($_POST['power_class']),'"'?>>
			<input type="hidden" name="power_level" value=<?php 		echo '"',cleanInput($_POST['power_level']),'"'?>>
			<input type="hidden" name="power_type" value=<?php 			echo '"',cleanInput($_POST['power_type']),'"'?>>
			<input type="hidden" name="power_type2" value=<?php 		echo '"',cleanInput($_POST['power_type2']),'"'?>>
			<input type="hidden" name="power_action" value=<?php 		echo '"',cleanInput($_POST['power_action']),'"'?>>
			<input type="hidden" name="power_range" value=<?php 		echo '"',cleanInput($_POST['power_range']),'"'?>>
			<input type="hidden" name="power_range_value" value=<?php 	echo '"',cleanInput($_POST['power_range_value']),'"'?>>
			<input type="hidden" name="power_range_aoe" value=<?php 	echo '"',cleanInput($_POST['power_range_aoe']),'"'?>>
			<input type="hidden" name="power_flavor" value=<?php 		echo '"',cleanInput($_POST['power_flavor']),'"'?>>
			<input type="hidden" name="keywords" value=<?php 			echo '"',cleanInput($_POST['keywords']),'"'?>>
			<?php 
				if (!empty($_POST['addtoplayer'])) {
					echo '<input type="hidden" name="addtoplayer" value="on">',"\n";;
					echo '	<input type="hidden" name="user" value=',			 '"',cleanInput($_POST['user']),'">',"\n";
				}

				for ($i=0;$i<12;$i++) {
					if(!empty(trim($_POST["line{$i}"])) or !empty(trim($_POST["line{$i}type"]))) {
						echo '<input type="hidden" name="line',$i,'indent" value="',$linesArray[$i]['line_indent'],'">',"\n";
						echo '<input type="hidden" name="line',$i,'gradient" value="',$linesArray[$i]['line_gradient'],'">',"\n";
						echo '<input type="hidden" name="line',$i,'type" value="',$linesArray[$i]['line_type'],'">',"\n";
						echo '<input type="hidden" name="line',$i,'" value="',$linesArray[$i]['line_text'],'">',"\n";
					}
					else {
						break;
					}
				}
			?>
			<input type="submit" value="Back"> 
		</form>
	</li>
	<li>
		<form action="add_power.php" method="POST">
			<input type="hidden" name="power_name" value=<?php 			echo '"',cleanInput($_POST['power_name']),'"';?>>
			<input type="hidden" name="power_class" value=<?php 		echo '"',cleanInput($_POST['power_class']),'"';?>>
			<input type="hidden" name="power_level" value=<?php 		echo '"',cleanInput($_POST['power_level']),'"';?>>
			<input type="hidden" name="power_type" value=<?php 			echo '"',cleanInput($_POST['power_type']),'"';?>>
			<input type="hidden" name="power_type2" value=<?php 		echo '"',cleanInput($_POST['power_type2']),'"';?>>
			<input type="hidden" name="power_action" value=<?php 		echo '"',cleanInput($_POST['power_action']),'"';?>>
			<input type="hidden" name="power_range" value=<?php 		echo '"',cleanInput($_POST['power_range']),'"';?>>
			<input type="hidden" name="power_range_value" value=<?php 	echo '"',cleanInput($_POST['power_range_value']),'"';?>>
			<input type="hidden" name="power_range_aoe" value=<?php 	echo '"',cleanInput($_POST['power_range_aoe']),'"';?>>
			<input type="hidden" name="power_flavor" value=<?php 		echo '"',cleanInput($_POST['power_flavor']),'"';?>>
			<input type="hidden" name="keywords" value=<?php 			echo '"',cleanInput($_POST['keywords']),'"';?>>
			<?php 
				if (!empty($_POST['addtoplayer'])) {
					echo '	<input type="hidden" name="addtoplayer" value="on">',"\n";;
					echo '	<input type="hidden" name="user" value=',			 '"',cleanInput($_POST['user']),'">',"\n";
				}

				for ($i=0;$i<12;$i++) {
					if(!empty(trim($_POST["line{$i}"])) or !empty(trim($_POST["line{$i}type"]))) {
						echo '<input type="hidden" name="line',$i,'indent" value="',$linesArray[$i]['line_indent'],'">',"\n";
						echo '    <input type="hidden" name="line',$i,'gradient" value="',$linesArray[$i]['line_gradient'],'">',"\n";
						echo '    <input type="hidden" name="line',$i,'type" value="',$linesArray[$i]['line_type'],'">',"\n";
						echo '    <input type="hidden" name="line',$i,'" value="',$linesArray[$i]['line_text'],'">',"\n";
					}
					else {
						break;
					}
				}
				if ($power_name=='Baka'){
					echo '	<input type="submit" value="Add Power" disabled> Name is required!';
				}
				else {
					echo '	<input type="submit" value="Add Power">';
				}
			?> 
		</form>
	</li>
	<?php if(!empty($_POST['addtoplayer'])) echo '<li>Power will be added to player "',cleanInput($_POST['user']),'".</li>';?>
</ul>
</div>
</body>
</html>