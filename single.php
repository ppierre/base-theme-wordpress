<!--
    'single.php' : Template utilisé quand on doit afficher la page d'un Post (Article).
    Rq: pour une Page c'est : 'page.php'

    Eg. est utilisée pour afficher l'intégralité du Post
-->

<!-- inclus header.php -->
<?php get_header(); ?>

<h1>single.php : un seul Post</h1>

<?php
    // début de la boucle WordPress
    while ( have_posts() ): the_post();
?>
        <h3><?php the_title(); // affiche le titre ?></h3>
        <?php the_content(); // affiche le contenu ?>

        <?php comments_template(); // affiche les commentaires du Post ?>
<?php
    // fin de la boucle WordPress
    endwhile
?>

<!-- inclus footer.php -->
<?php get_footer(); ?>