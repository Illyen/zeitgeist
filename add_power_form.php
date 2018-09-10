<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = 'Zeitgeist - Add new Power';
require_once 'head.php';

/*$power_name 		= ""; $power_name_err = FALSE;
$power_class 		= ""; $power_class_err = FALSE;
$power_level 		= ""; $power_level_err = FALSE;
$power_type 		= ""; $power_type_err = FALSE;
$power_type2 		= ""; $power_type2_err = FALSE;
$power_action 		= ""; $power_action = FALSE;
$keywords 			= ""; 
$power_range 		= ""; $power_range = FALSE;
$power_range_value 	= "";
$power_aoe 			= "";
$power_flavor 		= "";
$line1 				= "";
$line1indent 		= "";
$line1gradient 		= "";
$line2 				= "";
$line2indent 		= "";
$line2gradient 		= "";
$line3 				= "";
$line3indent 		= "";
$line3gradient 		= "";
$line4 				= "";
$line4indent 		= "";
$line4gradient 		= "";
$line5 				= "";
$line5indent 		= "";
$line5gradient 		= "";
$line6 				= "";
$line6indent 		= "";
$line6gradient 		= "";
$line7 				= "";
$line7indent 		= "";
$line7gradient 		= "";
$line8 				= "";
$line8indent 		= "";
$line8gradient 		= "";*/

