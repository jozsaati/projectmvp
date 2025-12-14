<?php
session_start();
include 'db.php';

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $nev = $_POST['nev'] ?: 'Névtelen';
    $eszkoz = $_POST['eszkoz'] ?? '';
    $leiras = $_POST['leiras'] ?? '';
    $stmt = $mysqli->prepare("INSERT INTO hibak (nev, eszkoz, leiras, status) VALUES (?, ?, ?, 'uj')");
    $stmt->bind_param('sss', $nev, $eszkoz, $leiras);
    $stmt->execute();
    header('Location: index.php');
    exit;
}

if ($action === 'status') {
    if (!isset($_SESSION['admin']) || $_SESSION['admin']!==true) { die('Nincs jogosultság'); }
    $id = (int)$_POST['id'];
    $status = $_POST['status'];
    $stmt = $mysqli->prepare("UPDATE hibak SET status=? WHERE id=?");
    $stmt->bind_param('si', $status, $id);
    $stmt->execute();
    header('Location: admin.php');
    exit;
}

if ($action === 'delete') {
    if (!isset($_SESSION['admin']) || $_SESSION['admin']!==true) { die('Nincs jogosultság'); }
    $id = (int)$_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM hibak WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: admin.php');
    exit;
}

header('Location: index.php');
exit;
?>