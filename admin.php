<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin']!==true) {
  header('Location: login.php');
  exit;
}
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Hibak kezelese</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="header">
    <a class="brand" href="index.php">Iskolai Hibabejelentő</a>
    <div class="actions">
      <a class="btn-ghost" href="index.php">Vissza</a>
      <a class="btn" href="logout.php">Kijelentkezés</a>
    </div>
  </div>

  <main class="container">
    <div class="card">
      <h3>Bejelentések kezelése</h3>
      <?php
      $res = $mysqli->query("SELECT * FROM hibak ORDER BY id DESC");
      while ($row = $res->fetch_assoc()) {
        $status = $row['status'];
        $cls = ($status==='uj') ? 's-uj' : (($status==='folyamatban') ? 's-folyamatban' : 's-befejezve');
        echo "<div class='report'>";
        echo "<strong>".htmlspecialchars($row['eszkoz'])."</strong>";
        echo "<div class='meta'><span class='small'>".htmlspecialchars($row['nev'])."</span><span style='margin-left:auto;' class='status $cls'>".htmlspecialchars($status)."</span></div>";
        echo "<p style='margin-top:10px;'>".nl2br(htmlspecialchars($row['leiras']))."</p>";
        echo "<div class='controls'>";
        echo "<form method='post' action='actions.php' style='display:inline;'><input type='hidden' name='action' value='status'><input type='hidden' name='id' value='".$row['id']."'><select name='status' class='input'><option value='uj'".($status=='uj'?' selected':'').">Új</option><option value='folyamatban'".($status=='folyamatban'?' selected':'').">Folyamatban</option><option value='befejezve'".($status=='befejezve'?' selected':'').">Befejezve</option></select><button class='btn' type='submit'>Mentés</button></form>";
        echo "<form method='post' action='actions.php' style='display:inline;margin-left:8px;'><input type='hidden' name='action' value='delete'><input type='hidden' name='id' value='".$row['id']."'><button class='btn' type='submit' style='background:#ff3b30;'>Törlés</button></form>";
        echo "</div></div>";
      }
      ?>
    </div>
  </main>
</body>
</html>
