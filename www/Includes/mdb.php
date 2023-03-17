<?php
$conn = new mysqli('localhost', 'langue', 'blondinChad1#', 'langue_anglais');

if (mysqli_connect_error()) {
    die("Connexion échouée: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

?>


