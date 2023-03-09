<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "Includes/mdb.php";
include "Includes/fonction.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Langue</title>
  <link rel="stylesheet" href="style.css">
  <script src='script.js'></script>
  <link rel="icon" href="Images/.ico"/>
</head>

<body>
<div class='principal'>
<fieldset id='voc'>
     <legend class='tit'>Les mots</legend>
     <table style="width: 99%;">
     <thead>
     <tr>
        <th>Mot</th>
        <th>Traduction</th>
        <th>Détails</th>
        <th>Action</th>
     </tr>
     </thead>
     <tbody>
     <?php Afficher($_GET); ?>
     </tbody>
     </table>
     
</fieldset>
</div>
</body>
</html>
