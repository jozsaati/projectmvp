<?php
include 'db.php';
$res=$conn->query("SELECT * FROM hibak");
echo "<table class='table mt-4'><tr><th>Név</th><th>Eszköz</th><th>Hiba</th><th>Státusz</th><th></th></tr>";
while($r=$res->fetch_assoc()){
echo "<tr>
<td>{$r['nev']}</td>
<td>{$r['eszkoz']}</td>
<td>{$r['hiba']}</td>
<td>{$r['status']}</td>";
if(isset($_SESSION['admin'])){
echo "<td>
<a href='update_status.php?id={$r['id']}' class='btn btn-sm btn-warning'>Váltás</a>
<a href='delete.php?id={$r['id']}' class='btn btn-sm btn-danger'>Törlés</a>
</td>";
}
echo "</tr>";
}
echo "</table>";
?>