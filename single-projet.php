<!--
    'single-projet.php' : Template utilisé quand on doit afficher la page d’un "projet".
    Rq: C’est pour les types personnalisés : 'single-nomDuType.php'
-->
<?php get_header(); ?>

<h1>single-projet.php : un seul projet (type personnalisé)</h1>

<?php
    while ( have_posts() ): the_post();
?>
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>

<!-- On obtient les champs personnalisés avec la fonction 'get_post_custom()' -->
        <?php $custom_fields = get_post_custom(); ?>
<!--
     C’est un tableau associatif contenant les valeurs dans des tableaux
                    <?php print_r($custom_fields); ?>
     Les valeurs sont classées par l’identifiant choisi lors de la déclaration du champ
     Ex. 'pp_url' : <?php print_r($custom_fields["pp_url"]); ?>
     Comme les valeurs peuvent être multiples, elles sont toujours sous la forme d’un tableau
     Si la valeur est unique, il suffit :
     Ex. 'pp_url' : <?php print_r($custom_fields["pp_url"][0]); ?>
-->
        <!-- Exemple d’usage d’un champ personnalisé pour l’URL d’un lien -->
        <p><a href="<?php echo esc_url($custom_fields["pp_url"][0]) ?>">lien du projet</a></p>

<?php
    endwhile
?>

<?php get_footer(); ?>