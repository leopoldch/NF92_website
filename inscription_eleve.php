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
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en utf-8
        $result = mysqli_query($connect,"SELECT * FROM seances WHERE supprime = 0 ");
        $resultbis = mysqli_query($connect,"SELECT * FROM eleve");
        /*La ligne du dessus représente la requete qui permet à php de récupérer les données demandés (ici en l'occurence la liste des
        noms qui sont présent dans notre tableau) et de les trier par ordre alphabétique.*/
        //On place sous forme de tableau les données récupérées dans la requête
        $responseCount1=mysqli_num_rows($result);
        $responseCount2=mysqli_num_rows($resultbis);

        /*On vérifie qu'il y ait des thèmes selectionnables, sinon l'opération est impossible*/
        if($responseCount1 == 0 or $responseCount2 == 0){
          echo"<p>Il faut avoir au moins une séance et un élève ajouté ";
          echo "<a href='inscription_eleve.php' target='contenu'> Retour <a>";
        }
        /*S'il existe des thèmes dans notre table theme, alors on affiche notre formulaire pour ajouter une séance */
        else{
          echo "<form method='post' action='inscrire_eleve.php'>";
          echo "<select><br><br>";
          echo "<fieldset style='width: 50%;''>";
          echo "<label for='menuchoixseance'> Veuillez selectionner une séance pour inscrire un élève </label>";
          echo "<select name='menuchoixseance' id='menuchoixseance' size='4' style='width:20%; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response = mysqli_fetch_array($result)) {

            $nomtheme = mysqli_query($connect,"SELECT nom FROM theme WHERE idtheme = {$response['idtheme']} ");

            echo "<option value=".$response['idseance'].">".$response['Date Seance']." / ".$nomtheme."<br><br>";
          }
          echo "</select><br><br>";

          echo "<select><br><br>";
          echo "<fieldset style='width: 50%;''>";
          echo "<label for='menuchoixeleve'> Veuillez selectionner une séance pour inscrire un élève </label>";
          echo "<select name='menuchoixeleve' id='menuchoixeleve' size='4' style='width:20%; text-align: center'>";
          /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
          while($response  = mysqli_fetch_array($result)) {

            $nomtheme = mysqli_query($connect,"SELECT nom FROM theme WHERE idtheme = {$response['idtheme']} ");

            echo "<option value=".$response['idseance'].">".$response['Date Seance']." / ".$nomtheme."<br><br>";
          }
          echo "</select><br><br>";




          echo "<br><br>";
          echo "<input type='submit' value='enregistrer séance'>";
          echo "</form>";
          echo "</fieldset>";

          mysqli_close($connect);


          ?>

  </body>
</html>
