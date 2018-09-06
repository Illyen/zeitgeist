<?php

//SQL Daten
$servername = "localhost";
$username 	= "lhmh_zeitgeist";
$password	= "55qaqNLGWYLG5AMk";

//open SQL Connection
$conn = new mysqli($servername, $username, $password);

function generatePlayerTable($playername) {

	$ausgabe  = "<table class=\"playertable\">\n";
	$ausgabe .= "<tr><td class=\"playername\" colspan=\"5\">".$playername."</td></tr>";
	$ausgabe .= "<tr class=\"bglightyellow\"><td colspan=\"2\">Name</td><td style=\"width:20px;\">L.</td><td class=\"aligncenter\">&#9684;</td><td class=\"aligncenter\">#</td></tr>";
//add powers, one per line

//end table
	$ausgabe .= "</table>";

	return $ausgabe;


}

//close SQL Connection
$conn->close();
?>