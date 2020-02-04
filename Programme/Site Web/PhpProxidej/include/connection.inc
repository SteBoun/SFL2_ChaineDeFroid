<?php

$PARAM_hote = 'localhost';
$PARAM_port = '3306';
$PARAM_nom_bd = 'test';
$PARAM_user = 'root';
$PARAM_mdp = '';
$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd,$PARAM_user,$PARAM_mdp);
