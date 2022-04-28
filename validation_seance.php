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
$dbuser = 'root';
$dbpass = '';
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
  echo"<a href='valider_seance.php'>Retour à la selection</a>";
}
else{
  $idseance = $_POST['menuchoixseance'];
  $request1 = mysqli_query($connect,"SELECT * FROM seances WHERE idseance=$idseance");
  $nombre_participants = mysqli_fetch_array($request1);
  $nombre_participants= $nombre_participants['nb_inscrits'];


  $request2 = mysqli_query($connect,"SELECT * FROM inscription WHERE idseance=$idseance");

  while($response = mysqli_fetch_array($request2)) {

          $ideleve = $response['ideleve'];
          $result_nom = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve=$ideleve");
          $tab = mysqli_fetch_array($result_nom);
          $nom= $tab['nom'];
          $prenom = $tab['prenom'];

          echo "<form method='POST' action='verification_seance.php'>";
          echo "<p>".$nom." ".$prenom;
          $note = mysqli_query($connect,"SELECT note FROM inscription WHERE idseance=$idseance");
          $tab2 = mysqli_fetch_array($note);
          $note= $tab2['note'];

          if($note == -1){
            echo " note à saisir : </p>";
            echo "<input type='number' min='0' max='40' name=''>";
          }
          else{
            echo " note actuelle : ".$note."</p>";

          }

  }

}



?>

</body>
</html>
