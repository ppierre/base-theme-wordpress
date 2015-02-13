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
    // Le nom de la taxonomie
    const TAXONOMY = "competences";
    // Le type associé à chercher
    const POST_TYPE = 'projet';

    // retrouve la liste des terms (un tableau)
    $taxonomy_terms = get_terms(TAXONOMY);
    // boucle sur les terms
    foreach ($taxonomy_terms as $a_term):
        // pour un terms, cherche les "post" du type défini
        $projets = new WP_Query(array(
            'post_type' => POST_TYPE,
            'taxonomy' => TAXONOMY,
            'term' => $a_term->slug,
            'nopaging' => true,
        )); ?>
        <h3><!-- Titre d'une liste correspondant à un terme (avec lien vers la page du terme) -->
            <a href="<?php echo esc_url(get_term_link($a_term, TAXONOMY)) ?>" rel="tag">
                <?php echo esc_html($a_term->name); ?>
            </a>
        </h3>
        <?php
        // boucle sur les contenus qui correspondent à ce terme
        while ($projets->have_posts()): $projets->the_post(); ?>
        <div>
            <h4><!-- Titre d'un contenu (avec lien vers la page du contenu) -->
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
            <?php the_excerpt(); ?>
        </div>
        <?php
        // fin de la boucle des contenus correspondant à un terme
        endwhile;
        ?>

<?php
    // fin de la boucle des termes
    endforeach;
?>


<!-- inclus footer.php -->
<?php get_footer(); ?>