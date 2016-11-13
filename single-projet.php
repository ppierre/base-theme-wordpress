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
        <?php the_post_thumbnail('portrait'); //affiche l'image à la une ?>
<!-- On obtient les champs personnalisés avec la fonction 'get_post_custom()' -->
        <?php $custom_fields = get_post_custom(); ?>

<!-- N'est pas affiché dans la page : regarder le code HTML pour voir

     C’est un tableau associatif contenant les valeurs dans des tableaux
                    <?php print_r($custom_fields);
                    /* Array (
                        [pp_url] => Array
                            (
                                [0] => http://mon.projet.org/
                            )
                       )*/?>
     Les valeurs sont classées par l’identifiant choisi lors de la déclaration du champ
     Ex. 'pp_url' : <?php print_r($custom_fields["pp_url"]);
                    /*Array
                    (
                        [0] => http://mon.projet.org/
                    )*/?>
     Comme les valeurs peuvent être multiples, elles sont toujours sous la forme d’un tableau
     Si la valeur est unique, il suffit :
     Ex. 'pp_url' : <?php print_r($custom_fields["pp_url"][0]);
                    /*        http://mon.projet.org/ */ ?>
-->
        <!-- Exemple d’usage d’un champ personnalisé pour l’URL d’un lien -->
        <p><a href="<?php echo esc_url($custom_fields["pp_url"][0]) ?>">lien du projet</a></p>

    <!-- Ou utiliser les fonctions fournies par "meta box" :
    http://metabox.io/docs/get-meta-value/
    Elles retournent automatiquement une seule valeur ou un tableau suivant les cas.
    Ex. 'pp_url' : <?php print_r(rwmb_meta("pp_url"));
                /*        http://mon.projet.org/ */ ?>
    -->


    <!-- Pour les champs mulptiples (ici images), il peut être nécessaire de demander un tableau :
        Ex. 'pp_images' : <?php print_r(rwmb_meta("pp_images", array('multiple' => true)));
    /*  Array ( [0] => 71, [1] => 72 ) */ ?>
    -->

        <h4>Listes d'images</h4>
        <ul>
            <!-- Récupère le tableau de la liste des images (liste d'ID d'autres formats possibles)
    Va simplement faire une boucle affichant chaque image.
            -->
            <?php $listImagesID = get_post_meta(get_the_ID(),"pp_images",false);
                  foreach($listImagesID as $imageID => $imageObj):
            ?>
            <!-- Fonction la plus simple pour afficher une image : juste lui passer l'ID et la taille
    D'autres fonctions existent pour plus de personnalisation ou pour obtenir l'URL et autre renseignement.-->
            <li><?php echo wp_get_attachment_image($imageID,'paysage'); ?></li>

            <?php endforeach; ?>
        </ul>
<?php
    endwhile
?>

<?php get_footer(); ?>
