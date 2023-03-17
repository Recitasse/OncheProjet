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
  <link rel="icon" href="Images/anglais.ico"/>
</head>
<body>
<div class='principal'>
   <?php
     if(isset($_GET) && !empty($_GET))
     {
        if(!empty($_GET['type']))
        {
           if($_GET['type'] == 'modif')
           {
              modifier($_GET['id']);
           }
        }
     }
   ?>
   
</div>
</body>
</html>

