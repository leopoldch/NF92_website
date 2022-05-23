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
        $date = date("Y-m-d");

        // requete pour connaitre le nombre de séance encore disponibles

        $result = mysqli_query($connect,"SELECT * FROM seances
          WHERE DateSeance > '$date'
          AND nb_inscrits < EffMax");


        if (!$result){
          echo "<br>erreur".mysqli_error($connect);
          exit;
          }


        $responseCount1=mysqli_num_rows($result);

        //on récupère les élèves
        $result2 = mysqli_query($connect,"SELECT * FROM eleves");


        if (!$result2){
          echo "<br>erreur".mysqli_error($connect);
          exit;
          }


        $responseCount2=mysqli_num_rows($result2);


        // si pas de séance ou pas d'élève opération impossible --> message d'erreur

        if($responseCount1 == 0 or $responseCount2 == 0){
          echo "<div class='retour'>";
          echo"<p>Attention : Il faut avoir au moins une séance libre et un élève ajouté.</p><br>";
          echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          echo "<a class='space' href='inscription_eleve.php'><input class='buttonclick' type='button' value='retour'/></a></div>";
        }

        else{

          //sinon on propose la sélection

          echo "<fieldset>";
          echo "<legend><p>Inscription</p></legend>";
          echo "<form method='POST' action='inscrire_eleve.php'>";
          echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour les inscrire </label><br>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";

          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result2)){

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

          }
          echo "</select><br><br>";
          echo "<br><br>";

          //requête pour afficher les séances encore dispo, dans le futur (pas inscrire dans le passé) et là où les thèmes ne sont pas supprimés

          $request = mysqli_query($connect,"SELECT *
          FROM seances
          INNER JOIN theme
          WHERE seances.idtheme = theme.idtheme
          AND seances.DateSeance > '$date'
          AND seances.nb_inscrits < seances.EffMax
          AND theme.supprime <> 1;");

          if (!$request){
            echo "<br>erreur".mysqli_error($connect);
            exit;
          }

          echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour inscrire l'élève </label><br>";
          echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

          while($response  = mysqli_fetch_array($request)){
            echo "<option value=".$response['idseance'].">".$response['nom'].' / '.$response['DateSeance']."</option>";
          }
          echo "</select><br><br>";

          echo "<input class='formbutton' type='submit' value='Valider'>";
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
