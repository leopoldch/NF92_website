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

        $result = mysqli_query($connect,"SELECT * FROM inscription");
        if (!$result){
          echo "<br>erreur".mysqli_error($connect);
          exit;
          }
        $responseCount1=mysqli_num_rows($result);
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

        else{
          echo "<form method='POST' action='desinscrire_seance_selection.php'>";
          echo "<fieldset>";
          echo "<legend><p>Choisir élèves</p></legend>";
          echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour les inscrire </label><br>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result2)){

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

          }
          echo "</select><br><br>";
          echo "<br><br>";
          echo "<input class='formbutton' type='submit' value='Voir les séances'>";
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
