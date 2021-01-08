<?php

include './Router.php';

Router::Get('accuiel', '/accueil', 'vitrine.accueil');

Router::Get('contact', '');
Router::Get('apropos', '');
Router::Get('connexion', '');
Router::Get('404', '');

Router::Get('recherche', '');

Router::Get('cycle', 'admin.cycle.index');

Router::Get('document', 'admin.document.index');

Router::Get('enseignant', 'admin.enseignant.index');

Router::Get('utilisateur', 'admin.utilisateur.index');