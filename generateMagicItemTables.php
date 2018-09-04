<?php

require 'var.php';
//generiert zu einem gegebenem startlevel eine preistabelle, nicht getestet, aber theoretisch fertig
function writeLvlLine($lvl1, $lvl2) {

	global $strItemPrices;

	$ausgabe = "";

	$ausgabe .= "<tr class=\"alignright\">";
	$ausgabe .= "<td>Lvl ".$lvl1."</td><td>+".ceil($lvl1/5)."</td><td>".$strItemPrices[$lvl1]." gp</td>";
	if ($lvl2 <> 0) {
		$ausgabe .= "<td>Lvl ".$lvl2."</td><td>+".ceil($lvl2/5)."</td><td>".$strItemPrices[$lvl2]." gp</td>";
		$ausgabe .= "</tr>\n";
	}
	else {
		$ausgabe .= "<td colspan=\"3\">&nbsp;</td>";
		$ausgabe .= "</tr>\n";
	}

	return $ausgabe;
}

function generateLvlTable($itemlevel) {
	
	$itemLevelCount = 6-floor(($itemlevel-1)/5);
	$ausgabe = "";

	if    ($itemLevelCount==2)
		$ausgabe .= writeLvlLine($itemlevel, $itemlevel+5);
	elseif($itemLevelCount==3) {
		$ausgabe .= writeLvlLine($itemlevel, $itemlevel+10);
		$ausgabe .= writeLvlLine($itemlevel+5, 0);
	}
	elseif($itemLevelCount==4){
		$ausgabe .= writeLvlLine($itemlevel, $itemlevel+10);
		$ausgabe .= writeLvlLine($itemlevel+5, $itemlevel+15);
	}
	elseif($itemLevelCount==5){
		$ausgabe .= writeLvlLine($itemlevel, $itemlevel+15);
		$ausgabe .= writeLvlLine($itemlevel+5, $itemlevel+20);
		$ausgabe .= writeLvlLine($itemlevel+10, 0);
	}
	else {
		$ausgabe .= writeLvlLine($itemlevel, $itemlevel+15);
		$ausgabe .= writeLvlLine($itemlevel+5, $itemlevel+20);
		$ausgabe .= writeLvlLine($itemlevel+10, $itemlevel+25);
	}
	return $ausgabe;
}


//generiert die mouseover item card
function generateItemTable($itemname) {

	//Variablen aus var.php!
	global $items;
	global $itemflavortexts;
	global $itemrarity;
	global $itemtype;
	global $itemenhancementtexts;
	global $itemproperties;
	global $itemprices;
	global $strItemPrices;
	global $itempowers;

	$nam = $itemname;
	$lvl = $items[$itemname][0];
	$scl = $items[$itemname][1];
	$rar = $items[$itemname][2];
	$typ = $items[$itemname][3];
	$enh = $items[$itemname][4];
	$crt = $items[$itemname][5];
	$prp = $items[$itemname][6];
	$pwc = $items[$itemname][7];

	$colspan = 2;
	if ($scl) $colspan = 6;


	$ausgabe  = "<table class=\"itemtable\">";
	$ausgabe .= "<tr><th colspan=\"".$colspan."\" class=\"itemname\">".$itemname."<span class=\"itemlevel\">Level ".$lvl;if($scl){$ausgabe .= "+";}$ausgabe .= "</span></th></tr>\n";
	$ausgabe .= "<tr><td colspan=\"".$colspan."\" class=\"flavortext\">".$itemflavortexts[$itemname]."</td></tr>\n";
	if($scl)	$ausgabe .= generateLvlTable($items[$itemname][0]);
	if($scl) 	$ausgabe .= "<tr><td colspan=\"".$colspan."\"><b>".$itemrarity[$rar]." ".$itemtype[$typ]."</b></td></tr>\n";
	else 		$ausgabe .= "<tr><td><b>".$itemrarity[$rar]." ".$itemtype[$typ]."</b></td><td>".$strItemPrices[$lvl]." gp</td></tr>\n";
	if($enh<>0) $ausgabe .= "<tr><td colspan=\"".$colspan."\"><b>Enhancement:</b> ".$itemenhancementtexts[$enh]."</td></tr>\n";
	if($crt<>0) $ausgabe .= "<tr><td colspan=\"".$colspan."\"><b>Critical:</b> +".$crt." damage per plus</td></tr>\n";
	//if($prp)    $ausgabe .= "<tr><td colspan=\"".$colspan."\"><b>Property:</b> ".$itemproperties[$itemname]."</td></tr>\n";
	if($prp<>0){
		for ($i=0;$i<$prp;$i++){
				$ausgabe .= "<tr><td colspan=\"".$colspan."\"><b>Property:</b> ".$itemproperties[$itemname][$i]."</td></tr>\n";
		}
	}
	if($pwc<>0){
		for ($i=0;$i<$pwc;$i++){
				$ausgabe .= "<tr><td colspan=\"".$colspan."\" class=\"power\">".$itempowers[$itemname][$i]."</td></tr>\n";
		}
	}
	$ausgabe .= "</table>\n";
		return $ausgabe;
}

