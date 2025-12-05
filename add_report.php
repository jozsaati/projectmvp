<?php
include 'db.php';
$stmt=$conn->prepare("INSERT INTO hibak (nev, eszkoz, hiba, status) VALUES (?, ?, ?, 'Folyamatban')");
$stmt->bind_param("sss", $_POST['nev'], $_POST['eszkoz'], $_POST['hiba']);
$stmt->execute();
header('Location: index.php');
?>