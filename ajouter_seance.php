<?php

$dbhost = 'localhost:3307';
$dbuser = 'root'; // remplacer les sxxx avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = ''; // remplacer votremotdepasse par votre mot de passe
$dbname = 'nf92p018'; // remplacer les sxxx comme indiqué ci-desus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8

// récupération de la date du jour mise dans $aujourdhui
date_default_timezone_set('europe/paris');
$aujourdhui = date("y-m-d");

//vérification que les champs soient bien remplis par l'utilisateur
if(empty($_POST['date_inscription']) or empty($_POST['menuchoixtheme']) or empty($_POST['effectif'])){
  echo "<p>Veuillez remplir tous les champs</p>";
  echo "<a href=ajout_seance.php> Retour </a>";
  exit();
}

$selected_date=$_POST['date_inscription'];
$idtheme=$_POST['menuchoixtheme'];
$effectif=$_POST['effectif'];

if($selected_date < $aujourdhui){
  echo"<p>Vous ne pouvez pas rentrer une date inférieure à aujourd'hui</p>";
  echo "<a href=ajout_seance.php> Retour </a>";
  exit();
}

$query2 = "SELECT * FROM seances WHERE idtheme ='$idtheme'";
$result2 = mysqli_query($connect, $query2);
$response2=mysqli_fetch_array($result2);
  if($response2['DateSeance']==$selected_date){
    echo "<p>La séance existe déjà</p>";
    echo "<a href=ajout_seance.php> Retour </a>";
  }
  else{
      $query = "INSERT INTO seances VALUES (NULL,"."'$selected_date'".","."'$effectif'".","."'$idtheme'".","."'0'".")";
      $result = mysqli_query($connect, $query);
      echo "<p> Votre séance a bien été enregistrée </p>";
      echo "<a href=ajout_seance.php> Retour </a>";
  }


?>
