<!doctype html>
<!-- Code HTML qui est commun au début de toutes les pages -->
<!-- Balise HTML ouverte dans header.php et fermée dans footer.php -->
<html>
<head>
    <title><?php wp_title("|",true,"right") ?><?php bloginfo('name'); ?></title>
    <!-- Juste avant la balise de fermeture de HEAD : wp_head();
         Ici WordPress ajoutera les liens (LINK) vers les ressources externes
         Eg. les feuilles de styles CSS -->
    <?php wp_head(); ?>
</head>
<!-- Balise BODY ouverte dans header.php et fermée dans footer.php
     WordPress peut ajouter des Class CSS
     variant suivant le type de contenu à afficher : 'body_class()'-->
<body <?php body_class(); ?>>
<header>
    <!-- 'home_url()' donne l’URL saisie comme URL d’accueil lors de l’installation -->
    <h1><a href="<?php echo home_url() ?>">Accueil</a></h1>
    <!-- 'wp_nav_menu(...)' permet d’afficher un menu dont le contenu est saisi
         dans l’interface d’administration -->
    <?php wp_nav_menu( array(
        'theme_location' => 'principale',
        'container'=> 'nav'
    )); ?>
</header>