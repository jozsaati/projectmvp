<?php session_start(); ?>
<!DOCTYPE html><html><head>
<meta charset='UTF-8'>
<link rel='stylesheet' href='style.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head><body>
<nav class='navbar navbar-dark bg-dark px-3'>
<a class='navbar-brand' href='index.php'>Hiba bejelentő</a>
<?php if(isset($_SESSION['admin'])): ?>
<a href='admin.php' class='btn btn-warning'>Admin panel</a>
<a href='logout.php' class='btn btn-danger ms-2'>Kijelentkezés</a>
<?php else: ?>
<a href='login.php' class='btn btn-success'>Admin belépés</a>
<?php endif; ?>
</nav>
