
<!DOCTYPE html>
<html lang="de">
<?php
$pageTitle = "Zeitgeist - PowersTest";
require 'head.php';
require 'mysqlbackend.php'
?>
<body>
<?php

echo "\n<!-- Start des automatisch generierten Inhalts -->\n";

$r = addUser("Fabian");
echo $r;

echo "\n<!-- Ende des automatisch generierten Inhalts -->\n";

 ?>
</body>
</html>

