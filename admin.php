<?php
session_start();

/* Admin védelem */
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit;
}

/* Adatbázis kapcsolat */
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Admin panel – Hibák kezelése</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-light">

<!-- FEJLÉC -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Iskolai Hibabejelentő</a>

        <div class="d-flex">
            <a href="index.php" class="btn btn-outline-light btn-sm me-2">Vissza</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Kijelentkezés</a>
        </div>
    </div>
</nav>

<!-- TARTALOM -->
<div class="container my-4">

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Bejelentett hibák kezelése</h4>

            <?php
            $result = $mysqli->query("SELECT * FROM hibak ORDER BY id DESC");

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $status = $row['status'];

                    $badge = match ($status) {
                        'uj' => 'secondary',
                        'folyamatban' => 'warning',
                        'befejezve' => 'success',
                        default => 'dark'
                    };
            ?>
            <!-- HIBA KÁRTYA -->
            <div class="card mb-3">
                <div class="card-body">

                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($row['eszkoz']); ?></h5>
                        <span class="badge bg-<?php echo $badge; ?> align-self-start align-self-md-center">
                            <?php echo htmlspecialchars($status); ?>
                        </span>
                    </div>

                    <small class="text-muted">
                        <?php echo htmlspecialchars($row['nev']); ?> |
                        <?php echo htmlspecialchars($row['created_at']); ?>
                    </small>

                    <p class="mt-2">
                        <?php echo nl2br(htmlspecialchars($row['leiras'])); ?>
                    </p>

                    <!-- ADMIN MŰVELETEK -->
                    <div class="d-flex flex-column flex-md-row gap-2">

                        <!-- STÁTUSZ -->
                        <form method="post" action="actions.php" class="d-flex gap-2">
                            <input type="hidden" name="action" value="status">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                            <select name="status" class="form-select form-select-sm">
                                <option value="uj" <?php if($status=='uj') echo 'selected'; ?>>Új</option>
                                <option value="folyamatban" <?php if($status=='folyamatban') echo 'selected'; ?>>Folyamatban</option>
                                <option value="befejezve" <?php if($status=='befejezve') echo 'selected'; ?>>Befejezve</option>
                            </select>

                            <button class="btn btn-primary btn-sm">Mentés</button>
                        </form>

                        <!-- TÖRLÉS -->
                        <form method="post" action="actions.php" 
                              onsubmit="return confirm('Biztosan törlöd ezt a hibát?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button class="btn btn-outline-danger btn-sm">Törlés</button>
                        </form>

                    </div>

                </div>
            </div>
            <?php
                endwhile;
            else:
                echo "<p class='text-muted'>Nincs megjeleníthető hibajelentés.</p>";
            endif;
            ?>

        </div>
    </div>

</div>

</body>
</html>
