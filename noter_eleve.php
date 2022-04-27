<?php

$dbhost = 'localhost:3307';
$dbuser = 'root'; // remplacer les sxxx avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = ''; // remplacer votremotdepasse par votre mot de passe
$dbname = 'nf92p018'; // remplacer les sxxx comme indiqué ci-desus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8

//vérification que les champs soient bien remplis par l'utilisateur
if(empty($_POST['menuchoixelevenote']) or empty($_POST['note'])){
  echo "<p>Veuillez remplir tous les champs</p>";
  echo "<a href=note_eleve.php> Retour </a>";
  exit();
}

$eleve = $_POST['menuchoixelevenote'];
$note = $_POST['note'];

if($note < 0 or $note > 20){
  echo"<p> Vous devez renseigner une note comprise entre 0 et 20</p>";
  echo "<a href=note_eleve.php> Retour </a>";
  exit();
}



$query = "SELECT * FROM inscription";
$result = mysqli_query($connect, $query);
$response=mysqli_fetch_array($result);

if(!$response){
  echo "<p>Vous devez d'abord inscrire un élève avant de pouvoir le noter<p><br>";
  echo "<a href='note_eleve.php'>retour</a>";
}
else{
    if($response['note'] != -1 ){ //on vérifie qu'il n'y ait pas déjà une note de rentrée si il y en a déjà une on va demander à l'utilisateur de valider qu'il veut rentrer sa note
    echo "<p>La note suivante a déjà été attribué à l'élève : ".$response['note']."/20 , voulez vous vraiment continuer la saisie ? </p>";
    ?>
  <form method='POST' action='valider_note.php'>
    <input type="hidden" name='note' value='<?php echo $note; ?>'>
    <input type="hidden" name='eleve' value='<?php echo $eleve; ?>'>
    <input type='submit' value='Oui'>
    <input type="button" value="Non" onclick="history.go(-1)">
  </form>
    <?php
    }
    else{
      $query = "UPDATE  inscription SET note = '$note' WHERE ideleve = '$eleve'";
      $result = mysqli_query($connect, $query);
      echo "<p>La note a bien été prise en compte  </p>";
      echo "<a href=note_eleve.php> Retour </a>";
    }
}

mysqli_close($connect);

?>
