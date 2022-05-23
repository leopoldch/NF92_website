<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class="title">Désinscrire un élève</h1>

        <?php

        include('connexion.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        //requete pour récupérer toutes les inscriptions, il faut vérifier qu'il existe des personnes inscrits pour en désisncrire

        $result = mysqli_query($connect,"SELECT * FROM inscription");
        if (!$result){
          echo "<br>erreur".mysqli_error($connect);
          exit;
          }
        $responseCount1=mysqli_num_rows($result);

        //requete pour récupérer toutes les élèves, il faut vérifier qu'il existe des élèves pour en désisncrire

        $result2 = mysqli_query($connect,"SELECT * FROM eleves");
        if (!$result2){
          echo "<br>erreur".mysqli_error($connect);
          exit;
          }
        $responseCount2=mysqli_num_rows($result2);


        if($responseCount1 == 0 or $responseCount2 == 0){
          echo "<div class='retour'>";
          echo"<p>Attention : Il faut avoir au moins un élève inscrit pour pouvoir le désinscrire.</p> ";
          echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          echo "<a class='space' href='isncription_eleve.php'><input class='buttonclick'type='button' value='Inscriptions'/></a></div>";
        }

        // S'il y a bien des inscriptions et des élèves alors on va proposer la selection à l'utiisateur
        else{
          echo "<form method='POST' action='desinscrire_seance.php'>";
          echo "<fieldset>";
          echo "<legend><p>Désinscription</p></legend>";
          echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour les désinscrire </label><br>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result2)){

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

          }
          echo "</select><br><br>";
          echo "<br><br>";

          //affichage de la date de la séance pour pouvoir les différencier

          $request = mysqli_query($connect,"SELECT *
          FROM seances
          INNER JOIN theme
          WHERE seances.idtheme = theme.idtheme
          AND seances.DateSeance > '$date'");

          if (!$request){
            echo "<br>erreur".mysqli_error($connect);
            exit;
          }

        echo "<label for='menuchoixseance'> Veuillez selectionner une séance </label><br>";
        echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

        while($response  = mysqli_fetch_array($request)){
            echo "<option value=".$response['idseance'].">".$response['nom'].' / '.$response['DateSeance']."</option>";
          }
            echo "</select><br><br>";




          echo "<input class='formbutton' type='submit' value='Valider'>";
          echo "</fieldset>";
          echo "</form>";
        }

          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
