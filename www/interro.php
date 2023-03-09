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
<fieldset>
     <legend class='tit'>Paramétrage</legend>
     <form action="interro.php" method="get">
     <label for="nombre">Choisissez le nombre de mot: </label>
     <input type="text" name="nombre" style="width: 20%;">
     <label for="Date">Type date : </label>
     <select id="select-option" name="Date">
        <option value="1">--Sélectionner--</option>
        <option value="1">Plus ancien</option>
        <option value="2">Plus récent</option>
        <option value="3">Indifférent</option>
     </select>
     <p><i>Le nombre max est de <?php Maxmot(); ?>. Ne rien mettre affiche tout les mots.</i> </p>

     <label for="selection">Choisissez le type d'interrogation : </label>
     <select id="select-option" name="selection">
        <option value="0">--Sélectionner--</option>
        <option value="1">Traduction FR->ANG</option>
        <option value="5">Traduction ANG->FR</option>
        <option value="2">Détails</option>
        <option value="3">Traduction et détails</option>
        <option value="4">Général</option>
     </select>
     
     <label for="lang-selection">Langue</label>
     <select id="select-option" name="lang-selection">
        <option value="anglais">--Sélectionner--</option>
        <option value="anglais">Anglais</option>
        <option value="russe">Russe</option>
     </select>
     <input type='submit' value='Générer' style="width:100%;">
     </form>
</fieldset>

<fieldset>
     <legend class='tit'>Les mots</legend>
     <table style="width: 99%;">
     <thead>
     <tr>
        <th>Numéro / <?= Maxmot();?></th>
        <th>Mot</th>
        <th>Traduction</th>
        <th>Détails</th>
     </tr>
     </thead>
     <tbody>
	<?php
	   if(isset($_GET) && !empty($_GET))
	   {
	      Afficher2($_GET['nombre'],$_GET['selection'],$_GET['lang-selection'], $_GET['Date']);
	   }
	?>
     </tbody>
     </table>
     
</fieldset>

</div>
</body>

<footer>
 <button onclick="removeTransparent()">Afficher les corrections</button>
</footer>

</html>


<script>
  var act = 1;
  function removeTransparent() {
  const elementsd = document.querySelectorAll('.devoil');
  const elementsv = document.querySelectorAll('.visible');
  if(act == 1)
  {
    elementsd.forEach(function(element) 
    {
        element.classList.replace('devoil','visible');
    });
    act = 0;
  }
  else
  {
    elementsv.forEach(function(element) 
    {
        element.classList.replace('visible','devoil');
    });
    act = 1;
  }


  }
</script>
