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
include 'text.txt';

echo "\n<!-- Start des automatisch generierten Inhalts -->\n";
foreach ($players as $playername => $itemtable) {
	echo generatePlayerTable($playername);
}
}
echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</div>
</body>
</html>