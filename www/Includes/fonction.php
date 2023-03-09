<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');

function modifier($id)
{
   include "mdb.php";
   $sql = "SELECT * FROM mot WHERE mot_id = $id";
   if(!empty(mysqli_query($conn, $sql)))
   {
      $result = mysqli_query($conn, $sql);
      while($l = mysqli_fetch_assoc($result))
      {
      $lien = "ajouter.php?submit=Modifier&id=".$id;
      ?>
      
     <fieldset>
     <legend class='tit'>Ajouter des mots</legend>
         <form action="<?=$lien?>" method="post">
         	   <?php 
         	   Error($_GET);
         	   Res($_GET);
         	    ?>
 	   <label for="mot">Mot :</label>
 	   <input name="mot" type="text" style="width: 30%;" required value="<?=$l['mot_mot']?>">
 	   <label for="trad">Traduction :</label>
 	   <input name="trad" type="text" style="width: 30%;" required value="<?=$l['mot_traduction']?>"><br>
 	   <p><i>Ajouter une description (ce n'est pas obigatoire).</i></p>
 	   <label for="details">Détails</label><br>
 	   <?php
 	   echo '<textarea name="details" id="my-textarea" placeholder="Détails ici... (avec les codes html)" style="width: 99%; font-size: 18px; height: 10vmax;">'.htmlspecialchars($l['mot_detail']).'</textarea>';
 	   ?>
 	   <div id='output'></div>
 	   <?php TableHtml(); ?>
 	   <input type='submit' value='Modifier' style="width:100%;">
	</form>
</fieldset>

<script>
  const textarea = document.getElementById('my-textarea');
  const output = document.getElementById('output');

  textarea.addEventListener('input', function() {
    output.innerHTML = textarea.value;
  });
</script>

<?php
      }
   }
}



function Error($val)
{
   if(isset($val) && !empty($val))
   {
      if(!empty($val['err']))
      {
       if($val['err'] == 'insertion')
       {
          echo "<p><span class='error'>Il manque un élément.</span></p>";
       }
       elseif($val['err'] == 'vide')
       {
          echo "<p><span class='error'>Erreur BD.</span></p>";
       }
      }
   }
}

function Res($val)
{
   if(!empty($val['re']))
   {
      if(isset($val) && !empty($val))
      {
          if($val['re'] == 'bd')
          {
              echo "<p style='margin-bottom: 10px;'><span class='done'>Ajout réussit !</span></p>";
          }
          else if($val['re'] == 'bdmodif')
          {
              echo "<p style='margin-bottom: 10px;'><span class='done'>Modification réussie !</span></p>";
          }
      }
   }
}


function TableHtml()
{
  ?>
  
  <table style="width: 100%;">
    <thead>
      <tr>
        <th>Commande</th>
        <th>Résultat</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>&ltspan class=&quotr&quot&gt...&lt;/span&gt
        <td>Met le texte en rouge</td>
      </tr>
      <tr>
        <td>&ltspan class=&quotb&quot&gt...&lt;/span&gt
        <td>Met le texte en bleu</td>
      </tr>
      <tr>
        <td>&ltspan class=&quotg&quot&gt...&lt;/span&gt
        <td>Met le texte en vert</td>
      </tr>
      <tr>
        <td>&ltspan class=&quotn&quot&gt...&lt;/span&gt
        <td>Pour mettre une note</td>
      </tr>
      <tr>
        <td>&ltstrike&gt...&lt;/strike&gt
        <td>Pour barrer</td>
      </tr>
      <tr>
        <td>&ltbr&gt&ltbr&gt
        <td>Pour sauter une ligne</td>
      </tr>
    </tbody>
  </table>
  
  <?php
}

function Afficher($val)
{
  if(isset($val) && !empty($val))
  {
     if($val['langue'] == 'russe')
     {
        AfficherR();
     }
     if($val['langue'] == 'anglais')
     {
        AfficherA();
     }
  }
}



function AfficherA()
{
   include "mdb.php";
   $sql = "SELECT * FROM mot WHERE langue='anglais' ORDER BY mot_date DESC";
   if(!empty(mysqli_query($conn, $sql)))
   {
      $result = mysqli_query($conn, $sql);
      while($l = mysqli_fetch_assoc($result))
      {
          echo "<tr style='font-size: 25px;'>";
          echo "<td><b>".$l['mot_mot']."</b></td>";
          echo "<td><b>".$l['mot_traduction']."</b></td>";
          echo "<td>".$l['mot_detail']."</td>";
          echo "<td><a href='action.php?type=modif&id=".$l['mot_id']."' class='modif' title='modifier'>oo</a><a href='action.php?type=suppr&id=".$l['mot_id']."' class='supr' title='supprimer'>oo</a></td>";
          echo "</tr>";
      }
   }
}

function AfficherR()
{
   include "mdb.php";
   $sql = "SELECT * FROM mot WHERE langue='russe' ORDER BY mot_date DESC";
   if(!empty(mysqli_query($conn, $sql)))
   {
      $result = mysqli_query($conn, $sql);
      while($l = mysqli_fetch_assoc($result))
      {
          echo "<tr style='font-size: 25px;'>";
          echo "<td><b>".$l['mot_mot']."</b></td>";
          echo "<td><b>".$l['mot_traduction']."</b></td>";
          echo "<td>".$l['mot_detail']."</td>";
          echo "<td><a href='action.php?type=modif&id=".$l['mot_id']."' class='modif' title='modifier'>oo</a><a href='action.php?type=suppr&id=".$l['mot_id']."' class='supr' title='supprimer'>oo</a></td>";
          echo "</tr>";
      }
   }
}

function Maxmot()
{
   include "mdb.php";
   $sql = "SELECT COUNT(mot_id) as count FROM mot";
   $result = mysqli_query($conn, $sql);
   $result = mysqli_fetch_array($result);
   echo "<b><span class='r'>".$result['count']."</span></b>";
}

function Afficher2($lim,$select,$lang, $date)
{

   include "mdb.php";
   if(empty($lim))
   {
      if($date == '1')
      {
         $sql = "SELECT * FROM (SELECT * FROM mot WHERE langue='$lang' ORDER BY mot_id ASC) AS recent_records ORDER BY RAND()";
      }
      elseif($date =='2')
      {
          $sql = "SELECT * FROM (
           SELECT * FROM mot WHERE langue='$lang' ORDER BY mot_id DESC) AS recent_records ORDER BY RAND()";
      }
      else
      {
         $sql = "SELECT * FROM mot WHERE langue='$lang' ORDER BY RAND()";
      }
      
   }
   else
   {
      
      if($date == '1')
      {
         $sql = "SELECT * FROM (
           SELECT * FROM mot WHERE langue='$lang' ORDER BY mot_id ASC LIMIT $lim) AS recent_records ORDER BY RAND()";
      }
      elseif($date =='2')
      {
         $sql = "SELECT * FROM (
           SELECT * FROM mot WHERE langue='$lang' ORDER BY mot_id DESC LIMIT $lim) AS recent_records ORDER BY RAND()";
      }
      else
      {
         $sql = "SELECT * FROM mot WHERE langue='$lang' ORDER BY RAND() LIMIT $lim";
      }
   }
   
   
   if(!empty(mysqli_query($conn, $sql)))
   {
      $result = mysqli_query($conn, $sql);
      
      if($select == 1)
      {
         while($l = mysqli_fetch_assoc($result))
         {
             echo "<tr>";
             echo "<td>".$l['mot_id']."</td>";
             echo "<td>".$l['mot_mot']."</td>";
             echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_traduction']."</td>";
             echo "<td>".$l['mot_detail']."</td>";
             echo "</tr>";
         }
      }
      
      elseif($select == 5)
      {
         while($l = mysqli_fetch_assoc($result))
         {
             echo "<tr>";
             echo "<td>".$l['mot_id']."</td>";
             echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_mot']."</td>";
             echo "<td>".$l['mot_traduction']."</td>";
             echo "<td>".$l['mot_detail']."</td>";
             echo "</tr>";
         }
      }
      
      elseif($select == 2)
      {
         while($l = mysqli_fetch_assoc($result))
         {
             echo "<tr>";
             echo "<td>".$l['mot_id']."</td>";
             echo "<td>".$l['mot_mot']."</td>";
             echo "<td>".$l['mot_traduction']."</td>";
             echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_detail']."</td>";
             echo "</tr>";
         }
      }
      elseif($select == 3)
      {
         while($l = mysqli_fetch_assoc($result))
         {
             echo "<tr>";
             echo "<td>".$l['mot_id']."</td>";
             echo "<td>".$l['mot_mot']."</td>";
             echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_traduction']."</td>";
             echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_detail']."</td>";
             echo "</tr>";
         }
      }
      elseif($select == 4 || $select == 0)
      {
         while($l = mysqli_fetch_assoc($result))
         {
             echo "<tr>";
             echo "<td>".$l['mot_id']."</td>";
             
             $val = array(mt_rand(0,1), mt_rand(0,1), mt_rand(0,1));
             $cond = array_sum($val);
             
             if($val[0]==1 || $cond == 0)
             {
                echo "<td>".$l['mot_mot']."</td>";
             }
             else
             {
                echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_mot']."</td>";
             }
             
             if($val[1]==1)
             {
                echo "<td>".$l['mot_traduction']."</td>";
             }
             else
             {
                echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_traduction']."</td>";
             }
             
             if($val[2]==1)
             {
                echo "<td>".$l['mot_detail']."</td>";
             }
             else
             {
                echo "<td class='devoil' style='background-color: rgba(255, 126, 0, 0.5);'>".$l['mot_detail']."</td>";
             }
             

             echo "</tr>";
         }
      }

   }
}

?>
