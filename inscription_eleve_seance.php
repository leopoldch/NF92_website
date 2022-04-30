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
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        if(empty($_POST['menuchoixeleve'])){
            echo"<p>Veuillez à bien selectionner un élève </p>";
            echo"<a href='inscription_eleve.php'>Retour à la page précédente</a>";
            exit;
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $verfication_seance = mysqli_query($connect,"SELECT * FROM seances
            INNER JOIN inscription
            WHERE 'seances.idseance' = 'inscription.idseance'
            AND 'seances.DateSeance' > $date
            AND 'seances.nb_inscrits'<'seances.EffMax'");

          $nombreseances = mysqli_num_rows($verfication_seance);

          if($nombreseances == 0){
            echo "<p>Vous devez d'abord ajouter une séance</p>";
            exit;
          }


            $verfication_inscription = mysqli_query($connect,"SELECT * FROM seances
            INNER JOIN inscription
            WHERE 'seances.idseance' = 'inscription.idseance'
            AND 'seances.DateSeance' > $date
            AND 'seances.nb_inscrits'<'seances.EffMax'
            AND 'inscription.ideleve' != $ideleve");

            $nombreseances_disponibles= mysqli_num_rows($verfication_inscription);

          if($nombreseances_disponibles == 0){
            echo "<p>L'élève est déjà inscrit à toutes les séances disponibles </p>";
          }
          else{


            $request = mysqli_query($connect,"SELECT *
            FROM inscription
            INNER JOIN seances
            ON 'inscription.idseance' = 'seances.idseance'
            INNER JOIN theme
            ON 'seances.idtheme' = 'theme.idtheme'
            WHERE 'seances.DateSeance' > $date
            AND 'seances.nb_inscrits'<'seances.EffMax'
            AND 'inscription.ideleve' != $ideleve;");

            echo "<form method='POST' action='inscrire_eleve.php'>";

            echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour les inscrire </label><br>";
            echo "<select name='menuchoixseance' id='menuchoixseance' multiple size='4' style='width:auto; text-align: center'>";

            while($response  = mysqli_fetch_array($request)){
              echo "<option value=".$response['idseance'].">".$response['nom'].' / '.$response['DateSeance']."</option>";
            }
            echo "</select><br><br>";
            echo "<br><br>";
            echo "<input type='submit' value='Choisir cette séance'>";
            echo "</form>";
          }
        }

          mysqli_close($connect);
          ?>

  </body>
</html>
