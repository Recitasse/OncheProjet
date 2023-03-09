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
  <h1>Langue</h1>
</div>
<div class='principal'>
<fieldset>
     <legend class='tit'>Ajouter des mots</legend>
         <form action="ajouter.php?submit=Ajouter" method="post">
         	   <?php 
         	   Error($_GET);
         	   Res($_GET);
         	    ?>
 	   <label for="mot">Mot :</label>
 	   <input name="mot" type="text" style="width: 20%;" required>
 	   <label for="trad">Traduction :</label>
 	   <input name="trad" type="text" style="width: 20%;" required>
	     <label for="langue">langue : </label>
	     <select id="select-option" name="langue">
	        <option value="anglais">--Sélectionner--</option>
	        <option value="anglais">Anglais</option>
	        <option value="russe">Russe</option>
	     </select>
 	   <p><i>Ajouter une description (ce n'est pas obigatoire).</i></p>
 	   <label for="details">Détails</label><br>
 	   <textarea name="details" id="my-textarea" placeholder="Détails ici... (avec les codes html)" style="width: 99%; font-size: 18px; height: 10vmax;"></textarea>
 	   <div id='output'></div>
 	   <?php TableHtml(); ?>
 	   <input type='submit' value='Ajouter' style="width:100%;">
	</form>
</fieldset>
</div>

<div class='principal'>
<div class="anglais">
<h3 onclick=""><a href="vocabulaire.php?langue=anglais" target="_blank">(Anglais) Ouvrir dans un autre onglet</a></h3>
<button onclick="afficheA()" class='bouton'>Afficher le contenu vocabulaire</button>
<fieldset id='vocA' style="display: none;">
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
     <?php AfficherA(); ?>
     </tbody>
     </table>
</fieldset>
</div>
<br>
<div class="russe">
<h3 onclick=""><a href="vocabulaire.php?langue=russe" target="_blank">(Russe) Ouvrir dans un autre onglet</a></h3>
<button onclick="afficheR()" class='bouton'>Afficher le contenu vocabulaire</button>
<fieldset id='vocR' style="display: none;">
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
     <?php AfficherR(); ?>
     </tbody>
     </table>
     
</fieldset>
</div>
</div>


<div class='principal'>
<fieldset>
     <legend class='tit'>Interrogation</legend>
<h3 onclick=""><a href="interro.php" target="_blank">Ouvrir dans un autre onglet</a></h3>
</fieldset>
</div>


</body>
</html>

<script>
  const textarea = document.getElementById('my-textarea');
  const output = document.getElementById('output');

  textarea.addEventListener('input', function() {
    output.innerHTML = textarea.value;
  });
</script>


