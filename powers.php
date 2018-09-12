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

echo generatePlayerPowerTable($_GET['user']);

echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</div>
</body>
</html>