<?php
include 'db.php';
$conn->query("DELETE FROM hibak WHERE id=".$_GET['id']);
header('Location: index.php');
?>