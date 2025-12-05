<?php include 'header.php'; ?>
<div class='container mt-5'>
<h3>Admin belépés</h3>
<form action='login_check.php' method='POST'>
<input type='password' name='pw' class='form-control mb-2' placeholder='Jelszó'>
<button class='btn btn-primary'>Belépés</button>
</form>
</div>
<?php include 'footer.php'; ?>
