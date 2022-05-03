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
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");

$idseance = $_POST['idseance'];
$idseance = mysqli_real_escape_string($connect, $idseance);

$request1 = mysqli_query($connect,"SELECT * FROM inscription
  INNER JOIN eleves ON eleves.ideleve = inscription.ideleve
  INNER JOIN seances ON seances.idseance = inscription.idseance
  WHERE seances.idseance=$idseance;");
  if (!$request1){
    echo "<br>erreur".mysqli_error($connect);
    exit;
    }

$tab = mysqli_fetch_array($request1);
$nombre_participants= $tab['nb_inscrits'];

$val = 0;
echo "<h1 style='margin:auto;'>Récapitulatif de la saisie :</h1>";
echo "<fieldset style='width:auto;height:auto;'>";
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
      echo "<a href='validation_seance.php'><input class='buttonclick'type='button' value='retour'/></a>";
      echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
    }
    else{
      $newnote = 40 - $note;
      $request_note = mysqli_query($connect, "UPDATE inscription SET note = '$newnote' WHERE ideleve='$ideleve'");
      if (!$request_note){
        echo "<br>erreur".mysqli_error($connect);
        exit;
        }
      echo "<p>".$nom." ".$prenom." : la note '".$newnote."/40' a bien été enregistrée</p><br>";
    }
  }
echo "</fieldset>";
}
echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
echo "<a href='validation_seance.php'><input class='buttonclick'type='button' value='Valider séances'/></a>";


mysqli_close($connect);
?>
<footer>
  <p class="copyright"><?php  include('footer.php'); ?></p>
</footer>

</body>
</html>
