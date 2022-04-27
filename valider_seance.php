<html>
    <body>

        <?php

        $dbhost = 'localhost:3307';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

        date_default_timezone_set('europe/paris');
        $aujourdhui = date("y\-m\-d");

        if(empty($_POST['menuchoixseance'])){
          echo "<p>Veuillez à bien selectionner une séance</p>";
          echo "<a href='validation_seance.php' target='contenu' > Retour </a>";
        }

        $idseance = $_POST['menuchoixseance'];


        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8
        $result = mysqli_query($connect,"SELECT ideleve FROM inscription WHERE idseance = $idseance ");

        $response=mysqli_fetch_array($result);

        if(!$response){
          echo"<p>Il faut avoir au moins un élève inscrit à cette séance </p> ";
          echo "<a href='ajout_eleve.html' target='contenu'> Retour <a>";
        }






        /*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
        else{
          echo "<form method='post' action='noter_eleve.php'>";
          echo "</select><br><br>";
          echo "<fieldset style='width: 50%;''>";
          echo "<label for='menuchoixelevenote'> Veuillez selectionner un élève </label>";
          echo "<select name='menuchoixelevenote' id='menuchoixelevenote' size='4' style='width:20%; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response = mysqli_fetch_array($result)) {
            echo "<option value=".$response['ideleve'].">".$response['nom'].$response['prenom']."<br><br>";
          }
          echo "</select><br><br>";
          echo "<label for='note'> Veuillez rentrer la note </label>";
          echo "<input type='number' name='note' id='note' > </input><br>";
          echo "<br><br>";
          echo "<input type='submit' value='enregistrer séance'>";
          echo "</form>";
          echo "</fieldset>";
        }
          mysqli_close($connect);


          ?>

  </body>
</html>
