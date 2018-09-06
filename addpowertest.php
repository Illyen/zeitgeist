
<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = "Zeitgeist - PowersTest";
require 'head.php';
require 'mysqlbackend.php'
?>
<body>
<div id="textblock">
<?php
include 'text.txt';

echo "\n<!-- Start des automatisch generierten Inhalts -->\n";


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

addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines);



echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</div>
</body>
</html><?php


?>

