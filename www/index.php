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
     <legend class='tit'>Traduction via l'API Glosbe</legend>
     <form method='post'>
     <label for="mot-trad">Mot :</label>
     <input name="mot-trad" type="text" style="width: 20%;" required>
       <label for="langue-trad">langue : </label>
       <select id="select-option-langue" name="langue-trad">
          <option value="eng">--Sélectionner--</option>
          <option value="eng">ANG->FR</option>
          <option value="ru">RU->FR</option>
       </select>
       <input type='submit' value='Traduire' style="width:30%;">
     </form>
     <?php
     if(isset($_POST) && !empty($_POST))
     {
        if(isset($_POST['mot-trad']) && !empty($_POST['mot-trad']))
        {
           echo "<div class='page'>";
           $text = shell_exec('python3 Includes/trad.py '.$_POST['langue-trad'].' '.$_POST['mot-trad'].'');
           echo "</div>";
           $text = preg_replace('/<button.*?>.*?<\/button>/s', '', $text);
           $text = preg_replace('/<app-translate-entry-summary class="">.*?<\/app-translate-entry-summary>/s', '', $text);
           $text = preg_replace('/<div class="translate-entry-header">.*?<\/div>/s', '', $text);
           $text = preg_replace('/<app-translate-entry-translation-info>.*?<\/app-translate-entry-translation-info>/s', '', $text);
           $text = preg_replace('/<app-translate-entry-summary-info>.*?<\/app-translate-entry-summary-info>/s', '', $text);
           $text = preg_replace('/<section class="mat-ripple translate-intermediate gl-box gl-gray-clickable ng-star-inserted" matripple="">.*?<\/section>/s', '', $text);
           $text = preg_replace('/<app-footer.*?<\/app-footer>/s', '', $text);
           $text = preg_replace('/<app-translate-entry-others.*?<\/app-translate-entry-others>/s', '', $text);
           $text = preg_replace('/<section matripple="" class="mat-ripple translate-intermediate gl-box gl-gray-clickable ng-star-inserted">.*?<\/section>/s', '', $text);
           $text = preg_replace('/<section class="translate-gallery translate-divider ng-star-inserted">.*?<\/app-gallery>/s', '', $text);
           $text = preg_replace('/<section class="translate-examples translate-divider ng-star-inserted">.*?<\/section>/s', '', $text);
           $text = preg_replace('/<app-topwords-page-links.*?<\/app-topwords-page-links>/s','',$text);
           $text = preg_replace('/<app-wordlist.*?<\/app-wordlist>/s','',$text);
          
           $text = preg_replace('/<h4[^>]*>/', '<h4 class="trad-fr">', $text);
           $text = str_replace('<!---->','',$text);
           $text = str_replace('translate-container ng-star-inserted','trad-cont',$text);
           
           
           
           
$text = str_replace('<app-translate-entry class="translate-entry">','',$text);
$text = str_replace('</app-translate-entry>','',$text);
$text = str_replace('<app-translate-entry-translation class="ng-star-inserted">','',$text);
$text = str_replace('</app-translate-entry-translation>','',$text);
$text = str_replace('<section class="translate-entry-translation-content">','<section class="case-trad">',$text);
$text = str_replace('<app-translate-entry-translation-definitions class="translate-entry-translation-definitions ng-star-inserted">','<div class="trad-div">',$text);
$text = str_replace('</app-translate-entry-translation-definitions>','</div>',$text);

           echo $text;
           ?>
           <script>
           const nameElements = document.querySelectorAll('h4.trad-fr');
	const names = [];
	nameElements.forEach((nameElement) => {
	  names.push(nameElement.textContent.trim());
	});
           </script>
           <?php

        }
     }
     ?>
</fieldset>

<div class='principal'>
<fieldset>
     <legend class='tit'>Ajouter des mots</legend>
         <form action="ajouter.php?submit=Ajouter" method="post">
         	   <?php 
         	   Error($_GET);
         	   Res($_GET);
         	    ?>
 	   <label for="mot">Mot :</label>
 	   <?php
 	   if(isset($_POST['langue-trad']) && !empty($_POST['langue-trad']))
 	   {
 	     echo '<input name="mot" type="text" style="width: 20%;" required value="'.$_POST['mot-trad'].'">';
 	   }
 	   else
 	   {
	     echo '<input name="mot" type="text" style="width: 20%;" required>';
 	   }
 	   ?>
 	   <label for="trad">Traduction :</label>
 	   <?php
 	   if(isset($_POST['langue-trad']) && !empty($_POST['langue-trad']))
 	   {
 	     echo '<input id="trad" name="trad" type="text" style="width: 20%;" required>';
 	     ?>
 	     <script>
 	       const inputTrad = document.getElementById('trad');
 	       const liste = names.join(', ');
 	       inputTrad.value = liste;
 	     </script>
 	     <?php
 	   }
 	   else
 	   {
	     echo '<input name="trad" type="text" style="width: 20%;" required>';
 	   }
 	   ?>
 	   
	     <label for="langue">langue : </label>
	     <select id="select-option" name="langue">
	     <?php
	     if(isset($_POST['mot-trad']) && !empty($_POST['mot-trad']))
	     {
	       if($_POST['langue-trad'] == 'ru')
	       {
	         $lan = 'russe';
	       }
	       elseif($_POST['langue-trad'] == 'eng')
	       {
	         $lan = 'anglais';
	       }
	     }
	     else
	     {
	       $lan = "anglais";
	     }
	     ?>
	        <option value="<?=$lan?>">--Sélectionner--</option>
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


