<?php
require "db.php";

if ($mysqli) {
    echo "OK – adatbázis kapcsolat él";
} else {
    echo "HIBA – nincs kapcsolat";
}
