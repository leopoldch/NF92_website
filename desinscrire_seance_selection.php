<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="title">désinscrire un élève</h1>


  <?php

  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p018';
  $dbpass = 'vE5DSom3';
  $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');
        date_default_timezone_set('Europe/Paris');
        $date = date("Ymd");

        if(empty($_POST['menuchoixeleve'])){
            echo"<p>Veuillez à bien selectionner un élève </p>";
            echo "<a href='desinscription_seance.php'><input class='buttonclick'type='button' value='Retour'/></a>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            exit;
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $verification_inscription = mysqli_query($connect,"SELECT * FROM inscription
            INNER JOIN seances
            ON inscription.idseance = seances.idseance
            INNER JOIN theme
            ON seances.idtheme = theme.idtheme
            WHERE DateSeance > $date
            AND ideleve = $ideleve");

          $nombreinscription = mysqli_num_rows($verification_inscription);

          if($nombreinscription == 0){
            echo "<p>L'élève n'est inscrit à aucune séance à venir </p>";
          }
          else{

            echo "<form method='POST' action='desinscrire_seance.php'>";

            echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour désinscrire l'élève </label><br>";
            echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

            while($response  = mysqli_fetch_array($verification_inscription)){
              echo "<option value=".$response['idseance'].">".$response['nom'].' / '.$response['DateSeance']."</option>";
            }
            echo "</select><br><br>";
            echo "<input type='hidden' name ='ideleve' value='$ideleve'>";
            echo "<br><br>";
            echo "<input type='submit' value='Choisir cette séance'>";
            echo "</form>";
          }
        }

          mysqli_close($connect);
          ?>

  </body>
</html>
