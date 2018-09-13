<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = 'Zeitgeist - Add new Power';
require_once 'head.php';
require_once 'mysqlbackend.php';
?>
<body>
	<div id="textblock">
		<form action="add_power_preview.php" method="post">
			<table>
				<tr>
					<td class="alignright" colspan="2">Name:</td>
					<td><input type="text" pattern="^[A-Za-z0-9\s:']{0,50}$" name="power_name"<?php if(!empty($_POST['power_name'])) echo ' value="',cleanInput($_POST['power_name']),'"'; ?>></td>
					<td class="alignright">Class:</td>
					<td>
						<select name="power_class">
							<?php
							if (isset($_POST['power_class'])) {
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
					<td class="alignright">Level:</td>
					<td>
						<input type="number" style="width: 50px;" pattern="^[0-9]{0,2}$" name="power_level"<?php if(isset($_POST['power_level'])) echo ' value="',cleanInput($_POST['power_level']),'"'; ?>>
					</td>
				</tr>
				<tr>
					<td class="alignright" colspan="2">Type:</td>
					<td>
						<select name="power_type">
							<?php
							if (isset($_POST['power_type'])) {
							echo '<option value="0"';if ($_POST['power_type']=='0') echo ' selected'; echo '>At-Will</option>'."\n";
							echo '<option value="1"';if ($_POST['power_type']=='1') echo ' selected'; echo '>Encounter</option>'."\n";
							echo '<option value="2"';if ($_POST['power_type']=='2') echo ' selected'; echo '>Daily</option>'."\n";
							}
							else {
							echo '<option value="0">At-Will</option>
							<option value="1">Encounter</option>
							<option value="2">Daily</option>'."\n";
							}
							?>
						</select>
					</td>
					<td class="alignright">Type 2:</td>
					<td>
						<select name="power_type2">
							<?php
							if (isset($_POST['power_type2'])) {
							echo '<option value="0"';if ($_POST['power_type2']=='0') echo ' selected'; echo '>Attack</option>'."\n";
							echo '<option value="1"';if ($_POST['power_type2']=='1') echo ' selected'; echo '>Utility</option>'."\n";
							echo '<option value="2"';if ($_POST['power_type2']=='2') echo ' selected'; echo '>Combat Action</option>'."\n";
							echo '<option value="3"';if ($_POST['power_type2']=='3') echo ' selected'; echo '>Item Power</option>'."\n";
							echo '<option value="4"';if ($_POST['power_type2']=='4') echo ' selected'; echo '>Class Feature</option>'."\n";
							echo '<option value="5"';if ($_POST['power_type2']=='5') echo ' selected'; echo '>Race Feature</option>'."\n";
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
					<td class="alignright">Action:</td>
					<td> 
						<select name="power_action">
							<?php
							if (isset($_POST['power_action'])) {
							echo '<option value="0"';if ($_POST['power_action']=='0') echo ' selected'; echo '>Standard</option>'."\n";
							echo '<option value="1"';if ($_POST['power_action']=='1') echo ' selected'; echo '>Move</option>'."\n";
							echo '<option value="2"';if ($_POST['power_action']=='2') echo ' selected'; echo '>Minor</option>'."\n";
							echo '<option value="3"';if ($_POST['power_action']=='3') echo ' selected'; echo '>Free</option>'."\n";
							echo '<option value="4"';if ($_POST['power_action']=='4') echo ' selected'; echo '>Immediate Interrupt</option>'."\n";
							echo '<option value="5"';if ($_POST['power_action']=='5') echo ' selected'; echo '>Immediate Reaction</option>'."\n";
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
					<td class="alignright" colspan="2">Keywords:</td>
					<td colspan="5">
						<input type="text" class="powerTableTextInput" pattern="^([A-Za-z]{0,25}[,\s]){0,}[A-Za-z]{0,25}$" name="keywords"<?php if(isset($_POST['keywords'])) echo ' value="',cleanInput($_POST['keywords']),'"'; ?>><br /><span style="font-size: 8pt;">Enter keywords, separated by comma.</span>
					</td>
				</tr>
				<tr>
					<td class="alignright" colspan="2">Rangetype:</td>
					<td>
						<select name="power_range">
							<?php
							if (isset($_POST['power_range'])) {
							echo '<option value="0"';if ($_POST['power_range']=='0') echo ' selected'; echo '>Ranged</option>';
							echo '<option value="1"';if ($_POST['power_range']=='1') echo ' selected'; echo '>Melee</option>';
							echo '<option value="6"';if ($_POST['power_range']=='6') echo ' selected'; echo '>Melee touch</option>';
							echo '<option value="7"';if ($_POST['power_range']=='7') echo ' selected'; echo '>Melee weapon</option>';
							echo '<option value="8"';if ($_POST['power_range']=='8') echo ' selected'; echo '>Ranged weapon</option>';
							echo '<option value="9"';if ($_POST['power_range']=='9') echo ' selected'; echo '>M./R. weapon</option>';
							echo '<option value="2"';if ($_POST['power_range']=='2') echo ' selected'; echo '>Close Blast</option>';
							echo '<option value="3"';if ($_POST['power_range']=='3') echo ' selected'; echo '>Close Burst</option>';
							echo '<option value="4"';if ($_POST['power_range']=='4') echo ' selected'; echo '>Area</option>';
							echo '<option value="5"';if ($_POST['power_range']=='5') echo ' selected'; echo '>Personal</option>';
							}
							else {
							echo '<option value="0">Ranged</option>
							<option value="1">Melee</option>
							<option value="6">Melee touch</option>
							<option value="7">Melee weapon</option>
							<option value="8">Ranged weapon</option>
							<option value="9">M./R. weapon</option>
							<option value="2">Close Blast</option>
							<option value="3">Close Burst</option>
							<option value="4">Area</option>
							<option value="5">Personal</option>';
							}
							?>
						</select>
					</td>
					<td class="alignright">AOE:</td>
					<td>
						<input type="number" style="width: 50px;" pattern="^[0-9]{0,2}$" name="power_range_aoe"<?php if(isset($_POST['power_range_aoe'])) echo ' value="',cleanInput($_POST['power_range_aoe']),'"'; ?>>
					</td>
					<td class="alignright">Range:</td>
					<td>
						<input type="number" style="width: 50px;" pattern="^[0-9]{0,2}$" name="power_range_value"<?php if(isset($_POST['power_range_value'])) echo ' value="',cleanInput($_POST['power_range_value']),'"'; ?>>
					</td>
				</tr>
				<tr>
					<td class="alignright" colspan="2">Flavortext:</td>
					<td colspan="5">
						<input type="text" class="powerTableTextInput" name="power_flavor"<?php if(isset($_POST['power_flavor'])) echo ' value="',cleanInput($_POST['power_flavor']),'"'; ?>>
					</td>
				</tr>
				<tr>
					<td>Indent</td>
					<td>Grad.</td>
					<td>Title</td>
					<td colspan="4">Text</td>
				</tr>
				<?php
				for ($i=0;$i<12;$i++) {
					echo '<tr>'."\n";
					echo '<td>I:'."\n";
					echo '<select name="line'.$i.'indent">'."\n";
					if (isset($_POST["line{$i}indent"])) {
						echo '<option value="0"';if ($_POST["line{$i}indent"]=='0') echo ' selected'; echo '>0</option>'."\n";
						echo '<option value="1"';if ($_POST["line{$i}indent"]=='1') echo ' selected'; echo '>1</option>'."\n";
						echo '<option value="2"';if ($_POST["line{$i}indent"]=='2') echo ' selected'; echo '>2</option>'."\n";
					}
					else {
						echo '<option value="0">0</option>'."\n";
						echo '<option value="1">1</option>'."\n";
						echo '<option value="2">2</option>'."\n";
					}
					echo '</select>'."\n";
					echo '</td>'."\n";
					echo '<td>G:<input type="checkbox" name="line'.$i.'gradient"';if(!empty($_POST["line{$i}gradient"])) echo ' checked'; echo ">\n";
					echo '</td>'."\n";
					echo '<td>'."\n";
					echo '<input type="text" pattern="^.{0,25}$" name="line'.$i.'type"';if(isset($_POST["line{$i}type"])) echo ' value="'.cleanInput($_POST["line{$i}type"]),'"'; echo ">\n";
					echo '</td>'."\n";
					echo '<td colspan="4">'."\n";
					echo '<input type="text" name="line'.$i.'" class="powerTableTextInput"';if(isset($_POST["line{$i}"])) echo ' value="'.cleanInput($_POST["line{$i}"]).'"'; echo ">\n";
					echo "</td>\n";
					echo '</tr>'."\n";
				}?>
				<tr>
					<td colspan="3" class="alignright"><label for="addtoplayer">Add to player?</label><input type="checkbox" name="addtoplayer"<?php if(!empty($_POST['addtoplayer'])) echo 'checked';?>>
						<select name="user">
							<?php
								$users = getUsers();
								foreach ($users as $index => $user) {
									echo '<option value="',$user,'"'; if ($_POST['user']==$user) echo ' selected'; echo ">$user</option>\n";
								}
							?>
						</select>
					</td>
					<td colspan="4"><input type="submit" value="Preview"></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>