//berechne die hoechste anzahl an items, die (irgend)ein spieler besitzt und gebe die anzahl aus, fuer offset (leerzeilen)
function calculateHighestItemCount(){

	global $players;

	$ausgabe=0;
	foreach ($players as $key => $value){
		if(count($value)>$ausgabe) $ausgabe=count($value);
	}
	return $ausgabe;
}


//generiert die komplette tabelle fuer einen spieler

function generatePlayerTable($playername) {

	global $players;
	global $items;
	global $itemrarity;
	global $itemprices;
	global $strItemPrices;

	//array mit allen items (name, enhancement, rhc bekannt, anzeigename)
	$playeritems = $players[$playername];
	//gesamtpreis aller magischen items
	$total = 0;
	//gesamtpreis der vom rhc angeforderten items
	$totalrhc = 0;
	//anzahl ungewoehlicher und seltener items
	$totalrhcrar = 0;



	$ausgabe  = "<table class=\"playertable\">\n";
	$ausgabe .= "<tr><th colspan=\"5\" class=\"playername\">".$playername."</th>\n";
	$ausgabe .= "<tr class=\"bglightyellow\"><th>Item</th><th>Level</th><th>Seltenheit</th><th>Preis</th><th>RHC?</th></tr>\n";
	for ($i=0;$i<count($playeritems);$i++){

		$nam = $playeritems[$i][0];
		if(array_key_exists(3, $playeritems[$i])) $nam = $playeritems[$i][3];

		if ($playeritems[$i][1]>0) 	$ausgabe .= "<tr>\n<td class=\"dropdown dropbtn\">".$nam." +".$playeritems[$i][1]."\n";
		else 						$ausgabe .= "<tr>\n<td class=\"dropdown dropbtn\">\n".$nam;
		$ausgabe .= "<div class=\"dropdown-content\">\n";
		$ausgabe .= generateItemTable($playeritems[$i][0]);
		$ausgabe .= "</div>\n</td>\n";

		//berechne das Itemlevel aus dem Enhancement Level, andersrum wäre auch möglich gewesen, aber umständlicher zum nachpflegen im array
		if($playeritems[$i][1]>0)
			$itmlvlcurr = $items[$playeritems[$i][0]][0]+(5*($playeritems[$i][1]-1));
		else 
			$itmlvlcurr = $items[$playeritems[$i][0]][0];

		$ausgabe .= "<td>".$itmlvlcurr."</td>";
		$ausgabe .= "<td>".$itemrarity[$items[$playeritems[$i][0]][2]]."</td>";
		$ausgabe .= "<td class=\"alignright\">".$strItemPrices[$itmlvlcurr]."</td>";

		//addiere den preis des items zum gesamtpreis
		$total += $itemprices[$itmlvlcurr];

		//ueberpruefe ob das item dem rhc bekannt ist
		if ($playeritems[$i][2]){
			$ausgabe .= "<td>Yes</td></tr>\n";

			//addiere den preis zum rhc gesamtpreis
			$totalrhc += $itemprices[$itmlvlcurr];

			//erhoehe itemcount, falls ungewoehnlich oder seltener
			if ($items[$playeritems[$i][0]][2]>0) $totalrhcrar++;
		}

		else {$ausgabe .= "<td>No</td></tr>\n";}
	}
	//schreibe leerzeilen abhaengig von der anzahl der items
	$offset = calculateHighestItemCount()-count($playeritems);
	for ($i=0;$i<$offset;$i++) $ausgabe .= "<tr><td colspan=\"5\">&nbsp;</td></tr>\n";
	
	$ausgabe .= "<tr><th colspan=\"3\" class=\"bglightyellow\">Gesamtpreis</th><td class=\"alignright\"><b>".number_format($total,0,",",".")."</b></td><td>&nbsp;</td></tr>\n";
	$ausgabe .= "<tr><th colspan=\"3\" class=\"bglightorange\">Gesamtpreis (RHC)</th><td class=\"alignright\"><b>".number_format($totalrhc,0,",",".")."</b></td><td>&nbsp;</td></tr>\n";
	$ausgabe .= "<tr><th colspan=\"4\" class=\"bglightyellow\">Anzahl ungew. & selten (RHC bekannt)</th><td style =\"text-align: center;\"><b>".$totalrhcrar."</b></td></tr>\n";
	$ausgabe .= "</table>\n";

	return $ausgabe;

}














?>