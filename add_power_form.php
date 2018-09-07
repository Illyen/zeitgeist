<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = 'Zeitgeist - Add new Power';
require_once 'head.php';
require_once 'mysqlbackend.php'
?>
<body>
	<form action="add_power.php" method="post">
		<table>
			<tr>
				<td>Name: <input type="text" name="power_name"></td>
				<td>Class: 
					<select name="power_class">
						<option value="Cleric">Cleric</option>
						<option value="Fighter">Fighter</option>
						<option value="Paladin">Paladin</option>
						<option value="Rogue">Rogue</option>
						<option value="Wizard">Wizard</option>
						<option value="Psion">Psion</option>
						<option value="Avenger">Avenger</option>
						<option value="0">EMPTY</option>
					</select>
				</td>
				<td>Level: <input type="text" name="power_level"></td>
			</tr>
			<tr>
				<td>Typ: 
					<select name="power_type">
						<option value="0">At-Will</option>
						<option value="1">Encounter</option>
						<option value="2">Daily</option>
					</select>
				</td>
				<td>Art:
					<select name="power_type2">
						<option value="0">Attack</option>
						<option value="1">Utility</option>
						<option value="2">Combat Action</option>
						<option value="3">Item Power</option>
						<option value="4">Class Feature</option>
						<option value="5">Race Feature</option>
					</select>
				</td>
				<td>Action: 
					<select name="power_action">
						<option value="0">Standard</option>
						<option value="1">Move</option>
						<option value="2">Minor</option>
						<option value="3">Free</option>
						<option value="4">Immediate Interrupt</option>
						<option value="5">Immediate Reaction</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="3">Keywords: <input type="text" name="keywords"></td>
			</tr>
			<tr>
				<td>
					<select name="power_range">
						<option value="0">Ranged</option>
						<option value="1">Melee</option>
						<option value="2">Close Blast</option>
						<option value="3">Close Burst</option>
						<option value="4">Area</option>
						<option value="5">Personal</option>
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
					<select name="line1indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line1gradient">
					<input type="text" name="line1"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line2indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line2gradient">
					<input type="text" name="line2"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line3indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line3gradient">
					<input type="text" name="line3"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line4indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line4gradient">
					<input type="text" name="line4"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line5indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line5gradient">
					<input type="text" name="line5"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line6indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line6gradient">
					<input type="text" name="line6"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line7indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line7gradient">
					<input type="text" name="line7"></td>
			</tr>
			<tr>
				<td colspan="3">I:
					<select name="line8indent">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					G: <input type="checkbox" name="line8gradient">
					<input type="text" name="line8"></td>
			</tr>
		</table>
	<input type="submit">
	</form>
</body>
</html>