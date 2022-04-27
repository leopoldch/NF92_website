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

        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8
        $result = mysqli_query($connect,"SELECT * FROM seances WHERE ('Date Seance' <= CURDATE() and supprime = 0)");
        /*La ligne du dessus représente la requete qui permet à php de récupérer les données demandés (ici en l'occurence la liste des
        noms qui sont présent dans notre tableau) et de les trier par ordre alphabétique.*/
        //On place sous forme de tableau les données récupérées dans la requête
        $response=mysqli_fetch_array($result);
        /*On vérifie qu'il y ait des thèmes selectionnables, sinon l'opération est impossible*/
        if(!$response){
          echo"<p>Il faut avoir au moins une séance ajouté ";
          echo "<a href='ajout_eleve.html' target='contenu'> Retour <a>";
        }
        /*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
        else{
          echo "<form method='post' action='valider_seance.php'>";
          echo "</select><br><br>";
          echo "<fieldset style='width: 50%;''>";
          echo "<label for='menuchoixseance'> Veuillez selectionner la séance </label>";
          echo "<select name='menuchoixseance' id='menuchoixseance' size='4' style='width:20%; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response = mysqli_fetch_array($result)) {
            echo "<option value=".$response['idseance'].">"."Séance du ".$response['Date Seance']."<br><br>";
          }
          echo "</select><br><br>";
          echo "<input type='submit' value='Valider'>";
          echo "<input type='button' value='Retour' onclick='history.go(-1)''>";
          echo "</form>";
          echo "</fieldset>";
        }
          mysqli_close($connect);


          ?>

  </body>
</html>
