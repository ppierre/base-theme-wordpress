<!--
    'index.php' : Template par défaut.
    Rq. pour la page d'accueil, c'est :
      'home.php' pour une liste de Posts (Articles)
      'front-page.php' une page ou une liste suivant les réglages

    Eg. il est préférable d'utiliser un Template plus spécialisé
      'archive.php' pour les listes de Posts (Articles)
      Et d'autres : http://codex.wordpress.org/Template_Hierarchy
-->

<!-- inclus header.php -->
<?php get_header(); ?>

<h1>index.php : template par défaut</h1>
<?php
    // début de la boucle WordPress
    while ( have_posts() ): the_post();
?>
        <!-- Pour chaque contenu à afficher -->
        <h3>
            <!-- Fais un lien vers la page du contenu à afficher -->
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); // affiche le titre ?>
            </a>
        </h3>
<?php
    // fin de la boucle WordPress
    endwhile
?>

<!-- inclus footer.php -->
<?php get_footer(); ?>