<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body>

        <?php

        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92p018';
        $dbpass = 'vE5DSom3';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

          $selected_date =$_POST["date"];
          $idtheme=$_POST["idtheme"];
          $effectif=$_POST["effectif"];
          $valider=$_POST['valider'];

          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");

          if ($valider == 1){
            //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
            $query = "INSERT INTO seances VALUES (NULL,"."'$selected_date'".","."'$effectif'".","."'$idtheme'".","."'0'".")";
            $result = mysqli_query($connect, $query);
            // $query utilise comme parametre de mysqli_query
            // le test ci-dessous est desormais impose pour chaque appel de :
            // mysqli_query($connect, $query)
            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<br><a href='ajout_seance.php'><input class='buttonclick'type='button' value='retour'/></a><br>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }
          else{
            echo "<p>L'inscription a bien été annulée</p>";
            echo "<br><a href='ajout_seance.php'><input class='buttonclick'type='button' value='retour'/></a><br>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }

          mysqli_close($connect);


          ?>

  </body>
</html>
