<!--
    'archive-projet.php' : Template utilisé quand on doit afficher la liste des "projet".
    Rq: C'est pour les types personnalisés : 'archive-nomDuType.php'
-->
<?php get_header(); ?>

<h1>achive-projet.php : liste des «projet»</h1>
<?php
    while ( have_posts() ): the_post();
?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php
    endwhile
?>

<?php get_footer(); ?>