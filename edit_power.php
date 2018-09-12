<?php 
/*
Example values for addPower:
$name = 'Lance of Faith';
$class = 'Cleric';
$level = 1;
$type = 0; 		//types: 0: At-Will 	1: Encounter 	2: Daily
$type2 = 0;		//types: 0: Attack 		1: Utility		2: Combat Action 	3: Item Power 	4: Class Feature 	5: Race Feature
$keywords = array('Divine','Implement','Radiant');
$action = 0;	//types: 0: Standard 	1: Move 		2: Minor 			3: Free 		4: Immediate Interrupt 	5: Immediate Reaction
$range = 0;		//types: O: Ranged 		1: Melee 		2: Close blast		3: Close burst 	4: Area 			5: Personal
$rangevalue = 5;
$aoe = 0;
$flavor = 'A brilliant ray of light sears your foe with golden radiance. Sparkles of light linger around the target, guiding your ally’s attack.';
$lines = array(

	// indent, gradient, type (0 for no type), text
	array(0,0,'Target','One creature'),
	array(0,0,'Attack,Wisdom vs. Reflex'),
	array(1,1,'Hit','1d8 + Wisdom modifier radiant damage, and one ally you can see gains a +2 power bonus to his or her next attack roll against the target.'),
	array(0,0,'','Increase damage to 2d8 + Wisdom modifier at 21st level.')
);
$username = 'Thomas';


example values for assocPowers
$username = 'Thomas';
$powers = array(
	array('Lance of Faith',0),
	array('Astral Seal',0),
	);
EXPECTS a nested array for $powers, so won't accept $powers=array('Lance of Faith',0); only $powers=array(array('Lance of Faith',0));



*/

if ($_GET['admin']=='true') {
$name = 'Icy End of the Earth';
$class = 'Eschatologist';
$level = 1;
$type = 1; 		//types: 0: At-Will 	1: Encounter 	2: Daily
$type2 = 0;		//types: 0: Attack 		1: Utility		2: Combat Action 	3: Item Power 	4: Class Feature 	5: Race Feature
$keywords = array('Psionic','Cold');
$action = 0;	//types: 0: Standard 	1: Move 		2: Minor 			3: Free 		4: Immediate Interrupt 	5: Immediate Reaction
$range = 3;		//types: O: Ranged 		1: Melee 		2: Close blast		3: Close burst 	4: Area 			5: Personal
$rangevalue = 3;
$aoe = 0;
$flavor = 'The world shall end in ice. As you sense the closeness of your own mortality, this undeniable doomsday manifests in your presence.';
$lines = array(

	// indent, gradient, type (0 for no type), text
	array(0,0,'Requirement','You must be bloodied to use this power.'),
	array(0,0,'Target','Each creature in burst'),
	array(1,1,'Effect','You create a stationary zone of unnatural winter in the area. The zone lasts until the end of your next turn. Creatures in the zone cannot heal damage or gain temporary hit points. Creatures that start their turn in the zone (including you) take 5 cold damage.<br />Level 11: 10 cold damage.<br />Level 21: 15 cold damage.'),
	array(1,0,'Special','You cannot reduce the damage this power does to you by any means. Other creatures’ resistances and immunities function normally.'),
	array(1,1,'Sustain Minor','You must be bloodied to sustain this power. If you are outside the zone, you take 5 cold damage. If you are inside the zone, you can sustain without spending an action. You cannot heal or gain temporary hit points while this power is active.'),
	array(1,0,'It Will All Turn To Dust','You may choose to peel away impermanent physical structures. If you do, within the zone creatures can move through man-made objects and structures that are less than a thousand years old as if they had phasing.')
);
$username = 'Thomas';
$usablecount = 0;

$powersToAdd = array(
	//Power name, how often it can be used (0 for unlimited)


	//DEFAULT, comment for custom and edit below
	//array($name, ($type==0)?0:1),


	//CUSTOM, start custom here
	array('Lance of Faith',0),
	array('Astral Seal',0),
	array('Sacred Flame',0),
	array('Second Wind',1),
	array('Channel Divinity: Healer\s Mercy',1),
	array('Channel Divinity: Divine Fortune',1),
	array('Healing Word',2),
	array('Shield Bearer',1),
	array('Shield Bearer',1),
	array('Icy End of the Earth',1),
);



$powerID = addPower ($name,$class,$level,$type,$type2,$keywords,$action,$range,$rangevalue,$aoe,$flavor,$lines);


assocPower(getUserID($username),$powersToAdd);


//addUser($username);


}
else {
echo 'ERROR 418 - You shouldn\'t be here.';
}
?>

























