<?php
$string = "one|two|three";
$values = explode("|", $string);

echo $string;
echo "<br>";
echo $values[0];
echo "<br>";
echo $values[1];
echo "<br>";
echo $values[2];

echo "<br>";
echo ($_GET['ok']) ? "TRUE" : "FALSE";
?>