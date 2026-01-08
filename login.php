<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  if (isset($_POST['pw']) && $_POST['pw'] === 'admin123') {
    $_SESSION['admin'] = true;
    header('Location: admin.php');
    exit;
  } else {
    $error = 'Hibás jelszó.';
  }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <title>Admin belépés</title>

  <!-- Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="index.php">Iskolai Hibabejelentő</a>
  </div>
</nav>

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
  <div class="card shadow-sm w-100" style="max-width:400px;">
    <div class="card-body p-4">
      <h4 class="mb-3 text-center">Admin belépés</h4>

      <?php if($error): ?>
        <div class="alert alert-danger py-2"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label small">Jelszó</label>
          <input type="password" name="pw" class="form-control" required>
        </div>

        <button class="btn btn-dark w-100">Belépés</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
