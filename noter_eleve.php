<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="title">Valider une séance</h1>

<?php

$dbhost = 'tuxa.sme.utc/pma/';
$dbuser = 'nf92p018';
$dbpass = 'vE5DSom3';
$dbname = 'nf92p018';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
mysqli_set_charset($connect, 'utf8');
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");

$idseance = $_POST['idseance'];

$request1 = mysqli_query($connect,"SELECT * FROM inscription
  INNER JOIN eleves ON eleves.ideleve = inscription.ideleve
  INNER JOIN seances ON seances.idseance = inscription.idseance
  WHERE seances.idseance=$idseance;");

$tab = mysqli_fetch_array($request1);
$nombre_participants= $tab['nb_inscrits'];

$val = 0;
echo "<h1>Récapitulatif de la saisie :</h1>";
while($val<=($nombre_participants-1)){
  $val++;
  $name = "ideleve".$val;
  $ideleve = $_POST[$name];
  //on récupère les données du formulaire avec cette astuce d'assigner un nom qui dépend du nombre de valeur envoyés, on a juste besoin de savoir le nombre de valeurs envoyés
  $prenom = $tab['prenom'];
  $nom = $tab['nom'];
  $note=$_POST[$val];
  $tab = mysqli_fetch_array($request1); // on fait bouger le curseur de ligne pour afficher correctement les noms

  if(isset($_POST[$val]) and !is_numeric($_POST[$val])){
    echo "<p>".$nom." ".$prenom;
    echo ": pas de note rentrée </p><br>";
  }

  else{

    if($note<0 or $note>40){
      echo "<p>Valeur rentrée non valide, veuillez rentrer une valeur entre 0 et 40</p><br>";
      echo "<a href='valider_seance.php>Retour</a>'";
    }
    else{
      $newnote = 40 - $note;
      $request_note = mysqli_query($connect, "UPDATE inscription SET note = '$newnote' WHERE ideleve='$ideleve'");
      echo "<p>".$nom." ".$prenom." : la note '".$newnote."/40' a bien été enregistrée</p><br>";
    }
  }

}
echo "<a href='bienvenue.html'>Accueil</a><br>";
echo "<a href='validation_seance.php>Valider une autre séance</a>'";


mysqli_close($connect);
?>

</body>
</html>
