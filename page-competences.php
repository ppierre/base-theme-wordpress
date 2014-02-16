<!--
    'page-competences.php' : template personnalisé pour la page 'competences' (a créer dans WP)
    Volontairement nommé comme la taxonomie servira d'accueil de cette taxonomie.
-->

<!-- inclus header.php -->
<?php get_header(); ?>

<h1>page-competences.php : sert d'accueil de la taxonomie "competences"</h1>
<?php
    // pas besoin de boucle
    the_post();
?>
        <!-- Le contenu de la page à saisir dans WordPress -->
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>

<!-- Seconde boucle avec WP_Query -->
<h2> Liste les projets classés par la taxonomie compétences</h2>
<?php
    // retrouve la liste des compétences (un tableau)
    $competences = get_terms("competences");
    // boucle sur les compétences
    foreach ($competences as $une_competence):
        // pour une compétence, cherche les projets
        $projets = new WP_Query(array(
            'post_type' => 'projet',
            'taxonomy' => 'competences',
            'term' => $une_competence->slug,
            'nopaging' => true,
        )); ?>
        <h3><!-- Titre d'une compétences (avec lien) -->
            <a href="<?php echo esc_url(get_term_link($une_competence, 'competences')) ?>" rel="tag">
                <?php echo $une_competence->name ?>
            </a>
        </h3>
        <?php
        // boucle sur les projet qui ont cette compétences
        while ($projets->have_posts()): $projets->the_post(); ?>
        <div>
            <h4>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
            <?php the_excerpt(); ?>
        </div>
        <?php
        // fin de la boucle des projets d'une compétence
        endwhile;
        ?>

<?php
    // fin de la boucle des compétences
    endforeach;
?>


<!-- inclus footer.php -->
<?php get_footer(); ?>