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

$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92p018';
$dbpass = 'vE5DSom3';
$dbname = 'nf92p018';
/*Les 4 lignes précédentes permettent la connexion à la BDD, on renseigne notre identifiant, mot de passe, nom de notre
bdd et comment y accéder (ici le lien )*/
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
mysqli_set_charset($connect, 'utf8');
// récupération de la date du jour mise dans $aujourdhui
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");



if(empty($_POST['menuchoixseance'])){
  echo"<p>Veuillez à bien selectionner une séance </p>";
  echo "<br><a href='valider_seance.php'><input class='buttonclick'type='button' value='retour'/></a><br>";
  echo "<a href='suppression_theme.php'><input class='buttonclick' type='button' value='Accueil' /></a>";
}
else{
  $idseance = $_POST['menuchoixseance'];
  $request1 = mysqli_query($connect,"SELECT * FROM seances WHERE idseance=$idseance");
  $nombre_participants = mysqli_fetch_array($request1);
  $nombre_participants= $nombre_participants['nb_inscrits'];


  $request = mysqli_query($connect,"SELECT * FROM inscription INNER JOIN eleves WHERE eleves.ideleve = inscription.ideleve AND idseance=$idseance");

  if(mysqli_num_rows($request) == 0){
    echo "<p> Il n'y a pas d'élèves inscrits à cette séance </p>";
    echo "<br><a href='inscription_eleve.php'><input class='buttonclick'type='button' value='inscire un élève'/></a><br>";
    echo "<a href='suppression_theme.php'><input class='buttonclick' type='button' value='Accueil' /></a>";
    exit;
  }

  echo "<form method='POST' action='noter_eleve.php'>";

  $val=0;
  while($response = mysqli_fetch_array($request)) {

          echo "<p>".$response['nom']." ".$response['prenom'];

          $ideleve = $response['ideleve'];

          $note= $response['note'];



          if($note == -1){
            $val++;
            echo " pas encore de note enregistrée. Veuillez renseigner le nombre de fautes : ";
            echo "<input type='number' min='0' max='40' name='".$val."'></p>";
            echo "<input type='hidden' name='ideleve".$val."' value='".$ideleve."'>";
          }
          else{
            $val++;
            echo " note actuelle ".$note."/40.   Veuillez renseigner le nombre de fautes pour mettre à jour : ";
            echo "<input type='number' placeholder='".$note."' min='0' max='40' name='".$val."'></p>";
            echo "<input type='hidden' name='ideleve".$val."' value='".$ideleve."'>";

          }

  }
  echo "<input type='hidden' name='idseance' value='".$idseance."'>";
  echo "<input type='submit' value='Evaluer'>";
  echo "<input type='reset' value='Réinitialiser'>";
  echo "</form>";
}



?>

</body>
</html>
