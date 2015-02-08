<!--
    'taxonomy-competences-CSS.php' : Template utilisé quand on doit afficher
        les pages correspondant à la "competences" "CSS"
    Rq. C’est pour les termes des taxonomies personnalisé :
        'taxonomy-nomTaxonomie-terme.php'
-->
<?php get_header(); ?>
<h1>taxonomy-competences-CSS.php : liste les pages correspondant à la "competences" "CSS"</h1>
<p><?php echo esc_html(term_description()); ?></p>
<?php
    while ( have_posts() ): the_post();
?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php
    endwhile
?>

<?php get_footer(); ?>