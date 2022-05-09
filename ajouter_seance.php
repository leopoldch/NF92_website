<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class='title'>Ajout d'une séance</h1>

<?php

include('connexion.php');

// récupération de la date du jour mise dans $aujourdhui
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");

//vérification que les champs soient bien remplis par l'utilisateur
if(empty($_POST['date_inscription']) or empty($_POST['menuchoixtheme']) or empty($_POST['effectif'])){
  echo "<div class='retour'>";
  echo "<p>Attention : Veuillez remplir tous les champs.</p>";
  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
  exit();
}

$selected_date=$_POST['date_inscription'];
$idtheme=$_POST['menuchoixtheme'];
$effectif=$_POST['effectif'];

$selected_date = mysqli_real_escape_string($connect, $selected_date);
$idtheme = mysqli_real_escape_string($connect, $idtheme);
$effectif = mysqli_real_escape_string($connect, $effectif);

if($effectif < 1){
  echo "<div class='retour'>";
  echo"<p>Attention : Vous ne pouvez pas rentrer un effectif inférieur à 1.</p>";
  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
  exit();
}



if($selected_date < $aujourdhui){
  echo "<div class='retour'>";
  echo"<p>Attention : Vous ne pouvez pas rentrer une date inférieure à aujourd'hui.</p>";
  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
  exit();
}

$result1 = mysqli_query($connect, "SELECT * FROM seances WHERE idtheme ='$idtheme' AND DateSeance='$selected_date'");
if (!$result1){
  echo "<br>erreur".mysqli_error($connect);
  exit;
  }
if (mysqli_num_rows($result1) != 0 ) {

  $nomtheme = mysqli_query($connect, "SELECT nom FROM theme WHERE idtheme ='$idtheme' AND supprime = 0");
  $nom = mysqli_fetch_array($nomtheme);
  $nom= $nom['nom'];

  echo "<div class='retour'>";
  echo "<p>La séance prévue le ".$selected_date." sur les ".$nom." existe déjà, ajout annulé. </p>";
  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
}
else{
      $query = "INSERT INTO seances VALUES (NULL,"."'$selected_date'".","."'$effectif'".","."'$idtheme'".","."'0'".")";
      $result = mysqli_query($connect, $query);
      if (!$result){
        echo "<br>erreur".mysqli_error($connect);
        exit;
        }
        echo "<div class='retour'>";
        echo "<p>La séance a bien été ajouté. </p>";
        echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
        echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
}


?>
<footer>
  <p class="copyright"><?php  include('footer.php'); ?></p>
</footer>

</body>
</html>
