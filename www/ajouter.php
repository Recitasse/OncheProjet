<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "Includes/mdb.php";
include "Includes/fonction.php";
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST) && !empty($_POST) && isset($_GET) && !empty($_GET))
{
  
  if($_GET['submit'] == 'Ajouter')
   {
   
      echo var_dump($_POST);
      $sql = "INSERT INTO mot (mot_mot, mot_traduction, mot_detail, langue) VALUES (?, ?, ?, ?)";
      
      
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssss", $_POST['mot'], $_POST['trad'], $_POST['details'], $_POST['langue']);
      if(!mysqli_stmt_execute($stmt))
      {
         header('location: index.php?err=vide');
         exit();
      }
      else
      {
        mysqli_stmt_close($stmt);
        header('location: index.php?re=bd');
        exit();
      }

   }
 if($_GET['submit'] == 'Modifier')
 {
      $sql = "UPDATE mot SET mot_mot=?, mot_traduction=?, mot_detail=? WHERE mot_id=?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "sssi", $_POST['mot'], $_POST['trad'], $_POST['details'], $_GET['id']);

      if(!mysqli_stmt_execute($stmt))
      {
         header('location: index.php?err=vide');
         exit();
      }
      else
      {
        mysqli_stmt_close($stmt);
        header('location: index.php?re=bd');
        exit();
      }
 }
}

?>
