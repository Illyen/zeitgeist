<?php
$itemprices = array(200,360,520,680,840,1000,1800,2600,3400,4200,5000,9000,13000,17000,21000,25000,45000,65000,85000,105000,125000,225000,325000,425000,525000,625000,1125000,1625000,2125000,2625000,3125000);

$strItemPrices = array("200","360","520","680","840","1.000","1.800","2.600","3.400","4.200","5.000","9.000","13.000","17.000","21.000","25.000","45.000","65.000","85.000","105.000","125.000","225.000","325.000","425.000","525.000","625.000","1.125.000","1.625.000","2.125.000","2.625.000","3.125.000");

$itemrarity = array("Common","Uncommon","Rare","Legendary");

$itemenhancementtexts = array(
	"none", 							#0
	"Attack rolls and damage rolls",	#1
	"AC",								#2
	"Fortitude, Reflex, and Will",		#3
	"Angriff und Schaden, Schaden verdoppelt",#4 Special for Mjolnir
);

$itemtype = array(
	//unsortiert
	"Implement (Holy Symbol)", 		#0
	"Armor:</b> any<b>",			#1
	"Neck slot item",				#2
	"Wondrous Item",				#3
	"Head Slot Item",				#4
	"Weapon:</b> Bow, crossbow<b>",	#5
	"Weapon:</b> any firearm<b>",	#6
	"Implement (Orb)",				#7
	"Armor:</b> Cloth<b>",			#8
	"Implement (Staff)",			#9
	"Weapon:</b> Hammer<b>",		#10
	"Weapon:</b> any melee<b>",		#11
	"Hand Slot Item",				#12
	"Weapon:</b> any<b>",			#13
	"Feet Slot Items",				#14
	"Armor:</b> Cloth, Leather<b>"	#15
	"Armor:</b> Scale, Plate<b>"	#16


);

$itemflavortexts = array
(
	"Symbol of Life"		=>"The power of your faith adds energy to your healing powers",
	"Veteran's Armor"		=>"Battered and worn, this unassuming armor helps you get the most out of your experiences.",
	"Amulet of Protection"	=>"This light blue amulet increases your defenses.",
	"Golden Icon of Urim"	=>"About three inches across, this coin has primitive designs of earth, stone, and dots that might represent stars.",
	"Baffling Cape"			=>"This rippling cape allows you to slip past an attacking foe.",
	"Reading Spectacles"	=>"You can decipher any written passage while gazing through these unadorned copper eyeglasses.",
	"Window of Escape"		=>"When you need to get out of a room in a hurry, this unremarkable window is your best escape",
	"Targeting Weapon"		=>"When the bolt flies from your weapon, it shows the way to victory.",
	"Badger Gun"			=>"You pull the trigger, and a badger springs forth to attack your foes.",
	"Magic Armor"			=>"A set of basic yet effective enchanted armor.",
	"Crown of Leaves"		=>"This halo of ever-fresh oak leaves pulses with primal energy.",
	"Golden Icon of Avilona"=>"About three inches across, this coin has primitive designs of birds, clouds, and dots that might represent stars.",
	"Golden Icon of Nem"	=>"About three inches across, this coin has primitive designs of shadows, the moon, and dots that might represent stars.",
	"Orb of Unlucky Exchanges"=>"This orb offers relief to an ally and unleashes terrible retribution upon an enemy.",
	"Mage Cuffs"			=>"Made specially for the RHC.",
	"Robe of Contingecy"	=>"Stitched with thread from the Feywild, this robe is favored by many wizards for its ability to escape a bind.",
	"Staff of the Ancients" =>"This wooden staff is covered in a spiral of symbols that denote the primal elements of air, earth, fire, and water. When you attack, it turns briefly to gold.",
	"Amulet of the Ancients"=>"This stone amulet is engraved with ancient pictograms depicting a tree surrounded by the primal elements of earth, water, wind, and fire. When you are attacked, the amulet turns briefly to gold.",
	"Mjolnir"				=>"G&ouml;tterhammer",
	"Lifedrinker Weapon"	=>"This weapon transfers an enemy’s vitality to you.",
	"Frostwolf Pelt"		=>"The icy white fur of this cloak protects you against frost.",
	"Gauntlets of Ogre Power"=>"These oversized armored gloves increase your strength and can be activated to increase your damage.",
	"Vicious Weapon"		=>"Some wielders claim this weapon takes pleasure in dealing pain.",
	"Acrobat Boots"			=>"These enchanted boots enhance your acrobatic skills.",
	"Burglar Gloves"		=>"These fingerless black gloves are embroidered with dark red sigils and improve your thievery skills.",
	"Veganes Grimoire"		=>"Eingebunden in Bio-Menschenhaut",
	"Weapon of Oaths Fulfilled"=>"As your weapon slays your deity's enemy, you feel a surge of vitality that allows you to keep fighting.",
	"Deepfarer's Pouch"		=>"This oilskin pouch holds more than it should, including a small breathing tube, that extends from the inside.",
	"Escape Tattoo"			=>"Broken chains and skeleton keys are popular images for this tattoo.",
	"Holy Adversary's Armor"=>"When you swear an oath against your prey, divine grace permeates this armor, protecting you against that creature's attacks.",
	"Symbol of Brawn"		=>"Physical strength and holy devotion are both enhanced by this adamantine holy symbol.",
	"Staff of the Adaptable Mind"=>"This staff lets you move at the instant you perceive a threat, allowing you and your friends to avoid harm.",
	"Elusive Armor"			=>"This armor offers no purchase to foes that would pin you down.",
	"Safewing Amulet"		=>"This orange amulet reduces the damage you suffer when falling.",
	"Aura Killer Weapon"	=>"The dark purple magic trailing this weapon's wake shuts down your enemy's subtle spells and instinctive powers."
	"Fortification Armor"	=>"Dragonborn are no strangers to battle, and they developed this armor to deflect the deadliest enemy attacks."
);

