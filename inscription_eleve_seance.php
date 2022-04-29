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

        if(empty($_POST['menuchoixeleve'])){
            echo"<p>Veuillez à bien selectionner un élève </p>";
            echo"<a href='inscription_eleve.php'>Retour à la page précédente</a>";
            exit;
        }
        else{
          $ideleve = $_POST['menuchoixeleve'];
          $result_verification = mysqli_query($connect,"SELECT * FROM inscription WHERE ideleve='$ideleve'");
          $responseCount1=mysqli_num_rows($result_verification);

          if ($responseCount1 == 0){
            $result = mysqli_query($connect,"SELECT * FROM seances WHERE nb_inscrits < EffMax");
            $result_verif=mysqli_num_rows($result);
            if($result_verif == 0){
              echo "<p>Il faut ajouter des séances pour pouvoir inscrire des élèves </p>";
            }
            else{
              echo "<form method='POST' action='inscrire_eleve.php'>";
              echo "<select name='selection_seance'  multiple size='4' style='width:auto; text-align: center' >";

            while($response  = mysqli_fetch_array($result)){

              $idtheme = $response['idtheme'];
              $result_nom = mysqli_query($connect,"SELECT * FROM theme WHERE idtheme=$idtheme");
              $tab = mysqli_fetch_row($result_nom);
              $nom= $tab['nom'];
              echo "<option value=".$response['idseance'].">  ".$nom.$response['DateSeance']." </option>";

            }
            echo "</select><br><br>";
            echo "<br><br>";
            echo "<input type='hidden' value='$ideleve' name='ideleve'>";
            echo "<input type='submit' value='Inscrire ces élèves'>";
            echo "</form>";
          }
        }
          else{
            $recupid = mysqli_query($connect,"SELECT * FROM inscription WHERE ideleve='$ideleve''");

            echo "<form method='POST' action='inscrire_eleve.php'>";
            echo "<select name='selection_seance'  multiple size='4' style='width:auto; text-align: center' >";

            while($tab = mysqli_fetch_array($recupid)){
              $idseance_inscrit=$tab['idseance'];
              $result = mysqli_query($connect,"SELECT * FROM seances WHERE nb_inscrits<EffMax' AND idseance != '$idseance'");

              if(mysqli_num_rows($result) == 0){
                echo "Cet élève est déjà inscrit à toutes les séances</p>";
                exit;
              }
              
              while($response  = mysqli_fetch_array($result)){

                $idtheme = $response['idtheme'];
                $result_nom = mysqli_query($connect,"SELECT * FROM theme WHERE idtheme='$idtheme'");
                $tab = mysqli_fetch_row($result_nom);
                $nom= $tab['nom'];
                echo "<option value=".$response['idseance'].">  ".$nom.$response['DateSeance']." </option>";

              }

            }
            echo "</select><br><br>";
            echo "<br><br>";
            echo "<input type='hidden' value='$ideleve' name='ideleve'>";
            echo "<input type='submit' value='Inscrire ces élèves'>";
            echo "</form>";
          }
          }




          mysqli_close($connect);


          ?>

  </body>
</html>
