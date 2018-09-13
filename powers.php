<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = "Zeitgeist - Powers";
require 'head.php';
require_once 'generatePowerTables.php';
require_once 'mysqlbackend.php';
?>
<body>
<div id="textblock">
<?php

echo "\n<!-- Start des automatisch generierten Inhalts -->\n";

if (!empty($_GET['user'])) {
	generatePlayerPowerTable($_GET['user']);
}
else {
	$userarray = getUsers();
	foreach ($userarray as $user) {
		generatePlayerPowerTable($user);
	}
}

echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</div>
</body>
</html>