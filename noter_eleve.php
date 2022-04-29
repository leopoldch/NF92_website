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
date_default_timezone_set('europe/paris');
$aujourdhui = date("Y-m-d");

$idseance = $_POST['idseance'];

$request1 = mysqli_query($connect,"SELECT * FROM seances WHERE idseance=$idseance");
$nombre_participants = mysqli_fetch_array($request1);
$nombre_participants= $nombre_participants['nb_inscrits'];

$val = 0;
echo "<h1>Récapitulatif de la saisie :</h1>";
while($val<=($nombre_participants+1)){
  $val++;
  $name = "ideleve".$val;
  $ideleve = $_POST[$name];
  $request_nom = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve=$ideleve");
  $tab = mysqli_fetch_array($request_nom);
  $nom= $tab['nom'];
  $prenom = $tab['prenom'];
  $note=$_POST[$val];

  if(empty($note) and $note != 0 ){
    echo "<p>".$nom." ".$prenom;
    echo ": pas de note rentrée ";
  }

  else{

    if($note<0 or $note>40){
      echo "<p>Valeur rentrée non valide, veuillez rentrer une valeur entre 0 et 40</p>";
      echo "<a href='valider_seance.php>Retour</a>'";
    }
    else{
      $ideleve = $_POST[$name];
      $newnote= 40 - $note;
      $request_note = mysqli_query($connect, "UPDATE inscription SET note = '$note' WHERE ideleve='$ideleve'");
      echo "<p>".$nom." ".$prenom." : la note '".$newnote."' a bien été enregistrée";
    }
  }

}




mysqli_close($connect);
?>

</body>
</html>
