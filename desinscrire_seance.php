<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

        <?php

        $dbhost = 'tuxa.sme.utc/pma/';
        $dbuser = 'nf92p018';
        $dbpass = 'vE5DSom3';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        $ideleve = $_POST['ideleve'];


        if(empty($_POST['menuchoixseance'])){
          echo"<p>Veuillez à bien selectionner une séance</p>";
          echo"<a href='inscription_eleve'>Réitérer la désinscription</a>";
        }
        else{
          $idseance = $_POST['menuchoixseance'];
          $resquest = mysqli_query($connect,"DELETE FROM inscription WHERE ideleve = $ideleve AND idseance = $idseance ");

          echo "<p>L'élève a bien été désincrit</p><br>";
          echo "<a href='inscription_eleve.php'>Inscrire un nouvel élève</a><br>";
          echo "<a href='bienvenue.html'>Accueil</a><br>";
          }




          mysqli_close($connect);


          ?>

  </body>
</html>
