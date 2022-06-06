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

//récupération des données reçu depuis le formulaire HTML et vérification injection SQL et éxécution de scripts
$idseance = $_POST['idseance'];
$idseance = mysqli_real_escape_string($connect, $idseance);
$idseance = htmlspecialchars($idseance);

//requête pour connaitre tous les élèves qui sont inscrit à une séance précise choisie par l'utilisateur

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


$val = 0; // la variable val va nous permettre de savoir combien de fois il va falloir fetch array ! On ne sait pas combien de gens sont inscrits
echo "<fieldset style='margin-left:0%'>";
echo "<legend><h1>Récapitulatif de la saisie :</h1></legend>";
while($val<($nombre_participants)){
  $val++;
  $name = "ideleve".$val;
  $ideleve = $_POST[$name];
  //on récupère les données du formulaire avec cette astuce d'assigner un nom qui dépend du nombre de valeur envoyés, on a juste besoin de savoir le nombre de valeurs envoyés
  $prenom = $tab['prenom'];
  $nom = $tab['nom'];
  $note=$_POST[$val];
  $tab = mysqli_fetch_array($request1); // on fait bouger le curseur de ligne pour afficher correctement les noms

  //on différencie les cas où l'utilisateur n'a pas rentré de note et quand il a rentré une note
  if(isset($_POST[$val]) and !is_numeric($_POST[$val])){
    echo "<p>".$nom." ".$prenom;
    echo ": pas de note rentrée </p><br>";
  }

  else{

    //vérification sur la valeur de la note
    if($note<0 or $note>40){
      echo "<p>Attention : Valeur rentrée non valide, veuillez rentrer une valeur entre 0 et 40.</p><br>";
      echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
      echo "<a class='space' href='valider_seance.php'><input class='buttonclick'type='button' value='Retour'/></a>";
      exit;
    }
    else{
      //on calcule la note par rapport au nombre d'erreur rentrée par l'utilisateur
      $newnote = 40 - $note;
      //on met à jour la BDD par rapport aux informations renntrées
      $request_note = mysqli_query($connect, "UPDATE inscription SET note = '$newnote' WHERE ideleve='$ideleve'");

      if (!$request_note){
        echo "<br>erreur".mysqli_error($connect);
        exit;
        }
      echo "<p>".$nom." ".$prenom." : la note '".$newnote."/40' a bien été enregistrée</p><br>"; //affiche la note rentrée par l'utilisateur
    }
  }
}
echo "</fieldset>";
echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
echo "<a class='space' href='valider_seance.php'><input class='buttonclick'type='button' value='Valider séances'/></a>";


mysqli_close($connect);
?>
<footer>
  <p class="copyright"><?php  include('footer.php'); ?></p>
</footer>

</body>
</html>
