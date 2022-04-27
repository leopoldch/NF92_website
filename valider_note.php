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
$eleve = $_POST['eleve'];
$note = $_POST['note'];

$query = "UPDATE  inscription SET note = '$note' WHERE ideleve = '$eleve'";
$result = mysqli_query($connect, $query);
echo "<p>La note a bien été prise en compte  </p>";
echo "<a href=note_eleve.php> Retour </a>";

mysqli_close($connect);


?>
