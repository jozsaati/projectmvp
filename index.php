<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iskolai Eszköz Hibabejelentő</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">📚 Hibabejelentő</a>

    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']===true): ?>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-light btn-sm" href="admin.php">Admin</a>
        <a class="btn btn-danger btn-sm" href="logout.php">Kilépés</a>
      </div>
    <?php else: ?>
      <a class="btn btn-outline-light btn-sm" href="login.php">Admin mód</a>
    <?php endif; ?>
  </div>
</nav>

<div class="container px-2">

<!-- ÚJ HIBA -->
<div class="card shadow-sm mb-3">
  <div class="card-body">
    <h5 class="card-title">Új hibajelentés</h5>

    <form action="actions.php" method="post">
      <input type="hidden" name="action" value="add">

      <div class="mb-2">
        <label class="form-label">Név (opcionális)</label>
        <input type="text" name="nev" class="form-control form-control-lg">
      </div>

      <div class="mb-2">
        <label class="form-label">Eszköz</label>
        <input type="text" name="eszkoz" class="form-control form-control-lg" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Hiba leírása</label>
        <textarea name="leiras" class="form-control form-control-lg" rows="3" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-lg w-100">
        Bejelentés küldése
      </button>
    </form>
  </div>
</div>

<!-- HIBÁK -->
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="card-title">Bejelentések</h5>

<?php
$res = $mysqli->query("SELECT * FROM hibak ORDER BY id DESC");
while ($row = $res->fetch_assoc()):
$status = $row['status'];

$badge = match($status){
  'uj' => 'bg-secondary',
  'folyamatban' => 'bg-warning text-dark',
  'befejezve' => 'bg-success',
  default => 'bg-secondary'
};
?>
  <div class="border rounded p-3 mb-3 bg-white">
    <div class="d-flex flex-column flex-sm-row justify-content-between">
      <strong><?php echo htmlspecialchars($row['eszkoz']); ?></strong>
      <span class="badge <?php echo $badge; ?> align-self-start mt-2 mt-sm-0">
        <?php echo htmlspecialchars($status); ?>
      </span>
    </div>

    <small class="text-muted d-block mt-1">
      <?php echo htmlspecialchars($row['nev']); ?> |
      <?php echo htmlspecialchars($row['created_at']); ?>
    </small>

    <p class="mt-2 fs-6">
      <?php echo nl2br(htmlspecialchars($row['leiras'])); ?>
    </p>

<?php if(isset($_SESSION['admin']) && $_SESSION['admin']===true): ?>
    <div class="d-grid gap-2">
      <form method="post" action="actions.php">
        <input type="hidden" name="action" value="status">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <select name="status" class="form-select form-select-lg mb-2">
          <option value="uj" <?php if($status=='uj') echo 'selected'; ?>>Új</option>
          <option value="folyamatban" <?php if($status=='folyamatban') echo 'selected'; ?>>Folyamatban</option>
          <option value="befejezve" <?php if($status=='befejezve') echo 'selected'; ?>>Befejezve</option>
        </select>
        <button class="btn btn-primary btn-lg w-100">Mentés</button>
      </form>

      <form method="post" action="actions.php">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button class="btn btn-danger btn-lg w-100">Törlés</button>
      </form>
    </div>
<?php endif; ?>

  </div>
<?php endwhile; ?>

  </div>
</div>

</div>
</body>
</html>
