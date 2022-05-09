<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class="title">Calendrier </h1>

        <?php

        include('connexion.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Ymd");




        if( empty($_POST['menuchoixeleve'])){
          echo "<div class='retour'>";
          echo"<p>Attention : Veuillez à bien selectionner un élève .</p>";
          echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          echo "<a class='space' href='visualisation_calendrier_eleve.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $ideleve = mysqli_real_escape_string($connect, $ideleve);

          $request_inscription = mysqli_query($connect, "SELECT * FROM inscription
            INNER JOIN seances
            ON inscription.idseance = seances.idseance
            INNER JOIN theme
            ON theme.idtheme = seances.idtheme
            WHERE inscription.ideleve = $ideleve");
          if(!$request_inscription){
            echo "<br>erreur".mysqli_error($connect);
            exit;
          }

          $nb = mysqli_num_rows($request_inscription);

          if($nb == 0){

            $seances = mysqli_query($connect, "SELECT * FROM seances
            INNER JOIN theme ON seances.idtheme = theme.idtheme
            WHERE DateSeance > $date");

            echo "<fieldset>";
            echo "<legend><h1>L'élève n'a encore réalisé aucune séance, voici celles qui lui reste à faire </h1></legend>";
            while($response = mysqli_fetch_array($seances)){
                echo"<p>".$response['nom'].'  '.$response['DateSeance']."</p>";
            }
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='visualisation_calendrier_eleve.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
            echo "</fieldset>";


          }
          else{

            $donnee = '';
            while($response = mysqli_fetch_array($request_inscription)){

              $donnee = $donnee.' AND theme.idtheme <> '.$response['idtheme'];
            }

            $seances = mysqli_query($connect, "SELECT * FROM `inscription`
            INNER JOIN seances ON seances.idseance = inscription.idseance
            INNER JOIN theme ON seances.idtheme = theme.idtheme
            WHERE DateSeance > $date
            $donnee");

            if(!$seances){
              echo "<br>erreur".mysqli_error($connect);
              exit;
            }

            if (mysqli_num_rows($seances) == 0 ){
              echo "<div class='retour'>";
              echo "<p>L'élève a effectué ou est inscrit à toutes les séances possibles</p>";
              echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
              echo "<a class='space' href='visualisation_calendrier_eleve.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
              exit;
            }



            echo "<fieldset>";
            echo "<legend><h1>Voici les séances sur les thème que l'élève n'a pas encore effectué</h1></legend>";
            while($response = mysqli_fetch_array($seances)){
                echo"<p>".$response['nom'].'  '.$response['DateSeance']."</p>";
            }
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='visualisation_calendrier_eleve.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
            echo "</fieldset>";



          }
        }




          mysqli_close($connect);


          ?>
         <footer>
            <p class="copyright"><?php // include('footer.php'); ?></p>
          </footer>

  </body>
</html>
