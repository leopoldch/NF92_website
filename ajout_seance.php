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

$result = mysqli_query($connect,"SELECT * FROM theme WHERE supprime=0 ORDER BY nom ASC");
if (!$result){
  echo "<br>erreur".mysqli_error($connect);
  exit;
  }

/*La ligne du dessus représente la requete qui permet à php de récupérer les données demandés (ici en l'occurence la liste des
noms qui sont présent dans notre tableau) et de les trier par ordre alphabétique.*/
//On place sous forme de tableau les données récupérées dans la requête
$resultCount=mysqli_num_rows($result);
/*On vérifie qu'il y ait des thèmes selectionnables, sinon l'opération est impossible*/
if($resultCount== 0){
  echo "<div class='retour'>";
  echo"<p>Il faut ajouter un thème pour pouvoir ajouter une séance</p><br>";
  echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
  echo "<a href='ajout_theme.html'><input class='buttonclick' type='button' value='Ajout thème' /></a></div>";
}
/*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
else{
  echo "<form method='post' action='ajouter_seance.php'>";
  echo "<fieldset>";
  echo "<legend><p>Selection thème</p></legend>";
  echo "<label for='menuchoixtheme'> Veuillez selectionner un thème </label><br><br>";
  echo "<select name='menuchoixtheme' id='menuchoixtheme' size='4' style='width:20%; text-align: center'>";
  /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
  while($response = mysqli_fetch_array($result)) {
    echo "<option value=".$response['idtheme'].">".$response['nom']."</option>";
  }
  echo "</select><br><br>";
  echo "<label for='date_inscription'>Date de la séance </label><input type='date' id='date_inscription' name='date_inscription' data-date='' data-date-format='DD MMMM YYYY' min='$aujourdhui'><br><br>";
  echo "<label for='effectif'> Effectif </label><br>";
  echo "<input class='text' type='number' name='effectif' id='effectif'> </input><br>";
  echo "<br><br>";
  echo "<input class='formbutton' type='submit' value='Enregistrer'>";
  echo "</form>";
  echo "</fieldset>";



}
mysqli_close($connect);
?>
<footer>
  <p class="copyright"><?php  include('footer.php'); ?></p>
</footer>
</body>
</html>
