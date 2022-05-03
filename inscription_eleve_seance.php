<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class="title">Inscrire un élève </h1>


  <?php

  include('connexion.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Ymd");

        if(empty($_POST['menuchoixeleve'])){
            echo "<div class='retour'>";
            echo"<p>Veuillez à bien selectionner un élève </p>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
            exit;
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $ideleve = mysqli_real_escape_string($connect, $ideleve);
          $verification_seance = mysqli_query($connect,"SELECT * FROM seances
            WHERE DateSeance > $date
            AND nb_inscrits < EffMax");
            if (!$verification_seance){
              echo "<br>erreur".mysqli_error($connect);
              exit;
              }

          $nombreseances = mysqli_num_rows($verification_seance);

          if($nombreseances == 0){
            echo "<div class='retour'>";
            echo "<p>Vous devez d'abord ajouter une séance</p>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a href='ajout_seance.php'><input class='buttonclick'type='button' value='Ajout séance'/></a></div>";
          }
          else{


            $request = mysqli_query($connect,"SELECT *
            FROM seances
            INNER JOIN theme
            WHERE seances.idtheme = theme.idtheme
            AND seances.DateSeance > $date
            AND seances.nb_inscrits<seances.EffMax;");
            if (!$request){
              echo "<br>erreur".mysqli_error($connect);
              exit;
              }

            echo "<fieldset>";
            echo "<legend><p>Choisir Séance</p></legend>";
            echo "<form method='POST' action='inscrire_eleve.php'>";

            echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour inscrire l'élève </label><br>";
            echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

            while($response  = mysqli_fetch_array($request)){
              echo "<option value=".$response['idseance'].">".$response['nom'].' / '.$response['DateSeance']."</option>";
            }
            echo "</select><br><br>";
            echo "<input type='hidden' name ='ideleve' value='$ideleve'>";
            echo "<br><br>";
            echo "<input class='formbutton' type='submit' value='Choisir'>";
            echo "</form>";
            echo "</fieldset>";
          }
        }

          mysqli_close($connect);
          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
