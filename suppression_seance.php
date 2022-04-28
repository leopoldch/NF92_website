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
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
mysqli_set_charset($connect, 'utf8');
// récupération de la date du jour mise dans $aujourdhui
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");

$result = mysqli_query($connect,"SELECT * FROM seances WHERE supprime = 0");
/*La ligne du dessus représente la requete qui permet à php de récupérer les données demandés (ici en l'occurence la liste des
noms qui sont présent dans notre tableau) et de les trier par ordre alphabétique.*/
//On place sous forme de tableau les données récupérées dans la requête
$resultCount=mysqli_num_rows($result);
/*On vérifie qu'il y ait des thèmes selectionnables, sinon l'opération est impossible*/
if($resultCount == 0){
  echo"<p>il faut ajouter un thème pour pouvoir ajouter une séance";
  echo "<a href='ajout_seance.php' target='contenu'> Retour <a>";
}
/*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
else{
  echo "<form method='post' action='supprimer_seance.php'>";
  echo "<fieldset style='width: 50%; height: 15%'>";
  echo "<label for='menuchoixseance_supp'> Veuillez selectionner la séance à supprimer </label>";
  echo "<select name='menuchoixseance_supp' id='menuchoixseance_supp' size='4' style='width:35%; text-align: center'>";

  /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
  while($response = mysqli_fetch_array($result)) {

    $num = $response['Idtheme'];
    $result_nom = mysqli_query($connect,"SELECT nom FROM theme WHERE idtheme=$num");
    $nom = mysqli_fetch_array($result_nom);
    $nom= $nom['nom'];

    echo "<option value=".$response['idseance'].">".$response['DateSeance'].' / '.$nom."</option>";
  }


  echo "</select><br><br>";
  echo "<input type='submit' value='Valider la suppression'>";
  echo "</form>";
  echo "</fieldset>";



}
mysqli_close($connect);
?>
</body>
</html>
