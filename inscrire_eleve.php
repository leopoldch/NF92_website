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

        if(empty($_POST['menuchoixseance'])){
            echo"<p>Veuillez à bien selectionner une seance </p>";
            echo"<a href='inscription_eleve.php'>Retour à la page précédente</a>";
            exit;
        }

      /*  elseif () {
          echo"<p>Veuillez à bien selectionner au moins un élève </p>";
          echo"<a href='inscription_eleve.php'>Retour à la page précédente</a>";
          exit;
        } */

        $seance = $_POST['menuchoixseance'];
        $result = mysqli_query($connect,"SELECT * FROM seances WHERE supprime = 0 AND nb_inscrits<EffMax");

        echo $_POST['menuchoixeleve'];


        /*
        else{
          $request1 = mysqli_query($connect,"UPDATE seances Set nb_inscrits=nb_inscrits+1 where idseance=$seance");
          $request2 = mysqli_query($connect,"INSERT INTO inscription VALUES("."'$seance'".", "."'$nom'".","."'-1'".");
");
        }
        */

          mysqli_close($connect);


          ?>

  </body>
</html>