$itemproperties = array
(
	"Veteran's Armor"		=>array("When you spend an action point, you gain a +1 item bonus to all attack rolls and defenses until the end of your next turn.",),
	"Golden Icon of Urim"	=>array("When you use an action point, you can create a wall of stone 2 squares high, which fills 3 contiguous squares within 5 squares of you. The wall lasts until the end of your next turn.",
									"While on Axis Island, a person holding the icon or wearing it as a necklace gains Resist All 5 while not bloodied, and can influence earth magic. Most notably, earth elementals are drawn to it, and they defend the bearer and obey his or her orders.",),
	"Reading Spectacles"	=>array("You can read any language while wearing this item.",),
	"Window of Escape"		=>array("When you jump or fall out of this window, you take no damage when you hit the ground, regardless of the distance.",),
	"Crown of Leaves"		=>array("Gain a +2 item bonus to Nature and Insight checks.",),
	"Golden Icon of Avilona"=>array("When you use an action point, once before the end of your next turn you can fly your speed as a move action.",
									"While on Axis Island, a person holding the icon or wearing it as a necklace gains a jump speed equal to his or her walk speed, and can influence air magic. Most notably, air elementals are drawn to it, and they defend the bearer and obey his or her orders.",),
	"Golden Icon of Nem"	=>array("When you use an action point, you may become insubstantial until the end of your next turn. This effect ends if you attack.",
									"While on Axis Island, a person holding the icon or wearing it as a necklace gains darkvision, and can influence shadow magic. Most notably, shadow creatures are drawn to it, and they defend the bearer and obey his or her orders.",),
	"Mage Cuffs"			=>array("When a person wearing <i>mage-cuffs</i> uses any magical power (generally defined as an arcane, divine, primal, psionic, or shadow power, or equivalent nontypedabilities), the cuffs glow, make a warning whistle sound, and deal 10 damage to the wearer. A creature reduced to 0 hit points this way becomes unconscious.<br />&nbsp;&nbsp;<i>Mage-cuffs</i> can only be applied to helpless or willing creatures of Small or Medium size.",),
	"Amulet of the Ancients"=>array("You gain resist acid, cold, fire, lightning, and thunder equal to the amulet’s enhancement bonus.",),
	"Mjolnir"				=>array("Das Level von Mjolnir entspricht dem Level des Benutzers.",),
	"Lifedrinker Weapon"	=>array("When you drop an enemy to 0 hit points or fewer with a melee attack made with this weapon, gain 5 temporary hit points.<br /><i>Level 15 or 20:</i> Gain 10 temporary hit points.<br /><i>Level 25 or 30:</i> Gain 15 temporary hit points.",),
	"Frostwolf Pelt"		=>array("You gain resist 5 cold.<br /><i>Level 14 or 19:</i> Resist 10 cold<br /><i>Level 24 or 29:</i> Resist 15 cold",),
	"Gauntlets of Ogre Power"=>array("Gain a +1 item bonus to Athletics checks and Strength ability checks (but not Strength attacks).",),
	"Acrobat Boots"			=>array("Gain a +1 item bonus to Acrobatics checks.",),
	"Burglar Gloves"		=>array("Gain a +1 item bonus to Thievery checks.",),
	"Weapon of Oaths Fulfilled"=>array("Avengers can use this weapon as an implement for avenger powers and avenger paragon path powers.",
									"When you reduce the target of your <i>oath of enmity</i> to 0 hit points, the next attack you make with this weapon before the end of your next turn deals 1d6 extra damage per plus.",),
	"Deepfarer's Pouch"		=>array("This belt pouch contains 1 hour's worth of air, which remains freh indefinitely. Once the air in the pouch has been consumed, you can refresh the supply by exposing the pouch to any supply of breathable air during a short rest.",),
	"Escape Tattoo"			=>array("When a nonminion enemy scores a critical hit against you and deals damage, you can teleport 3 squares as a free action.",),
	"Staff of the Adaptable Mind"=>array("You gain a +1 item bonus to perception checks.<br /><i>Level 14 or 19:</i> +2 item bonus.<br /><i>Level 24 or 29:</i> +3 item bonus.",),
	"Elusive Armor"			=>array("You gain a +2 bonus to escape checks.",),
	"Safewing Amulet"		=>array("When falling, reduce the distance by 10 feet for every plus (-10 feet for +1, -20 for +2, and so on) for the purpose of calculating damage. You always land on your feet after a fall."),
	"Fortification Armor"	=>array("Whenever a critical hit is scored against you, roll 1d20. On a result of 16-20, the critical hit becomes a normal hit."),

);

