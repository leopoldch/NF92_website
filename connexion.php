<?php

        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92p018';
        $dbpass = 'vE5DSom3';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

          ?>
