<!--
    'front-page.php' une page ou une liste suivant les reglages pour la page d accueil
-->

<!-- inclus header.php -->
<?php get_header(); ?>

<h1>front-page.php template de la page d'accueil</h1>
<?php
    // début de la boucle WordPress, ici le contenu normal de la page d'accueil.
    // http://codex.wordpress.org/Settings_Reading_SubPanel#Reading_Settings
    while ( have_posts() ): the_post();
?>
        <!-- Pour chaque contenu à afficher,
             éventuellement une seule page si elle est mise comme page d'accueil -->
        <h3><?php the_title(); // affiche le titre ?></h3>
        <?php the_content(); // et le contenu ?>
<?php
    // fin de la boucle WordPress
    endwhile
?>

<!-- Seconde boucle avec WP_Query -->
<h3> Affiche deux projets </h3>
<?php
    // Fais une requête sur les projets, limitée à deux résultats.
    $projet = new WP_Query('post_type=projet&posts_per_page=2');
    /* la boucle est identique à une boucle normale.
       Simplement, tout est préfixé par : "$projet->..." */
    while ($projet->have_posts()): $projet->the_post(); ?>
            <div>
                <h3>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <?php the_excerpt(); ?>
            </div>
<?php
    // fin de la boucle
    endwhile;
?>

<!-- inclus footer.php -->
<?php get_footer(); ?>