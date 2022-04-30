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
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        $ideleve = $_POST['ideleve'];





        if(empty($_POST['menuchoixseance'])){
          echo"<p>Veuillez à bien selectionner une séance</p>";
          echo"<a href='inscription_eleve'>Réitérer l'inscription</a>";
        }
        else{
          $idseance = $_POST['menuchoixseance'];


          $verification_inscription = mysqli_query($connect,"SELECT * FROM inscription WHERE ideleve= $ideleve  AND idseance = $idseance ");
          $nb_erreur = mysqli_num_rows($verification_inscription);
          if($nb_erreur ! = 0){
            echo "<p>L'élève est déjà inscrit à cette séance, vous ne pouvez pas l'ajouter deux fois à une même séance</p>";
            echo "<a href='inscrire_eleve.php'>Inscrire un élève</a>";
            echo "<a href='bienvenue.html'>Accueil</a>";
          }
          else{
            $resquest = mysqli_query($connect,"INSERT INTO inscription VALUES("."'$idseance'".","."'$ideleve'".","."'-1'".") ");

            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<a href='inscription_eleve.php'>Inscrire un nouvel élève</a>";
            echo "<a href='bienvenue.html'>Accueil</a>";
          }

        }



          mysqli_close($connect);


          ?>

  </body>
</html>
