<!--
    'taxonomy-competences.php' : Template utilisé quand on doit afficher
        les pages correspondant à une certaine "competences" (passer dans l'URL)
    Rq. C'est pour les taxonomies personnalisé : 'taxonomy-nomTaxonomie.php'
-->
<?php get_header(); ?>

<h1>taxonomy-competences.php : liste les pages correspondant à une certaine "competences"</h1>
<?php
    while ( have_posts() ): the_post();
?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php
    endwhile
?>

<?php get_footer(); ?>