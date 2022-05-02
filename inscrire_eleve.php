<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>

        <?php

        include('connexion.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        $ideleve = $_POST['ideleve'];
        $ideleve = mysqli_real_escape_string($connect, $ideleve);





        if(empty($_POST['menuchoixseance'])){
          echo"<p>Veuillez à bien selectionner une séance</p>";
          echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='réitérer l'inscription'/></a>";
          echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
        }
        else{
          $idseance = $_POST['menuchoixseance'];
          $idseance = mysqli_real_escape_string($connect, $idseance);


          $verification_inscription = mysqli_query($connect,"SELECT * FROM inscription WHERE ideleve= $ideleve  AND idseance = $idseance ");
          $nb_erreur = mysqli_num_rows($verification_inscription);
          if($nb_erreur != 0){
            echo "<p>L'élève est déjà inscrit à cette séance, vous ne pouvez pas l'ajouter deux fois à une même séance</p>";
            echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='inscrire un élève'/></a>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }
          else{
            $resquest = mysqli_query($connect,"INSERT INTO inscription VALUES("."'$idseance'".","."'$ideleve'".","."'-1'".") ");
            $incrementation_nbinscrits = mysqli_query($connect,"UPDATE seances Set nb_inscrits=nb_inscrits+1 where idseance=$idseance ");

            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<a href='inscription_eleve.php'><input class='buttonclick'type='button' value='Inscrire un élève'/></a>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }

        }



          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