$itempowers = array
(
	//"Bezeichner"			=>array(beschreibung)
	"Symbol of Life"		=>array(
		"<b>Power (Daily &#10022; Healing)</b> Minor Action.Until the end of your turn, any character healed by one of your encounter powers or daily powers regains an additional 1d6 hit points.<br />Level 12 or 17: regains an additional 2d6 hit points.<br />Level 22 or 27: Regains an additional 3d6 hit points."
	),
	"Veteran's Armor"		=>array(
		"<b>Power (Daily)</b> Free Action. Spend an action point. You do not gain the normal extra action. Instead, you regain the use of one expended daily power."
	),
	"Baffling Cape"			=>array(
		"<b>Power (Daily &#10022; Teleportation):</b> Immediate Reaction. <i>Trigger:</i> An enemy adjacent to you misses you with a melee attack. <i>Effect:</i> Swap positions with the triggering enemy.",
	),
	"Targeting Weapon"		=>array(
		"<b>Power (Daily):</b> Free Action. <i>Trigger:</i> You hit an enemy with an attack using this weapon. <i>Effect:</i> Until the end of your next turn, you and your allies can roll twice on attaqck rolls against that enemy and use either result.",
	),
	"Badger Gun"			=>array(
		"<b>Power (Daily):</b> Immediate Reaction <i>Trigger:</i> You hit a target with a ranged attack using this gun. <i>Effect (Free Action):</i> A Dreaming badger (page 515) appears in an unoccupied square adjacent to the target, and the target is grabbed by the badger. The badger has your defenses, and hit points equal to half your bloodied value. If it is destroyed, you lose a healing surge. The badger does not take its own actions. When you use a move action, you may have the badger use a move action as well. You may spend a standard action to have it attack. Its attack bonus is equal to your attack bonus with the <i>badger gun</i>. Apply the weapon’s critical property to the badger’s attacks.",
	),
	"Orb of Unlucky Exchanges"=>array(
		"<b>Power (Daily):</b> Free Action. Use this power when you hit a target with an attack with this implement. One effect affecting you or an ally within 5 squares of you ends. The target gains that effect with the same duration."
	),
	"Robe of Contingecy"	=>array(
		"<b>Power (Daily &#10022; Teleportation):</b> Immediate Reaction. Use this power while you are bloodied and when an attack damages you. Teleport 6 squares, and you can spend a healing surge."
	),
	"Staff of the Ancients"	=>array(
		"<b>Power (Encounter):</b> Immediate Reaction. <i>Trigger:</i> You make an attack roll with a power that deals acid, cold, fire, lightning, or thunder damage. <i>Effect:</i> You may reroll the attack roll.",
		"<b>Power (Daily):</b> Standard Action. You use an attack power with the acid, cold, fire, lightning, or thunder keyword that an enemy you can see used in the last round. You choose the targets using your own space as the origin, but you use the enemy’s attack bonus.",
	),
	"Amulet of the Ancients"=>array(
		"<b>Power (Daily):</b> Standard Action. You use an attack power with the acid, cold, fire, lightning, or thunder keyword that an enemy you can see used in the last round. You choose the targets using your own space as the origin, but you use the enemy’s attack bonus.",
		"<b>Power (Daily):</b> Free Action. You and each ally within 5 squares gains resist 5 acid, cold, fire, lightning, and thunder until the end of your next turn.<br /><i>Lvl 12 or 17:</i> Resist 10.<br /><i>Lvl 22 or 27:</i> Resist 15.",
	),
	"Mjolnir"				=>array(
		"<b>Power (At-Will):</b> Free Action. Schadensart von Physisch auf Donner oder Blitz umstellen.",
		"<b>Power (Encounter):</b> Free Action. Der n&auml;chste ausgef&uuml;hrte Nahkampangriff erh&auml;lt 10 Felder Reichweite.",
		"<b>Power (Daily):</b> Standard Action. In 5 Feldern Umkreis werden alle ausgew&auml;hlten Ziele f&uuml;r 1d10 Blitzschaden pro Plus getroffen. Funktioniert nur unter freiem Himmel. Prim&auml;res Attribut gegen Reflex.",
	),
	"Frostwolf Pelt"		=>array(
		"<b>Power (Daily):</b> Immediate Reaction. <i>Trigger:</i> An enemy adjacent to you hits you. <i>Effect:</i> The triggering enemy is knocked prone.",
	),
	"Gauntlets of Ogre Power"=>array(
		"<b>Power (Daily):</b> Free Action. Use this power when you hit with a melee attack. Add a +5 power bonus to the damage roll.",
	),
	"Acrobat Boots"			=>array(
		"<b>Power (At-Will):</b> Minor Action. Stand up from prone.",
	),
	"Holy Adversary's Armor"=>array(
		"<b>Power (Daily):</b> Minor Action. Until the end of the encounter, you gain reistance to all damage against attacks by your current <i>oath of enmity</i> target equals  to the armor's enhancement bonus.",
	),
	"Symbol of Brawn"		=>array(
		"<b>Power (Daily):</b> Free Action. <i>Trigger:</i> You hit with a divine attack power using this holy symbol. <i>Effect:</i> Make a melee basic attack. If the attack hits a creature marked by you, it deals 1d10 extra damage.<br /><i>Level 13 or 18:</i> 2d10 extra damage.<br /><i>Level 23 or 28:</i> 3d10 extra damage.",),
	"Staff of the Adaptable Mind"=>array(
		"<b>Power (Daily &#10022; Augmentable):</b> Immediate Interrupt. <i>Trigger:</i> An enemy hits you. <i>Effect:</i> You gain resistance to all damage equal to 5 + the staff's enhancement bonus until the start of your next turn.<br /><b>Augment 1:</b> Each ally adjacent to you also gains the resistance until the start of your next turn.",
	),
	"Elusive Armor"			=>array(
		"<b>Power (Daily &#10022; Augmentable):</b> Immediate Reaction. <i>Trigger:</i> You are immobilized by an attack. <i>Effect:</i> You are no longer immobilized, and you shift 1 square.<br /><b>Augment 1:</b> The number of squares you shift equals half your speed.",
	),
	"Aura Killer Weapon"	=>array(
		"<b>Power (Daily):</b> Free Action. <i>Trigger:</i> You use this weapon to hit an enemy that has an aura. <i>Effect:</i> The enemy's aura ends, and the enemy can't reactivate it (save ends).",
	),

);

