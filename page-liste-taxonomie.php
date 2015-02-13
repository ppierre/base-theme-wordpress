<!--
    'page-liste-taxonomie.php' : template personnalisé pour la page 'Liste Taxonomie' (a créé dans WP)
    Le nom "Liste Taxonomie" est utilisé pour construire l'URL de la page : "liste-taxonomie".
    "liste-taxonomie" est le 'slug' : l'identifiant textuel de la page.
-->

<!-- inclus header.php -->
<?php get_header(); ?>

<h1>page-liste-taxonomie.php : exemple de listing personalisé d'une taxonomie</h1>
<?php
    // pas besoin de boucle
    the_post();
?>
        <!-- Le contenu de la page à saisir dans WordPress -->
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>

<h2> Liste la taxonomie compétences</h2>

<ul>
    <?php
        // retrouve la liste des terms (un tableau)
        $taxonomy_terms = get_terms("competences");
        // boucle sur les terms
        foreach ($taxonomy_terms as $a_term):
    ?>
            <h3><!-- Titre d'une liste correspondant à un terme (avec lien vers la page du terme) -->
                <a href="<?php echo esc_url(get_term_link($a_term)) ?>" rel="tag">
                    <!-- le nom du terme -->
                    <?php echo esc_html($a_term->name); ?>
                    <!-- le nombre de contenus correspondants au terme -->
                    ( <?php echo esc_html($a_term->count); ?> )
                </a>
            </h3>
            <!-- Affiche la description du terme -->
            <p><?php echo esc_html($a_term->description); ?></p>
            <!-- Pour les autres informations sur un terme de taxonomie :
            http://codex.wordpress.org/Function_Reference/get_terms#Return_Values
            -->

    <?php
        // fin de la boucle des termes
        endforeach;
    ?>
</ul>


<!-- inclus footer.php -->
<?php get_footer(); ?>