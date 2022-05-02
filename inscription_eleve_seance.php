<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>


  <?php

  include('connexion.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Ymd");

        if(empty($_POST['menuchoixeleve'])){
            echo"<p>Veuillez à bien selectionner un élève </p>";
            echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='retour'/></a>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            exit;
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $ideleve = mysqli_real_escape_string($connect, $ideleve);
          $verfication_seance = mysqli_query($connect,"SELECT * FROM seances
            WHERE DateSeance > $date
            AND nb_inscrits < EffMax");

          $nombreseances = mysqli_num_rows($verfication_seance);

          if($nombreseances == 0){
            echo "<p>Vous devez d'abord ajouter une séance</p>";
            echo "<a href='ajout_seance.php'><input class='buttonclick'type='button' value='ajouter une séance'/></a>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }
          else{


            $request = mysqli_query($connect,"SELECT *
            FROM seances
            INNER JOIN theme
            WHERE seances.idtheme = theme.idtheme
            AND seances.DateSeance > $date
            AND seances.nb_inscrits<seances.EffMax;");

            echo "<form method='POST' action='inscrire_eleve.php'>";

            echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour inscrire l'élève </label><br>";
            echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

            while($response  = mysqli_fetch_array($request)){
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
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