?>
<body>
<form action="add_power.php" method="post">
<table>
<tr>
<td>Name: <input type="text" name="power_name"<?php if(isset($_POST['power_name'])) echo ' value="',$_POST['power_name'],'"'; ?>></td>
<td>Class:
<select name="power_class">
<?php
if (isset($_POST['power_class'])&&$_POST['power_class']!=-1) {
echo '<option value="Cleric"';	if ($_POST['power_class']=='Cleric') 	echo ' selected'; echo '>Cleric</option>'."\n";
echo '<option value="Fighter"';	if ($_POST['power_class']=='Fighter') 	echo ' selected'; echo '>Fighter</option>'."\n";
echo '<option value="Paladin"';	if ($_POST['power_class']=='Paladin') 	echo ' selected'; echo '>Paladin</option>'."\n";
echo '<option value="Rogue"';	if ($_POST['power_class']=='Rogue') 	echo ' selected'; echo '>Rogue</option>'."\n";
echo '<option value="Wizard"';	if ($_POST['power_class']=='Wizard') 	echo ' selected'; echo '>Wizard</option>'."\n";
echo '<option value="Psion"';	if ($_POST['power_class']=='Psion') 	echo ' selected'; echo '>Psion</option>'."\n";
echo '<option value="Avenger"';	if ($_POST['power_class']=='Avenger') 	echo ' selected'; echo '>Avenger</option>'."\n";
echo '<option value="0"';		if ($_POST['power_class']=='0') 		echo ' selected'; echo '>None</option>'."\n";
}
else {
echo '<option value="0">None</option>
<option value="Cleric">Cleric</option>
<option value="Fighter">Fighter</option>
<option value="Paladin">Paladin</option>
<option value="Rogue">Rogue</option>
<option value="Wizard">Wizard</option>
<option value="Psion">Psion</option>
<option value="Avenger">Avenger</option>'."\n";
}
?>
</select>
</td>
<td>Level: <input type="text" name="power_level"<?php if(isset($_POST['power_level'])) echo ' value="',$_POST['power_level'],'"'; ?>></td>
</tr>
<tr>
<td>Type: 
<select name="power_type">
<?php
if (isset($_POST['power_type'])&&$_POST['power_type']!=-1) {
echo '<option value="0"';if ($_POST['power_type']==0) echo ' selected'; echo '>At-Will</option>'."\n";
echo '<option value="1"';if ($_POST['power_type']==1) echo ' selected'; echo '>Encounter</option>'."\n";
echo '<option value="2"';if ($_POST['power_type']==2) echo ' selected'; echo '>Daily</option>'."\n";
}
else {
echo '<option value="0">At-Will</option>
<option value="1">Encounter</option>
<option value="2">Daily</option>'."\n";
}
?>
</select>
</td>
<td>Type 2:
<select name="power_type2">
<?php
if (isset($_POST['power_type2'])&&$_POST['power_type2']!=-1) {
echo '<option value="0"';if ($_POST['power_type2']==0) echo ' selected'; echo '>Attack</option>'."\n";
echo '<option value="1"';if ($_POST['power_type2']==1) echo ' selected'; echo '>Utility</option>'."\n";
echo '<option value="2"';if ($_POST['power_type2']==2) echo ' selected'; echo '>Combat Action</option>'."\n";
echo '<option value="3"';if ($_POST['power_type2']==3) echo ' selected'; echo '>Item Power</option>'."\n";
echo '<option value="4"';if ($_POST['power_type2']==4) echo ' selected'; echo '>Class Feature</option>'."\n";
echo '<option value="5"';if ($_POST['power_type2']==5) echo ' selected'; echo '>Race Feature</option>'."\n";
}
else {
echo '<option value="0">Attack</option>
<option value="1">Utility</option>
<option value="2">Combat Action</option>
<option value="3">Item Power</option>
<option value="4">Class Feature</option>
<option value="5">Race Feature</option>'."\n";
}
?>
</select>
</td>
<td>Action: 
<select name="power_action">
<?php
if (isset($_POST['power_action'])&&$_POST['power_action']!=-1) {
echo '<option value="0"';if ($_POST['power_action']==0) echo ' selected'; echo '>Standard</option>'."\n";
echo '<option value="1"';if ($_POST['power_action']==1) echo ' selected'; echo '>Move</option>'."\n";
echo '<option value="2"';if ($_POST['power_action']==2) echo ' selected'; echo '>Minor</option>'."\n";
echo '<option value="3"';if ($_POST['power_action']==3) echo ' selected'; echo '>Free</option>'."\n";
echo '<option value="4"';if ($_POST['power_action']==4) echo ' selected'; echo '>Immediate Interrupt</option>'."\n";
echo '<option value="5"';if ($_POST['power_action']==5) echo ' selected'; echo '>Immediate Reaction</option>'."\n";
}
else {
echo '<option value="0">Standard</option>
<option value="1">Move</option>
<option value="2">Minor</option>
<option value="3">Free</option>
<option value="4">Immediate Interrupt</option>
<option value="5">Immediate Reaction</option>'."\n";
}
?>
</select>
</td>
</tr>
<tr>
<td colspan="3">Keywords: <input type="text" name="keywords"><?php if(isset($_POST['keywords'])) echo ' value="',$_POST['keywords'],'"'; ?></td>
</tr>
<tr>
<td>
<select name="power_range">
<option value="5">Personal</option>
<option value="0">Ranged</option>
<option value="1">Melee</option>
<option value="2">Close Blast</option>
<option value="3">Close Burst</option>
<option value="4">Area</option>
</select>
</td>
<td>AOE:<input type="text" name="power_aoe"></td>
<td>Range:<input type="text" name="power_range_value"></td>
</tr>
<tr>
<td colspan="3">Flavortext: <input type="text" name="power_flavor"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line0indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line0gradient">
<input type="text" name="line0type">
<input type="text" name="line0" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line1indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line1gradient">
<input type="text" name="line1type">
<input type="text" name="line1" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line2indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line2gradient">
<input type="text" name="line2type">
<input type="text" name="line2" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line3indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line3gradient">
<input type="text" name="line3type">
<input type="text" name="line3" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line4indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line4gradient">
<input type="text" name="line4type">
<input type="text" name="line4" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line5indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line5gradient">
<input type="text" name="line5type">
<input type="text" name="line5" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line6indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line6gradient">
<input type="text" name="line6type">
<input type="text" name="line6" size="50"></td>
</tr>
<tr>
<td colspan="3">I:
<select name="line7indent">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
G: <input type="checkbox" name="line7gradient">
<input type="text" name="line7type">
<input type="text" name="line7" size="50"></td>
</tr>
</table>
<input type="submit">
</form>
</body>
</html>