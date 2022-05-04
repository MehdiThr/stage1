<?php

if(session_status()!=PHP_SESSION_ACTIVE) session_start();

//require 'vue/v_header.php'; // entête des pages HTML
// inclure les bibliothèques de fonctions
//require_once 'app/_config.inc.php';
require_once 'controller/modele/PdoCine.php';

// Connexion au serveur et à la base (A)
$db = PdoCine::getPdoCine();
?>
<html>
<!-- Entête -->
<head>
    <title>CinePhalsbourg - Connexion</title>
	<!--<link rel="shortcut icon" type="image/x-icon" href="ic_launcher.png" />-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" media="all" href="style_d.css" type="text/css" />-->
	<!--<link rel="stylesheet" media="all" href="bulma.css" type="text/css" />-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/lib/cine.js"></script>
    <script src="assets/lib/sha512.js"></script>
</head>
<header></header>
<body>
<?php
// Si aucun utilisateur connecté, on considère que la page demandée est la page de connexion
//   $_SESSION['idUtilisateur']  est crée lorsqu'un utilisateur autorisé se connecte (dans c_connexion.php)


if (!isset($_SESSION['idMembre'])) {
    require 'controller/c_connexion.php';


} else {   
    if ($_SESSION['typeMembre']=='admin'){
        require 'controller/c_membres.php';
    }
    if ($_SESSION['typeMembre']=='projectionniste'){
        require 'vues/v_passmodif.php';
    }
    
}


// Fermeture de la connexion (C)
$db = null;

// pied de page
//require('vue/v_footer.html');
?>
</body>
<footer>
</footer>
</html>
