<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="title">Consulter les informations d'un élève</h1>

        <?php

        $dbhost = 'localhost:3307';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');


        $result = mysqli_query($connect,"SELECT * FROM eleves");
        $responseCount=mysqli_num_rows($result);

        if($responseCount == 0 ){
          echo"<p>Il faut avoir au moins un élève inscrit pour pouvoir consulter ses informations </p><br> ";
          echo "<a href='ajout_eleve.html' target='contenu'> ajout d'un élève <a><br>";
          echo "<a href='bienvenue.html' target='contenu'> Accueil <a>";
        }

        else{
          echo "<form method='POST' action='consulter_eleve.php'>";
          echo "<fieldset>";

          echo "<label for='ideleve'> Veuillez selectionner des élèves pour les inscrire </label><br>";
          echo "<select name='ideleve' id='ideleve' multiple size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result)){

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."</option><br><br>";

          }
          echo "</select><br><br>";
          echo "<br><br>";
          echo "<input type='submit' value='Voir les informations de cet élève'>";
          echo "</fieldset>";
          echo "</form>";
        }

          mysqli_close($connect);


          ?>

  </body>
</html>
