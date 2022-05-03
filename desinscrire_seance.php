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
          echo "<div class='retour'>";
          echo"<p>Veuillez à bien selectionner une séance</p>";
          echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          echo "<a href='desinscription_seance_selection.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
        }
        else{
          $idseance = $_POST['menuchoixseance'];
          $idseance = mysqli_real_escape_string($connect, $idseance);
          $request = mysqli_query($connect,"DELETE FROM inscription WHERE ideleve = $ideleve AND idseance = $idseance ");
          if (!$request){
            echo "<br>erreur".mysqli_error($connect);
            exit;
            }
          echo "<div class='retour'>";
          echo "<p>L'élève a bien été désincrit</p><br>";
          echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          echo "<a href='desinscription_seance_selection.php'><input class='buttonclick'type='button' value='Desinscriptions'/></a></div>";
          }




          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
