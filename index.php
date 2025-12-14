<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <title>Iskolai Eszköz Hibabejelentő</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <header class="header">
    <a class="brand" href="index.php">Iskolai Hibabejelentő</a>
    <div class="actions">
      <?php if(isset($_SESSION['admin']) && $_SESSION['admin']===true): ?>
        <a class="btn-ghost" href="admin.php">Admin panel</a>
        <a class="btn" href="logout.php">Kijelentkezés</a>
      <?php else: ?>
        <a class="btn" href="login.php">Admin mód</a>
      <?php endif; ?>
    </div>
  </header>

  <main class="container">
    <section class="card">
      <h3>Új hibajelentés</h3>
      <form action="actions.php" method="post">
        <input type="hidden" name="action" value="add">
        <div class="form-grid">
          <div>
            <label class="small">Név (opcionális)</label>
            <input class="input" name="nev" placeholder="Pl. Kovács tanár">
          </div>
          <div>
            <label class="small">Eszköz</label>
            <input class="input" name="eszkoz" required placeholder="Pl. Projektor">
          </div>
        </div>
        <label class="small">Hiba leírása</label>
        <textarea name="leiras" required></textarea>
        <div style="margin-top:8px;">
          <button class="btn" type="submit">Bejelentés küldése</button>
        </div>
      </form>
    </section>

    <section class="card">
      <h3>Bejelentések</h3>
<?php
$res = $mysqli->query("SELECT * FROM hibak ORDER BY id DESC");
while ($row = $res->fetch_assoc()):
  $status = $row['status'];
  $cls = ($status==='uj') ? 's-uj' : (($status==='folyamatban') ? 's-folyamatban' : 's-befejezve');
?>
  <div class="report">
    <strong><?php echo htmlspecialchars($row['eszkoz']); ?></strong>
    <div class="meta">
      <span class="small"><?php echo htmlspecialchars($row['nev']); ?></span>
      <span class="small"><?php echo htmlspecialchars($row['created_at']); ?></span>
      <span style="margin-left:auto;" class="status <?php echo $cls; ?>"><?php echo htmlspecialchars($status); ?></span>
    </div>
    <p style="margin-top:10px;"><?php echo nl2br(htmlspecialchars($row['leiras'])); ?></p>

    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']===true): ?>
      <div class="controls">
        <form method="post" action="actions.php" style="display:inline;">
          <input type="hidden" name="action" value="status">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <select name="status" class="input">
            <option value="uj" <?php if($status=='uj') echo 'selected'; ?>>Új</option>
            <option value="folyamatban" <?php if($status=='folyamatban') echo 'selected'; ?>>Folyamatban</option>
            <option value="befejezve" <?php if($status=='befejezve') echo 'selected'; ?>>Befejezve</option>
          </select>
          <button class="btn" type="submit">Mentés</button>
        </form>

        <form method="post" action="actions.php" style="display:inline;">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <button class="btn" type="submit" style="background:#ff3b30;">Törlés</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
<?php endwhile; ?>
    </section>

    <p class="footer-note"></p>
  </main>
</body>
</html>
