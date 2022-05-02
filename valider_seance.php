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

//la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8
$result = mysqli_query($connect,"SELECT * FROM seances INNER JOIN theme WHERE seances.idtheme=theme.idtheme;");

/*La ligne du dessus représente la requete qui permet à php de récupérer les données demandés (ici en l'occurence la liste des
noms qui sont présent dans notre tableau) et de les trier par ordre alphabétique.*/
//On place sous forme de tableau les données récupérées dans la requête
$resultCount=mysqli_num_rows($result);

/*On vérifie qu'il y ait des thèmes selectionnables, sinon l'opération est impossible*/
if($resultCount == 0){
  echo"<p>il faut ajouter une séance pour pouvoir noter des élèves</p><br>";
  echo "<br><a href='ajout_seance.php'><input class='buttonclick'type='button' value='ajout séance'/></a><br>";
  echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
}
/*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
else{
  echo "<form method='post' action='validation_seance.php'>";
  echo "<fieldset style='width: 50%;>";
  echo "<label for='menuchoixseance'> Veuillez selectionner une séance </label>";
  echo "<select name='menuchoixseance' id='menuchoixseance' size='4' style='width:35%; text-align: center'>";
  /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
  while($response = mysqli_fetch_array($result)) {
    echo "<option value=".$response['idseance'].">".$response['DateSeance'].' / '.$response['nom']."</option>";
  }
  echo "</select><br><br>";
  echo "<br><br>";
  echo "<input type='submit' value='Voir les élèves pour cette séance'>";
  echo "</fieldset>";
  echo "</form>";



}
mysqli_close($connect);
?>
<footer>
  <p class="copyright">Auto école © 2022</p>
</footer>

</body>
</html>
