<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

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
$aujourdhui = date("Y-m-d");

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

$result1 = mysqli_query($connect, "SELECT * FROM seances WHERE idtheme ='$idtheme' AND DateSeance='$selected_date' AND supprime=1");
$result2 = mysqli_query($connect, "SELECT * FROM seances WHERE idtheme ='$idtheme' AND DateSeance='$selected_date' AND supprime=0");
if(mysqli_num_rows($result1) !=0 ){
    $request = mysqli_query($connect, "UPDATE seances SET supprime=0 WHERE idtheme ='$idtheme' AND Date Seance='$selected_date' AND supprime=1");
    echo "<p>La séance à bien était remise à jour</p>";
}
elseif (mysqli_num_rows($result2) != 0 ) {

  $nomtheme = mysqli_query($connect, "SELECT nom FROM theme WHERE idtheme ='$idtheme' AND supprime = 0");
  $nom = mysqli_fetch_array($nomtheme);
  $nom= $nom['nom'];

  echo "<p>La séance prévue le ".$selected_date."sur les ".$nom." existe déjà, que voulez vous faire ?</p>";
  echo "<form method='POST' action='verification_seance.php'>";
  echo "<input type='hidden' name='date' value ='".$selected_date."'>";
  echo "<input type='hidden' name='idtheme' value ='".$idtheme."'>";
  echo "<input type='hidden' name='effectif' value ='".$effectif."'>";
  echo "<label for='valider1'> Valider l'ajout</label>";
  echo "<input type='radio' name='valider' id='valider1' selected value='1'><br><br>";
  echo "<label for='valider2'> Annuler l'ajout</label>";
  echo "<input type='radio' name='valider' id='valider2' value='2'><br><br>";
  echo "<input type='submit' value='Valider'>";
  echo "<input type='reset'>";
}
else{
      $query = "INSERT INTO seances VALUES (NULL,"."'$selected_date'".","."'$effectif'".","."'$idtheme'".","."'0'".","."'0'".")";
      $result = mysqli_query($connect, $query);
      echo "<p> Votre séance a bien été enregistrée </p>";
      echo "<a href=ajout_seance.php> Retour </a>";
}


?>

</body>
</html>
