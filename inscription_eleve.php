<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="title">Inscrire un élève </h1>

        <?php

        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92p018';
        $dbpass = 'vE5DSom3';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');


        $result = mysqli_query($connect,"SELECT * FROM seances WHERE  nb_inscrits<EffMax");
        $responseCount1=mysqli_num_rows($result);
        $result2 = mysqli_query($connect,"SELECT * FROM eleves");
        $responseCount2=mysqli_num_rows($result2);

        if($responseCount1 == 0 or $responseCount2 == 0){
          echo"<p>Il faut avoir au moins une séance et un élève ajouté ";
          echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='retour'/></a>";
          echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
        }

        else{
          echo "<form method='POST' action='inscription_eleve_seance.php'>";

          echo "<fieldset>";

          echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour les inscrire </label><br>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result2)){

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

          }
          echo "</select><br><br>";
          echo "<br><br>";
          echo "<input type='submit' value='Inscrire ces élèves'>";
          echo "</fieldset>";
          echo "</form>";
        }

          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright">Auto école © 2022</p>
          </footer>

  </body>
</html>
