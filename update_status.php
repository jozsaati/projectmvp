<?php
include 'db.php';
$id=$_GET['id'];
$conn->query("UPDATE hibak SET status = IF(status='Folyamatban','Befejezve','Folyamatban') WHERE id=$id");
header('Location: index.php');
?>