//name => lvl, scl, typ, enh, crt, prp, pwc

$items = array(
//									lvl0 	 	rar2 	enh4	prp6
//										 scl1 		typ3	crt5 	pwc7
	"Symbol of Life"		=>array(2,	true,	1,	0,	1,	"1d6",0,1),
	"Veteran's Armor"		=>array(2,	true,	0,	1,	2,	0,	1,	1),
	"Amulet of Protection"	=>array(1,	true,	0,	2,	3,	0,	0,	0),
	"Golden Icon of Urim"	=>array(3,  false,  2,  3,  0,  0,  2,   0),
	"Baffling Cape"			=>array(3,	true, 	1,	2, 	3, 	0, 	0, 	1),
	"Reading Spectacles"	=>array(2, 	false,	0, 	4, 	0, 	0, 	1, 	0),
	"Window of Escape"		=>array(2,	false,	0,	3, 	0,	0, 	1,	0),
	"Targeting Weapon"		=>array(3,	true,	1,	5,	1,  "1d6",0,1),
	"Badger Gun"			=>array(3,	true,	1,	6,	1,	"1d6",0,1),
	"Magic Armor"			=>array(1,	true,	0,	1,	2,	0,	0,	0),
	"Crown of Leaves"		=>array(7,	false,	0,	4,	0,	0,	1,	0),
	"Golden Icon of Avilona"=>array(2,	false,	2,	3,	0,	0,	2,	0),
	"Golden Icon of Nem"	=>array(4,	false,	2,	3,	0,	0,	2,	0),
	"Orb of Unlucky Exchanges"=>array(3,true,	1,	7,	1,	"1d6",0,1),
	"Mage Cuffs"			=>array(1,	false,	0,	3,	0,	0,	1,	0),
	"Robe of Contingency"	=>array(4,	true,	1,	8,	2,	0, 	0,	1),
	"Staff of the Ancients"	=>array(9,	true,	2,	9,	1,	"1d6 acid, cold, fire, lightning and thunder", false, 2),
	"Amulet of the Ancients"=>array(8,	true,	2,	2,	0,	0,	1,	2),
	"Mjolnir"				=>array(5,	true,	3, 10,	4,	"2d6 thunder and lightning", 1, 3),
	"Lifedrinker Weapon"	=>array(5,	true,	1, 11,	1,	"1d6 necrotic", 1, 0),
	"Frostwolf Pelt"		=>array(4,	true, 	1, 	2,	3, 	0,	1,	1),
	"Gauntlets of Ogre Power"=>array(5,false,	1, 12,	0,	0,	1,	1),
	"Vicious Weapon"		=>array(2,	true,	0, 13,	1,	"1d12",0,0),
	"Magic Weapon"			=>array(1, 	true,	0, 13,  1,	"1d6",0,0),
	"Acrobat Boots"			=>array(2,	false,	1, 14,	0,	0,	1,	1),
	"Burglar Gloves"		=>array(2,	false,  0, 12,	0,	0,	1,	0),
	"Veganes Grimoire"		=>array(4,  false,  3,  3,  0,  0, 0,   0),
	"Weapon of Oaths Fulfilled"=>array(4,true,  1, 13,  1,  "1d6",2,0),
	"Deepfarer's Pouch"		=>array(5,  false,  0,  3,  0,  0,  1,  0),
	"Escape Tattoo"			=>array(3,  false,  0, 13,  0,  0,  1,  0),
	"Holy Adversary's Armor"=>array(3,  true,  	1,  8,  2,  0,  0,  1),
	"Symbol of Brawn"		=>array(3,  true,  	1,  0,  1,  "1d6",0,1),
	"Staff of the Adaptable Mind"=>array(4,true,1,  9,  1,  "1d8",1,1),
	"Elusive Armor"			=>array(2,	true,  	1, 15,  2,  0,  1,  1),
	"Safewing Amulet"		=>array(3,  true,  	0,  2,  3,  0,  1,  0),
	"Aura Killer Weapon"	=>array(3,	true,	1, 11,  1,  "1d6",0,1),
	"Fortification Armor"	=>array(4,	true,  	1, 16,  2,  0,  1,  0),
);

