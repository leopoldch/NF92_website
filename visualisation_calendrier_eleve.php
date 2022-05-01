<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1>Calendrier élève</h1>

<?php

$dbhost = 'tuxa.sme.utc/pma/';
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

$request = mysqli_query($connect,"SELECT * FROM eleves");
$responseCount=mysqli_num_rows($request);

if( $responseCount == 0){
  echo"<p>Il faut avoir au moins un élève pour visualiser son calendrier </p> ";
  echo "<a href='ajout_eleve.html' target='contenu'> Ajout d'un élève <a><br>";
  echo "<a href='bienvenue.html' target='contenu'> Accueil <a>";
}

else{
  echo "<form method='POST' action='visualiser_calendrier_eleve.php'>";
  echo "<fieldset>";

  echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour voir leur calendrier  </label><br>";
  echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";
  /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
  while($response  = mysqli_fetch_array($rrequest)){

    echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

  }
  echo "</select><br><br>";
  echo "<br><br>";
  echo "<input type='submit' value='Voir le calendrier de cet élève'>";
  echo "</fieldset>";
  echo "</form>";
}

  mysqli_close($connect);



?>

</body>
</html>
