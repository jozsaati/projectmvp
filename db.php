<?php
$mysqli = new mysqli("localhost", "root", "", "projectmvp");
if ($mysqli->connect_error) {
    die("Adatbázis hiba: " . $mysqli->connect_error);
}
?>