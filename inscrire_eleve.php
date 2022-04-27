<?php

$dbhost = 'localhost:3307';
$dbuser = 'root'; // remplacer les sxxx avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = ''; // remplacer votremotdepasse par votre mot de passe
$dbname = 'nf92p018'; // remplacer les sxxx comme indiqué ci-desus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8

//vérification que les champs soient bien remplis par l'utilisateur
if(empty($_POST['menuchoixeleve']) or empty($_POST['effectif'])){
  echo "<p>Veuillez remplir tous les champs</p>";
  echo "<a href=inscription_eleve.php> Retour </a>";
  exit();
}

$eleve = $_POST['menuchoixeleve'];
$note = -1;
$seance = $_POST['seance'];

$query = "INSERT INTO inscription VALUES ("."'$seance'".","."'$eleve'".","."'$note'".")";
$result = mysqli_query($connect, $query);
echo "<p>L'inscription a bien été prise en compte  </p>";
echo "<a href=inscription_eleve.php> Retour </a>";

mysqli_close($connect);

?>
