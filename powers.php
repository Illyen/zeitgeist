<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = "Zeitgeist - Powers";
require 'head.php';
require_once 'generatePowerTables.php';
?>
<body>
<div id="textblock">
<?php

echo "\n<!-- Start des automatisch generierten Inhalts -->\n";
$players = array('Thomas', 'Fabian');

foreach ($players as $playername) {
	echo generatePlayerPowerTable($playername);
}
echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</div>
</body>
</html>