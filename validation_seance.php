<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class="title">Valider une séance</h1>

<?php

include('connexion.php');
// récupération de la date du jour mise dans $aujourdhui
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");



if(empty($_POST['menuchoixseance'])){
  echo "<div class='retour'>";
  echo"<p>Veuillez à bien selectionner une séance </p>";
  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a class='space' href='valider_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
}
else{
  $idseance = $_POST['menuchoixseance'];
  $idseance = mysqli_real_escape_string($connect, $idseance);
  $idseance = htmlspecialchars($idseance);
  $request1 = mysqli_query($connect,"SELECT * FROM seances WHERE idseance=$idseance");
  $nombre_participants = mysqli_fetch_array($request1);
  $nombre_participants= $nombre_participants['nb_inscrits'];


  $request = mysqli_query($connect,"SELECT * FROM inscription INNER JOIN eleves WHERE eleves.ideleve = inscription.ideleve AND idseance=$idseance");
  if (!$request){
    echo "<br>erreur".mysqli_error($connect);
    exit;
    }

  if(mysqli_num_rows($request) == 0){
    echo "<div class='retour'>";
    echo "<p>Attention : Il n'y a pas d'élèves inscrits à cette séance </p>";
    echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
    echo "<a class='space' href='inscription_eleve.php'><input class='buttonclick'type='button' value='Inscriptions'/></a></div>";
    exit;
  }

  echo "<fieldset style='width:auto; height:auto;'>";
  echo "<legend><p> Notation </p></legend>";
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
  echo "<input class='formbutton' type='submit' value='Evaluer'>";
  echo "<input class='formbutton' type='reset' value='Réinitialiser'>";
  echo "</form>";
  echo "</fieldset>";
}



?>
<footer>
  <p class="copyright"><?php  include('footer.php'); ?></p>
</footer>

</body>
</html>
