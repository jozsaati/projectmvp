<?php include 'header.php'; ?>
<div class='container mt-5'>
<h2>Hibabejelentés</h2>
<form action='add_report.php' method='POST'>
<input name='nev' class='form-control mb-2' placeholder='Név' required>
<input name='eszkoz' class='form-control mb-2' placeholder='Eszköz' required>
<input name='hiba' class='form-control mb-2' placeholder='Hiba leírása' required>
<button class='btn btn-primary mt-2'>Küldés</button>
</form>
<?php include 'list_reports.php'; ?>
</div>
<?php include 'footer.php'; ?>
