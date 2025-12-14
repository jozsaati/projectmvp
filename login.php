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
<html>
<head>
  <meta charset="utf-8">
  <title>Admin belépés</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="header">
    <a class="brand" href="index.php">Iskolai Hibabejelentő</a>
  </div>

  <main class="container">
    <div class="card">
      <h3>Admin belépés</h3>
      <form method="post">
        <label class="small">Jelszó</label>
        <input class="input" type="password" name="pw" required>
        <div style="margin-top:10px;">
          <button class="btn" type="submit">Belépés</button>
        </div>
      </form>
      <p style="color:#b00020;"><?php echo $error; ?></p>
    </div>
  </main>
</body>
</html>