$players = array (
//			  name 	enhancement  rhc
	"Thomas" =>array(
		array("Symbol of Life",	3, true),
		array("Veteran's Armor",2, true),
		array("Amulet of Protection",2, true),
		array("Golden Icon of Urim",0, false),
		array("Veganes Grimoire", 1, false),
		),
	"Max"	=>array(
		array("Deepfarer's Pouch", 0, true),
		array("Escape Tattoo", 0, true),
		array("Holy Adversary's Armor", 1, true),
		array("Weapon of Oaths Fulfilled", 1, true),
		array("Symbol of Brawn", 1, true),
		),
	"Daniel" =>array(
		array("Staff of the Adaptable Mind", 2, true),
		array("Elusive Armor", 2, true),
		array("Safewing Amulet", 2, true),
		),
	"Fabian" =>array(
		array("Magic Weapon", 2, true, "Magic Pistol"),
		array("Magic Weapon", 2, true, "Magic Pistol"),
		array("Magic Weapon", 1, true, "Magic Rapier"),
		array("Magic Armor", 3, true, "Magic Hide Armor"),
		array("Reading Spectacles", 0, true),
		array("Amulet of Protection", 2, true),
		array("Burglar Gloves", 0, true),
		),
	"Caro" =>array(
		array("Aura Killer Weapon", 2, true, "Aura Killer Battleaxe"),
		array("Fortification Armor", 2, true, "Fortification Scale Armor")
		),
	"Richard" =>array(
		array("Crown of Leaves", 0, false),
		array("Golden Icon of Avilona", 0, false),
		array("Golden Icon of Nem", 0, false),
		array("Orb of Unlucky Exchanges", 1, true),
		array("Mage Cuffs", 0, true),
		array("Robe of Contingency", 1, true),
		),
);































?>