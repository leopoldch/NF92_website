<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

        <?php

        $dbhost = 'localhost:3307';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');


        $result = mysqli_query($connect,"SELECT * FROM seances WHERE supprime = 0 AND nb_inscrits<EffMax");
        $responseCount1=mysqli_num_rows($result);
        $result2 = mysqli_query($connect,"SELECT * FROM eleves");
        $responseCount2=mysqli_num_rows($result2);

        if($responseCount1 == 0 or $responseCount2 == 0){
          echo"<p>Il faut avoir au moins une séance et un élève ajouté ";
          echo "<a href='inscription_eleve.php' target='contenu'> Retour <a>";
        }

        else{
          echo "<form method='post' action='inscrire_eleve.php'>";
          echo "<fieldset style='width: 50%;''>";
          echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour inscrire un élève </label>";
          echo "<select name='menuchoixseance' id='menuchoixseance' size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response = mysqli_fetch_array($result)) {

            $num = $response['Idtheme'];
            $result_nom = mysqli_query($connect,"SELECT nom FROM theme WHERE idtheme=$num");
            $nom = mysqli_fetch_array($result_nom);
            $nom= $nom['nom'];
            $places = $response['EffMax'] - $response['nb_inscrits'];
            echo "<option value=".$response['idseance'].">".$nom." / ".$response['DateSeance'].' / places disponibles :'.$places."</option>";
            }

          echo "</select><br><br>";

          echo "<label for='menuchoixeleve'> Veuillez selectionner des élèves pour les inscrire </label><br>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' multiple size='4' style='width:auto; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result2))

            echo "<option value=".$response['ideleve'].">".$response['nom'].' '.$response['prenom']."<br><br>";
            echo "</select><br><br>";
            echo "<br><br>";
            echo "<input type='submit' value='Inscrire ces élèves'>";
            echo "</form>";
          }



          mysqli_close($connect);


          ?>

  </body>
</html>
